@extends('layouts.app')

@section('content')
<script src="{!! asset('chart/Chart.bundle.min.js') !!}" ></script>
<script src="{!! asset('chart/config.js') !!}" ></script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Factors</h1>   
            <table class="table table-bordered">
                <tr>
                    <td class="blank"></td>
                    @foreach($factors as $factorKey=>$factorValue)
                    <td>Factor {{ $factorKey }}</td>
                    @endforeach
                </tr>                
                <tr>
                    <td>Bobot</td>

                    @foreach($factors as $factorKey=>$factorValue)
                    <td> {{ $factorValue }}</td>
                    @endforeach

                </tr>
            </table>
        </div>


        <div class="col-md-10 col-md-offset-1">
            <h1>Sub Factors</h1>

            <?php foreach ($subFactors as $key => $value) { ?>
                <?php $subFactor = $value; ?>
                <h2>Factor {{ $key }}</h2>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank"></td>
                        @foreach($subFactor['arrayWeightPriority'] as $rankKey=>$rankValue)
                        <td>{{ str_replace('weight_', ' Sub Factor ',$rankKey) }}</td>
                        @endforeach
                    </tr>                
                    <tr>
                        <td>Bobot</td>

                        @foreach($subFactor['arrayWeightPriority'] as $rankKey=>$rankValue)
                        <td>{{ $rankValue }}</td>
                        @endforeach

                    </tr>
                </table>

            <?php } ?>

        </div>

        <div class="col-md-10 col-md-offset-1">
            <h1>Global Rank</h1>
            <table class="table table-bordered">
                <tr>
                    <td class="blank"></td>
                    <th>Bobot</th>

                </tr>   
                @foreach($globalRank as $keys=>$value)                   

                <tr>
                    <td>{{ str_replace('weight_', ' Sub Factor ',$keys) }}</td>
                    <td>{{ str_replace('weight_', ' Sub Factor ',$value) }}</td>                

                </tr>
                @endforeach
            </table>
        </div>
        <?php
        arsort($globalRank);
        $i = 0;
        ?>
        <div class="col-md-10 col-md-offset-1">
            <h1>Ranking Global Rank</h1>
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <td class="blank"></td>
                    <th>Keterangan</th>
                    <th>Bobot</th>

                </tr>   
                @foreach($globalRank as $keys=>$value)                   
                <?php
                $currKey = explode("_", $keys);
                $i++;
                ?>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ str_replace('weight_', ' Sub Factor ',$keys) }}</td>
                    <td>{{ $keteranganSubFactor['Sub Factor '.$currKey[1]] }}</td>      
                    <td>{{ str_replace('weight_', ' Sub Factor ',$value) }}</td>   

                </tr>
                @endforeach
            </table>
            <?php
            $labels = [];
            $data = [];
            foreach ($globalRank as $keys => $value) {
                $currLabel = str_replace("weight_", "Sub Factor ", $keys);
                array_push($labels, $currLabel);
                $value = round($value, 6);
                array_push($data, $value);
            }
            ?>
            <canvas id="rank"></canvas>
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
        var rankData = {
        labels: <?php echo json_encode($labels); ?>,
                datasets: [
                {
                type: 'bar',
                        label: 'Global Rank',
                        backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
                        borderColor: window.chartColors.blue,
                        data: <?php echo json_encode($data); ?>,
                },
                ]
                };
        window.onload = function () {
        var ctx = document.getElementById("rank").getContext("2d");
                window.myBar = new Chart(ctx, {
                type: 'bar',
                        data: rankData,
                        options: {
                        responsive: true,
                                title: {
                                display: true,
                                        text: 'Global Rank'
                                },
                        }
                });
                }
            </script>
        </div>
    </div>
</div>
@endsection