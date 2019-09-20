@extends('peacePoem')
@section('title', 'Responses')
@section('page')

<div class="bg-yellow-100 text-green-900 p-8 pt-32 flex flex-col">
    <h1 class="uppercase font-display text-center text-5xl text-outline md:text-8xl">Responses</h1>

     <span class="whitespace-pre-line font-cursive lowercase leading-loose self-end  md:self-center md:text-2xl md:ml-56 text-sm">personal experiences, 
        thoughts, and expressions 
        of a global community of 
        writers
    </span>

    <div class="container mx-auto grid mt-24 text-center ">
        @foreach($responses as $response)
            @php
                $dealy = $loop->index * 20; //ms
            @endphp

            <div class="response text-green-900 md:w-1/2 lg:w-1/3 mb-12 px-8 xl:px-10 transition" style="opacity: 0; transform: translateY(.5rem); transition-delay: {{$dealy}}ms">
                <h1 class="font-display font-light text-xl xl:text-3xl leading-normal">{{$response->content}}</h1>
                <span class="uppercase font-bold mt-5 inline-block leading-normal">{{$response->name}}<br /> {{$response->city ?? ''}}</span>
            </div>
        @endforeach
    </div>


</div>


@endsection


@section('scripts')
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

<script type="text/javascript">
(function() {
     setTimeout(() => {
         $('.grid').isotope({
            itemSelector: '.response',
                layoutMode: 'masonry',
            });

        $('.response').css({'opacity': 1, 'transform': 'none'});

     }, 150);
})();
    
</script>
@endsection