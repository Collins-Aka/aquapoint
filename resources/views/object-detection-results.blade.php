@extends('master')

@section('title', 'Object Results')

@section('content')

    <h1>Object Detection Results</h1>

    <pre>
    {{ json_encode($output, JSON_PRETTY_PRINT) }}
</pre>

@endsection
