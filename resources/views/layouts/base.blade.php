<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>@yield('title') - {{ config('site.name') }} </title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- <link rel="stylesheet" href="/css/bootstrap.css" type="text/css" /> -->
  <link rel="stylesheet" href="/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="/css/font.css" type="text/css" />
  <link rel="stylesheet" href="/vendor/select2/css/select2.min.css">
  <link rel="stylesheet" href="/vendor/datetimepicker/jquery.datetimepicker.css">
  <link rel="stylesheet" href="/vendor/sweetalert/sweetalert.css">
  <link rel="stylesheet" href="/vendor/trumbowyg/ui/trumbowyg.css">  
  <link rel="stylesheet" href="/css/app.css" type="text/css" />

  @yield('css')

    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">

  @yield('mainContent')

  <script src="/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/vendor/jquery/dist/jquery-ui.min.js"></script>
  <script src="/vendor/datetimepicker/jquery.datetimepicker.full.min.js"></script>
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/vendor/datatables/dataTables.select.min.js"></script>
  <script src="/vendor/sweetalert/sweetalert.min.js"></script>  

  <script src="/vendor/slugify/slugify.js"></script>
  
  <script src="/js/all.js"></script>

  @yield('js')

  @yield('modal')
</body>
</html>
