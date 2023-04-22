@extends('threadDisplay')
@section('title', $space->name.' Responses')
@section('page')
    @if ($responses == null)
    <div class="fixed inset-0 flex items-center justify-center">
        No responses have been approved for the {{ $space->name }} slideshow.
    </div>
    @else
    <slideshow :responses="{{$responses}}" :space="{{$space}}" :autoplay="{{$autoplay}}" :interval="{{empty($space->slideshow_interval) ? 10 : $space->slideshow_interval}}" orientation="{{$orientation}}" />
    @endif
@endsection
