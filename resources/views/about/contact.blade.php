@extends('layouts.app')
@section('content')
<div  class="container">
    <header class="major">
        <h2 class="grey satisfic-font font1">Contactanos</h2>
    </header>
</div>
<div class="row">
    <div class="10u$ 12u$(medium) important(medium) faq">
        {!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}
        @if(Session::has('message'))
        <div class="alert alert-info">
            {{Session::get('message')}}
        </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger text-left">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            {!! Form::label('Nombre:') !!}
            {!! Form::text('name', null, 
                array('required', 
                    'class'=>'form-control', 
                    'placeholder'=>'Coloca aqui tu nombre')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Email:') !!}
            {!! Form::text('email', null, 
                array('required', 
                    'class'=>'form-control', 
                    'placeholder'=>'Coloca Aqui tu Email')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Mensaje:') !!}
            {!! Form::textarea('message', null, 
                array('required', 
                    'class'=>'form-control', 
                    'placeholder'=>'Coloca aqui tu mensaje')) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Enviar', 
            array('class'=>'btn btn-primary')) !!}
        </div>
        {!! Form::close() !!}
  </div>
</div>
@endsection