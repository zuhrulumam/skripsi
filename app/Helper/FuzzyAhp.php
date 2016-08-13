<?php

namespace App\Helper;

class FuzzyAhp {

    protected $data;
    protected $sumCategory;
    protected $sumQuestion;
    protected $sumData;
    protected $sumUser;
    protected $arrayCategoryAnswer = []; // for per category per answer
    protected $arrayQuestionAnswer = []; // for per question per answer    
    protected $arraySubCategoryAnswer = [];
    protected $arraySumCategoryAnswer = [];
    protected $arraySumAnswer = [];
    protected $prefix;
    protected $min = 0;
    protected $arrayGeometri = [];
    protected $arrayInverseGeometri = [];
    protected $weight = [];
    protected $defuzzy = [];
    protected $normalWeight = [];

    public function __construct($data, $sumCategory, $sumQuestion, $sumUsers) {
        $this->data = $data;
        $this->sumData = count($data);
        $this->sumCategory = $sumCategory;
        $this->sumQuestion = $sumQuestion;
        $this->sumUser = $sumUsers;

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

    public function FuzzyConversion() {
        // buat global ini sampai for
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

//        print_r($this->arrayCategoryAnswer);
        //conversi yang sesungguhnya nanti dikasih dibeda tempat

        for ($i = 1; $i <= $this->sumCategory; $i++) {
            $currentSum = [];
            $currentSum['SS'] = [
                'l' => $this->arrayCategoryAnswer['category_' . $i]['SS'] * 7,
                'm' => $this->arrayCategoryAnswer['category_' . $i]['SS'] * 9,
                'u' => $this->arrayCategoryAnswer['category_' . $i]['SS'] * 11,
            ];
            $currentSum['S'] = [
                'l' => $this->arrayCategoryAnswer['category_' . $i]['S'] * 5,
                'm' => $this->arrayCategoryAnswer['category_' . $i]['S'] * 7,
                'u' => $this->arrayCategoryAnswer['category_' . $i]['S'] * 9,
            ];
            $currentSum['N'] = [
                'l' => $this->arrayCategoryAnswer['category_' . $i]['N'] * 3,
                'm' => $this->arrayCategoryAnswer['category_' . $i]['N'] * 5,
                'u' => $this->arrayCategoryAnswer['category_' . $i]['N'] * 7,
            ];
            $currentSum['TS'] = [
                'l' => $this->arrayCategoryAnswer['category_' . $i]['TS'] * 1,
                'm' => $this->arrayCategoryAnswer['category_' . $i]['TS'] * 3,
                'u' => $this->arrayCategoryAnswer['category_' . $i]['TS'] * 5,
            ];
            $currentSum['STS'] = [
                'l' => $this->arrayCategoryAnswer['category_' . $i]['STS'] * 1,
                'm' => $this->arrayCategoryAnswer['category_' . $i]['STS'] * 1,
                'u' => $this->arrayCategoryAnswer['category_' . $i]['STS'] * 1,
            ];

            $this->arraySumCategoryAnswer['category_' . $i]['l'] = $currentSum['SS']['l'] + $currentSum['S']['l'] + $currentSum['N']['l'] + $currentSum['TS']['l'] + $currentSum['STS']['l'];
            $this->arraySumCategoryAnswer['category_' . $i]['m'] = $currentSum['SS']['m'] + $currentSum['S']['m'] + $currentSum['N']['m'] + $currentSum['TS']['m'] + $currentSum['STS']['m'];
            $this->arraySumCategoryAnswer['category_' . $i]['u'] = $currentSum['SS']['u'] + $currentSum['S']['u'] + $currentSum['N']['u'] + $currentSum['TS']['u'] + $currentSum['STS']['u'];
        }

        //save per category
        for ($i = 1; $i <= $this->sumCategory; $i++) {
            for ($j = 1; $j <= $this->sumQuestion; $j++) {
                if (in_array($j, $arrayQuestion['category_' . $i])) {
                    array_push($this->arraySubCategoryAnswer['subCategory_' . $i], $this->arrayQuestionAnswer['question_' . $j]);
                }
            }
        }

//        print_r($this->arraySubCategoryAnswer);

        $arraySumSubCategoryAnswer = [];
        for ($j = 1; $j <= $this->sumCategory; $j++) {
            $countQuestionFactor = count($this->arraySubCategoryAnswer['subCategory_' . $j]);
            for ($i = 0; $i < $countQuestionFactor; $i++) {
                $currentSum = [];
                $currentSum['SS'] = [
                    'l' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['SS'] * 7,
                    'm' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['SS'] * 9,
                    'u' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['SS'] * 11,
                ];
                $currentSum['S'] = [
                    'l' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['S'] * 5,
                    'm' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['S'] * 7,
                    'u' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['S'] * 9,
                ];
                $currentSum['N'] = [
                    'l' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['N'] * 3,
                    'm' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['N'] * 5,
                    'u' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['N'] * 7,
                ];
                $currentSum['TS'] = [
                    'l' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['TS'] * 1,
                    'm' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['TS'] * 3,
                    'u' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['TS'] * 5,
                ];
                $currentSum['STS'] = [
                    'l' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['STS'] * 1,
                    'm' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['STS'] * 1,
                    'u' => $this->arraySubCategoryAnswer['subCategory_' . $j][$i]['STS'] * 1,
                ];

                $arraySumSubCategoryAnswer['subCategory_' . $j][$i]['l'] = $currentSum['SS']['l'] + $currentSum['S']['l'] + $currentSum['N']['l'] + $currentSum['TS']['l'] + $currentSum['STS']['l'];
                $arraySumSubCategoryAnswer['subCategory_' . $j][$i]['m'] = $currentSum['SS']['m'] + $currentSum['S']['m'] + $currentSum['N']['m'] + $currentSum['TS']['m'] + $currentSum['STS']['m'];
                $arraySumSubCategoryAnswer['subCategory_' . $j][$i]['u'] = $currentSum['SS']['u'] + $currentSum['S']['u'] + $currentSum['N']['u'] + $currentSum['TS']['u'] + $currentSum['STS']['u'];
            }
        }

//        print_r($arraySumSubCategoryAnswer);

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
        $this->arrayRowMultiple = [];
        $this->arrayGeometri = [];
        $this->arrayInverseGeometri = [];
        $this->weight = [];
        $this->defuzzy = [];
        $this->normalWeight = [];

        $pairwise = $this->pairwise();
//        print_r(($pairwise));
        $rowMultiple = $this->rowMultiple();
//        print_r($rowMultiple);

        $geometriMean = $this->geometriMean();
//        print_r($geometriMean);

        $InverseGeometri = $this->InverseGeometri();
//        print_r($InverseGeometri);

        $weight = $this->weight();
//        print_r($weight);

        $defuzzy = $this->defuzzy();
//        print_r($defuzzy);

        $normalWeight = $this->normalWeight();
//        print_r($noemalWeight);

        $rank = $this->rank();
//        print_r($rank);
        return [
            'pairwise' => $pairwise,
            'rowMultiple' => $rowMultiple,
            'geometriMean' => $geometriMean,
            'InverseGeometri' => $InverseGeometri,
            'weight' => $weight,
            'defuzzy' => $defuzzy,
            'normalWeight' => $normalWeight,
            'rank' => $rank
        ];
    }

    public function pairwise() {
        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            for ($j = (1 - $this->min); $j <= $this->sumCategory; $j++) {
                $currentComparation = [];
                $currentComparation['l'] = $this->arraySumAnswer[$this->prefix . $i]['l'] / $this->arraySumAnswer[$this->prefix . $j]['l'];
                $currentComparation['m'] = $this->arraySumAnswer[$this->prefix . $i]['m'] / $this->arraySumAnswer[$this->prefix . $j]['m'];
                $currentComparation['u'] = $this->arraySumAnswer[$this->prefix . $i]['u'] / $this->arraySumAnswer[$this->prefix . $j]['u'];
                $text = $this->prefix . $i . '/' . $this->prefix . $j;
                $intext = $this->prefix . $j . '/' . $this->prefix . $i;
                 $this->arrayPairwise [$text] = $currentComparation['l'];
//                if (array_key_exists($intext, $this->arrayPairwise)) {
////                    $this->arrayPairwise [$text]['l'] = $currentComparation['u'];
////                    $this->arrayPairwise [$text]['m'] = $currentComparation['m'];
////                    $this->arrayPairwise [$text]['u'] = $currentComparation['l'];
//                    $this->arrayPairwise [$text] = $currentComparation['u'];
//                } else {
////                    $this->arrayPairwise [$text]['l'] = $currentComparation['l'];
////                    $this->arrayPairwise [$text]['m'] = $currentComparation['m'];
////                    $this->arrayPairwise [$text]['u'] = $currentComparation['u'];
//                    $this->arrayPairwise [$text] = $currentComparation['l'];
//                }
            }
        }

        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            for ($j = (1 - $this->min); $j <= $this->sumCategory; $j++) {
                $text = $this->prefix . $i . '/' . $this->prefix . $j;
                $currentPairwise = $this->arrayPairwise[$text];
                $pairwise = [
                    1 => [
                        'l' => 1,
                        'm' => 1,
                        'u' => 1,
                    ],
                    2 => [
                        'l' => 1,
                        'm' => 3,
                        'u' => 5,
                    ],
                    3 => [
                        'l' => 3,
                        'm' => 5,
                        'u' => 7,
                    ],
                    4 => [
                        'l' => 5,
                        'm' => 7,
                        'u' => 9,
                    ],
                    5 => [
                        'l' => 7,
                        'm' => 9,
                        'u' => 11,
                    ],
                ];

                if ($currentPairwise == 1) {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text] = $pairwise[1];
                } else if ($currentPairwise > 1 && $currentPairwise <= 1.5) {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text] = $pairwise[2];
                } else if ($currentPairwise < (1) && $currentPairwise >= (1 / 1.5)) {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text]['l'] = (1 / $pairwise[2]['u']);
                    $this->arrayPairwise[$text]['m'] = (1 / $pairwise[2]['m']);
                    $this->arrayPairwise[$text]['u'] = (1 / $pairwise[2]['l']);
                } else if ($currentPairwise > 1.5 && $currentPairwise <= 2) {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text] = $pairwise[3];
                } else if ($currentPairwise < (1 / 1.5) && $currentPairwise >= (1 / 2)) {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text]['l'] = (1 / $pairwise[3]['u']);
                    $this->arrayPairwise[$text]['m'] = (1 / $pairwise[3]['m']);
                    $this->arrayPairwise[$text]['u'] = (1 / $pairwise[3]['l']);
                } else if ($currentPairwise > 2 && $currentPairwise <= 2.5) {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text] = $pairwise[4];
                } else if ($currentPairwise < (1 / 2) && $currentPairwise >= (1 / 2.5)) {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text]['l'] = (1 / $pairwise[4]['u']);
                    $this->arrayPairwise[$text]['m'] = (1 / $pairwise[4]['m']);
                    $this->arrayPairwise[$text]['u'] = (1 / $pairwise[4]['l']);
                } else if ($currentPairwise > 2.5) {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text] = $pairwise[5];
                } else if ($currentPairwise < (1 / 2.5)) {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text]['l'] = (1 / $pairwise[5]['u']);
                    $this->arrayPairwise[$text]['m'] = (1 / $pairwise[5]['m']);
                    $this->arrayPairwise[$text]['u'] = (1 / $pairwise[5]['l']);
                } else {
                    $this->arrayPairwise[$text] = [];
                    $this->arrayPairwise[$text] = $pairwise[1];
                }
            }
        }

        return $this->arrayPairwise;
    }

    public function rowMultiple() {
        $sum = [
            'l' => 1,
            'm' => 1,
            'u' => 1
        ];

        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            for ($j = (1 - $this->min); $j <= $this->sumCategory; $j++) {
                $sum['l'] *= ($this->arrayPairwise[$this->prefix . $i . '/' . $this->prefix . $j]['l']);
                $sum['m'] *= ($this->arrayPairwise[$this->prefix . $i . '/' . $this->prefix . $j]['m']);
                $sum['u'] *= ($this->arrayPairwise[$this->prefix . $i . '/' . $this->prefix . $j]['u']);
            }
            $this->arrayRowMultiple['RowMultiple_' . $i]['l'] = $sum['l'];
            $this->arrayRowMultiple['RowMultiple_' . $i]['m'] = $sum['m'];
            $this->arrayRowMultiple['RowMultiple_' . $i]['u'] = $sum['u'];
            $sum = [
                'l' => 1,
                'm' => 1,
                'u' => 1
            ];
        }
//        print_r($this->arrayPairwise);
        return $this->arrayRowMultiple;
//        print_r($this->arrayRowMultiple);
    }

    public function geometriMean() {
        $exp = 1 / $this->sumCategory;
        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            $this->arrayGeometri['geometri_' . $i]['l'] = pow($this->arrayRowMultiple['RowMultiple_' . $i]['l'], $exp);
            $this->arrayGeometri['geometri_' . $i]['m'] = pow($this->arrayRowMultiple['RowMultiple_' . $i]['m'], $exp);
            $this->arrayGeometri['geometri_' . $i]['u'] = pow($this->arrayRowMultiple['RowMultiple_' . $i]['u'], $exp);
        }

        return $this->arrayGeometri;
    }

    public function InverseGeometri() {
        $sum = [
            'l' => 0,
            'm' => 0,
            'u' => 0
        ];
        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            $sum['l']+= $this->arrayGeometri['geometri_' . $i]['l'];
            $sum['m']+= $this->arrayGeometri['geometri_' . $i]['m'];
            $sum['u']+= $this->arrayGeometri['geometri_' . $i]['u'];
        }
        $this->arrayInverseGeometri['l'] = pow($sum['u'], -1);
        $this->arrayInverseGeometri['m'] = pow($sum['m'], -1);
        $this->arrayInverseGeometri['u'] = pow($sum['l'], -1);

        return $this->arrayInverseGeometri;
    }

    public function weight() {
        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            $this->weight['weight_' . $i]['l'] = $this->arrayGeometri['geometri_' . $i]['l'] * $this->arrayInverseGeometri['l'];
            $this->weight['weight_' . $i]['m'] = $this->arrayGeometri['geometri_' . $i]['m'] * $this->arrayInverseGeometri['m'];
            $this->weight['weight_' . $i]['u'] = $this->arrayGeometri['geometri_' . $i]['u'] * $this->arrayInverseGeometri['u'];
        }

        return $this->weight;
    }

    public function defuzzy() {
        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            $this->defuzzy['defuzzy_' . $i] = $this->weight['weight_' . $i]['l'] + $this->weight['weight_' . $i]['m'] + $this->weight['weight_' . $i]['u'];
        }

        return $this->defuzzy;
    }

    public function normalWeight() {
        $sum = 0;
        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            $sum +=$this->defuzzy['defuzzy_' . $i];
        }
        for ($i = (1 - $this->min); $i <= $this->sumCategory; $i++) {
            $this->normalWeight['normalWeight_' . $i] = $this->defuzzy['defuzzy_' . $i] / $sum;
        }

        return $this->normalWeight;
    }

    public function rank() {
        arsort($this->normalWeight);

        return $this->normalWeight;
    }

}
