<?php

namespace App\Helper;

class AHP {

    protected $data;
    protected $sumCategory;
    protected $sumQuestion;
    protected $sumData;
    protected $sumUser;
    protected $arrayCategoryAnswer = []; // for per category per answer
    protected $arrayQuestionAnswer = []; // for per question per answer
    protected $arraySumCategoryAnswer = []; // for per question sum    
    protected $arraySubCategoryAnswer = [];
    protected $arrayPairwise = [];
    protected $arrayColumnSum = [];
    protected $arrayRowSum = [];
    protected $arrayWeightPriority = [];
    protected $arraySumAnswer = [];
    protected $prefix;
    protected $min = 0;
    
    protected $sumExperts;
    protected $sumExpertsQuestions;
    protected $sumExpertAnswers;
    
    protected $userQuestions;
    protected $expertAnswers;

    public function __construct($data, $sums) {
        $this->userQuestions= $data['userQuestions'];
        $this->sumData = count($data['userQuestions']);
        $this->sumCategory = $sums['sumCategory'];           
        $this->sumQuestion = $sums['sumQuestion'];
        $this->sumUser = $sums['sumUsers'];
        
        $this->expertAnswers = $data['expertAnswers'];
        $this->sumExperts = $sums['sumExperts'];
        $this->sumExpertsQuestions = $sums['sumExpertsQuestions'];
        $this->sumExpertAnswers = $sums['sumExpertAnswers'];

        for ($i = 1; $i <= $this->sumCategory; $i++) {
            $this->arrayCategoryAnswer['category_' . $i] = [
                'SS' => 0,
                'S' => 0,
                'N' => 0,
                'TS' => 0,
                'STS' => 0,
            ];
            $this->arraySubCategoryAnswer['subCategory_' . $i] = [];
        }

//        for ($i = 1; $i <= $this->sumExpertsQuestions; $i++) {
//            $this->arrayQuestionAnswer['question_' . $i] = [
//                'SS' => 0,
//                'S' => 0,
//                'N' => 0,
//                'TS' => 0,
//                'STS' => 0,
//            ];
//        }
        for ($i = 1; $i <= $this->sumQuestion; $i++) {
            $this->arrayQuestionAnswer['question_' . $i] = [
                'SS' => 0,
                'S' => 0,
                'N' => 0,
                'TS' => 0,
                'STS' => 0,
            ];
        }
    }

    public function AHPConversion() {
        
        //for category
        //make 
        
        for ($i = 1; $i <= $this->sumCategory; $i++) {
            $arrayQuestion['category_' . $i] = [];
        }

        for ($i = 0; $i < $this->sumData; $i++) {
            $currentAnswer = $this->data[$i]->rel_answer;
            $currentCategory = $this->data[$i]->category->category->category_id;
            $currentQuestion = $this->data[$i]->rel_question_id;
            if (!in_array($currentQuestion, $arrayQuestion['category_' . $currentCategory])) {
                array_push($arrayQuestion['category_' . $currentCategory], $currentQuestion);
            }
            if ($currentAnswer == 5) {
                $this->arrayQuestionAnswer['question_' . $currentQuestion]['SS'] += 1;
                $this->arrayCategoryAnswer['category_' . $currentCategory]['SS'] += 1;
            } else if ($currentAnswer == 4) {
                $this->arrayQuestionAnswer['question_' . $currentQuestion]['S'] += 1;
                $this->arrayCategoryAnswer['category_' . $currentCategory]['S'] += 1;
            } else if ($currentAnswer == 3) {
                $this->arrayQuestionAnswer['question_' . $currentQuestion]['N'] += 1;
                $this->arrayCategoryAnswer['category_' . $currentCategory]['N'] += 1;
            } else if ($currentAnswer == 2) {
                $this->arrayQuestionAnswer['question_' . $currentQuestion]['TS'] += 1;
                $this->arrayCategoryAnswer['category_' . $currentCategory]['TS'] += 1;
            } else if ($currentAnswer == 1) {
                $this->arrayQuestionAnswer['question_' . $currentQuestion]['STS'] += 1;
                $this->arrayCategoryAnswer['category_' . $currentCategory]['STS'] += 1;
            }
        }

        for ($i = 1; $i <= $this->sumCategory; $i++) {
            $this->arrayCategoryAnswer['category_' . $i]['SS'] *= 5;
            $this->arrayCategoryAnswer['category_' . $i]['S'] *= 4;
            $this->arrayCategoryAnswer['category_' . $i]['N'] *= 3;
            $this->arrayCategoryAnswer['category_' . $i]['TS'] *= 2;
            $this->arrayCategoryAnswer['category_' . $i]['STS'] *= 1;

            $this->arraySumCategoryAnswer['category_' . $i] = $this->arrayCategoryAnswer['category_' . $i]['SS'] + $this->arrayCategoryAnswer['category_' . $i]['S'] + $this->arrayCategoryAnswer['category_' . $i]['N'] + $this->arrayCategoryAnswer['category_' . $i]['TS'] + $this->arrayCategoryAnswer['category_' . $i]['STS'];
        }

        //save per category
        for ($i = 1; $i <= $this->sumCategory; $i++) {
            for ($j = 1; $j <= $this->sumQuestion; $j++) {
                if (in_array($j, $arrayQuestion['category_' . $i])) {
                    array_push($this->arraySubCategoryAnswer['subCategory_' . $i], $this->arrayQuestionAnswer['question_' . $j]);
                }
            }
        }


        $arraySumSubCategoryAnswer = [];
        for ($j = 1; $j <= $this->sumCategory; $j++) {
            $countQuestionFactor = count($this->arraySubCategoryAnswer['subCategory_' . $j]);
            for ($i = 0; $i < $countQuestionFactor; $i++) {
                $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['SS'] *= 5;
                $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['S'] *= 4;
                $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['N'] *= 3;
                $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['TS'] *= 2;
                $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['STS'] *= 1;

                $arraySumSubCategoryAnswer['subCategory_' . $j][$i] = $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['SS'] + $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['S'] + $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['N'] + $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['TS'] + $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['STS'];
            }
        }

        return [
            'ForFactor' => $this->arraySumCategoryAnswer,
            'ForSubFactor' => $arraySumSubCategoryAnswer
        ];
    }

    public function doCalculate($arraySumAnswer = [], $factor = 0) {
        $this->sumCategory = count($arraySumAnswer);
        $this->arraySumAnswer = $arraySumAnswer;

        if ($factor == 0) {
            $this->prefix = 'category_';
        } else {
            $this->prefix = '';
            $this->arraySumAnswer = $arraySumAnswer['subCategory_' . $factor];
            $this->sumCategory = count($this->arraySumAnswer) - 1;

            $this->min = 1;
        }
        
        $this->arrayPairwise = [];
        $this->arrayColumnSum = [];
        $this->arrayRowSum = [];
        $this->arrayWeightPriority = [];
        

//        print_r($factor);
//        print_r($this->arraySumAnswer);
//        //make pairwise
        $pairwise = $this->pairwise();
//        print_r(count($pairwise));
        //count sum per column in pairwise
        $columnSum = $this->ColumnSum();
//        print_r($columnSum);
//        
        //update pairwise with columnSum
        $newPairwise = $this->updatePairwise();
//        print_r($newPairwise);
////        
//        //count sum row of new pairwise
        $rowSum = $this->rowSum();
//         print_r($rowSum);
////        
//        //find weight priority
        $weight = $this->weightPriority();
//        print_r($weight);
////        
//        //sort from the biggest weight
        $rank = $this->rank();
//        print_r($rank);

        return [
            'pairwise' => $pairwise,
            'columnSum' => $columnSum,
            'newPairwise' => $newPairwise,
            'rowSum' => $rowSum,
            'weight' => $weight,
            'rank' => $rank
        ];
    }

    public function pairwise() {
        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            for ($j = (1 - $this->min); $j <= $this->sumCategory; $j++) {
                $currentComparation = $this->arraySumAnswer[$this->prefix . $i] / $this->arraySumAnswer[$this->prefix . $j];
                $text = $this->prefix . $i . '/' . $this->prefix . $j;
                $this->arrayPairwise [$text] = $currentComparation;
            }
        }
        return $this->arrayPairwise;
    }

    public function ColumnSum() {
        $sum = 0;

        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            for ($j = (1 - $this->min); $j <= $this->sumCategory; $j++) {
                $sum += ($this->arrayPairwise[$this->prefix . $j . '/' . $this->prefix . $i]);
            }
            $this->arrayColumnSum['sumColumn_' . $i] = $sum;
            $sum = 0;
        }
//        print_r($this->arrayColumnSum);
        return $this->arrayColumnSum;
    }

    public function updatePairwise() {

        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            $currentSumColumn = $this->arrayColumnSum['sumColumn_' . $i];
            for ($j = (1 - $this->min); $j <= $this->sumCategory; $j++) {
                $this->arrayPairwise[$this->prefix . $j . '/' . $this->prefix . $i] /= ($currentSumColumn);
            }
        }
     
        return $this->arrayPairwise;
    }

    public function rowSum() {
        $sum = 0;

        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            for ($j = (1 - $this->min); $j <= $this->sumCategory; $j++) {
                $sum += ($this->arrayPairwise[$this->prefix . $i . '/' . $this->prefix . $j]);
            }
            $this->arrayRowSum['sumRow_' . $i] = $sum;
            $sum = 0;
        }
//        print_r($this->arrayPairwise);
        return $this->arrayRowSum;
//        print_r($this->arrayRowSum);
    }

    public function weightPriority() {
        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            $this->arrayWeightPriority['weight_' . $i] = ($this->arrayRowSum['sumRow_' . $i]) / ($this->sumCategory + $this->min);
        }
        return $this->arrayWeightPriority;
    }

    public function rank() {

        arsort($this->arrayWeightPriority);
        return $this->arrayWeightPriority;
    }

    public function consistency() {
        $eigenmaks = 0;
        for ($i = 1; $i <= $this->sumCategory; $i++) {
            $eigenmaks +=(($this->arrayRowSum['sumRow_' . $i]) / $this->arrayWeightPriority['weight_' . $i]) / 5;
        }

        $CI = ($eigenmaks - $this->sumCategory) / ($this->sumCategory - 1);

        $randomIndex = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41];

        $CR = $CI / ($randomIndex[$this->sumCategory - 1]);

//        print_r($eigenmaks);
//        
//        print_r($CI);
//        print_r($CR);
    }

}
