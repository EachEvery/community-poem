<title>@yield('title') | Global Peace Poem</title>

<link type="text/css" href="{{mix('css/app.css')}}" rel="stylesheet">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{csrf_token()}}">

<link href="https://fonts.googleapis.com/css?family=Homemade+Apple|Work+Sans:300,400,500,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/gow0spk.css">

<body class="text-gray-600 overflow-x-hidden" style="@yield('body_style')">
    <div id="app">
        @yield('page')        
    </div>
    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
</body>