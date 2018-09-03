<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{csrf_token()}}">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('b/assets/images/fav.png')}}">
<title>UQ Admin - Admin Undangan Qu</title>
<!-- This page CSS -->
<!-- chartist CSS -->
<link href="{{asset('b/assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
<!--Toaster Popup message CSS -->
<link href="{{asset('b/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{asset('b/assets/dist/css/style.min.css')}}" rel="stylesheet">
<!-- Dashboard 1 Page CSS -->
<link href="{{asset('b/assets/dist/css/pages/dashboard1.css')}}" rel="stylesheet">

<link href="{{asset('plugins/sweet-alert/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">

<link href="{{asset('b/assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">

<link href="{{asset('b/assets/dist/css/pages/user-card.css')}}" rel="stylesheet">
@yield('style')