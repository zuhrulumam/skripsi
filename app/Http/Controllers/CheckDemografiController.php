<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Users;

class CheckDemografiController extends Controller {

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

    public function checkDemografiMahasiswa($checkedUser) {
        $ever = $checkedUser['ever'];
        $never = $checkedUser['never'];

        $everFaculty = [];
        $neverFaculty = [];

        //ever
        $countEverUser = count($ever);
        for ($i = 0; $i < $countEverUser; $i++) {
            $currNIM = $ever[$i]->identityNumber[0];

            if (!array_key_exists($currNIM, $everFaculty)) {
                $everFaculty[$currNIM] = 1;
            } else {
                $everFaculty[$currNIM] ++;
            }
        }

        $everFaculty['TOTAL'] = $countEverUser;

        //never -> yang belum pernah mengakses elearning
        $countNeverUser = count($never);

        for ($i = 0; $i < $countNeverUser; $i++) {

            $currNIM = $never[$i]->identityNumber[0];
            if (!array_key_exists($currNIM, $neverFaculty)) {
                $neverFaculty[$currNIM] = 1;
            } else {
                $neverFaculty[$currNIM] ++;
            }
        }

        $neverFaculty['TOTAL'] = $countNeverUser;
        $result = [
            'ever' => $everFaculty,
            'never' => $neverFaculty,
        ];

        return $result;
    }

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

    public function chooseCompletedUser() {

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
        $completedUser = $this->chooseCompletedUser();

        //dosen
        $everAccessedDosen = $this->checkAccessed($completedUser['dosen']);
        $demografiDosen = $this->checkDemografiDosen($everAccessedDosen);

        //mahasiswa
        $everAccessedMahasiswa = $this->checkAccessed($completedUser['mahasiswa']);
        $demografiMahasiswa = $this->checkDemografiMahasiswa($everAccessedMahasiswa);

        $result = [
            'dosen' => $demografiDosen,
            'mahasiswa' => $demografiMahasiswa
        ];

        return view('demografi.demografi', [
            'result' => $result
        ]);
    }

}
