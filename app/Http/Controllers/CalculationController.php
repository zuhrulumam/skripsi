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

class CalculationController extends Controller {

    public function index() {

        $expertAnswers = ExpertAnswers::orderBy("rel_user_id", 'asc')->orderBy("rel_question_id", 'asc')->get();
        $sumExperts = Experts::count();
        $sumExpertsQuestions = ExpertsQuestions::count();
        $sumExpertAnswers = ExpertAnswers::count();
        $sumCategory = Categories::count() - 1;

        $newAhp = new NewAHP($expertAnswers, $sumExpertsQuestions, $sumExperts, $sumCategory);

        $faktorPairwise = $newAhp->createPairwise();

        $newPairwise = $newAhp->createNewPairwise();
        
        $arraySumColumn = $newAhp->columnSum();
        
        $updatePairwise = $newAhp->updatePairwise();
       
        $arraySumRow = $newAhp->rowSum(); 
        
        $arrayWeightPriority = $newAhp->weightPriority();
        
        $rank = $newAhp->rank();
        
        $consistency = $newAhp->consistency();
        
        return view('calculation.ahp', [
            'faktorPairwise' => $faktorPairwise,
            'newPairwise' => $newPairwise,
            'arraySumColumn' =>$arraySumColumn,
            'updatePairwise' => $updatePairwise,
            'arraySumRow' => $arraySumRow,
            'arrayWeightPriority' => $arrayWeightPriority,
            'rank' => $rank,
            'consistency' =>$consistency
        ]);


//        
//        $userQuestion = UserQuestions::all();
//        $sumCategory = Categories::count() - 1;
//        $sumQuestion = Questions::count();        
//        $sumUsers = Users::count();
//        
//        
//        
//        $data = [
//            'userQuestions'=>$userQuestion,
//            'expertAnswers'=>$expertAnswers
//        ];
//        
//        $sums = [
//            'sumCategory' => $sumCategory,
//            'sumQuestion' => $sumQuestion,
//            'sumUsers' => $sumUsers,
//            'sumExperts' => $sumExperts,
//            'sumExpertsQuestions' => $sumExpertsQuestions,
//            'sumExpertAnswers' => $sumExpertAnswers,
//        ];
//
//        $ahp = new AHP($data, $sums);       
//        $conversion = $ahp->AHPConversion();
//
//        $factor = $ahp->doCalculate($conversion['ForFactor']);
//
//        $subFactor = [];
//        for ($i = 1; $i <= $sumCategory; $i++) {
//            $subFactor[$i] = $ahp->doCalculate($conversion['ForSubFactor'], $i);
//        }
//
//        $result = [
//            'factor' => $factor,
//            'subFactors' => $subFactor
//        ];
//        $ahp->consistency();
//        $ahp->subFactor();
//        return view('calculation.index', ['rank' => $result['rank'], 'weight' => $result['weight'], 'rowSum' => $result['rowSum'], 'pairwise' => $result['pairwise'], 'columnSum' => $result['columnSum'], 'newPairwise' => $result['newPairwise']]);
//        return view('calculation.index', ['result' => $result]);
    }

    public function fuzzy() {
        $data = UserQuestions::all();
        $sumCategory = Categories::count();
        $sumQuestion = Questions::count();
        $sumUsers = Users::count();

        $fuzzy = new FuzzyAhp($data, $sumCategory, $sumQuestion, $sumUsers);
        $conversion = $fuzzy->FuzzyConversion();
        $factor = $fuzzy->doCalculate($conversion['ForFactor']);

        $subFactor = [];
        for ($i = 1; $i <= $sumCategory; $i++) {
            $subFactor[$i] = $fuzzy->doCalculate($conversion['ForSubFactor'], $i);
        }

        $result = [
            'factor' => $factor,
            'subFactors' => $subFactor
        ];
        return view('calculation.fuzzy', ['result' => $result]);
    }

}
