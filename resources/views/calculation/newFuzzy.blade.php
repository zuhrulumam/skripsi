@extends('layouts.app')
<style>
    table {
        table-layout: fixed;
        word-wrap: break-word;
        overflow: hidden;
        border: 3px solid yellow;
    }
</style>
@section('content')

<section class="content-header">
    <h1 class="pull-left">Calculation</h1>

</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <?php
            $countFaktorPairwise = count($faktorPairwise);
            $rowCount = sqrt(count($faktorPairwise["PairwiseUser_1"]));
            ?>

            <h1>Pairwise Expert</h1>
            @for($k=1; $k<=$countFaktorPairwise; $k++)
            <h2>Pairwise Expert {{ $k }}</h2>
            <table class="table table-bordered">
                <tr>
                    <td class="blank" rowspan="2"> </td>
                    @for($i=0; $i<$rowCount; $i++)
                    <th colspan="3">Category <?php echo $i + 1 ?></th>
                    @endfor                   
                </tr>
                <tr>    
                    @for($i=0; $i<$rowCount; $i++)
                    <th>l</th>
                    <th>m</th>
                    <th>u</th>
                    @endfor
                </tr>
                @for($i=1; $i<=$rowCount; $i++)
                <tr>
                    <td class="rowTitle">Category {{ $i }}</td>
                    @for($j=1; $j<=$rowCount; $j++)
                    <td>{{ $faktorPairwise['PairwiseUser_'.$k]['faktor_'.$i.' / faktor_'.$j]['l'] }}</td>
                    <td>{{ $faktorPairwise['PairwiseUser_'.$k]['faktor_'.$i.' / faktor_'.$j]['m'] }}</td>
                    <td>{{ $faktorPairwise['PairwiseUser_'.$k]['faktor_'.$i.' / faktor_'.$j]['u'] }}</td>                    
                    @endfor
                </tr>    
                @endfor                

            </table>
            @endfor

            <h1>Group Pairwise Expert</h1>
            <table class="table table-bordered">
                <tr>
                    <td class="blank" rowspan="2"> </td>
                    @for($i=0; $i<$rowCount; $i++)
                    <th colspan="3">Category <?php echo $i + 1 ?></th>
                    @endfor                   
                </tr>
                <tr>    
                    @for($i=0; $i<$rowCount; $i++)
                    <th>l</th>
                    <th>m</th>
                    <th>u</th>
                    @endfor
                </tr>
                @for($i=1; $i<=$rowCount; $i++)
                <tr>
                    <td class="rowTitle">Category {{ $i }}</td>
                    @for($j=1; $j<=$rowCount; $j++)
                    <td>{{ $newPairwise['faktor_'.$i.' / faktor_'.$j]['l'] }}</td>
                    <td>{{ $newPairwise['faktor_'.$i.' / faktor_'.$j]['m'] }}</td>
                    <td>{{ $newPairwise['faktor_'.$i.' / faktor_'.$j]['u'] }}</td>
                    @endfor
                </tr>    
                @endfor                
                >
            </table>

            <h2>Geometric mean</h2>
            <table class="table table-bordered">
                <tr>
                    <td class="blank"> </td>
                    <th>l</th>
                    <th>m</th>
                    <th>u</th>
                </tr>                
                @for($i=1; $i<=$rowCount; $i++)
                <tr>
                    <td class="rowTitle">Category {{ $i }}</td>

                    <td>{{ $arrayGeometry['geometri_'.$i]['l'] }}</td>
                    <td>{{ $arrayGeometry['geometri_'.$i]['m'] }}</td>
                    <td>{{ $arrayGeometry['geometri_'.$i]['u'] }}</td>

                </tr>
                @endfor
                <tr>
                    <td class="rowTitle">Inverse Geometri</td>                    
                    <td>{{ $InverseGeometri['l'] }}</td>
                    <td>{{ $InverseGeometri['m'] }}</td>
                    <td>{{ $InverseGeometri['u'] }}</td>                  
                </tr>
            </table>

            <h2>Bobot</h2>
            <table class="table table-bordered">
                <tr>
                    <td class="blank"> </td>
                    <th>l</th>
                    <th>m</th>
                    <th>u</th>
                </tr>                
                @for($i=1; $i<=$rowCount; $i++)
                <tr>
                    <td class="rowTitle">Category {{ $i }}</td>

                    <td>{{ $weight['weight_'.$i]['l'] }}</td>
                    <td>{{ $weight['weight_'.$i]['m'] }}</td>
                    <td>{{ $weight['weight_'.$i]['u'] }}</td>

                </tr>
                @endfor

            </table>
            
             <h2>Defuzzy</h2>
            <table class="table table-bordered">
                <tr>
                    <td class="blank"> </td>
                    <th>Value</th>
                </tr>                
                @for($i=1; $i<=$rowCount; $i++)
                <tr>
                    <td class="rowTitle">Category {{ $i }}</td>                    
                    <td>{{ $defuzzy['defuzzy_'.$i] }}</td>             

                </tr>
                @endfor

            </table>
             
             <h2>Bobot Normal</h2>
            <table class="table table-bordered">
                <tr>
                    <td class="blank"> </td>
                    <th>Value</th>
                </tr>                
                @for($i=1; $i<=$rowCount; $i++)
                <tr>
                    <td class="rowTitle">Category {{ $i }}</td>                    
                    <td>{{ $normalWeight['normalWeight_'.$i] }}</td> 
                </tr>
                @endfor

            </table>
             
             
            <h2>Rank</h2>
            <?php $i = 1; ?>
            @foreach($rank as $key=>$value)
            {{ $i }}. {{ str_replace('normalWeight_', ' Factor ',$key)}} = {{$value}} <br>
            <?php $i++ ?>
            @endforeach
        </div>
    </div>
</div>

@endsection

