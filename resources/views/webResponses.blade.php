<title>{{$space->name}} | Community Poem</title>

<link type="text/css" href="{{mix('css/app.css')}}" rel="stylesheet">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{csrf_token()}}">

<meta name="apple-mobile-web-app-capable" content="yes">

<link href="https://fonts.googleapis.com/css?family=Homemade+Apple|Work+Sans:300,400,500,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/gow0spk.css">

<body class="text-gray-600 " style="@yield('body_style') --secondary: {{$space->secondary_color ?? '#FFFDD5'}}; --primary:  {{$space->primary_color ?? '#1E6043'}};" >
    <div id="app" class="overflow-x-hidden max-w-full">    
        <div class="bg-secondary text-primary p-8 pt-32 flex flex-col">

        <div class="flex    xl:scale-up md:absolute top-0 right-0 xl:mt-24 xl:mr-56 justify-end" style="transform-origin: left">
            <div class="flex flex-row-reverse md:mr-12 opacity-50">
                @component('attribution')            
                @endcomponent
            </div>

            <a href="#" class="font-display text-lg border-2 border-green-900 px-10 py-3 uppercase font-bold self-center hidden md:block bg-white" open-typeform>RESPOND</a>
        </div>

            <h1 class="uppercase font-display text-center text-5xl text-outline md:text-6xl mt-24">{{$space->name}}</h1>            

            <span class="whitespace-pre-line font-cursive lowercase leading-loose self-end  md:self-center md:text-2xl text-center text-sm">responses</span>

            <div class="container mx-auto grid mt-24 text-center ">
                @foreach($space->responses as $response)
                    @php
                        $dealy = $loop->index * 40; //ms
                    @endphp

                    <div class="response text-primary md:w-1/2 lg:w-1/3 mb-12 px-8 xl:px-10 transition" style="opacity: 0; transform: translateY(.5rem); transition-delay: {{$dealy}}ms">
                        @unless(empty($response->prompt))
                            <div class="flex justify-center mb-3">
                                <h3 class="bg-white p-3 font-display text-base uppercase font-semibold leading-none">{{$response->prompt}}</h3>
                            </div>
                        @endunless
                        
                        <h1 class="font-display font-light text-xl xl:text-3xl leading-normal">{!!strip_tags($response->content)!!}</h1>
                        <span class="uppercase font-bold mt-5 inline-block leading-normal">{{$response->name}}<br /> {{$response->city ?? ''}}</span>
                    </div>
                @endforeach
            </div>
        </div>



        <footer class="p-8 pt-32 pb-48 bg-primary text-white xl:px-32">
            <div class="md:flex container mx-auto">                            
                <div class="flex flex-grow md:flex-row-reverse self-center xl:scale-up" style="transform-origin: top right">
                    @component('attribution')
                        @slot('class', 'text-white md:scale-up md:mx-5')
                    @endcomponent
                </div>
            </div>
        </footer>



        <portal-target name="end-of-body"></portal-target>

        

        
            @php
                $path = request()->path();    
            @endphp
            
        </div>
    </div>

    {!!$space->embed_code!!}
    
    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>

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



    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-150862045-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-150862045-1');
    </script>

</body> 