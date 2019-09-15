<title>@yield('title') | Global Peace Poem</title>

<link type="text/css" href="{{mix('css/app.css')}}" rel="stylesheet">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{csrf_token()}}">

<link href="https://fonts.googleapis.com/css?family=Homemade+Apple|Work+Sans:300,400,500,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/gow0spk.css">

<body class="text-gray-600 " style="@yield('body_style')">
    <div id="app" class="overflow-x-hidden max-w-full">
        

        @yield('page')        

        <footer class="p-8 pt-32 pb-48 bg-green-900 text-white xl:px-32">
            <div class="md:flex container mx-auto">
                <div class="xl:scale-up" style="transform-origin: top left">
                    <h3 class="text-lg uppercase text-3xl block font-display font-bold mb-5">Get in Touch</h3>
                    <p class="mb-10 max-w-sm">The goal of our Global Community Poem is to show how creative expression can be used to help communities heal. If you would like us to set up a community poem for your classroom, institution, conference, or other community event, please contact us at wickpoetry@kent.edu</p>
                </div>
                
                <div class="flex flex-grow md:flex-row-reverse self-center xl:scale-up" style="transform-origin: top right">
                    @component('attribution')
                        @slot('class', 'text-white md:scale-up md:mx-5')
                    @endcomponent
                </div>
            </div>
        </footer>

        <portal-target name="end-of-body"></portal-target>
        <mobile-header current-route-name="{{Route::currentRouteName()}}" class="xl:hidden"></mobile-header>    

        
@php
    $path = request()->path();    
    
@endphp
        <div class="hidden xl:flex fixed w-100vh justify-between flex-row text-green-900 left-0 bg-white p-6  top-0 px-8" style="transform-origin: top left; transform: rotate(90deg) translateY(-100%);">
            <div>
                    <a
                    href="/"
                    class="font-display text-3xl font-semibold uppercase self-center mr-12 {{$path === '/' ? '': 'text-outline'}}"                    
                  >About</a>
        
                  {{-- <a
                    href="/responses"
                    class="font-display text-3xl font-semibold uppercase self-center mr-12 {{$path === 'responses' ? '': 'text-outline'}}"                    
                  >Responses</a> --}}
        
                  <a
                    href="mailto:wickpoetry@kent.edu?subject=Global Peace Poem"
                    class="font-display text-3xl font-semibold uppercase self-center text-outline"
                    
                  >Get in Touch</a>
            </div>

            <a
                href="/contest"
                class="font-display text-3xl font-semibold uppercase self-center {{$path === 'contest' ? '': 'text-outline'}}"
            >Contest</a>
        </div>

            
        </div>
    </div>

    {!!env('PEACEPOEM_EMBED', '')!!}
    
    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>

    @yield('scripts')
</body> 