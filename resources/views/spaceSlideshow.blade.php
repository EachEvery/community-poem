@extends('master')
@section('title', $space->name.' Responses')
@section('page')
    <slideshow :responses="{{$responses}}" :space="{{$space}}" :autoplay="{{$autoplay}}" :interval="{{empty($space->slideshow_interval) ? 10 : $space->slideshow_interval}}"/>
@endsection