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
    protected $max = 1;
    protected $min = 1;
    protected $userIds = [];

    public function __construct($answers, $countQuestion, $countUser, $max) {
        $this->answers = $answers;
        $this->countAnswer = count($answers);
        $this->countQuestion = $countQuestion;
        $this->countUser = $countUser;
        $this->countCategory = (1 + sqrt((1 + 4 * (2 * ($this->countQuestion))))) / 2; //cari akar persamaan kuadrat n(n-1)/2
        $this->max = $max * $this->countCategory;
        $this->min = $this->max - $this->countCategory + 1;
    }

    public function consistency() {
        $eigenmaks = 0;
        for ($i = $this->min; $i <= $this->max; $i++) {
            $eigenmaks += ((($this->arrayRowSum['sumRow_' . $i]) / $this->arrayWeightPriority['weight_' . $i]) / 5);
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

        for ($i = $this->min; $i <= $this->max; $i++) {
            for ($j = $this->min; $j <= $this->max; $j++) {
                $value *= ($this->newPairwise["faktor_" . $i . " / faktor_" . $j]);
            }
            $this->arrayWeightPriority['weight_' . $i] = pow($value, (1 / $this->countCategory));
            $value = 1;
        }
        return $this->arrayWeightPriority;
    }

    public function rowSum() {
        $sum = 0;

        for ($i = $this->min; $i <= $this->max; $i++) {
            for ($j = $this->min; $j <= $this->max; $j++) {
                $sum += ($this->newPairwise["faktor_" . $i . " / faktor_" . $j]);
            }
            $this->arrayRowSum['sumRow_' . $i] = $sum;
            $sum = 0;
        }

        return ($this->arrayRowSum);
    }

    public function updatePairwise() {
        for ($i = $this->min; $i <= $this->max; $i++) {
            $currentSumColumn = $this->arrayColumnSum['sumColumn_' . $i];
            for ($j = $this->min; $j <= $this->max; $j++) {
                $this->newPairwise["faktor_" . $j . " / faktor_" . $i] /= ($currentSumColumn);
            }
        }

        return ($this->newPairwise);
    }

    public function columnSum() {

        for ($i = $this->min; $i <= $this->max; $i++) {
            $value = 0;
            for ($j = $this->min; $j <= $this->max; $j++) {
                $text = "faktor_" . $j . " / faktor_" . $i;
                $value += $this->newPairwise[$text];
            }
            $this->arrayColumnSum['sumColumn_' . $i] = $value;
        }

        return ($this->arrayColumnSum);
    }

    public function createNewPairwise() {

        for ($j = $this->min; $j <= $this->max; $j++) {
            for ($k = $this->min; $k <= $this->max; $k++) {
                $value = 1;
                $text = "faktor_" . $j . " / faktor_" . $k;
                foreach ($this->userIds as $key => $value) {
                    $value *= $this->pairwise['PairwiseUser_' . $value][$text];
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

        for ($i = 0; $i < $this->countAnswer; $i++) {

            $userId = $this->answers[$i]->rel_user_id;
            if (!in_array($userId, $this->userIds)) {
                $this->userIds[] = $userId;
            }
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

//            if ($firstFaktorId == ($this->countCategory - 1)) {
            $sameText2 = "faktor_" . $secondFaktorId . " / faktor_" . $secondFaktorId;
            $this->pairwise['PairwiseUser_' . $userId][$sameText2] = 1;
//            }
        }

        return $this->pairwise;
//        print_r($this->userIds);
    }

}
