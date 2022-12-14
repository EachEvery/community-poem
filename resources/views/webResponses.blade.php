<!DOCTYPE html>
<title>{{$space->name}} | Community Poem</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{csrf_token()}}">
<meta name="apple-mobile-web-app-capable" content="yes">

@include('partials.googleTagManagerHead')

<link type="text/css" href="{{mix('css/app.css')}}" rel="stylesheet">
{{-- <link href="https://fonts.googleapis.com/css?family=Homemade+Apple|Work+Sans:300,400,500,600&display=swap" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="https://use.typekit.net/gow0spk.css"> --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">

<body class="text-gray-600 " style="@yield('body_style') --secondary: {{$space->secondary_color ?? '#FFFDD5'}}; --primary:  {{$space->primary_color ?? '#1E6043'}};" >

    @include('partials.googleTagManagerBody')

    <div id="app" class="overflow-x-hidden max-w-full">
        <div class="bg-secondary text-primary p-8  @if($space->show_header_footer) md:pt-32 @endif flex flex-col">

        @if($space->show_header_footer)
            <div class="flex xl:scale-up md:absolute top-0 right-0 md:p-4 xl:p-0 xl:mt-24 xl:mr-56 justify-between md:justify-end" style="transform-origin: left">
                <div class="flex flex-row-reverse md:mr-12 opacity-50">
                    @component('attribution')
                    @endcomponent
                </div>

                <a href="#" class="font-display text-lg border-2 px-10 py-3 uppercase font-bold self-center border-primary  bg-white" open-typeform>RESPOND</a>
            </div>

            <h1 class="uppercase font-display text-center text-4xl text-outline md:text-6xl mt-24">{{$space->name}}</h1>

            <span class="whitespace-pre-line font-cursive lowercase leading-loose self-center md:text-2xl text-center text-sm">responses</span>
        @endif

            <div class="container mx-auto mt-24 grid">
                @foreach($space->approved_responses()->latest()->limit(100)->get() as $index => $response)
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

        @if($space->show_header_footer)
        <footer class="p-8 pt-32 pb-48 bg-primary text-white xl:px-32">
            <div class="md:flex container mx-auto">
                <div class="flex flex-grow md:flex-row-reverse self-center xl:scale-up" style="transform-origin: top right">
                    @component('attribution')
                        @slot('class', 'text-white md:scale-up md:mx-5')
                    @endcomponent
                </div>
            </div>
        </footer>
        @endif

        <portal-target name="end-of-body"></portal-target>
            @php
                $path = request()->path();
            @endphp
        </div>
    </div>

    {!!$space->embed_code!!}

<script type="text/javascript" src="{{mix('js/app.js')}}"></script>


{{-- SYNC WITH PEACE POEM RESPONSES --}}

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
                        $.get('/paged/responses?spaceId=' + $('.space-id').text() + '&offset=' + $('.response').length + '&lang=' + $('.language-switcher').val(), function(res) {
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
                            // Track Infinite Scroll
                            dataLayer.push({'event':'more_responses'});
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

            // Track How Many People Start The Printing Process
            dataLayer.push({'event':'start_print_response'});

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
                            // Track Print Response
                            dataLayer.push({'event':'print_response'});
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
            // Track Responses Copied
            dataLayer.push({'event':'copy_response'});
        });

        $('.container').on('click', '.controls .share', function(event){
            // if a check is displayed on the other copy option, clear it
            $('.controls .copy.success').removeClass("success");
            event.stopPropagation();
            copyToClipboard($(this).attr('data-share-link'));
            $(this).addClass('success');
            // Track Responses Shared
            dataLayer.push({'event':'share_response'});
        });

        @if ($auto_resize)
        if (window.location !== window.parent.location) {

            const resizeObserver = new ResizeObserver((entries) => {
                window.parent.postMessage($('#app').height(), '*');
            });
            const divElem = document.querySelector('#app');
            resizeObserver.observe(divElem);

        }
        @endif
    })();

</script>

@include('partials.responseScript')


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150862045-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'UA-150862045-1');
</script>

</body>
