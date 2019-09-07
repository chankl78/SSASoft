@extends('layout.securitymaster')

@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i><a href="{{{ URL::action('SecurityDashboardController@getIndex') }}}">Home</a>
			</li>
			<li class="active"><a href="{{{ URL::action('SecurityAttendanceController@getIndex') }}}">Attendance</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Attendance<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<table id="tattendance" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="hidden-480">Login</th>
						<th class="hidden-480">Centre</th>
						<th class="hidden-480">Shift</th>
						<th class="hidden-480">Name</th>
						<th class="hidden-480">Logout</th>
						<th class="hidden-480">Action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
	<script type="text/javascript">	
	$(document).ready(function() {
		var oattendance = $('#tattendance').DataTable({
			"displayLength": 10, // Default No of Records per page on 1st load
			"lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			"pagingType": "full_numbers",
			"responsive": true,
			"processing": true,
			"stateSave": true, // Remember paging & filters
			"autoWidth": true,
			"scrollCollapse": true,
			"processing": false,
			"serverSide": true,
			"searching": true,
			"order": [[ 0, "desc" ]],
			"ajax": $.fn.dataTable.pipeline({
				url: 'getSecurityAttendanceListing',
				pages: 5 // number of pages to cache
			}),
			"columnDefs": [
			{
				"targets": [ 0 ], "data": "login", "width": "170px", "searchable": "true",
				"render": function ( data, type, full ){
					return moment(data).format("DD-MMM-YYYY HH:mm:ss");
				}
			},
			{ "targets": [ 1 ], "data": "location", "searchable": "true" },
			{ "targets": [ 2 ], "data": "shifttype", "searchable": "true" },
			{ "targets": [ 3 ], "data": "name", "searchable": "true" },
			{
				"targets": [ 4 ], "data": "logout", "width": "170px", "searchable": "true",
				"render": function ( data, type, full ){
					if (data == '0000-00-00 00:00:00') { return '';} 
					else if (data == '') { return ''; }
					else if (data == null) { return ''; }
					else { return moment(data).format("DD-MMM-YYYY HH:mm:ss"); }
				}
			},
			{
				"targets": [ 5 ], "data": "uniquecode",
				"render": function ( data, type, full ){
					return '<button type="submit" onClick=postSignOut('+ data +') class="btn btn-xs btn-success"><i class="fa fa-sign-out bigger-120"></i></button> <button type="submit" onClick=deletesecurityattendance('+ data +') class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
				}
			}]
		}); // Definition of Attendance Datatable
		oattendance.clearPipeline().draw();
	});
		
	</script>
@stop