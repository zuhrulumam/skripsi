@extends('layouts.app')

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
            <h1>Factor</h1>
            <?php $factor = $result['factor']; ?>

            <h2>Pairwise</h2>
            <?php $rowCount = sqrt(count($factor['pairwise'])); ?>
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
                    <td>{{ $factor['pairwise']['category_'.$i.'/category_'.$j] }}</td>
                    @endfor
                </tr>    
                @endfor                
                <tr class="success">
                    <td>Sum Column</td>
                    @for($i=1; $i<=$rowCount; $i++)
                    <td>{{ $factor['columnSum']['sumColumn_'.$i] }}</td>
                    @endfor                   
                </tr>
            </table>

            <h2>New Pairwise</h2>
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
                    <td>{{ $factor['newPairwise']['category_'.$i.'/category_'.$j] }}</td>
                    @endfor
                    <td class="danger">{{ $factor['rowSum']['sumRow_'.$i] }}</td>
                    <td class="warning">{{ $factor['weight']['weight_'.$i] }}</td>
                </tr>    
                @endfor                

            </table>

            <h2>Rank</h2>
            <?php $i = 1; ?>
            @foreach($factor['rank'] as $key=>$value)
            {{ $i }}. {{ str_replace('weight_', ' Factor ',$key)}} = {{$value}} <br>
            <?php $i++ ?>
            @endforeach

            <h1>Sub Factors</h1>
            <?php for ($k = 1; $k <= count($result['subFactors']); $k++) { ?>
                <?php $subFactor = $result['subFactors'][$k]; ?>
                <h2>Pairwise Sub Category {{ $k }}</h2>
                <?php $rowSubCount = sqrt(count($subFactor['pairwise'])); ?>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank"> </td>
                        @for($i=0; $i<($rowSubCount); $i++)
                        <th>Sub <?php echo $i + 1 ?> Category {{ $k }}</th>
                        @endfor                   
                    </tr>
                    @for($i=0; $i<($rowSubCount); $i++)
                    <tr>
                        <td class="rowTitle">Sub <?php echo $i + 1 ?> Category {{ $k }}</td>
                        @for($j=0; $j<($rowSubCount); $j++)
                        <td>{{ $subFactor['pairwise'][$i.'/'.$j] }}</td>
                        @endfor
                    </tr>    
                    @endfor 
                    <tr class="success">
                        <td>Sum Column</td>
                        @for($i=0; $i<$rowSubCount; $i++)
                        <td>{{ $subFactor['columnSum']['sumColumn_'.$i] }}</td>
                        @endfor                   
                    </tr>
                </table>


                <h2>New Pairwise</h2>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank"> </td>                        
                        @for($i=0; $i<($rowSubCount); $i++)
                        <th>Sub <?php echo $i + 1 ?> Category {{ $k }}</th>
                        @endfor           
                        <th class="danger">Row Sum</th>
                        <th class="warning">Weight Priority</th>
                    </tr>
                    @for($i=0; $i<($rowSubCount); $i++)
                    <tr>
                        <td class="rowTitle">Sub <?php echo $i + 1 ?> Category {{ $k }}</td>
                        @for($j=0; $j<($rowSubCount); $j++)
                        <td>{{ $subFactor['newPairwise'][$i.'/'.$j] }}</td>
                        @endfor                    
                        <td class="danger">{{ $subFactor['rowSum']['sumRow_'.$i] }}</td>
                        <td class="warning">{{ $subFactor['weight']['weight_'.$i] }}</td>
                    </tr>    
                    @endfor                

                </table>
                <h2>Rank</h2>
                <?php $i = 1; ?>
                @foreach($subFactor['rank'] as $key=>$value)
                <?php $str = explode("_", $key);?>
                {{ $i }}. {{ 'Sub '.($str[1]+1).' Factor '.$k }} = {{$value}} <br>
                {{ 'Global Weight = '.($factor['rank']['weight_'.$k]*$value) }} <br>
                <?php $i++ ?>
                @endforeach
            <?php } ?>

        </div>
    </div>
</div>
@endsection

