@extends('layouts.app')

@section('content')

<h1>Demografi Dosen</h1>
<h2>Demografi Dosen Penah Mengakses E-learning dan menjawab lengkap</h2>
<table class="table table-bordered">
    <tr>
        <th>Fakultas</th>                  
        <th>Jumlah</th>                 
    </tr>
    @foreach($result['dosen']['ever'] as $key=>$value)
    <tr>

        <td>{{ $key }}</td>
        <td>{{ $value }}</td>

    </tr>   
    @endforeach
    

</table>

<h2>Demografi Dosen Belum Penah Mengakses E-learning dan menjawab lengkap</h2>
<table class="table table-bordered">
    <tr>
        <th>Fakultas</th>                  
        <th>Jumlah</th>                  
    </tr>
    @foreach($result['dosen']['never'] as $key=>$value)
    <tr>

        <td>{{ $key }}</td>
        <td>{{ $value }}</td>

    </tr>   
    @endforeach

</table>

<h1>Demografi Mahasiswa</h1>
<h2>Demografi Mahasiswa Penah Mengakses E-learning dan menjawab lengkap</h2>
<table class="table table-bordered">
    <tr>
        <th>Fakultas</th>                  
        <th>Jumlah</th>                 
    </tr>
    @foreach($result['mahasiswa']['ever'] as $key=>$value)
    <tr>

        <td>{{ $key }}</td>
        <td>{{ $value }}</td>

    </tr>   
    @endforeach
    

</table>

<h2>Demografi mahasiswa Belum Penah Mengakses E-learning dan menjawab lengkap</h2>
<table class="table table-bordered">
    <tr>
        <th>Fakultas</th>                  
        <th>Jumlah</th>                  
    </tr>
    @foreach($result['mahasiswa']['never'] as $key=>$value)
    <tr>

        <td>{{ $key }}</td>
        <td>{{ $value }}</td>

    </tr>   
    @endforeach

</table>
@endsection