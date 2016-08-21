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

class CalculationController extends Controller {

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
            $newAhp = new NewAHP($perUserAnswers[$i], $arrayCountPerUserQuestions[$i], $countUser, $i);
            $subfaktorPairwise = $newAhp->createPairwise();
            $subNewPairwise = $newAhp->createNewPairwise();
            $arraySumColumn = $newAhp->columnSum();
            $updatePairwise = $newAhp->updatePairwise();
            $arraySumRow = $newAhp->rowSum();
            $arrayWeightPriority = $newAhp->weightPriority();
            $rank = $newAhp->rank();
            $consistency = $newAhp->consistency();
            $subFactors[$i] = [
                'pairwise' => $subfaktorPairwise,
                'subNewPairwise' => $subNewPairwise,
                'arraySumColumn' => $arraySumColumn,
                'updatePairwise' => $updatePairwise,
                'arraySumRow' => $arraySumRow,
                'arrayWeightPriority' => $arrayWeightPriority,
                'rank' => $rank,
                'consistency' => $consistency
            ];
        }
        return view('calculation.ahp', [
            'faktor' => $faktor,
            'subFactors' => $subFactors
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
