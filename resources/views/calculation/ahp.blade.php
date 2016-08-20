@extends('layouts.app')

@section('content')
<?php
$countFaktorPairwise = count($faktor['faktorPairwise']);
$rowCount = sqrt(count($faktor['faktorPairwise']["PairwiseUser_1"]));
?>

<h1>Pairwise Expert</h1>
@for($k=1; $k<=$countFaktorPairwise; $k++)
<h2>Pairwise Expert {{ $k }}</h2>
<table class="table table-bordered">
    <tr>
        <td class="blank"> </td>
        @for($i=0; $i<$rowCount; $i++)
        <th>Category <?php echo $i + 1 ?></th>
        @endfor                   
    </tr>
    @for($i=1; $i<=$rowCount; $i++)
    <tr>
        <td class="rowTitle">Category {{ $i }}</td>
        @for($j=1; $j<=$rowCount; $j++)
        <td>{{ $faktor['faktorPairwise']['PairwiseUser_'.$k]['faktor_'.$i.' / faktor_'.$j] }}</td>
        @endfor
    </tr>    
    @endfor                

</table>
@endfor

<h1>Group Pairwise Expert</h1>
<table class="table table-bordered">
    <tr>
        <td class="blank"> </td>
        @for($i=0; $i<$rowCount; $i++)
        <th>Category <?php echo $i + 1 ?></th>
        @endfor                   
    </tr>
    @for($i=1; $i<=$rowCount; $i++)
    <tr>
        <td class="rowTitle">Category {{ $i }}</td>
        @for($j=1; $j<=$rowCount; $j++)
        <td>{{ $faktor['newPairwise']['faktor_'.$i.' / faktor_'.$j] }}</td>
        @endfor
    </tr>    
    @endfor                
    <tr class="success">
        <td>Sum Column</td>
        @for($i=1; $i<=$rowCount; $i++)
        <td>{{ $faktor['arraySumColumn']['sumColumn_'.$i] }}</td>
        @endfor                   
    </tr>
</table>

<h1>Update Pairwise Expert</h1>
<table class="table table-bordered">
    <tr>
        <td class="blank"> </td>
        @for($i=0; $i<$rowCount; $i++)
        <th>Category <?php echo $i + 1 ?></th>
        @endfor
        <th class="danger">Sum Row</th>
        <th class="warning">Weight Priority</th>
    </tr>
    @for($i=1; $i<=$rowCount; $i++)
    <tr>
        <td class="rowTitle">Category {{ $i }}</td>
        @for($j=1; $j<=$rowCount; $j++)
        <td>{{ $faktor['updatePairwise']['faktor_'.$i.' / faktor_'.$j] }}</td>
        @endfor
        <td class="danger">{{ $faktor['arraySumRow']['sumRow_'.$i] }}</td>
        <td class="warning">{{ $faktor['arrayWeightPriority']['weight_'.$i] }}</td>
    </tr> 
    @endfor   
</table>


<h2>Rank</h2>
<?php $i = 1; ?>
@foreach($faktor['rank'] as $key=>$value)
{{ $i }}. {{ str_replace('weight_', ' Factor ',$key)}} = {{$value}} <br>
<?php $i++ ?>
@endforeach

<h1>Consistency = {{ $faktor['consistency'] }}</h1>


<h1>Sub Factors</h1>
<?php $min = 1; ?>
<?php for ($k = 1; $k <= count($subFactors); $k++) { ?>
    <?php $subFactor = $subFactors[$k]; ?>
    <h2>Pairwise Sub Category {{ $k }}</h2>
    <?php
    $countSubFaktorPairwise = count($subFactor['pairwise']);

    $rowSubCount = sqrt(count($subFactor['pairwise']["PairwiseUser_1"]));
    ?>
    @for($m=1; $m<=$countSubFaktorPairwise; $m++)
    <h2>Pairwise Sub Category {{ $k }} User {{ $m }}</h2>

    <table class="table table-bordered">
        <tr>
            <td class="blank"> </td>
            @for($i=$min; $i<($min + $rowSubCount); $i++)
            <th>Category {{ $i }}</th>
            @endfor                   
        </tr>
        @for($i=$min; $i<($min + $rowSubCount); $i++)
        <tr>
            <td class="rowTitle">Category {{ $i }}</td>
            @for($j=$min; $j<($min+$rowSubCount); $j++)
            <td>{{ $subFactor['pairwise']['PairwiseUser_'.$m]['faktor_'.$i.' / faktor_'.$j] }}</td>
            @endfor
        </tr>    
        @endfor                

    </table>
    @endfor

    <h1>Group Pairwise User Sub Category {{ $k }}</h1>
    <table class="table table-bordered">
        <tr>
            <td class="blank"> </td>
            @for($i=$min; $i<($min + $rowSubCount); $i++)
            <th>Category {{ $i }}</th>
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

    <h1>Update Pairwise User Sub Category {{ $k }}</h1>
    <table class="table table-bordered">
        <tr>
            <td class="blank"> </td>
            @for($i=$min; $i<($min + $rowSubCount); $i++)
            <th>Category {{ $i }}</th>
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
    @foreach($subFactor['rank'] as $key=>$value)
    {{ $i }}. {{ str_replace('weight_', ' Factor ',$key)}} = {{$value}} <br>
    <?php $i++ ?>
    @endforeach

    <h1>Consistency = {{ $subFactor['consistency'] }}</h1>
    <?php
    $min += $rowSubCount;
}
?>
@endsection