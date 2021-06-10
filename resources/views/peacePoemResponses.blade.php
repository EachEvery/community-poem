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
                $delay = $loop->index * 40; //ms
            @endphp

            @include('partials.responseCard', ['response' => $response, 'delay' => $delay])
        @endforeach
    </div>

    <div class="loading-indicator w-full text-center opacity-0 py-8" style="transition: opacity .35s ease-in-out;">Loading more responses...</div>

</div>


<div class="hidden space-id">{{ $spaceId }}</div>
@endsection


@section('scripts')
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

<script type="text/javascript">
(function() {
     setTimeout(() => {
        var $grid = $('.grid').isotope({
            itemSelector: '.response',
                layoutMode: 'masonry',
            });

        $(window).on('scroll', function() {
            var isAtBottom = $(window).scrollTop() + $(window).height() > $(document).height() - $('footer').outerHeight();
            if(isAtBottom) {
                $('.loading-indicator').removeClass('opacity-0').addClass('opacity-100');
                clearTimeout(window.infiniteScrollTimeout);
                window.infiniteScrollTimeout = setTimeout(function() {
                    $.get('/paged/responses?spaceId=' + $('.space-id').text() + '&offset=' + $('.response').length, function(res) {
                        var $offsetResults = $(res);
                        $grid.append( $offsetResults ).isotope( 'appended', $offsetResults );
                        $('.loading-indicator').removeClass('opacity-100').addClass('opacity-0');
                    });
                }, 500);   
            }
        });

        $('.response').css({'opacity': 1, 'transform': 'none'});

     }, 150);
})();
    
</script>
@endsection