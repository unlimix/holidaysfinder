@extends('welcome')

@section('content')
    <div class="title m-b-md">
        Holidays Finder
    </div>
    <div class="m-b-md">
        {!! $title !!}
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(['url' => '/']) !!}
    {!! Form::date('date') !!}
    {!! Form::submit('send') !!}
    {!! Form::close() !!}
@endsection('content')
