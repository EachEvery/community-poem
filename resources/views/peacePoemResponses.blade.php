@extends('peacePoem')
@section('title', 'Responses')
@section('page')

<div class="bg-secondary text-primary p-8 pt-32 flex flex-col" style="@yield('body_style') --secondary: {{$space->secondary_color ?? '#FFFDD5'}}; --primary:  {{$space->primary_color ?? '#1E6043'}};">
    <h1 class="uppercase font-display text-center text-5xl text-outline md:text-8xl">Responses</h1>

     <span class="whitespace-pre-line font-cursive lowercase leading-loose self-end  md:self-center md:text-2xl md:ml-56 text-sm">personal experiences, 
        thoughts, and expressions 
        of a global community of 
        writers
    </span>

    <div class="container mx-auto grid mt-24 text-center ">
        @foreach($responses as $index => $response)
            @php
                $isHighlighted = request('highlight') == strval($response->id);
                $delay = $index > 15 ? 0 : $loop->index * 40; //ms
            @endphp

            @include('partials.responseCard', ['response' => $response, 'delay' => $delay, 'space' => $space, 'isHighlighted' => $isHighlighted])
            @include('partials.responsePrint', ['response' => $response])
        @endforeach
    </div>

    <div class="loading-indicator w-full text-center opacity-0 py-8" style="transition: opacity .35s ease-in-out;">Loading more responses...</div>

</div>


<div class="hidden space-id">{{ $space->id }}</div>
@endsection

{{-- SYNC WITH WEB RESPONSES --}}

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

        if(!$('.highlight').length) return;
        
        const tour = new Shepherd.Tour({
                useModalOverlay: true,
                
                defaultStepOptions: {
                    classes: ['font-display'],
                    modalOverlayOpeningPadding: 20,
                    modalOverlayOpeningRadius: 5,
                    cancelIcon: {
                        enabled: true
                    },
                    classes: 'class-1 class-2',
                    scrollTo: { behavior: 'smooth', block: 'center' }
                }
            });

            tour.addStep({
                title: 'Here\'s Your Poem!',
                text: `Thanks for creating a poem for {{$space->name}}.`,
                attachTo: {
                    element: '.highlight',
                    on: 'bottom'
                },
                buttons: [
                    {
                    action() {
                        tour.cancel();
                    },
                    classes: 'shepherd-button-secondary',
                    text: 'Dismiss'
                    },
                    
                ],
                id: 'creating'
            });

            tour.start();
     }, 150);

     function resetSelected(parent, event) {
        event.stopPropagation();
        $(".response.selected").removeClass("selected");
        $('.controls', parent).removeClass('rotate');
        $('.controls .copy.success').removeClass("success");
        $('.controls .share.success').removeClass("success");
        $('.content.border-primary').removeClass('border-primary')
    }

    $(window).click(function(event) {
        resetSelected(this, event)
    });

    $('.response').click(function(event){
        resetSelected(this, event);
        event.stopPropagation();
        
        $('.content', this).css('transition', '125ms ease-in all 0ms')

        var offset = $(this).offset(); 
        var responseControls = $('.controls', this);
        var relX = event.pageX - offset.left - (responseControls.width() / 2);
        var relY = event.pageY - offset.top - (responseControls.height() / 2);
        responseControls.css({"top": relY, "left": relX})

        setTimeout(() => {
            $('.controls', this).addClass('rotate')
        }, 50);

        $(this).addClass('selected');
        $('.content', this).addClass('border-primary')
    });

    $('.controls .close').click(function(event) {
        resetSelected(this, event)
    });

    $('.controls .print').click(function(event) {
        event.stopPropagation();
        var responseId = $(this).closest('.response').attr('id');
        var responseToPrint = $('#print-'+responseId);
        responseToPrint.addClass('show');
        html2canvas(responseToPrint[ 0 ], { scale: 2, useCORS: true }).then((canvas) => {
            var imageToPrint = canvas.toDataURL("image/png", 1.0);
            var inputCode = window.prompt("Enter Print Code");
            axios.post("https://ts-print.eachevery.dev/job", {
                content: imageToPrint,
                code: inputCode,
                origin: window.location.origin,
            })
                .then(() => window.alert("Success! Printing Now..."))
                .catch((error) => window.alert(error.response.data));
        });
        responseToPrint.removeClass('show');
    });

    const copyToClipboard = (textToCopy) => {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(textToCopy).select();
        document.execCommand("copy");
        $temp.remove();
    };
    
    $('.controls .copy').click(function(event) {
        event.stopPropagation();
        copyToClipboard($(this).closest('.response').find('.content .content-text').text());
        $(this).addClass('success');
    });

    $('.controls .share').click(function(event) {
        event.stopPropagation();
        copyToClipboard($(this).attr('data-share-link'));
        $(this).addClass('success');
    });
})();
    
</script>
@endsection