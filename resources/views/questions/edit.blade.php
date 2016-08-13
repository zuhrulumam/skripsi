@extends('layouts.app')

@section('content')
   <section class="content-header">
           <h1>
               Questions
           </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($questions, ['route' => ['questions.update', $questions->id], 'method' => 'patch']) !!}

                    @include('questions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection