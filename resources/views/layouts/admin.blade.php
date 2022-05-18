<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title',env('APP_NAME'))</title>
	<!-- core:css -->
	{{-- <link rel="stylesheet" href="{{asset('assets/admin/vendors/core/core.css')}}"> --}}
	<!-- endinject -->
	<!-- plugin css for this page -->
	 <link rel="stylesheet" href="{{asset('assets/admin/vendors/select2/select2.min.css')}}">
	  <!-- Datatables CSS CDN -->
    
	 {{-- <link rel="stylesheet" href="{{asset('assets/admin/vendors/jquery-tags-input/jquery.tagsinput.min.css')}}"> --}}
{{--	 <link rel="stylesheet" href="{{asset('assets/admin/vendors/dropzone/dropzone.min.css')}}">--}}
{{--	 <link rel="stylesheet" href="{{asset('assets/admin/vendors/dropify/dist/dropify.min.css')}}">--}}
{{--	 <link rel="stylesheet" href="{{asset('assets/admin/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}">--}}
{{--	 <link rel="stylesheet" href="{{asset('assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">--}}
{{--	 <link rel="stylesheet" href="{{asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css')}}">--}}
{{--	 <link rel="stylesheet" href="{{asset('assets/admin/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')}}">--}}
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	 <link rel="stylesheet" href="{{asset('assets/admin/fonts/feather-font/css/iconfont.css')}}">
{{--	 <link rel="stylesheet" href="{{asset('assets/admin/vendors/flag-icon-css/css/flag-icon.min.css')}}">--}}
	<!-- endinject -->
  <!-- Layout styles -->
	<link rel="stylesheet" href="{{asset('assets/admin/css/demo_5/style.css')}}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('assets/admin/images/favicon.png')}}" />
  @yield('css')
</head>
<body class="rtl">
	<div class="main-wrapper">
        @include('admin.partials.header')
		<div class="page-wrapper">
			<div class="page-content">
				@yield('content')
			</div>
			@include('admin.partials.footer')
		</div>
	</div>
	<!-- core:js -->
	<script src="{{asset('assets/admin/vendors/core/core.js')}}"></script>
	<!-- endinject -->
	<!-- plugin js for this page -->
	{{-- <script src="{{asset('assets/admin/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendors/inputmask/jquery.inputmask.min.js')}}"></script> --}}
 	<script src="{{asset('assets/admin/vendors/select2/select2.min.js')}}"></script>
  
    {{--
 	<script src="{{asset('assets/admin/vendors/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendors/dropzone/dropzone.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendors/dropify/dist/dropify.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendors/moment/moment.min.js')}}"></script>
	<script src="{{asset('assets/admin/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')}}"></script> --}}
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	{{-- <script src="{{asset('assets/admin/vendors/feather-icons/feather.min.js')}}"></script> --}}
	{{-- <script src="{{asset('assets/admin/js/template.js')}}"></script> --}}
	<!-- endinject -->
	<!-- custom js for this page -->
	{{-- <script src="{{asset('assets/admin/js/form-validation.js')}}"></script>
	<script src="{{asset('assets/admin/js/bootstrap-maxlength.js')}}"></script>
	<script src="{{asset('assets/admin/js/inputmask.js')}}"></script>
	<script src="{{asset('assets/admin/js/select2.js')}}"></script>
	<script src="{{asset('assets/admin/js/typeahead.js')}}"></script>
	<script src="{{asset('assets/admin/js/tags-input.js')}}"></script>
	<script src="{{asset('assets/admin/js/dropzone.js')}}"></script>
	<script src="{{asset('assets/admin/js/dropify.js')}}"></script>
	<script src="{{asset('assets/admin/js/bootstrap-colorpicker.js')}}"></script>
	<script src="{{asset('assets/admin/js/datepicker.js')}}"></script>
	<script src="{{asset('assets/admin/js/timepicker.js')}}"></script> --}}
	<!-- end custom js for this page -->
	@yield('js')
</body>
</html>
