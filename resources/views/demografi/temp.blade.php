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

<h2>Demografi Mahasiswa Penah Mengakses E-learning dan menjawab lengkap</h2>
<table class="table table-bordered">
    <tr>
        <th>Fakultas</th>                  
        <th>Jumlah</th>                 
    </tr>
    @foreach($result['mahasiswa']['everFaculties'] as $key=>$value)
    <tr>

        <td>{{ $key }}</td>
        <td>{{ $value }}</td>

    </tr>   
    @endforeach


</table>
<h2>Demografi Tahun Mahasiswa Penah Mengakses E-learning dan menjawab lengkap</h2>
<table class="table table-bordered">
    <tr>
        <th>Tahun</th>                  
        <th>Jumlah</th>                 
    </tr>
    @foreach($result['mahasiswa']['everYear'] as $key=>$value)
    <tr>

        <td>{{ $key }}</td>
        <td>{{ $value }}</td>

    </tr>   
    @endforeach


</table>

<h2>Demografi mahasiswa Belum Pernah Mengakses E-learning dan menjawab lengkap</h2>
<table class="table table-bordered">
    <tr>
        <th>Fakultas</th>                  
        <th>Jumlah</th>                  
    </tr>
    @foreach($result['mahasiswa']['neverFaculties'] as $key=>$value)
    <tr>

        <td>{{ $key }}</td>
        <td>{{ $value }}</td>

    </tr>   
    @endforeach

</table>

<h2>Demografi Tahun Mahasiswa Belum Pernah Mengakses E-learning dan menjawab lengkap</h2>
<table class="table table-bordered">
    <tr>
        <th>Tahun</th>                  
        <th>Jumlah</th>                 
    </tr>
    @foreach($result['mahasiswa']['neverYear'] as $key=>$value)
    <tr>

        <td>{{ $key }}</td>
        <td>{{ $value }}</td>

    </tr>   
    @endforeach


</table>