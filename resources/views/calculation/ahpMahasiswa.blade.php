@extends('layouts.app')

@section('content')

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
            <td class="blank"> </td>
            @for($i=$min; $i<($min + $rowSubCount); $i++)
            <th>Sub Category  {{ $i }}</th>
            @endfor                   
        </tr>
        @for($i=$min; $i<($min + $rowSubCount); $i++)
        <tr>
            <td class="rowTitle">Sub Category {{ $i }}</td>
            @for($j=$min; $j<($min+$rowSubCount); $j++)
            <td>{{ $pairValue['faktor_'.$i.' / faktor_'.$j] }}</td>
            @endfor
        </tr>    
        @endfor                

    </table>

    @endforeach

    <h1>Group Pairwise User Sub Category {{ $key }}</h1>
    <table class="table table-bordered">
        <tr>
            <td class="blank"> </td>
            @for($i=$min; $i<($min + $rowSubCount); $i++)
            <th>Sub Category {{ $i }}</th>
            @endfor                   
        </tr>
        @for($i=$min; $i<($min + $rowSubCount); $i++)
        <tr>
            <td class="rowTitle">Category {{ $i }}</td>
            @for($j=$min; $j<($min+$rowSubCount); $j++)
            <td>{{ $subFactor['subNewPairwise']['faktor_'.$i.' / faktor_'.$j] }}</td>
            @endfor
        </tr>    
        @endfor    
        <tr class="success">
            <td>Sum Column</td>
            @for($i=$min; $i<($min + $rowSubCount); $i++)
            <td>{{ $subFactor['arraySumColumn']['sumColumn_'.$i] }}</td>
            @endfor                   
        </tr>

    </table>

    <h1>Update Pairwise User Sub Category {{ $key }}</h1>
    <table class="table table-bordered">
        <tr>
            <td class="blank"> </td>
            @for($i=$min; $i<($min + $rowSubCount); $i++)
            <th>Sub Category {{ $i }}</th>
            @endfor 
            <th class="danger">Sum Row</th>
            <th class="warning">Weight Priority</th>
        </tr>
        @for($i=$min; $i<($min + $rowSubCount); $i++)
        <tr>
            <td class="rowTitle">Category {{ $i }}</td>
            @for($j=$min; $j<($min+$rowSubCount); $j++)
            <td>{{ $subFactor['updatePairwise']['faktor_'.$i.' / faktor_'.$j] }}</td>
            @endfor
            <td class="danger">{{ $subFactor['arraySumRow']['sumRow_'.$i] }}</td>
            <td class="warning">{{ $subFactor['arrayWeightPriority']['weight_'.$i] }}</td>
        </tr> 
        @endfor   
    </table>
    
    <h2>Rank</h2>
    <?php $i = 1; ?>
    @foreach($subFactor['rank'] as $keys=>$value)
    {{ $i }}. {{ str_replace('weight_', ' Sub Factor ',$keys)}} = {{$value}} <br>
    <?php $i++ ?>
    @endforeach
	
    <h1>Consistency = {{ $subFactor['consistency'] }}</h1>
	
	
    <?php
//    $min += $rowSubCount;

}
?>
    <h2>Global Rank</h2>
     <?php $i = 1; ?>
    @foreach($globalRank as $keys=>$value)
	
    {{ $i }}. {{ str_replace('weight_', ' Sub Factor ',$keys)}} = {{$value }} <br>
    <?php $i++ ?>
    @endforeach
@endsection