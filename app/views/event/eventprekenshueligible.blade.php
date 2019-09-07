@extends('layout.master')

@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i><a href="{{{ URL::action('DashboardController@getIndex') }}}">Home</a>
			</li>
			<li class="active"><a href="{{{ URL::action('EventPreKenshuEligibleController@getIndex') }}}">Pre Kenshu Eligible List</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>PreKenshu Eligible List<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="tabbable tabs-right">
					<ul class="nav nav-tabs" id="ModuleTab">
						<li class="active">
							<a data-toggle="tab" href="#home">
								<i class="blue fa fa-dashboard bigger-110"></i>
								Info
							</a>
						</li> <!-- Info -->
						@if ($REEV05R == 't') 
							<li>
								<a data-toggle="tab" href="#reports">
									<i class="green fa fa-user bigger-110"></i>
									Reports
								</a>
							</li>
						@endif <!-- Report -->
						@if ($REEV01R == 't') 
							<li>
								<a data-toggle="tab" href="#logs">
									<i class="fa fa-book"></i>
									Logs
								</a>
							</li>
						@endif <!-- Logs, Access Rights -->
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Prekenshu Eligible Listing</h5>
										<div class="widget-toolbar">
											<a href="#" data-action="fullscreen" class="orange2">
												<i class="ace-icon fa fa-expand"></i>
											</a>
											<a href="#" data-action="reload">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<table id="tdefault" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Name</th>
														<th>Rhq</th>
														<th>Zone</th>
														<th>Chaptar</th>
														<th>District</th>
														<th>Division</th>
														<th>Position</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
										<div class="widget-toolbox padding-8 clearfix">
											<div class="col-xs-12">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@if ($REEV05R == 't') 
							<div id="reports" class="tab-pane">
							</div>
						@endif <!-- Reports -->
						@if ($REEV01R == 't') 
							<div id="logs" class="tab-pane">
							</div>
						@endif
					</div>
				</div>
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function () {
			$.mask.definitions['~']='[+-]';
			$('.input-mask-date').mask('99-99-9999');

			$(function() {
				var oTable = $('#tdefault').DataTable({
					dom: 'Bflrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
			        displayLength: 100, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "full_numbers",
			        responsive: false,
			        processing: false,
			        stateSave: true, // Remember paging & filters
			        autoWidth: true,
			        scrollCollapse: true,
			        serverSide: false,
			        searching: true,
			        order: [[ 1, "desc" ],[ 2, "desc" ],[ 3, "desc" ],[ 4, "desc" ],[ 5, "desc" ],[ 6, "desc" ],[ 0, "desc" ]],
			        ajax: 'EventPreKenshuEligible/getListing',
			        columnDefs: [
	            	{ targets: [ 0 ], data: "name", searchable: true },
			    	{ targets: [ 1 ], data: "rhq", searchable: true },
			    	{ targets: [ 2 ], data: "zone", searchable: true },
			    	{ targets: [ 3 ], data: "chapter", searchable: true },
					{ targets: [ 4 ], data: "district", searchable: true },
					{ targets: [ 5 ], data: "division", searchable: true },
			    	{ targets: [ 6 ], data: "position", searchable: true }]
			    });
			});
		});
	</script>
@stop