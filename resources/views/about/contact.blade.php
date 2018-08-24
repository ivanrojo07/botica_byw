@extends('layouts.app')
@section('content')
<div  class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Contactanos</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
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
                                'placeholder'=>'Coloca aquí tu nombre')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Email:') !!}
                        {!! Form::text('email', null, 
                            array('required', 
                                'class'=>'form-control', 
                                'placeholder'=>'Coloca aquí tu Email')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Mensaje:') !!}
                        {!! Form::textarea('message', null, 
                            array('required', 
                                'class'=>'form-control', 
                                'placeholder'=>'Coloca aquí tu mensaje')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Enviar', 
                        array('class'=>'btn btn-primary')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection