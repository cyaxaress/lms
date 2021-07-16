<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Panel</title>
    <link rel="stylesheet" href="/panel/css/style.css?v={{ uniqid() }}">
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
    <link rel="stylesheet" href="/panel/css/responsive_991.css" media="(max-width:991px)">
    <link rel="stylesheet" href="/panel/css/responsive_768.css" media="(max-width:768px)">
    <link rel="stylesheet" href="/panel/css/font.css">
    <link rel="stylesheet" href="/css/custom.css?v=1.0.1">
    @yield('css')
</head>
