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

class CalculationAHPController extends Controller {

    public function subfactor($type) {
        $users = Users::all();
        $countUser = count($users);

        // array untuk menampung mahasiswa dan dosen yang sudah mengisi quesioner
        $completedMahasiswa = [];
        $completedDosen = [];

        // array untuk menampung jawaban mahasiswa dan dosen yang sudah selesai
        $answersMahasiswa = [];
        $answersDosen = [];

        for ($i = 0; $i < $countUser; $i++) {
            $currUser = $users[$i];
            $currKeterangan = json_decode($currUser->keterangan);

            if ($currKeterangan->answered == 2) {
                if ($currKeterangan->type == "mahasiswa") {
                    array_push($completedMahasiswa, $currUser);
//                    array_push($answersMahasiswa, $currUser->getAnswers);
                } elseif ($currKeterangan->type == "dosen") {
                    array_push($completedDosen, $currUser);
//                    array_push($answersDosen, $currUser->getAnswers);
                }
            }
        }

        $countCompletedMahasiswa = count($completedMahasiswa);
        $countCompletedDosen = count($completedDosen);

        //sub faktor mahasiswa
        // jumlah category untuk mahsiswa
        $arrayMahsiswaCategory = [2, 3, 5];
        $arrayCountPerMahasiswaQuestions = [];
        $perMahasiswaAnswer = [];

        $userQuestion = Questions::all();
        $countUserQuestion = $userQuestion->count();

        foreach ($arrayMahsiswaCategory as $key => $value) {
            $arrayCountPerMahasiswaQuestions[$value] = 0;
        }

        for ($i = 0; $i < $countUserQuestion; $i++) {
            $categoryId = $userQuestion[$i]->question_category_id;
            if (in_array($categoryId, $arrayMahsiswaCategory)) {
                $arrayCountPerMahasiswaQuestions[$categoryId] ++;
            }
        }

        for ($j = 0; $j < $countCompletedMahasiswa; $j++) {
            for ($i = 0; $i < count($completedMahasiswa[$j]->getAnswers); $i++) {
                $currQuestionId = $completedMahasiswa[$j]->getAnswers[$i]->rel_question_id;
                $categoryId = $completedMahasiswa[$j]->getAnswers[$i]->category->question_category_id;
                if ($currQuestionId !== 31) {
                    array_push($answersMahasiswa, $completedMahasiswa[$j]->getAnswers[$i]);
                    $perMahasiswaAnswer[$categoryId] [] = $completedMahasiswa[$j]->getAnswers[$i];
                }
            }
        }

        $subFactors = [];
        foreach ($arrayMahsiswaCategory as $key => $value) {
            $newAhp = new NewAHP($perMahasiswaAnswer[$value], $arrayCountPerMahasiswaQuestions[$value], $countCompletedMahasiswa, $value);
            $subfaktorPairwise = $newAhp->createPairwise();
            $subNewPairwise = $newAhp->createNewPairwise();
            $arraySumColumn = $newAhp->columnSum();
            $updatePairwise = $newAhp->updatePairwise();
            $arraySumRow = $newAhp->rowSum();
            $arrayWeightPriority = $newAhp->weightPriority();
            $rank = $newAhp->rank();
            $consistency = $newAhp->consistency();

            //data view
            $userId = $perMahasiswaAnswer[$value][0]->rel_user_id;
            $countSubFaktorPairwise = count($subfaktorPairwise);
            $rowSubCount = sqrt(count($subfaktorPairwise["PairwiseUser_" . $userId]));
            $min = $perMahasiswaAnswer[$value][0]->getQuestionId->getSubCategory->sub_category_id;
//            print_r($min);

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
            'subFactors' => $subFactors
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

    public function fuzzy() {

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

        //subfaktor
        $countCategory = Categories::count();
        $userAnswers = UserQuestions::all();
        $countUserAnswers = $userAnswers->count();
        $userQuestion = Questions::all();
        $countUserQuestion = $userQuestion->count();
        $countUser = Users::count();
        $perUserAnswers = [];
        $arrayCountPerUserQuestions = [];

        for ($i = 1; $i <= $countCategory; $i++) {
            $arrayCountPerUserQuestions[$i] = 0;
        }
        for ($i = 0; $i < $countUserQuestion; $i++) {
            $categoryId = $userQuestion[$i]->question_category_id;
            $arrayCountPerUserQuestions[$categoryId] ++;
        }
        for ($i = 0; $i < $countUserAnswers; $i++) {
            $categoryId = $userAnswers[$i]->category->question_category_id;
            $perUserAnswers[$categoryId][] = $userAnswers[$i];
        }

        $subFactors = [];
        for ($i = 1; $i <= $countCategory; $i++) {
            $fuzzy = new NewFuzzyAHP($perUserAnswers[$i], $arrayCountPerUserQuestions[$i], $countUser, $i);

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
            $subFactors[$i] = [
                'pairwise' => $faktorPairwise,
                'newPairwise' => $newPairwise,
                'arrayGeometry' => $arrayGeometry,
                'InverseGeometri' => $inverseGeometry,
                'weight' => $weight,
                'defuzzy' => $defuzzy,
                'normalWeight' => $normalWeight,
                'rank' => $rank
            ];
        }

        return view('calculation.newFuzzy', [
            'factor' => $faktor,
            'subFactors' => $subFactors
        ]);

//        $data = UserQuestions::all();
//        $sumCategory = Categories::count();
//        $sumQuestion = Questions::count();
//        $sumUsers = Users::count();
//
//        $fuzzy = new FuzzyAhp($data, $sumCategory, $sumQuestion, $sumUsers);
//        $conversion = $fuzzy->FuzzyConversion();
//        $factor = $fuzzy->doCalculate($conversion['ForFactor']);
//
//        $subFactor = [];
//        for ($i = 1; $i <= $sumCategory; $i++) {
//            $subFactor[$i] = $fuzzy->doCalculate($conversion['ForSubFactor'], $i);
//        }
//
//        $result = [
//            'factor' => $factor,
//            'subFactors' => $subFactor
//        ];
//        return view('calculation.fuzzy', ['result' => $result]);
    }

}
