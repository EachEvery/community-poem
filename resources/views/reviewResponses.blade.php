@extends('master')
@section('title', 'Review Responses')
@section('page')

    <review-responses :responses="{{$responses}}" :space="{{$space}}" />
@endsection