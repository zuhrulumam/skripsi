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

class CalculationFuzzyController extends Controller {

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

//        $users = Users::all();
        $users = Users::orderBy("id", 'asc')->get();
        $countUser = count($users);

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
//            for ($i = 0; $i < count($completedUser[$j]->getAnswers); $i++) {
//                $currQuestionId = $completedUser[$j]->getAnswers[$i]->rel_question_id;
//                $categoryId = $completedUser[$j]->getAnswers[$i]->getCategory->question_category_id;
//
//                if ($currQuestionId !== 31) {
//                    $perUserAnswer[$categoryId] [] = $completedUser[$j]->getAnswers[$i];
//                }
//            }
//        }
                $countCheckedUser = count($checkedUser[$condition]);
//        $countCheckedUser = 285;
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
$factors = [0.33671719519044,0.14289752332143 ,0.26317733871162, 0.10693303127343 , 0.15027491150309 ];
        $subFactors = [];
        foreach ($arrayCategory as $key => $value) {
//            $fuzzy = new NewFuzzyAHP($perUserAnswer[$value], $arrayCountPerUserQuestions[$value], $countCompletedUser, $value);
            $fuzzy = new NewFuzzyAHP($perUserAnswer[$value], $arrayCountPerUserQuestions[$value], $countCheckedUser, $value);

            $faktorPairwise = $fuzzy->createPairwise();

            $newPairwise = $fuzzy->createNewPairwise();
//
            $arrayGeometry = $fuzzy->geometryMean();
//
            $inverseGeometry = $fuzzy->InverseGeometri();
//
            $weight = $fuzzy->weight();
//
            $defuzzy = $fuzzy->defuzzy();
//
            $normalWeight = $fuzzy->normalWeight();

            $rank = $fuzzy->rank();

            //data view
            $userId = $perUserAnswer[$value][0]->rel_user_id;
            $countSubFaktorPairwise = count($faktorPairwise);
            $rowSubCount = sqrt(count($faktorPairwise["PairwiseUser_" . $userId]));
            $min = $perUserAnswer[$value][0]->getQuestionId->getSubCategory->sub_category_id;


            $subFactors[$value] = [
                'pairwise' => $faktorPairwise,
                'newPairwise' => $newPairwise,
                'arrayGeometry' => $arrayGeometry,
                'InverseGeometri' => $inverseGeometry,
                'weight' => $weight,
                'defuzzy' => $defuzzy,
                'normalWeight' => $normalWeight,
                'rank' => $rank,
                'countSubFaktorPairwise' => $countSubFaktorPairwise,
                'rowSubCount' => $rowSubCount,
                'min' => $min
            ];
        }

        return view('calculation.fuzzyMahasiswa', [
            'subFactors' => $subFactors,
			'factors' => $factors        ]);
    }

    public function index() {

        $expertAnswers = ExpertAnswers::orderBy("rel_user_id", 'asc')->orderBy("rel_question_id", 'asc')->get();
        $sumExperts = Experts::count();
        $sumExpertsQuestions = ExpertsQuestions::count();

        $fuzzy = new NewFuzzyAHP($expertAnswers, $sumExpertsQuestions, 9, 1);

        $faktorPairwise = $fuzzy->createPairwise();

        $newPairwise = $fuzzy->createNewPairwise();

        $arrayGeometry = $fuzzy->geometryMean();

        $inverseGeometry = $fuzzy->InverseGeometri();

        $weight = $fuzzy->weight();

        $defuzzy = $fuzzy->defuzzy();

        $normalWeight = $fuzzy->normalWeight();

        $rank = $fuzzy->rank();

        $faktor = [
            'faktorPairwise' => $faktorPairwise,
            'newPairwise' => $newPairwise,
            'arrayGeometry' => $arrayGeometry,
            'InverseGeometri' => $inverseGeometry,
            'weight' => $weight,
            'defuzzy' => $defuzzy,
            'normalWeight' => $normalWeight,
            'rank' => $rank
        ];

//        //subfaktor
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
//
//        $subFactors = [];
//        for ($i = 1; $i <= $countCategory; $i++) {
//            $fuzzy = new NewFuzzyAHP($perUserAnswers[$i], $arrayCountPerUserQuestions[$i], $countUser, $i);
//
//            $faktorPairwise = $fuzzy->createPairwise();
//
//            $newPairwise = $fuzzy->createNewPairwise();
////
//            $arrayGeometry = $fuzzy->geometryMean();
////
//            $inverseGeometry = $fuzzy->InverseGeometri();
////
//            $weight = $fuzzy->weight();
////
//            $defuzzy = $fuzzy->defuzzy();
////
//            $normalWeight = $fuzzy->normalWeight();
//
//            $rank = $fuzzy->rank();
//            $subFactors[$i] = [
//                'pairwise' => $faktorPairwise,
//                'newPairwise' => $newPairwise,
//                'arrayGeometry' => $arrayGeometry,
//                'InverseGeometri' => $inverseGeometry,
//                'weight' => $weight,
//                'defuzzy' => $defuzzy,
//                'normalWeight' => $normalWeight,
//                'rank' => $rank
//            ];
//        }

        return view('calculation.newFuzzy', [
            'factor' => $faktor,
//            'subFactors' => $subFactors
        ]);
    }

}
