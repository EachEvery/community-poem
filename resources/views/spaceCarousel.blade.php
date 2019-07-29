@extends('master')
@section('title', $space->name.' Responses')
@section('page')
    <carousel :responses="{{$responses}}" :space="{{$space}}" />
@endsection