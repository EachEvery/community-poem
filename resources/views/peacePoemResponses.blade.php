@extends('peacePoem')
@section('title', 'Responses')
@section('page')

<div class="responses-container bg-secondary text-primary p-8 pt-32 flex flex-col" style="@yield('body_style') --secondary: {{$space->secondary_color ?? '#FFFDD5'}}; --primary:  {{$space->primary_color ?? '#1E6043'}};">
    <h1 class="uppercase font-display text-center text-5xl text-outline md:text-8xl">Responses</h1>

     <span class="whitespace-pre-line font-cursive lowercase leading-loose self-end  md:self-center md:text-2xl md:ml-56 text-sm">personal experiences, 
        thoughts, and expressions 
        of a global community of 
        writers
    </span>

    <div class="container mx-auto grid mt-24">
        @foreach($responses as $index => $response)
            @php
                $isHighlighted = request('highlight') == strval($response->id);
                $delay = $index > 15 ? 0 : $loop->index * 40; //ms
            @endphp

            @include('partials.responseCard', ['response' => $response, 'delay' => $delay, 'space' => $space, 'isHighlighted' => $isHighlighted, 'languages' => $languages])
            @include('partials.responsePrint', ['response' => $response])
        @endforeach
    </div>

    <div class="loading-indicator w-full text-center opacity-0 py-8" style="transition: opacity .35s ease-in-out;">Loading more responses...</div>
    <div class="done-loading-message w-full text-center opacity-0 py-8" style="transition: opacity .35s ease-in-out;">All responses have been loaded.</div>

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
                // 5 Pixel Offset
                var isAtBottom = $(window).scrollTop() + $(window).height() + 5 >= $(document).height();
                if(isAtBottom) {
                    $('.loading-indicator').removeClass('opacity-0').addClass('opacity-100');
                    clearTimeout(window.infiniteScrollTimeout);
                    window.infiniteScrollTimeout = setTimeout(function() {
                        $.get('/paged/responses?spaceId=' + $('.space-id').text() + '&offset=' + $('.response').length, function(res) {
                            var $offsetResults = $(res);
                            $('.loading-indicator').removeClass('opacity-100').addClass('opacity-0');
                            // all responses have been loaded
                            if(res == ''){
                                $('.done-loading-message').removeClass('opacity-0').addClass('opacity-100');
                                let timer;
                                clearTimeout(timer);
                                timer = setTimeout(() => {
                                    $('.done-loading-message').removeClass('opacity-100').addClass('opacity-0');
                                }, 5000);
                            } else {
                                $grid.append( $offsetResults ).isotope( 'appended', $offsetResults );
                            }
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
    })();
    
    (function() {
         function resetSelected(parent, event) {
            event.stopPropagation();
            $(".response.selected .content").css('opacity', '1');
            $(".response.selected").removeClass("selected");
            $('.controls', parent).removeClass('rotate');
            $('.controls .copy.success').removeClass("success");
            $('.controls .share.success').removeClass("success");
            // $('.content.border-primary').removeClass('border-primary')
        }
    
        $(window).click(function(event) {
            resetSelected(this, event)
        });
    
        $('.container').on('click', '.response', function(event){
            resetSelected(this, event);
            event.stopPropagation();
            
            $('.content', this).css({
                'transition': '125ms ease-in all 0ms',
                'opacity'   : '0.3'
            });
    
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
    
        $('.container').on('click', '.controls .close', function(event){
            resetSelected(this, event)
        });
    
        $('.container').on('click', '.controls .print', function(event){
            event.stopPropagation();
            $(this).addClass('loading');
            var responseId = $(this).closest('.response').attr('id');
            var responseToPrint = $('#print-'+responseId);
            responseToPrint.show();

            setTimeout(() => {
                html2canvas(responseToPrint[ 0 ], { scale: 2, useCORS: true }).then((canvas) => {
                    var imageToPrint = canvas.toDataURL("image/png", 1.0);
                    var inputCode = window.prompt("Enter Print Code");
                    axios.post("https://ts-print.eachevery.dev/job", {
                        content: imageToPrint,
                        code: inputCode,
                        origin: window.location.origin,
                    })
                        .then(() => {
                            window.alert("Success! Printing Now...");
                            responseToPrint.hide();
                            $(this).removeClass('loading');
                        })
                        .catch((error) => {
                            window.alert(error.response.data);
                            $(this).removeClass('loading');
                        });
                })
            }, 15);
        });
    
        const copyToClipboard = (textToCopy) => {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(textToCopy).select();
            document.execCommand("copy");
            $temp.remove();
        };
        
        $('.container').on('click', '.controls .copy', function(event){
            // if a check is displayed on the other copy option, clear it
            $('.controls .share.success').removeClass("success");
            event.stopPropagation();
            copyToClipboard($(this).closest('.response').find('.content .content-text').text());
            $(this).addClass('success');
        });
    
        $('.container').on('click', '.controls .share', function(event){
            // if a check is displayed on the other copy option, clear it
            $('.controls .copy.success').removeClass("success");
            event.stopPropagation();
            copyToClipboard($(this).attr('data-share-link'));
            $(this).addClass('success');
        });
    })();
        
</script>

@include('partials.responseScript')

@endsection