@extends('layout.master')

@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i><a href="{{{ URL::action('DashboardController@getIndex') }}}">Home</a>
			</li>
			<li><a href="{{{ URL::action('EventController@getIndex') }}}">Event</a></li>
			<li class="active">Registration Status</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Event <small><i class="icon-double-angle-right"></i> Registration Status</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-sm-offset-2 col-sm-8 widget-container-span ui-sortable">
					<div class="widget-box">
						<div class="widget-header header-color-blue">
							<h5>Registration Status</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="1 icon-chevron-up bigger-125"></i>
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
											<th class="hidden-480">Date</th>
											<th class="hidden-480">Description</th>
											<th class="hidden-480">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								{{ Form::open(array('action' => 'AccessRightsController@postRole', 'id' => 'RoleAdd', 'class' => 'form-horizontal')) }}
									<fieldset>
											<div class="col-sm-offset-4 col-xs-7">
												{{ Form::text('arole', '', array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'arole' )); }}
											</div>
											{{ Form::button('<i class="icon-plus Add"></i> Add', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger pull-right' )); }}
										
									</fieldset>
								{{ Form::close() }}
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
		
		
		function editrow(submit){ 
	        console.log(submit)
	    }

	    function deleterow(submit){ 
	        console.log(submit)
	    }
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(function() {
				var oTable = $('#tdefault').dataTable({
			        "iDisplayLength": 10, // Default No of Records per page on 1st load
			        "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        //"aaSorting": [[0, "desc"]], // Default 1st column sorting
			        "bStateSave": true, // Remember paging & filters
			        "bAutoWidth": true,
			        "bScrollCollapse": true,
			        "bServerSide": true,
			        "fnServerData": fnDataTablesPipeline,
			        "sPaginationType": "bootstrap", // Include page number
			        "sAjaxSource": 'getRegistrationStatusListing',
			        "aoColumns": [
	                    { "mData": "created_at" }, { "mData": "value" }],
	                "aoColumnDefs": [
	            	{
				    	"aTargets": [ 0 ], "mData": "created_at",
				    	"mRender": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{
				    	"aTargets": [ 2 ], "mData": "id",
				    	"mRender": function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<button type="submit" onClick=editrow('+ data +') class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></button> <button type="submit" onClick=deleterow('+ data +') class="btn btn-xs btn-danger"><i class="icon-trash bigger-120"></i></button>'
					    }
			    	}]
			    });
			});

			$('#RoleAdd').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postRoles',
			        type: 'POST',
			        data: { role: 'test 4' },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').dataTable();
			        		oTable.fnDraw();
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Created!!',
								animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	},
			        	400:function(info){ 
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Create!!  Please check your entry.' + ' ' + $("#arole").val() + ' ' + info,
								animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	}
			        }
			    });
			    e.preventDefault();
		    });
		});
	</script>
@stop