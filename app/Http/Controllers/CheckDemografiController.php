<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Users;
use App\Models\UserQuestions;

class CheckDemografiController extends Controller {

    public $everAccessedMahasiswa = [];
    public $neverAccessedMahasiswa = [];

    public function checkDemografiDosen($checkedUser) {
        $ever = $checkedUser['ever'];
        $never = $checkedUser['never'];

        $everFaculty = [];
        $neverFaculty = [];

        //ever -> yang pernah mengakses elearning
        $countEverUser = count($ever);
        for ($i = 0; $i < $countEverUser; $i++) {
            $currFaculty = $ever[$i]->getFaculty->FAKULTAS;
            if (!array_key_exists($currFaculty, $everFaculty)) {
                $everFaculty[$currFaculty] = 1;
            } else {
                $everFaculty[$currFaculty] ++;
            }
        }

        $everFaculty['TOTAL'] = $countEverUser;

        //never -> yang belum pernah mengakses elearning
        $countNeverUser = count($never);
        for ($i = 0; $i < $countNeverUser; $i++) {
            $currFaculty = $never[$i]->getFaculty->FAKULTAS;
            if (!array_key_exists($currFaculty, $neverFaculty)) {
                $neverFaculty[$currFaculty] = 1;
            } else {
                $neverFaculty[$currFaculty] ++;
            }
        }
        $neverFaculty['TOTAL'] = $countNeverUser;
        $result = [
            'ever' => $everFaculty,
            'never' => $neverFaculty,
        ];

        return $result;
    }

    public function checkDemografiMahasiswa() {
        $faculties = [
            'D' => 'FISIP',
            'E' => 'FH',
            'I' => 'FT',
            'C' => 'FSSR',
            'H' => 'FP',
            'F' => 'FEB',
            'K' => 'FKIP',
            'M' => 'MIPA',
            'G' => 'FK',
            'R' => 'FK',
            'X' => 'FKIP',
            'S' => 'PASCA SARJANA',
            'T' => 'PASCA SARJANA',
            'B' => 'PASCA SARJANA',
            'A' => 'PASCA SARJANA',
        ];

        $everFaculty = [];
        $neverFaculty = [];

        $everYear = [];
        $neverYear = [];

        //ever
        $countEverUser = count($this->everAccessedMahasiswa);
        for ($i = 0; $i < $countEverUser; $i++) {
            $currNIM = $this->everAccessedMahasiswa[$i]->identityNumber[0];
            $key = $faculties[$currNIM];

            $currYear = '20' . $this->everAccessedMahasiswa[$i]->identityNumber[3] . $this->everAccessedMahasiswa[$i]->identityNumber[4];

            if (!array_key_exists($key, $everFaculty)) {
                $everFaculty[$key] = 1;
            } else {
                $everFaculty[$key] ++;
            }
            if (!array_key_exists($currYear, $everYear)) {
                $everYear[$currYear] = 1;
            } else {
                $everYear[$currYear] ++;
            }
        }

        $everFaculty['TOTAL'] = $countEverUser;

        //never -> yang belum pernah mengakses elearning
        $countNeverUser = count($this->neverAccessedMahasiswa);

        for ($i = 0; $i < $countNeverUser; $i++) {
            $currNIM = $this->neverAccessedMahasiswa[$i]->identityNumber[0];
            $key = $faculties[$currNIM];
            $currYear = '20' . $this->neverAccessedMahasiswa[$i]->identityNumber[3] . $this->neverAccessedMahasiswa[$i]->identityNumber[4];

            if (!array_key_exists($currYear, $neverYear)) {
                $neverYear[$currYear] = 1;
            } else {
                $neverYear[$currYear] ++;
            }

            if (!array_key_exists($key, $neverFaculty)) {
                $neverFaculty[$key] = 1;
            } else {
                $neverFaculty[$key] ++;
            }
        }

        $neverFaculty['TOTAL'] = $countNeverUser;

        $result = [
            'everFaculties' => $everFaculty,
            'everYear' => $everYear,
            'neverYear' => $neverYear,
            'neverFaculties' => $neverFaculty,
        ];

        return $result;
    }

    public function checkAccessed($completedUser) {
        $everAccessedUser = [];
        $neverAccessedUser = [];
        $countCompletedUser = count($completedUser);

        for ($j = 0; $j < $countCompletedUser; $j++) {
            $countAnswers = count($completedUser[$j]->getAnswers);
//            $k = 0;
//            $flag = false;
            for ($i = 0; $i < $countAnswers; $i++) {
//                $k++;
                $currQuestionId = $completedUser[$j]->getAnswers[$i]->rel_question_id;
//                if ($k > $currQuestionId) {
////                    $completedUser[$j]->getAnswers[$i]->rel_question_id = $k;
//                    $flag = TRUE;
//                    $userQ = UserQuestions::where("rel_user_id", $completedUser[$j]->id)
//                            ->where("rel_question_id", $currQuestionId)
//                            ->first();
//                    
//                           $userQ->update(["rel_question_id" => $k]);
//                }
                if ($currQuestionId == 31) {

                    $answer = $completedUser[$j]->getAnswers[$i]->rel_answer;
                    if ($answer == 1) {
//                        echo $completedUser[$j]->id.'<br>';
                        array_push($everAccessedUser, $completedUser[$j]);
                    } else {
//                        echo $completedUser[$j]->id.'<br>';
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

    public function getCompletedUser() {

        $users = Users::orderBy("id", 'asc')->get();

        $countUser = count($users);
        $completedMahasiswa = [];
        $completedDosen = [];

        for ($i = 0; $i < $countUser; $i++) {
            $currUser = $users[$i];
            $currKeterangan = json_decode($currUser->keterangan);

            if ($currKeterangan->answered == 2) {
                if ($currKeterangan->type == "mahasiswa") {
                    array_push($completedMahasiswa, $currUser);
                } else {
                    array_push($completedDosen, $currUser);
                }
            }
        }

        $result = [
            'mahasiswa' => $completedMahasiswa,
            'dosen' => $completedDosen,
        ];

        return $result;
    }

    public function check() {
        $completedUser = $this->getCompletedUser();

        //dosen
        $accessedDosen = $this->checkAccessed($completedUser['dosen']);
        $demografiDosen = $this->checkDemografiDosen($accessedDosen);

        //mahasiswa
        $accessedMahasiswa = $this->checkAccessed($completedUser['mahasiswa']);
        $this->everAccessedMahasiswa = $accessedMahasiswa['ever'];
        $this->neverAccessedMahasiswa = $accessedMahasiswa['never'];

        $demografiMahasiswa = $this->checkDemografiMahasiswa();

        $result = [
            'dosen' => $demografiDosen,
            'mahasiswa' => $demografiMahasiswa
        ];

        return view('demografi.demografi', [
            'result' => $result
        ]);
    }

}
