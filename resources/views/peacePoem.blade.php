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

        <footer class="p-8 pt-32 pb-48 bg-green-900 text-white">
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


        <div class="hidden xl:block fixed w-24 bg-white h-screen left-0">

        </div>
    </div>
    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
</body> 