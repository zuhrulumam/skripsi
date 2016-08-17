<?php

namespace App\Helper;

class NewFuzzyAHP {

    protected $countQuestion = 0;
    protected $countUser = 0;
    protected $countAnswer = 0;
    protected $answers = [];
    protected $countCategory = 0;
    protected $pairwise = [];

    public function __construct($answers, $countQuestion, $countUser, $countCategory) {
        $this->answers = $answers;
        $this->countAnswer = $answers->count();
        $this->countQuestion = $countQuestion;
//        $this->countUser = $countUser;
        $this->countUser = 9;
//        $this->countCategory = $countCategory;
        $this->countCategory = (1 + sqrt((1 + 4 * (2 * ($this->countQuestion))))) / 2; //cari akar persamaan kuadrat n(n-1)/2
    }
    
    public function createPairwise() {
//       5 = [5, 7, 9]
//       4 = [3, 5, 7]
//       3 = [1, 1, 1]
//       2 = [0.14, 0.20, 0.33]
//       1 = [0.111, 0.14, 0.2]
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
