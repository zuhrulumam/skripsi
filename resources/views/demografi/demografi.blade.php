@extends('layouts.app')

@section('content')
<script src="{!! asset('chart/Chart.bundle.min.js') !!}" ></script>
<script src="{!! asset('chart/config.js') !!}" ></script>

<h1>Demografi Dosen</h1>
<?php
$totalDosenEver = $result['dosen']['ever']['TOTAL'];
$totalDosenNever = $result['dosen']['never']['TOTAL'];

array_pop($result['dosen']['ever']);
array_pop($result['dosen']['never']);

$labels = array_keys($result['dosen']['ever']);
$ever = array_values($result['dosen']['ever']);
$never = array_values($result['dosen']['never']);
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Demografi Dosen</div>
                <div class="panel-body">
                    <canvas id="dosen"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
            window.chartColors = {
            red: 'rgb(255, 99, 132)',
                    orange: 'rgb(255, 159, 64)',
                    yellow: 'rgb(255, 205, 86)',
                    green: 'rgb(75, 192, 192)',
                    blue: 'rgb(54, 162, 235)',
                    purple: 'rgb(153, 102, 255)',
                    grey: 'rgb(231,233,237)'
            };
            var color = Chart.helpers.color;
            var dosenData = {
            labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                    type: 'bar',
                            label: 'Pernah Mengakses E-learning : <?php echo $totalDosenEver; ?>',
                            backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
                            borderColor: window.chartColors.blue,
                            data: <?php echo json_encode($ever); ?>,
                    }, {
                    type: 'bar',
                            label: 'Belum Pernah Mengakses E-learning : <?php echo $totalDosenNever; ?>',
                            backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
                            borderColor: window.chartColors.red,
                            data: <?php echo json_encode($never); ?>,
                    },
                    ]
            };</script>



<h1>Demografi Mahasiswa</h1>
<?php
$totalMahasiswaEver = $result['mahasiswa']['everFaculties']['TOTAL'];
$totalMahasiswaNever = $result['mahasiswa']['neverFaculties']['TOTAL'];

array_pop($result['mahasiswa']['everFaculties']);
array_pop($result['mahasiswa']['neverFaculties']);

$labelsMahasiswaFaculties = array_keys($result['mahasiswa']['everFaculties']);
$everMahasiswaFaculties = array_values($result['mahasiswa']['everFaculties']);
$neverMahasiswaFaculties = array_values($result['mahasiswa']['neverFaculties']);

$labelsMahasiswaYears = array_keys($result['mahasiswa']['everYear']);
$everMahasiswaYears = array_values($result['mahasiswa']['everYear']);
$neverMahasiswaYears = array_values($result['mahasiswa']['neverYear']);
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Demografi Fakultas Mahasiswa</div>
                <div class="panel-body">
                    <canvas id="mahasiswaFaculties"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Demografi Tahun Mahasiswa</div>
                <div class="panel-body">
                    <canvas id="mahasiswaYears"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
            var color = Chart.helpers.color;
            var mahasiswaFacultiesData = {
            labels: <?php echo json_encode($labelsMahasiswaFaculties); ?>,
                    datasets: [{
                    type: 'bar',
                            label: 'Pernah Mengakses E-learning : <?php echo $totalMahasiswaEver; ?>',
                            backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
                            borderColor: window.chartColors.blue,
                            data: <?php echo json_encode($everMahasiswaFaculties); ?>,
                    }, {
                    type: 'bar',
                            label: 'Belum Pernah Mengakses E-learning : <?php echo $totalMahasiswaNever; ?>',
                            backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
                            borderColor: window.chartColors.red,
                            data: <?php echo json_encode($neverMahasiswaFaculties); ?>,
                    },
                    ]
            };
            var mahasiswaYearsData = {
            labels: <?php echo json_encode($labelsMahasiswaYears); ?>,
                    datasets: [{
                    type: 'bar',
                            label: 'Pernah Mengakses E-learning : <?php echo $totalMahasiswaEver; ?>',
                            backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
                            borderColor: window.chartColors.blue,
                            data: <?php echo json_encode($everMahasiswaYears); ?>,
                    }, {
                    type: 'bar',
                            label: 'Belum Pernah Mengakses E-learning : <?php echo $totalMahasiswaNever; ?>',
                            backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
                            borderColor: window.chartColors.red,
                            data: <?php echo json_encode($neverMahasiswaYears); ?>,
                    },
                    ]
            };
            window.onload = function () {
            var ctx = document.getElementById("mahasiswaFaculties").getContext("2d");
                    window.myBar = new Chart(ctx, {
                    type: 'bar',
                            data: mahasiswaFacultiesData,
                            options: {
                            responsive: true,
                                    title: {
                                    display: true,
                                            text: 'Demografi Fakultas Mahasiswa'
                                    },
                            }
                    });
            var ctx = document.getElementById("mahasiswaYears").getContext("2d");
                    window.myBar = new Chart(ctx, {
                    type: 'bar',
                            data: mahasiswaYearsData,
                            options: {
                            responsive: true,
                                    title: {
                                    display: true,
                                            text: 'Demografi Tahun Mahasiswa'
                                    },
                            }
                    });
                    var ctx = document.getElementById("dosen").getContext("2d");
                    window.myBar = new Chart(ctx, {
                    type: 'bar',
                            data: dosenData,
                            options: {
                            responsive: true,
                                    title: {
                                    display: true,
                                            text: 'Demografi Dosen'
                                    },
                            }
                    });
            };
</script>



@endsection