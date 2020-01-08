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
			<li class="active"><a href="{{{ URL::action('EventSSAMADKenshuController@getIndex') }}}">SSA M&D Training Course</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>SSA M&D Training Course<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
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
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							<div class="col-xs-12 col-sm-3 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-purple">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											Update SSA Training Course
										</h6>
										<div class="widget-toolbar">
											<a href="#" data-action="fullscreen" class="orange2">
												<i class="ace-icon fa fa-expand"></i>
											</a>
											<a href="#" data-action="reload">
												<i class="fa fa-refresh"></i>
											</a>
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-down"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main no-padding">
											{{ Form::open(array('action' => 'Event20194ObjectsController@postStatistic', 'id' => 'fUpdate', 'class' => 'form-horizontal')) }}
												<br />
												<div class="form-group">
													<div class="col-md-offset-2 col-xs-12 col-sm-12">
														<div class="clearfix">
															{{ Form::button('Update Statistic', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
														</div>
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Update Statistic -->
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">SSA M&D Kenshu Listing</h5>
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
														<th>Training Date</th>
														<th>Language</th>
														<th>Name</th>
														<th>Rhq</th>
														<th>Zone</th>
														<th>Chap</th>
														<th>Dist</th>
														<th>Div</th>
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
							</div> <!-- Listing -->
						</div>
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
			        displayLength: 10, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "full_numbers",
			        responsive: false,
			        processing: false,
			        stateSave: true, // Remember paging & filters
			        autoWidth: true,
			        scrollCollapse: true,
			        processing: false,
			        serverSide: false,
			        searching: true,
			        order: [[ 0, "desc" ]],
			        ajax: 'EventSSAMADKenshu/getListing',
			        columnDefs: [
	            	{ targets: [ 0 ], data: "trainingdate", searchable: true },
			    	{ targets: [ 1 ], data: "language", searchable: true },
			    	{ targets: [ 2 ], data: "name", searchable: true },
			    	{ targets: [ 3 ], data: "rhq", searchable: true },
			    	{ targets: [ 4 ], data: "zone", searchable: true },
			    	{ targets: [ 5 ], data: "chapter", searchable: true },
			    	{ targets: [ 6 ], data: "district", searchable: true },
					{ targets: [ 7 ], data: "division", searchable: true },
			    	{ targets: [ 8 ], data: "position", searchable: true }]
			    });
			});
		});

		$('#fUpdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: '/EventSSAMADKenshu/postStatistic',
		        type: 'POST',
		        data: { },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
						oTable.ajax.reload(null, false);
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		var txtMessage;
		        		if (data.responseJSON.ErrType == "Duplicate") 
		        			{ txtMessage = 'Record already existed!';  }
		        		else if (data.responseJSON.ErrType == "Failed")
		        			{ txtMessage = 'Please check your entry!'; }
		        		else if (data.responseJSON.ErrType == "CannotUpdate")
		        			{ txtMessage = 'Unable to Update.  Please check your entry!'; }
		        		else { txtMessage = 'Please check your entry!'; }
		        		$("#search").focus();
		        		noty({
							layout: 'topRight', type: 'error', text: txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
		        	}
		        }
		    });
		    e.preventDefault();
	    });
	</script>
@stop