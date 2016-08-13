@extends('layouts.app')

@section('content')
   <section class="content-header">
           <h1>
               UserQuestions
           </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($userQuestions, ['route' => ['userQuestions.update', $userQuestions->id], 'method' => 'patch']) !!}

                    @include('userQuestions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection