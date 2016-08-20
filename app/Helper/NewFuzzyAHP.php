<?php

namespace App\Helper;

class NewFuzzyAHP {

    protected $countQuestion = 0;
    protected $countUser = 0;
    protected $countAnswer = 0;
    protected $answers = [];
    protected $countCategory = 0;
    protected $pairwise = [];
    protected $newPairwise = [];
    protected $arrayGeometry = [];
    protected $arrayInverseGeometri = [];
    protected $weight = [];
    protected $defuzzy = [];
    protected $normalWeight = [];

    public function __construct($answers, $countQuestion, $countUser) {
        $this->answers = $answers;
        $this->countAnswer = $answers->count();
        $this->countQuestion = $countQuestion;
//        $this->countUser = $countUser;
        $this->countUser = 9;
//        $this->countCategory = $countCategory;
        $this->countCategory = (1 + sqrt((1 + 4 * (2 * ($this->countQuestion))))) / 2; //cari akar persamaan kuadrat n(n-1)/2
    }
    
    public function rank() {
        arsort($this->normalWeight);

        return $this->normalWeight;
    }
    
    public function normalWeight() {
        $sum = 0;
        for ($i = (1); $i <= $this->countCategory; $i++) {
            $sum +=$this->defuzzy['defuzzy_' . $i];
        }
        for ($i = 1; $i <= $this->countCategory; $i++) {
            $this->normalWeight['normalWeight_' . $i] = $this->defuzzy['defuzzy_' . $i] / $sum;
        }

        return $this->normalWeight;
    }
    
    public function defuzzy() {
        for ($i = (1); $i <= $this->countCategory; $i++) {
            $this->defuzzy['defuzzy_' . $i] = ($this->weight['weight_' . $i]['l'] + $this->weight['weight_' . $i]['m'] + $this->weight['weight_' . $i]['u'])/3;
        }

        return $this->defuzzy;
    }
    
    public function weight() {
        for ($i = (1); $i <= $this->countCategory; $i++) {
            $this->weight['weight_' . $i]['l'] = $this->arrayGeometry['geometri_' . $i]['l'] * $this->arrayInverseGeometri['l'];
            $this->weight['weight_' . $i]['m'] = $this->arrayGeometry['geometri_' . $i]['m'] * $this->arrayInverseGeometri['m'];
            $this->weight['weight_' . $i]['u'] = $this->arrayGeometry['geometri_' . $i]['u'] * $this->arrayInverseGeometri['u'];
        }

        return $this->weight;
    }
    
     public function InverseGeometri() {
        $sum = [
            'l' => 0,
            'm' => 0,
            'u' => 0
        ];
        for ($i = (1); $i <= $this->countCategory; $i++) {
            $sum['l']+= $this->arrayGeometry['geometri_' . $i]['l'];
            $sum['m']+= $this->arrayGeometry['geometri_' . $i]['m'];
            $sum['u']+= $this->arrayGeometry['geometri_' . $i]['u'];
        }
        $this->arrayInverseGeometri['l'] = pow($sum['u'], -1);
        $this->arrayInverseGeometri['m'] = pow($sum['m'], -1);
        $this->arrayInverseGeometri['u'] = pow($sum['l'], -1);

        return $this->arrayInverseGeometri;
    }

    public function geometryMean() {
        for ($i = 1; $i <= $this->countCategory; $i++) {
            $value = [
                'l' => 1,
                'm' => 1,
                'u' => 1
            ];
            for ($j = 1; $j <= $this->countCategory; $j++) {
                $text = "faktor_" . $i . " / faktor_" . $j;
                $value = [
                    'l' => $value['l'] * $this->newPairwise[$text]['l'],
                    'm' => $value['m'] * $this->newPairwise[$text]['m'],
                    'u' => $value['u'] * $this->newPairwise[$text]['u'],
                ];
            }
            $this->arrayGeometry['geometri_'.$i] = [
                'l' =>pow($value['l'], (1/$this->countCategory)),
                'm' =>pow($value['m'], (1/$this->countCategory)),
                'u' =>pow($value['u'], (1/$this->countCategory)),
            ];
        }
        
//        print_r($this->arrayGeometry);
        return ($this->arrayGeometry);
    }

    public function createNewPairwise() {

        for ($j = 1; $j <= $this->countCategory; $j++) {
            for ($k = 1; $k <= $this->countCategory; $k++) {
                $value = [
                    'l' => 1,
                    'm' => 1,
                    'u' => 1
                ];
                $text = "faktor_" . $j . " / faktor_" . $k;
                for ($i = 1; $i <= $this->countUser; $i++) {
                    $value = [
                        'l' => $value['l'] * $this->pairwise['PairwiseUser_' . $i][$text]['l'],
                        'm' => $value['m'] * $this->pairwise['PairwiseUser_' . $i][$text]['m'],
                        'u' => $value['u'] * $this->pairwise['PairwiseUser_' . $i][$text]['u']
                    ];
                }
                $this->newPairwise[$text] = [
                    'l' => pow($value['l'], (1 / $this->countUser)),
                    'm' => pow($value['m'], (1 / $this->countUser)),
                    'u' => pow($value['u'], (1 / $this->countUser)),
                ];
            }
        }

        return $this->newPairwise;
//        print_r($this->newPairwise);
    }

    public function createPairwise() {
//       5 = [5, 7, 9]
//       4 = [3, 5, 7]
//       3 = [1, 1, 1]
//       2 = [0.14, 0.20, 0.33]
//       1 = [0.111, 0.14, 0.2]

        for ($i = 0; $i < $this->countAnswer; $i++) {

            $userId = $this->answers[$i]->rel_user_id;

            $firstFaktorId = $this->answers[$i]->getQuestionId->first_category_comparation;
            $secondFaktorId = $this->answers[$i]->getQuestionId->second_category_comparation;

            $answer = $this->answers[$i]->rel_answer;
            if ($answer == 5) {
                $answer = [
                    'l' => 5,
                    'm' => 7,
                    'u' => 9
                ];
            } else if ($answer == 4) {
                $answer = [
                    'l' => 3,
                    'm' => 5,
                    'u' => 7
                ];
            } else if ($answer == 3) {
                $answer = [
                    'l' => 1,
                    'm' => 1,
                    'u' => 1
                ];
            } else if ($answer == 2) {
                $answer = [
                    'l' => 0.14285,
                    'm' => 0.20000,
                    'u' => 0.33333
                ];
            } else if ($answer == 1) {
                $answer = [
                    'l' => 0.11111,
                    'm' => 0.14385,
                    'u' => 0.20000
                ];
            }

            $sameText = "faktor_" . $firstFaktorId . " / faktor_" . $firstFaktorId;
            $sameAnswer = [
                'l' => 1,
                'm' => 1,
                'u' => 1
            ];

            $text = "faktor_" . $firstFaktorId . " / faktor_" . $secondFaktorId;

            $reciprocalText = "faktor_" . $secondFaktorId . " / faktor_" . $firstFaktorId;
            $reciprocalAnswer = [
                'l' => 1 / $answer['u'],
                'm' => 1 / $answer['m'],
                'u' => 1 / $answer['l']
            ];

            $this->pairwise['PairwiseUser_' . $userId][$sameText] = $sameAnswer;
            $this->pairwise['PairwiseUser_' . $userId][$text] = $answer;
            $this->pairwise['PairwiseUser_' . $userId][$reciprocalText] = $reciprocalAnswer;

            if ($firstFaktorId == ($this->countCategory - 1)) {
                $sameText2 = "faktor_" . $this->countCategory . " / faktor_" . $this->countCategory;
                $this->pairwise['PairwiseUser_' . $userId][$sameText2] = [
                    'l' => 1,
                    'm' => 1,
                    'u' => 1
                ];
            }
        }

        return $this->pairwise;
//        print_r($this->pairwise);
    }

}
