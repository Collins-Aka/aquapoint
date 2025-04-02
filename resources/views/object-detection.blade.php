@extends('master')

@section('tile', 'Image Upload')

@section('content')


<form method="POST" action="{{ route('detect-objects') }}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <input type="file" name="image">
    <button type="submit">Detect Objects</button>
</form>

@endsection
