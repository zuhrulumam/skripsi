@extends('layouts.app')

@section('content')
   <section class="content-header">
           <h1>
               Experts
           </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($experts, ['route' => ['experts.update', $experts->id], 'method' => 'patch']) !!}

                    @include('experts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection