@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>



                <body>
                <div class="flex-center position-ref full-height">


                    {!!  Form::open(array('route' => 'import.file','method'=>'POST','files'=>'true','enctype'=>"multipart/form-data")) !!}
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {!! Form::label('sample_file','Select File to Import:',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                                    {!!  $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                                    @if (session()->has('error'))
                                        <p class="alert alert-danger">
                                            {{ session()->get('error') }}<br>
                                        </p>
                                    @endif
                                    @if(session()->has('success'))
                                        <p class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}




                </div>
                </body>


                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>



            </div>
        </div>
    </div>
</div>
@endsection
