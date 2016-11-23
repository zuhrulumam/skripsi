<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Helper\AHP;
use App\Helper\FuzzyAhp;
use App\Models\UserQuestions;
use App\Models\Categories;
use App\Models\Questions;
use App\Models\Users;
use App\Models\Experts;
use App\Models\ExpertsQuestions;
use App\Models\ExpertAnswers;
use App\Helper\NewAHP;
use App\Helper\NewFuzzyAHP;
use App\Models\SubCategories;
use App\Models\DataDosen;

class CalculationAHPController extends Controller {

    public function checkAccessed($completedUser) {
        $everAccessedUser = [];
        $neverAccessedUser = [];
        $countCompletedUser = count($completedUser);
        for ($j = 0; $j < $countCompletedUser; $j++) {
            $countAnswers = count($completedUser[$j]->getAnswers);
            for ($i = 0; $i < $countAnswers; $i++) {
                $currQuestionId = $completedUser[$j]->getAnswers[$i]->rel_question_id;

                if ($currQuestionId == 31) {
                    $answer = $completedUser[$j]->getAnswers[$i]->rel_answer;
                    if ($answer == 1) {
                        array_push($everAccessedUser, $completedUser[$j]);
                    } else {
                        array_push($neverAccessedUser, $completedUser[$j]);
                    }
                }
            }
        }

        $result = [
            'ever' => $everAccessedUser,
            'never' => $neverAccessedUser
        ];

        return $result;

//        print_r('Penah mengakses ' . count($everAccessedUser) . '<br>');
//        print_r('Belum Pernah mengakses ' . count($neverAccessedUser));
    }

    public function subfactor($type, $condition) {

        $users = Users::orderBy("id", 'asc')->get();

        $countUser = count($users);
//        $countUser = 8000;
//        print_r($users->count());
        //array user yang sudah complete
        $completedUser = [];

        for ($i = 0; $i < $countUser; $i++) {
            $currUser = $users[$i];
            $currKeterangan = json_decode($currUser->keterangan);

            if ($currKeterangan->answered == 2) {
                if ($currKeterangan->type == $type) {
                    array_push($completedUser, $currUser);
                }
            }
        }

        $countCompletedUser = count($completedUser);

        $checkedUser = $this->checkAccessed($completedUser);

        $arrayCategory = [];
        if ($type == 'mahasiswa') {
            $arrayCategory = [2, 3, 5];
        } else if ($type == 'dosen') {
            $arrayCategory = [1, 2, 3, 4, 5];
        }

        $arrayCountPerUserQuestions = [];
        //one by one user answer (nanti ditaruh percubkategori)
        $perUserAnswer = [];

        $userQuestion = Questions::orderBy("question_id", 'asc')->get();
        $countUserQuestion = $userQuestion->count();

        foreach ($arrayCategory as $key => $value) {
            $arrayCountPerUserQuestions[$value] = 0;
        }

        for ($i = 0; $i < $countUserQuestion; $i++) {
            $categoryId = $userQuestion[$i]->question_category_id;
            if (in_array($categoryId, $arrayCategory)) {
                $arrayCountPerUserQuestions[$categoryId] ++;
            }
        }

//        for ($j = 0; $j < $countCompletedUser; $j++) {
//            $countAnswers = count($completedUser[$j]->getAnswers);
//            for ($i = 0; $i < $countAnswers; $i++) {
//                $currQuestionId = $completedUser[$j]->getAnswers[$i]->rel_question_id;
////                print_r($currQuestionId.'<br>');
//                $categoryId = $completedUser[$j]->getAnswers[$i]->getCategory->question_category_id;
//
//                if ($currQuestionId !== 31) {
////                    $index = $currQuestionId - 1;
////                    $categoryId = $userQuestion[$index]->question_category_id;
////                 print_r($categoryId.'<br>');
//                    $perUserAnswer[$categoryId][] = $completedUser[$j]->getAnswers[$i];
//                }
//            }
//        }
        $countCheckedUser = count($checkedUser[$condition]);
        //$countCheckedUser = 300;
        for ($j = 0; $j < $countCheckedUser; $j++) {
            $countAnswers = count($checkedUser[$condition][$j]->getAnswers);
            for ($i = 0; $i < $countAnswers; $i++) {
                $currQuestionId = $checkedUser[$condition][$j]->getAnswers[$i]->rel_question_id;
//                print_r($currQuestionId.'<br>');
//                $categoryId = $checkedUser['ever'][$j]->getAnswers[$i]->getCategory->question_category_id;

                if ($currQuestionId !== 31) {
                    $index = $currQuestionId - 1;
                    $categoryId = $userQuestion[$index]->question_category_id;
//                 print_r($categoryId.'<br>');
                    $perUserAnswer[$categoryId][] = $checkedUser[$condition][$j]->getAnswers[$i];
                }
            }
        }
        $factors = [0.219901599, 0.18527445, 0.189895741, 0.1946323, 0.2095627];

//        $subCategories = SubCategories::orderBy("sub_category_id", 'asc')->get();
        $subFactors = [];
        foreach ($arrayCategory as $key => $value) {
//            $newAhp = new NewAHP($perUserAnswer[$value], $arrayCountPerUserQuestions[$value], $countCompletedUser, $value);
            $newAhp = new NewAHP($perUserAnswer[$value], $arrayCountPerUserQuestions[$value], $countCheckedUser, $value);
            $subfaktorPairwise = $newAhp->createPairwise();
            $subNewPairwise = $newAhp->createNewPairwise();
            $arraySumColumn = $newAhp->columnSum();
            $updatePairwise = $newAhp->updatePairwise();
            $arraySumRow = $newAhp->rowSum();
            $arrayWeightPriority = $newAhp->weightPriority();
            $rank = $newAhp->rank();
            $consistency = $newAhp->consistency();

            //data view
            $userId = $perUserAnswer[$value][0]->rel_user_id;
            $countSubFaktorPairwise = count($subfaktorPairwise);
            $rowSubCount = sqrt(count($subfaktorPairwise["PairwiseUser_" . $userId]));
            $min = $perUserAnswer[$value][0]->getQuestionId->getSubCategory->sub_category_id;
//            $min = $value;
//            print_r($min . '<br>');
//            $index = $value - 1;
//            $sub = $subCategories[$index]->sub_category_id;
//            print_r('sub' . $sub . '<br>');

            $subFactors[$value] = [
                'pairwise' => $subfaktorPairwise,
                'subNewPairwise' => $subNewPairwise,
                'arraySumColumn' => $arraySumColumn,
                'updatePairwise' => $updatePairwise,
                'arraySumRow' => $arraySumRow,
                'arrayWeightPriority' => $arrayWeightPriority,
                'rank' => $rank,
                'consistency' => $consistency,
                'countSubFaktorPairwise' => $countSubFaktorPairwise,
                'rowSubCount' => $rowSubCount,
                'min' => $min
            ];
        }

        return view('calculation.ahpMahasiswa', [
            'subFactors' => $subFactors,
            'factors' => $factors
        ]);
    }

    public function index() {

        $expertAnswers = ExpertAnswers::orderBy("rel_user_id", 'asc')->orderBy("rel_question_id", 'asc')->get();
        $sumExperts = Experts::count();
        $sumExpertsQuestions = ExpertsQuestions::count();

//        $newAhp = new NewAHP($expertAnswers, $sumExpertsQuestions, $sumExperts);
        $newAhp = new NewAHP($expertAnswers, $sumExpertsQuestions, 9, 1);

        $faktorPairwise = $newAhp->createPairwise();

        $newPairwise = $newAhp->createNewPairwise();

        $arraySumColumn = $newAhp->columnSum();

        $updatePairwise = $newAhp->updatePairwise();

        $arraySumRow = $newAhp->rowSum();

        $arrayWeightPriority = $newAhp->weightPriority();

        $rank = $newAhp->rank();

        $consistency = $newAhp->consistency();

        $faktor = [
            'faktorPairwise' => $faktorPairwise,
            'newPairwise' => $newPairwise,
            'arraySumColumn' => $arraySumColumn,
            'updatePairwise' => $updatePairwise,
            'arraySumRow' => $arraySumRow,
            'arrayWeightPriority' => $arrayWeightPriority,
            'rank' => $rank,
            'consistency' => $consistency
        ];

        //subfaktor
//        $countCategory = Categories::count();
//        $userAnswers = UserQuestions::all();
//        $countUserAnswers = $userAnswers->count();
//        $userQuestion = Questions::all();
//        $countUserQuestion = $userQuestion->count();
//        $countUser = Users::count();
//        $perUserAnswers = [];
//        $arrayCountPerUserQuestions = [];
//
//        for ($i = 1; $i <= $countCategory; $i++) {
//            $arrayCountPerUserQuestions[$i] = 0;
//        }
//        for ($i = 0; $i < $countUserQuestion; $i++) {
//            $categoryId = $userQuestion[$i]->question_category_id;
//            $arrayCountPerUserQuestions[$categoryId] ++;
//        }
//        for ($i = 0; $i < $countUserAnswers; $i++) {
//            $categoryId = $userAnswers[$i]->category->question_category_id;
//            $perUserAnswers[$categoryId][] = $userAnswers[$i];
//        }
//        $subFactors = [];
//        for ($i = 1; $i <= $countCategory; $i++) {
//            $newAhp = new NewAHP($perUserAnswers[$i], $arrayCountPerUserQuestions[$i], $countUser, $i);
//            $subfaktorPairwise = $newAhp->createPairwise();
//            $subNewPairwise = $newAhp->createNewPairwise();
//            $arraySumColumn = $newAhp->columnSum();
//            $updatePairwise = $newAhp->updatePairwise();
//            $arraySumRow = $newAhp->rowSum();
//            $arrayWeightPriority = $newAhp->weightPriority();
//            $rank = $newAhp->rank();
//            $consistency = $newAhp->consistency();
//            $subFactors[$i] = [
//                'pairwise' => $subfaktorPairwise,
//                'subNewPairwise' => $subNewPairwise,
//                'arraySumColumn' => $arraySumColumn,
//                'updatePairwise' => $updatePairwise,
//                'arraySumRow' => $arraySumRow,
//                'arrayWeightPriority' => $arrayWeightPriority,
//                'rank' => $rank,
//                'consistency' => $consistency
//            ];
//        }
        return view('calculation.ahp', [
            'faktor' => $faktor,
//            'subFactors' => $subFactors
        ]);
    }

}
