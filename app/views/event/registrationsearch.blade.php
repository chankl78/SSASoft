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
			<li><a href="{{{ URL::action('EventController@getIndex') }}}">Events</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Registration<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box transparent">
						<div class="well well-lg">
							{{ Form::open(array('action' => 'EventRegistrationSearchController@postSearch', 'class' => 'form-horizontal', 'id' => 'fSearch')) }}
								<fieldset>
									<div align='center'>
										{{ Form::text('search', '', array('class' => 'input-lg', 'placeholder' => 'Search NRIC', 'id' => 'search' )); }}
										{{ Form::button('<i class="icon-search"></i> Search', array('type' => 'Search', 'class' => 'btn btn-warning' )); }}
									</div>
								</fieldset>
							{{ Form::close() }}
						</div>
					</div>
				</div>
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Member Listing</h5>
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
							<div class="widget-toolbar no-border open">
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<table id="tdefault" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th class="hidden-480">Name</th>
											<th class="hidden-480">RHQ</th>
											<th class="hidden-480">Zone</th>
											<th class="hidden-480">Chap</th>
											<th class="hidden-480">Dist</th>
											<th class="hidden-480">Div</th>
											<th class="hidden-480">Pos</th>
											<th class="hidden-480">Age</th>
											<th class="hidden-480">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
							</div>
						</div>
					</div>
				</div>
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript">
		$('#fSearch').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Searching Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'Search',
		        type: 'POST',
		        data: { search: $("#search").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		$("#search").val('');
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Found!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						window.location.href = "Result/" + data.rid;
		        	},
		        	400:function(data){
		        		var txtMessage;
		        		if (data.responseJSON.ErrType == "Duplicate") 
		        			{ txtMessage = 'Record already existed!'; }
		        		else if (data.responseJSON.ErrType == "Does Not Exist")
		        			{ txtMessage = 'Please check your entry!'; }
		        		else if (data.responseJSON.ErrType == "Failed")
		        			{ txtMessage = 'Please check your entry!'; }
		        		else { txtMessage = 'Please check your entry!'; }
		        		$("#search").focus();
		        		noty({
							layout: 'topRight', type: 'error', text: 'Record does not Exist!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });
		
		function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').dataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.fnGetPosition(this); // getting the clicked row position
                RowID = oTable.fnGetData(position); // getting the value of the first (invisible) column
                window.location.href = "Result/" + submit;
            });
	    }
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(function() {
				var oTable = $('#tdefault').DataTable({
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
			            url: 'SearchName',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"aTargets": [ 8 ], "mData": "id",
				    	"mRender": function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<a href="#resourceedit" role="button" onClick=editrow('+ data +') class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a>'
					    }
			    	},
			    	{ "targets": [ 0 ], "data": "name", "searchable": "true" },
			    	{ "targets": [ 1 ], "data": "rhq", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "zone", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "chapter", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "district", "searchable": "true" },
			    	{ "targets": [ 5 ], "data": "division", "searchable": "true" },
			    	{ "targets": [ 6 ], "data": "position", "searchable": "true" },
			    	{
				    	"targets": [ 7 ], "data": "dateofbirth",
				    	"render": function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		var nowyear = moment().format("YYYY");
				    		var birthyear = moment(data).format("YYYY");

				    		var diff = nowyear - birthyear;
				    		if (data == '0000-00-00') { return '';} 
				    		else if (data == '') { return ''; }
				    		else { return diff; }
				    		return data;
					    }
			    	}]
			    });
			});
		});
	</script>
@stop