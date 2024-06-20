<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>Reconciliation System</title>

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}" />

	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}" />

	<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />

</head>

<body>


	<div id="app">
		<app></app>
	</div>

	<!-- js -->
	<script src="{{ asset('vendors/scripts/core.js') }}">
	</script>
	<script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
	<script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
	<script src="{{ asset('vendors/scripts/process.js') }}"></script>


	<script src="{{  asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
	<!-- buttons for Export datatable -->
	<script src="{{  asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/buttons.print.min.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
	<script src="{{  asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
	<!-- Datatable Setting js -->
	<script src="{{  asset('vendors/scripts/datatable-setting.js') }}"></script>
</body>
<!-- <script src="{{ mix('js/app.js') }}"></script> -->
<script src="{{ asset('js/app.js') }}" defer></script>

</html>