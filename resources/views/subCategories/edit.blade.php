@extends('layouts.app')

@section('content')
   <section class="content-header">
           <h1>
               SubCategories
           </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($subCategories, ['route' => ['subCategories.update', $subCategories->id], 'method' => 'patch']) !!}

                    @include('subCategories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection