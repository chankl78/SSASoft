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
			<li class="active"><a href="{{{ URL::action('StaffController@getIndex') }}}">Staff</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Staff<small><i class="ace-icon fa fa-angle-double-right"></i> Staffs Listing</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-sm-offset-2 col-sm-8 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Staff Listing</h5>
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
											<th class="hidden-480">Staff</th>
											<th class="hidden-480">Department</th>
											<th class="hidden-480">Position</th>
											<th class="hidden-480">Office Tel</th>
											<th class="hidden-480">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								{{ Form::open(array('action' => 'StaffController@postStaff', 'id' => 'fStaffAdd', 'class' => 'form-horizontal')) }}
									<fieldset>
											<div class="col-xs-2 form-group">
												{{ Form::select('position', $staffposition_options, 'Staff', array('class' => 'col-xs-12 col-sm-12', 'id' => 'position'));}}
											</div>
											<div class="col-xs-2 form-group">
												{{ Form::select('department', $staffdepartment_options, 'Gakkai', array('class' => 'col-xs-12 col-sm-12', 'id' => 'department'));}}
											</div>
											<div class="col-xs-2 form-group">
												{{ Form::text('teloffice', '', array('class' => 'form-control', 'placeholder' => 'Office Tel', 'id' => 'teloffice' )); }}
											</div>
											<div class="col-xs-5 form-group">
												{{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Staff Name', 'id' => 'name' )); }}
											</div>
											{{ Form::button('<i class="fa fa-plus Add"></i> Add', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger pull-right' )); }}
										
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
				<div id="resourceedit" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'StaffController@putStaff', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Edit Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div hidden>
												<div class="form-group">
													{{ Form::label('id', 'ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('id', '', array('class' => 'col-xs-12 col-sm-12', 'id' => 'id', 'disabled'));}}
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('ename', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::text('ename', '', array('class' => 'col-xs-12 col-sm-12', 'id' => 'ename'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('eposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::select('eposition', $staffposition_options, '', array('class' => 'col-xs-12 col-sm-12', 'id' => 'eposition'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('edepartment', 'Department:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::select('edepartment', $staffdepartment_options, '', array('class' => 'col-xs-12 col-sm-12', 'id' => 'edepartment'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('eteloffice', 'Office Tel:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::text('eteloffice', '', array('class' => 'col-xs-12 col-sm-12', 'id' => 'eteloffice'));}}
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
	<script type="text/javascript">
		$(document).ready(function () {
			$('#fStaffAdd').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					name: {
						required: true,
						minlength: 3
					},
				},
				messages: {
				},
				invalidHandler: function (event, validator) { //display error alert on form submit   
					$('.alert-danger', $('.fStaffAdd')).show();
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
					ename: {
						required: true,
						minlength: 3
					},
				},
				messages: {
				},
				invalidHandler: function (event, validator) { //display error alert on form submit   
					$('.alert-danger', $('.resourceupdate')).show();
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
                var position = oTable.row(this).index(); // getting the clicked row position
                RowID = oTable.row(position).data(); // getting the value of the first (invisible) column
                $("#id").val(submit);
                $("#ename").val(RowID.name);
                $("#eteloffice").val(RowID.teloffice);
                $("#edepartment").val(RowID.department);
                $("#eposition").val(RowID.position);
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
					        url: 'deleteStaff/' + submit,
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
			            url: 'getStaffListing',
			            pages: 5 // number of pages to cache
			        }),
	                "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "200px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{
				    	"targets": [ 1 ], "data": "name", "searchable": "true"
			    	},
			    	{
				    	"targets": [ 2 ], "data": "department", "searchable": "true"
			    	},
			    	{
				    	"targets": [ 3 ], "data": "position", "searchable": "true"
			    	},
			    	{
				    	"targets": [ 4 ], "data": "teloffice", "searchable": "true"
			    	},
			    	{
				    	"aTargets": [ 5 ], "data": "id",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=editrow('+ data +') class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleterow('+ data +') class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    });
			});

			$('#fStaffAdd').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Creating Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postStaff',
			        type: 'POST',
			        data: { position: $("#position").val(), department: $("#department").val(), teloffice: $("#teloffice").val(), name: $("#name").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		$("#name").val('');
			        		$("#teloffice").val('');
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
			        		else if (data.responseJSON.ErrType == "No Value")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else { txtMessage = 'Please check your entry!'; }
			        		$("#name").focus();
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

			$('#resourceupdate').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'putStaff',
			        type: 'POST',
			        data: { ename: $("#ename").val(), id: $("#id").val(), eteloffice: $("#eteloffice").val() , eposition: $("#eposition").val(), edepartment: $("#edepartment").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		$("#ename").val('');
			        		$("#eteloffice").val('');
			        		$("#id").val('');
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Updated!!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							});
							$("#resourceedit").modal('hide');
			        	},
			        	400:function(data){ 
			        		var txtMessage;
			        		if (data.responseJSON.ErrType == "Duplicate") 
			        			{ txtMessage = 'Record already existed!'; }
			        		else if (data.responseJSON.ErrType == "Failed")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else if (data.responseJSON.ErrType == "No Value")
			        			{ txtMessage = 'Please check your entry!'; }
			        		else { txtMessage = 'Please check your entry!'; }
			        		$("#ename").focus();
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
		});
	</script>
@stop