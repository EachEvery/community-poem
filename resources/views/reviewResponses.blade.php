@extends('master')
@section('title', 'Review Responses')
@section('page')
    <review-responses :init-responses="{{$responses}}" :space="{{$space}}" />
@endsection