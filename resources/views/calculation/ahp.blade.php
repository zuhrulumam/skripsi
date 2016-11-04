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



@endsection