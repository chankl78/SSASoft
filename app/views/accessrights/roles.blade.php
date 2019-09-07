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
			<li><a href="{{{ URL::action('AccessRightsController@getIndex') }}}">Access Rights</a></li>
			<li class="active">Roles</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Access Rights<small><i class="ace-icon fa fa-angle-double-right"></i> Roles</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-sm-offset-2 col-sm-8 widget-container-span ui-sortable">
					<div class="widget-box  widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Roles</h5>
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
								{{ Form::open(array('action' => 'AccessRightsController@postRole', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
									<fieldset>
										@if ($REAR02A == 't')
											<div class="form-group">
												<div class="col-sm-offset-4 col-xs-7">
													{{ Form::text('arole', '', array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'arole' )); }}
												</div>
												<div class="col-xs-1">
													{{ Form::button('<i class="icon-plus Add"></i> Add', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger pull-right' )); }}
												</div>
											</div>
										@endif
									</fieldset>
								{{ Form::close() }}
								<div hidden>
									<a href="#resourceedit" role="button" class="blue" data-toggle="modal" id="edit"> Form </a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="resourceedit" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'AccessRightsController@putRole', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Edit Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div hidden>
												<div class="form-group">
													{{ Form::label('roleid', 'RoleID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('eroleid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eroleid', 'disabled'));}}
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('role', 'Role:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::text('erole', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'erole'));}}
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn btn-sm" data-dismiss="modal" id="btnclose">
											<i class="icon-remove"></i>
											Cancel
										</button>
										{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'btnresourceupdate')); }}
									</div>
								</fieldset>
							{{ Form::close() }}
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
	<script type="text/javascript">
		$(document).ready(function () {
			$('#resourceadd').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					arole: {
						required: true,
						minlength: 3
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit   
					$('.alert-danger', $('.login-form')).show();
				},
				highlight: function (e) {
					$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
				},
				success: function (e) {
					$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
					$(e).remove();
				}
			});

			$('#resourceupdate').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					erole: {
						required: true,
						minlength: 3
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit   
					$('.alert-danger', $('.login-form')).show();
				},
				highlight: function (e) {
					$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
				},
				success: function (e) {
					$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
					$(e).remove();
				}
			});
		});
	</script>
	<script type="text/javascript">
		function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                $("#erole").val(RowID.value);
                $("#eroleid").val(submit);
            });
	        $("#resourceedit").modal('show');
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
					        url: 'deleteRoles/' + submit,
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
			            url: 'getRolesListing',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "200px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "value", "searchable": "true" },
			    	{
				    	"aTargets": [ 2 ], "data": "id",
				    	"render": function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<button type="submit" onClick=editrow('+ data +') class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleterow('+ data +') class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    });
			});

			$('#resourceadd').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postRoles',
			        type: 'POST',
			        data: { arole: $("#arole").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		$("#arole").val('');
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Created!!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	},
			        	400:function(data){ 
			        		var txtMessage;
			        		if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Record already existed!'; }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else { txtMessage = 'Please check your entry!'; }
			        		$("#arole").focus();
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	}
			        }
			    });
			    e.preventDefault();
		    });

			$('#resourceupdate').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'putRoles',
			        type: 'POST',
			        data: { erole: $("#erole").val(), eroleid: $("#eroleid").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		$("#erole").val('');
			        		$("#eroleid").val('');
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Updated!!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							});
							$("#resourceedit").modal('hide');
			        	},
			        	400:function(data){ 
			        		var txtMessage = 'Please check your entry!!';
			        		$("#erole").focus();
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
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