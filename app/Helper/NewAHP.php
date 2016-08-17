<?php

namespace App\Helper;

class NewAHP {

    protected $countQuestion = 0;
    protected $countUser = 0;
    protected $countAnswer = 0;
    protected $answers = [];
    protected $pairwise = [];
    protected $countCategory = 0;
    protected $answerId = 0;
    protected $newPairwise = [];
    protected $arrayColumnSum = [];
    protected $arrayRowSum = [];
    protected $arrayWeightPriority = [];

    public function __construct($answers, $countQuestion, $countUser, $countCategory) {
        $this->answers = $answers;
        $this->countAnswer = $answers->count();
        $this->countQuestion = $countQuestion;
//        $this->countUser = $countUser;
        $this->countUser = 9;
//        $this->countCategory = $countCategory;
        $this->countCategory = (1 + sqrt((1 + 4 * (2 * ($this->countQuestion))))) / 2; //cari akar persamaan kuadrat n(n-1)/2
    }

    public function consistency() {
        $eigenmaks = 0;
        for ($i = 1; $i <= $this->countCategory; $i++) {
            $eigenmaks +=(($this->arrayRowSum['sumRow_' . $i]) / $this->arrayWeightPriority['weight_' . $i]) / 5;
        }

        $CI = ($eigenmaks - $this->countCategory) / ($this->countCategory - 1);

        $randomIndex = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41];

        $CR = $CI / ($randomIndex[$this->countCategory - 1]);
        return $CR;
    }

    public function rank() {

        arsort($this->arrayWeightPriority);
        return $this->arrayWeightPriority;
    }

    public function weightPriority() {
        $value = 1;

        for ($i = 1; $i <= $this->countCategory; $i++) {
            for ($j = 1; $j <= $this->countCategory; $j++) {
                $value *= ($this->newPairwise["faktor_" . $i . " / faktor_" . $j]);
            }
            $this->arrayWeightPriority['weight_' . $i] = pow($value, (1 / $this->countCategory));
            $value = 1;
        }
        return $this->arrayWeightPriority;
    }

    public function rowSum() {
        $sum = 0;

        for ($i = 1; $i <= $this->countCategory; $i++) {
            for ($j = 1; $j <= $this->countCategory; $j++) {
                $sum += ($this->newPairwise["faktor_" . $i . " / faktor_" . $j]);
            }
            $this->arrayRowSum['sumRow_' . $i] = $sum;
            $sum = 0;
        }

        return ($this->arrayRowSum);
    }

    public function updatePairwise() {
        for ($i = 1; $i <= $this->countCategory; $i++) {
            $currentSumColumn = $this->arrayColumnSum['sumColumn_' . $i];
            for ($j = 1; $j <= $this->countCategory; $j++) {
                $this->newPairwise["faktor_" . $j . " / faktor_" . $i] /= ($currentSumColumn);
            }
        }

        return ($this->newPairwise);
    }

    public function columnSum() {

        for ($i = 1; $i <= $this->countCategory; $i++) {
            $value = 0;
            for ($j = 1; $j <= $this->countCategory; $j++) {
                $text = "faktor_" . $j . " / faktor_" . $i;
                $value += $this->newPairwise[$text];
            }
            $this->arrayColumnSum['sumColumn_' . $i] = $value;
        }

        return ($this->arrayColumnSum);
    }

    public function createNewPairwise() {

        for ($j = 1; $j <= $this->countCategory; $j++) {
            for ($k = 1; $k <= $this->countCategory; $k++) {
                $value = 1;
                $text = "faktor_" . $j . " / faktor_" . $k;
                for ($i = 1; $i <= $this->countUser; $i++) {
                    $value *= $this->pairwise['PairwiseUser_' . $i][$text];
                }
                $this->newPairwise[$text] = pow($value, (1 / $this->countUser));
            }
        }

        return $this->newPairwise;
    }

    public function createPairwise() {
//       5 = 9
//       4 = 3
//       3 = 1
//       2 = 0.33
//       1 = 0.11
        $userId = 0;
        for ($i = 0; $i < $this->countAnswer; $i++) {

            $userId = $this->answers[$i]->rel_user_id;

            $firstFaktorId = $this->answers[$i]->getQuestionId->first_category_comparation;
            $secondFaktorId = $this->answers[$i]->getQuestionId->second_category_comparation;

            $answer = $this->answers[$i]->rel_answer;
            if ($answer == 5) {
                $answer = 9;
            } else if ($answer == 4) {
                $answer = 3;
            } else if ($answer == 3) {
                $answer = 1;
            } else if ($answer == 2) {
                $answer = 0.33;
            } else if ($answer == 1) {
                $answer = 0.11;
            }

            $sameText = "faktor_" . $firstFaktorId . " / faktor_" . $firstFaktorId;
            $sameAnswer = 1;

            $text = "faktor_" . $firstFaktorId . " / faktor_" . $secondFaktorId;

            $reciprocalText = "faktor_" . $secondFaktorId . " / faktor_" . $firstFaktorId;
            $reciprocalAnswer = 1 / $answer;

            $this->pairwise['PairwiseUser_' . $userId][$sameText] = $sameAnswer;
            $this->pairwise['PairwiseUser_' . $userId][$text] = $answer;
            $this->pairwise['PairwiseUser_' . $userId][$reciprocalText] = $reciprocalAnswer;

            if ($firstFaktorId == ($this->countCategory - 1)) {
                $sameText2 = "faktor_" . $this->countCategory . " / faktor_" . $this->countCategory;
                $this->pairwise['PairwiseUser_' . $userId][$sameText2] = 1;
            }
        }

        return $this->pairwise;
    }

}
