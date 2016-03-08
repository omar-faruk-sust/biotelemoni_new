<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ucfirst($section)}} | Biotelemoni CMS</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- Bootstrap 3.3.2 -->
	<link href="{{ asset('skins/adminLTE/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- FontAwesome 4.3.0 -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons 2.0.0 -->
	<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="{{ asset('skins/adminLTE/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link href="{{ asset('skins/adminLTE/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- iCheck -->
	<link href="{{ asset('skins/adminLTE/plugins/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
	<!-- Morris chart -->
	<link href="{{ asset('skins/adminLTE/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
	<!-- jvectormap -->
	<link href="{{ asset('skins/adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
	<!-- Date Picker -->
	<link href="{{ asset('skins/adminLTE/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
	<!-- Daterange picker -->
	<link href="{{ asset('skins/adminLTE/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
	<!-- bootstrap wysihtml5 - text editor -->
	<link href="{{ asset('skins/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
    <!-- jQuery 2.1.3 -->

    {{-- Multiselect --}}
	<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css')}} " type="text/css"/>
	{{-- Tokenfield --}}
	<link rel="stylesheet" href="{{ asset('css/tokenfield-typeahead.min.css')}} " type="text/css"/>
	<link rel="stylesheet" href="{{ asset('css/bootstrap-tokenfield.min.css')}} " type="text/css"/>

    <script src="{{ asset('skins/adminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body class="skin-blue">
<div class="wrapper">
	@include('includes.cms.header')
	@include('includes.cms.sidebar')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			@yield('header')
		</section>
		<!-- Main content -->
		<section class="content">
            @if(Session::has('flash_message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ Session::get('flash_message') }}
                </div>
                @elseif(Session::has('error_message'))
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ Session::get('error_message') }}
                </div>
            @endif
            <br>
			@yield('content')
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
	<footer class="main-footer">
		<strong>Copyright &copy; {{date('Y')}} <a href="#">Biotelemoni</a>.</strong> All rights reserved.
	</footer>
</div><!-- ./wrapper -->


<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('skins/adminLTE/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('skins/adminLTE/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
<!-- Sparkline -->
<script src="{{ asset('skins/adminLTE/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<!-- jvectormap -->
<script src="{{ asset('skins/adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('skins/adminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('skins/adminLTE/plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="{{ asset('skins/adminLTE/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<!-- datepicker -->
<script src="{{ asset('skins/adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('skins/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
<!-- iCheck -->
<script src="{{ asset('skins/adminLTE/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="{{ asset('skins/adminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- FastClick -->
<script src="{{ asset('skins/adminLTE/plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('skins/adminLTE/dist/js/app.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('skins/adminLTE/dist/js/pages/dashboard.js') }}" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('skins/adminLTE/dist/js/demo.js') }}" type="text/javascript"></script>
 <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

{{-- Multiselect --}}
	<script type="text/javascript" src="{{ asset('js/lib/bootstrap-multiselect.js') }}"></script>
	{{-- Tokenfield --}}
	<script type="text/javascript" src="{{ asset('js/lib/bootstrap-tokenfield.js') }}"></script>


</body>
</html>
