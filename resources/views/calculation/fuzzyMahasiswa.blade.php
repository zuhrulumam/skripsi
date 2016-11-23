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
            <h1>Sub Factors</h1>
            <?php foreach ($subFactors as $key => $value) { ?>
                <?php $subFactor = $value; ?>
                <h2>Pairwise Sub Category {{ $key }}</h2>
                <?php
                $countSubFaktorPairwise = $subFactor['countSubFaktorPairwise'];

                $rowSubCount = $subFactor['rowSubCount'];
                $min = $subFactor['min'];
                ?>
                @foreach($subFactor['pairwise'] as $pairKey=>$pairValue)
                <h2>Pairwise Sub Category {{ $key }} User {{ str_replace('PairwiseUser_', '',$pairKey)}}</h2>

                <table class="table table-bordered">
                    <tr>
                        <td class="blank"  rowspan="2"> </td>
                        @for($i=$min; $i<($min + $rowSubCount); $i++)
                        <th colspan="3">Category {{ $i }}</th>
                        @endfor                   
                    </tr>
                    <tr>    
                        @for($i=0; $i<$rowSubCount; $i++)
                        <th>l</th>
                        <th>m</th>
                        <th>u</th>
                        @endfor
                    </tr>
                    @for($i=$min; $i<($min + $rowSubCount); $i++)
                    <tr>
                        <td class="rowTitle">Category {{ $i }}</td>
                        @for($j=$min; $j<($min+$rowSubCount); $j++)
                        <td>{{ $pairValue['faktor_'.$i.' / faktor_'.$j]['l'] }}</td>
                        <td>{{ $pairValue['faktor_'.$i.' / faktor_'.$j]['m'] }}</td>
                        <td>{{ $pairValue['faktor_'.$i.' / faktor_'.$j]['u'] }}</td>                    
                        @endfor
                    </tr>    
                    @endfor                

                </table>               
                @endforeach
                
                <h1>Group Pairwise User Sub Category {{ $key }}</h1>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank" rowspan="2"> </td>
                        @for($i=0; $i<$rowSubCount; $i++)
                        <th colspan="3">Category <?php echo $i + 1 ?></th>
                        @endfor                   
                    </tr>
                    <tr>    
                        @for($i=0; $i<$rowSubCount; $i++)
                        <th>l</th>
                        <th>m</th>
                        <th>u</th>
                        @endfor
                    </tr>
                    @for($i=$min; $i<($min + $rowSubCount); $i++)
                    <tr>
                        <td class="rowTitle">Category {{ $i }}</td>
                        @for($j=$min; $j<($min+$rowSubCount); $j++)
                        <td>{{ $subFactor['newPairwise']['faktor_'.$i.' / faktor_'.$j]['l'] }}</td>
                        <td>{{ $subFactor['newPairwise']['faktor_'.$i.' / faktor_'.$j]['m'] }}</td>
                        <td>{{ $subFactor['newPairwise']['faktor_'.$i.' / faktor_'.$j]['u'] }}</td>
                        @endfor
                    </tr>    
                    @endfor                

                </table>
                
                 <h2>Geometric mean User Sub Category {{ $key }}</h2>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank"> </td>
                        <th>l</th>
                        <th>m</th>
                        <th>u</th>
                    </tr>                
                    @for($i=$min; $i<($min + $rowSubCount); $i++)
                    <tr>
                        <td class="rowTitle">Category {{ $i }}</td>

                        <td>{{ $subFactor['arrayGeometry']['geometri_'.$i]['l'] }}</td>
                        <td>{{ $subFactor['arrayGeometry']['geometri_'.$i]['m'] }}</td>
                        <td>{{ $subFactor['arrayGeometry']['geometri_'.$i]['u'] }}</td>

                    </tr>
                    @endfor
                    <tr>
                        <td class="rowTitle">Inverse Geometri</td>                    
                        <td>{{ $subFactor['InverseGeometri']['l'] }}</td>
                        <td>{{ $subFactor['InverseGeometri']['m'] }}</td>
                        <td>{{ $subFactor['InverseGeometri']['u'] }}</td>                  
                    </tr>
                </table>
                 
                   <h2>Bobot User Sub Category {{ $key }}</h2>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank"> </td>
                        <th>l</th>
                        <th>m</th>
                        <th>u</th>
                    </tr>                
                    @for($i=$min; $i<($min + $rowSubCount); $i++)
                    <tr>
                        <td class="rowTitle">Category {{ $i }}</td>

                        <td>{{ $subFactor['weight']['weight_'.$i]['l'] }}</td>
                        <td>{{ $subFactor['weight']['weight_'.$i]['m'] }}</td>
                        <td>{{ $subFactor['weight']['weight_'.$i]['u'] }}</td>

                    </tr>
                    @endfor

                </table>

                <h2>Defuzzy User Sub Category {{ $key }}</h2>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank"> </td>
                        <th>Value</th>
                    </tr>                
                    @for($i=$min; $i<($min + $rowSubCount); $i++)
                    <tr>
                        <td class="rowTitle">Category {{ $i }}</td>                    
                        <td>{{ $subFactor['defuzzy']['defuzzy_'.$i] }}</td>             

                    </tr>
                    @endfor

                </table>

                <h2>Bobot Normal User Sub Category {{ $key }}</h2>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank"> </td>
                        <th>Value</th>
                    </tr>                
                    @for($i=$min; $i<($min + $rowSubCount); $i++)
                    <tr>
                        <td class="rowTitle">Category {{ $i }}</td>                    
                        <td>{{ $subFactor['normalWeight']['normalWeight_'.$i] }}</td> 
                    </tr>
                    @endfor

                </table>


                <h2>Rank</h2>
                <?php $i = 1; ?>
                @foreach($subFactor['rank'] as $keys=>$value)
                {{ $i }}. {{ str_replace('normalWeight_', ' Sub Factor ',$keys)}} = {{$value}} <br>
                <?php $i++ ?>
                @endforeach
				
				<h2>Global Rank</h2>
    <?php $i = 1; ?>
    @foreach($subFactor['rank'] as $keys=>$value)
	<?php $indexFactor = $key-1; $result = $value * $factors[$indexFactor];?>
    {{ $i }}. {{str_replace('normalWeight_', ' Sub Factor ',$keys)}} = {{$result}} <br>
    <?php $i++ ?>
    @endforeach

                <?php
            }
            ?>
        </div>
    </div>
</div>
@endsection