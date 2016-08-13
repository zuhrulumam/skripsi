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
            <h1>Factor</h1>
            <?php $factor = $result['factor']; ?>

            <h2>Pairwise</h2>
            <?php $rowCount = sqrt(count($factor['pairwise'])); ?>
            <div class="table-responsive">
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
                        <td>{{ $factor['pairwise']['category_'.$i.'/category_'.$j]['l'] }}</td>
                        <td>{{ $factor['pairwise']['category_'.$i.'/category_'.$j]['m'] }}</td>
                        <td>{{ $factor['pairwise']['category_'.$i.'/category_'.$j]['u'] }}</td>
                        @endfor
                    </tr>
                    @endfor
                </table>
            </div>

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

                    <td>{{ $factor['geometriMean']['geometri_'.$i]['l'] }}</td>
                    <td>{{ $factor['geometriMean']['geometri_'.$i]['m'] }}</td>
                    <td>{{ $factor['geometriMean']['geometri_'.$i]['u'] }}</td>

                </tr>
                @endfor
                <tr>
                    <td class="rowTitle">Inverse Geometri</td>                    
                    <td>{{ $factor['InverseGeometri']['l'] }}</td>
                    <td>{{ $factor['InverseGeometri']['m'] }}</td>
                    <td>{{ $factor['InverseGeometri']['u'] }}</td>                    
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

                    <td>{{ $factor['weight']['weight_'.$i]['l'] }}</td>
                    <td>{{ $factor['weight']['weight_'.$i]['m'] }}</td>
                    <td>{{ $factor['weight']['weight_'.$i]['u'] }}</td>

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
                    <td>{{ $factor['defuzzy']['defuzzy_'.$i] }}</td>             

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
                    <td>{{ $factor['normalWeight']['normalWeight_'.$i] }}</td>             

                </tr>
                @endfor

            </table>

            <h2>Rank</h2>
            <?php $i = 1; ?>
            @foreach($factor['rank'] as $key=>$value)
            {{ $i }}. {{ str_replace('normalWeight_', ' Factor ',$key)}} = {{$value}} <br>
            <?php $i++ ?>
            @endforeach

            <h1>Sub Factors</h1>
            <?php for ($k = 1; $k <= count($result['subFactors']); $k++) { ?>
                <?php $subFactor = $result['subFactors'][$k]; ?>
                <h2>Pairwise Sub Category {{ $k }}</h2>
                <?php $rowSubCount = sqrt(count($subFactor['pairwise'])); ?>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank" rowspan="2"> </td>
                        @for($i=0; $i<$rowSubCount; $i++)
                        <th colspan="3">Sub <?php echo $i + 1 ?> Category {{ $k }}</th>
                        @endfor 
                    </tr>
                    <tr>    
                        @for($i=0; $i<$rowSubCount; $i++)
                        <th>l</th>
                        <th>m</th>
                        <th>u</th>
                        @endfor
                    </tr>
                    @for($i=0; $i<$rowSubCount; $i++)
                    <tr>
                        <td class="rowTitle">Sub <?php echo $i + 1 ?> Category {{ $k }}</td>
                        @for($j=0; $j<$rowSubCount; $j++)
                        <td>{{ $subFactor['pairwise'][$i.'/'.$j]['l'] }}</td>
                        <td>{{ $subFactor['pairwise'][$i.'/'.$j]['m'] }}</td>
                        <td>{{ $subFactor['pairwise'][$i.'/'.$j]['u'] }}</td>
                        @endfor
                    </tr>
                    @endfor
                </table>

                <h2>Geometric mean</h2>
                <table class="table table-bordered">
                    <tr>
                        <td class="blank"> </td>
                        <th>l</th>
                        <th>m</th>
                        <th>u</th>
                    </tr>                
                    @for($i=0; $i<$rowSubCount; $i++)
                    <tr>
                        <td class="rowTitle">Sub <?php echo $i + 1 ?> Category {{ $k }}</td>

                        <td>{{ $subFactor['geometriMean']['geometri_'.$i]['l'] }}</td>
                        <td>{{ $subFactor['geometriMean']['geometri_'.$i]['m'] }}</td>
                        <td>{{ $subFactor['geometriMean']['geometri_'.$i]['u'] }}</td>

                    </tr>
                    @endfor
                    <tr>
                        <td class="rowTitle">Inverse Geometri</td>                    
                        <td>{{ $subFactor['InverseGeometri']['l'] }}</td>
                        <td>{{ $subFactor['InverseGeometri']['m'] }}</td>
                        <td>{{ $subFactor['InverseGeometri']['u'] }}</td>                    
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
                 @for($i=0; $i<$rowSubCount; $i++)
                <tr>
                    <td class="rowTitle">Sub <?php echo $i + 1 ?> Category {{ $k }}</td>

                    <td>{{ $subFactor['weight']['weight_'.$i]['l'] }}</td>
                    <td>{{ $subFactor['weight']['weight_'.$i]['m'] }}</td>
                    <td>{{ $subFactor['weight']['weight_'.$i]['u'] }}</td>

                </tr>
                @endfor

            </table>
                  <h2>Defuzzy</h2>
            <table class="table table-bordered">
                <tr>
                    <td class="blank"> </td>
                    <th>Value</th>
                </tr>                
                @for($i=0; $i<$rowSubCount; $i++)
                <tr>
                    <td class="rowTitle">Sub <?php echo $i + 1 ?> Category {{ $k }}</td>                    
                    <td>{{ $subFactor['defuzzy']['defuzzy_'.$i] }}</td>             

                </tr>
                @endfor

            </table>

            <h2>Bobot Normal</h2>
            <table class="table table-bordered">
                <tr>
                    <td class="blank"> </td>
                    <th>Value</th>
                </tr>                
                 @for($i=0; $i<$rowSubCount; $i++)
                <tr>
                    <td class="rowTitle">Sub <?php echo $i + 1 ?> Category {{ $k }}</td>                    
                    <td>{{ $subFactor['normalWeight']['normalWeight_'.$i] }}</td>             

                </tr>
                @endfor

            </table>

            <h2>Rank</h2>
            <?php $i = 1; ?>
            @foreach($subFactor['rank'] as $key=>$value)
            <?php $str = explode("_", $key);?>
             {{ $i }}. {{ 'Sub '.($str[1]+1).' Factor '.$k }} = {{$value}} <br>
            <?php $i++ ?>
            @endforeach
            <?php } ?>


        </div>
    </div>
</div>
@endsection

