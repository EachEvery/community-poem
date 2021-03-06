<title>@yield('title')</title>

<link type="text/css" href="{{mix('css/app.css')}}" rel="stylesheet">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{csrf_token()}}">


<link rel="stylesheet" href="https://use.typekit.net/cvr3vdf.css">
<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,700&display=swap" rel="stylesheet">


<body class="text-gray-600" style="@yield('body_style')">
    <div id="app">
        @yield('page')        
    </div>
    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
</body>