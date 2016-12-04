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
use Litipk\BigNumbers\Decimal;

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

    public function subfactor($type, $condition, $typeView = "parts") {

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
        $factors = [
            '1' => 0.35897798804938,
            '2' => 0.12439130567568,
            '3' => 0.25180792334218,
            '4' => 0.11983980778871,
            '5' => 0.14498297514404
        ];
        $keteranganSubFactor = [
            "Sub Factor 1" => "Kebijakan Finansial",
            "Sub Factor 2" => "Kebijakan Peraturan (SK)",
            "Sub Factor 3" => "Technical Support",
            "Sub Factor 4" => "Seminar dan Training",
            "Sub Factor 5" => "Sikap terhadap siswa",
            "Sub Factor 6" => "Respon yang cepat",
            "Sub Factor 7" => "Keaktivan pengajar",
            "Sub Factor 8" => "Sikap terhadap elearning",
            "Sub Factor 9" => "Keahlian dan wawasan menggunakan komputer",
            "Sub Factor 10" => "Keahlian dan wawasan menggunakan internet",
            "Sub Factor 11" => "Sikap terhadap e-learning",
            "Sub Factor 12" => "Adanya forum / diskusi",
            "Sub Factor 13" => "Course quality",
            "Sub Factor 14" => "Konten yang relevan",
            "Sub Factor 15" => "Kelengkapan konten",
            "Sub Factor 16" => "Fleksibilitas dalam mengambil materi",
            "Sub Factor 17" => "Tingkat portability produk",
            "Sub Factor 18" => "Tingkat reliability produk ",
            "Sub Factor 19" => "Mudah dimengerti dan Mudah digunakan",
            "Sub Factor 20" => "Desain dan user interface system",
        ];
        $globalRank = [];
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
            foreach ($normalWeight as $weightKey => $weightValue) {
                $globalRank[$weightKey] = $factors[$value] * $weightValue;
            }

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
        if ($typeView == 'parts') {
            return view('calculation.fuzzyChart', [
                'subFactors' => $subFactors,
                'factors' => $factors,
                'globalRank' => $globalRank,
                'keteranganSubFactor' => $keteranganSubFactor
            ]);
        } else if ($typeView == 'full') {
            return view('calculation.fuzzyMahasiswa', [
                'subFactors' => $subFactors,
                'factors' => $factors,
                'globalRank' => $globalRank,
            ]);
        }
        return view('calculation.fuzzyMahasiswa', [
            'subFactors' => $subFactors,
            'factors' => $factors]);
    }

    function NRoot($num, $n) {
        if ($n < 1)
            return 0; // we want positive exponents 
        if ($num <= 0)
            return 0; // we want positive numbers 
        if ($num < 2)
            return 1; // n-th root of 1 or 2 give 1 



            
// g is our guess number 
        $g = 2.0;

        // while (g^n < num) g=g*2 
        while (bccomp(bcpow($g, $n), $num) == -1) {
            $g = bcmul($g, 2.0);
        }
        // if (g^n==num) num is a power of 2, we're lucky, end of job 
        if (bccomp(bcpow($g, $n), $num) == 0) {
            return $g;
        }

        // if we're here num wasn't a power of 2 :( 
        $og = $g; // og means original guess and here is our upper bound 
        $g = bcdiv($g, "2.0"); // g is set to be our lower bound 
        $step = bcdiv(bcsub($og, $g), "2.0"); // step is the half of upper bound - lower bound 
        $g = bcadd($g, $step); // we start at lower bound + step , basically in the middle of our interval 
        // while step!=1 

        while (bccomp($step, "1.0") == 1) {
            $guess = bcpow($g, $n);
            $step = bcdiv($step, "2.0");
            $comp = bccomp($guess, $num); // compare our guess with real number 
            if ($comp == -1) { // if guess is lower we add the new step 
                $g = bcadd($g, $step);
            } else if ($comp == 1) { // if guess is higher we sub the new step 
                $g = bcsub($g, $step);
            } else { // if guess is exactly the num we're done, we return the value 
                return $g;
            }
        }

        // whatever happened, g is the closest guess we can make so return it 
        return $g;
    }

    public function index() {
        $a = 10927850545340136396499861;
        $i= 0;
        while ($i<13){
           $a = bcsqrt($a, 19);
//           $a = sqrt($a);
//           $a = sqrt($a);
            $i++;
        }
////        $a = sqrt(sqrt(sqrt($a)));
//       
       // echo $a;
       //exit();
        $expertAnswers = ExpertAnswers::orderBy("rel_user_id", 'asc')->orderBy("rel_question_id", 'asc')->get();
        $sumExperts = Experts::count();
        $sumExpertsQuestions = ExpertsQuestions::count();

        $fuzzy = new NewFuzzyAHP($expertAnswers, $sumExpertsQuestions, 10, 1);

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
