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
			<li class="active">Users Listing</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		@include('layout/skin')
		<div class="page-header">
			<h1>Access Rights<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-12 col-sm-12 widget-container-col">
					<div class="widget-box widget-color-blue">
						<div class="widget-header widget-header-small">
							<h5 class="widget-title">
								Users Listing
							</h5>
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
							<div class="widget-main no-padding">
								<table id="tdefault" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th class="hidden-480">Date</th>
											<th class="hidden-480">Name</th>
											<th class="hidden-480">Username</th>
											<th class="hidden-480">Role</th>
											<th class="hidden-480">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
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
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                window.location.href = 'AccessRights/User/' + submit;
            });
	    }

	    function deleterow(submit){ 
	        noty({
				layout: 'center', type: 'confirm', text: 'Do you want to delete record?',
				animation: { open: 'animated tada', close: 'animated lightSpeedOut', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Deleting Record ...',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'AccessRights/User/deleteUser/' + submit,
					        type: 'POST',
					        data: { drole: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oTable = $('#tdefault').DataTable();
					        		oTable.clearPipeline().draw();
			            			noty({
										layout: 'topRight', type: 'success', text: 'Record Deleted!!',
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500
											},
										timeout: 4000
									}); 
					        	},
					        	400:function(data){ 
					        		var txtMessage;
					        		noty({
										layout: 'topRight', type: 'error', text: 'Failed to Delete Record!! ' + " " + data.responseJSON.value,
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
											},
										timeout: 4000
									}); 
					        	}
					        }
					    });
				      }
				    },
				    {addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
				        $noty.close();
				        noty({
							layout: 'topRight', type: 'success', text: 'Delete Cancelled.',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
				      }
				    }
				  ]
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
			        "responsive": false,
			        "processing": true,
			        "stateSave": true, // Remember paging & filters
			        "autoWidth": true,
			        "scrollCollapse": true,
			        "processing": false,
			        "serverSide": true,
			        "searching": true,
			        "order": [[ 0, "desc" ]],
			        "ajax": $.fn.dataTable.pipeline({
			            url: 'AccessRights/getUsersListing',
			            pages: 5 // number of pages to cache
			        }),
	                "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "200px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "username", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "roleid", "searchable": "true" },
			    	{
				    	"targets": [ 4 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    });
			});
		});
	</script>
@stop