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
			<li class="active"><a href="{{{ URL::action('CrisisManagementController@getIndex') }}}">Crisis Management Listing</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Crisis Management<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Crisis Management Listing</h5>
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
											<th>Date</th>
											<th>Location</th>
											<th>Shift</th>
											<th>No of Failed</th>
											<th>No of Collected form</th>
											<th>Thermometer (Work)</th>
											<th>Thermometer (Spoilt)</th>
											<th>Surgical Mask</th>
											<th>Gloves</th>
											<th>Hand Sanitizers</th>
											<th>Anti Bacterial Wipes</th>
											<th>Declaration Forms (Not Used)</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<div class="col-xs-12">
									@if ($RECR03A == 't')
										<a href="#btnresourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="btnresourceadd" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'CrisisManagementController@postResource', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Add Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div class="form-group">
												{{ Form::label('resourcedate', 'Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('resourcedate', $currentdate, array('class' => 'col-xs-11 col-sm-11 input-mask-date', 'id' => 'resourcedate', 'placeholder' => 'DD-MM-YYYY'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('location', 'Location:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::select('location', $location_options, array('class' => 'col-xs-12 col-sm-10', 'id' => 'eventtype'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('shift', 'Shift:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::select('shift', $shift_options, array('class' => 'col-xs-12 col-sm-10', 'id' => 'eventtype'));}}
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
										{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceadd')); }}
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
	<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
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
					pagingType: "first_last_numbers",
					responsive: true,
					stateSave: true, // Remember paging & filters
					autoWidth: false,
					scrollCollapse: true,
					processing: false,
					serverSide: false,
					searching: true,
					order: [[ 0, "desc" ], [ 1, "asc" ]],
			        ajax: 'CrisisManagement/getListing',
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 2 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{
							targets: [ 0 ], data: "resourcedate", width: "150px", searchable: true,
							render: function ( data, type, full ){
								return moment(data).format("DD-MMM-YYYY");
							}
						},
						{ targets: [ 1 ], data: "location", searchable: true },
						{ targets: [ 2 ], data: "shift", searchable: true},
						{ targets: [ 3 ], data: "nooffailed", searchable: true},
						{ targets: [ 4 ], data: "noofdeclarationform", searchable: true},
						{ targets: [ 5 ], data: "equipthermometerwork", searchable: true},
						{ targets: [ 6 ], data: "equipthermometerspoilt", searchable: true},
						{ targets: [ 7 ], data: "equipmentsurgicalmask", searchable: true},
						{ targets: [ 8 ], data: "equipmentgloves", searchable: true},
						{ targets: [ 9 ], data: "equipmenthandsanitizer", searchable: true},
						{ targets: [ 10 ], data: "equipmentantibacterialwipes", searchable: true},
						{ targets: [ 11 ], data: "equipmentdeclarationforms", searchable: true},
						{
							targets: [ 12 ], data: "uniquecode",
							render: function ( data, type, full ){
								return '<a href="#resourceedit" role="button" onClick=editrow("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
							}
						}
					]
			    });
			});

			$('#resourceadd').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: '/CrisisManagement/postResource',
			        type: 'POST',
			        data: { resourcedate: $("#resourcedate").val(), location: $("#location").val(), shift: $("#shift").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
							oTable.ajax.reload(null, false);
			        		$("#resourcedate").val('{{$currentdate}}'); $("#shift").val('Morning'); $("#location").val('SSAHQ');
			        		$("#btnresourceadd").modal('hide');
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
		});

		function editrow(submit){ 
			$.ajax({
				url: 'CrisisManagement/postACCheck/' + submit,
				type: 'POST',
				data: { value: submit },
				dataType: 'json',
				statusCode: { 
					200:function(){
						var RowID = "";
						var oTable = $('#tdefault').DataTable();
						$("#tdefault tbody tr").click(function () {
							var position = oTable.row(this).index();
							RowID = oTable.row(position).data();
							window.location.href = "CrisisManagement/Detail/" + submit;
						});
					},
					400:function(data){ 
						var txtMessage;
						noty({
							layout: 'topRight', type: 'error', text: 'You do not have access rights to see this Event Detail!! ',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
					}
				}
			});
		}

		function deleterow(submit){ 
			noty({
				layout: 'center', type: 'confirm', text: 'Do you want to delete record?',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
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
							url: 'CrisisManagement/deleteResource/' + submit,
							type: 'POST',
							data: { value: submit },
							dataType: 'json',
							statusCode: { 
								200:function(){
									var oTable = $('#tdefault').DataTable();
									oTable.ajax.reload(null, false);
									noty({
										layout: 'topRight', type: 'success', text: 'Record Deleted!!',
										animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500
											},
										timeout: 4000
									}); 
								},
								400:function(data){ 
									var txtMessage;
									if (data.responseJSON.ErrType == "NoAccess") 
										{ txtMessage = 'You do not have Access Rights!'; }
									else { txtMessage = 'Please check your entry!'; }
									noty({
										layout: 'topRight', type: 'error', text: txtMessage,
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
@stop