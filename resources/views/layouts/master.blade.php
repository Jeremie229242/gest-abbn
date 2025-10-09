<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>@yield('title')</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('v2/vendors/images/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('v2/vendors/images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('v2/vendors/images/favicon-16x16.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('v2/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('v2/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('v2/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('v2/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('v2/vendors/styles/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	<!-- <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> -->

	<div class="header">



<x-sidebar/>




	</div>



	<div class="left-side-bar">


<x-menu/>




	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">

        @yield("contenu")


<x-footer/>



		</div>
	</div>
	<!-- js -->
	<script src="{{asset('v2/vendors/scripts/core.js')}}"></script>
	<script src="{{asset('v2/vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('v2/vendors/scripts/process.js')}}"></script>
	<script src="{{asset('v2/vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{asset('v2/plugins/apexcharts/apexcharts.min.js')}}"></script>
	<script src="{{asset('v2/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('v2/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('v2/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('v2/vendors/scripts/dashboard.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
     integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="{{asset('v2/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
     <script src="{{asset('v2/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
	<script src=" {{asset('v2/plugins/datatables/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('v2/plugins/datatables/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('v2/plugins/datatables/js/buttons.flash.min.js')}}"></script>
	<script src="{{asset('v2/plugins/datatables/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('v2/plugins/datatables/js/vfs_fonts.js')}}"></script>
	<!-- Datatable Setting js -->
	<script src="{{asset('v2/vendors/scripts/datatable-setting.js')}}"></script>
</body>
     @if(session()->get('error'))
    <script>
        iziToast.error({
            title: "Erreur",
            position: "topRight",
            message: "{{ session()->get('error') }}"
        })
    </script> 
@endif
@if(session()->get('success'))
    <script>
        iziToast.success({
            title: "Succes",
            position: "topRight",
            message: "{{ session()->get('success') }}"
        })
    </script>
@endif
</body>
</html>
