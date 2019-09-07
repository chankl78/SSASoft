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
			<li><a href="{{{ URL::action('EventController@getIndex') }}}">Event</a></li>
			<li class="active">Registration Status</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Event<small><i class="ace-icon fa fa-angle-double-right"></i> Registration Status</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-sm-offset-2 col-xs-12 col-sm-8 widget-container-col ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Registration Status</h5>
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
								{{ Form::open(array('action' => 'EventzRegistrationStatusController@postRegistrationStatus', 'id' => 'fResourceAdd', 'class' => 'form-horizontal')) }}
									<fieldset>
											<div class="col-sm-offset-4 col-xs-7">
												{{ Form::text('txtvalue', '', array('class' => 'form-control', 'placeholder' => 'Please enter a value for new record', 'id' => 'txtvalue' )); }}
											</div>
											{{ Form::button('<i class="fa fa-plus Add"></i> Add', array('type' => 'submit', 'class' => 'btn btn-xs bigger-120 btn-yellow bigger pull-right' )); }}
										
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
				<div id="resourceedit" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'EventzRegistrationStatusController@putRegistrationStatus', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Edit Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div hidden>
												<div class="form-group">
													{{ Form::label('evalueid', 'ValueID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('evalueid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'evalueid', 'disabled'));}}
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('value', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::text('evalue', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'evalue'));}}
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
	<script type="text/javascript">
		function editrow(submit){ 
	        var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                $("#evalue").val(RowID.value);
                $("#evalueid").val(submit);
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
					        url: 'deleteRegistrationStatus/' + submit,
					        type: 'POST',
					        data: { deletevalue: submit },
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
			            url: 'getRegistrationStatusListing',
			            pages: 5 // number of pages to cache
			        }),
			        "aoColumnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "value", "searchable": "true" },
			    	{
				    	"targets": [ 2 ], "data": "id",
				    	"render": function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<button type="submit" onClick=editrow('+ data +') class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleterow('+ data +') class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    });
			});

			$('#fResourceAdd').submit(function(e){
		    	noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'postRegistrationStatus',
			        type: 'POST',
			        data: { txtvalue: $("#txtvalue").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		$("#txtvalue").val('');
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Created!!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	},
			        	400:function(info){ 
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Create!!  Please check your entry.' + ' ' + $("#value").val() + ' ' + info,
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
			        url: 'putRegistrationStatus/' + $("#evalueid").val(),
			        type: 'POST',
			        data: { evalue: $("#evalue").val(), eroleid: $("#evalueid").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').DataTable();
			        		oTable.clearPipeline().draw();
			        		$("#evalue").val('');
			        		$("#evalueid").val('');
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