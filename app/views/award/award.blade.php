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
			<li class="active"><a href="{{{ URL::action('AwardController@getIndex') }}}">Award / Gift / Certificate</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Award / Gift / Certificate<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Award / Gift / Certificate Listing</h5>
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
											<th class="hidden-480">Award Date</th>
											<th class="hidden-480">Title</th>
											<th class="hidden-480">Type</th>
											<th class="hidden-480">Country</th>
											<th class="hidden-480">Given By</th>
											<th class="hidden-480">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								<div class="col-xs-12">
									@if ($RECE03A == 't')
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
							{{ Form::open(array('action' => 'AwardController@postAward', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Add Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div class="form-group">
												{{ Form::label('awarddate', 'Award Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('awarddate', '', array('class' => 'col-xs-11 col-sm-11 input-mask-date', 'id' => 'awarddate', 'placeholder' => 'DD-MM-YYYY'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('awardtype', 'Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::select('awardtype', $type_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'awardtype'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('awardtitle', 'Title:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('awardtitle', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'awardtitle'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('country', 'Country:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('country', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'country'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('awardby', 'Given By', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('awardby', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'awardby'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('description', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::textarea('description' , "", array('class' => 'col-xs-12 col-sm-9', 'rows' => '3', 'id' => 'description'));}}
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
		function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').dataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.fnGetPosition(this); // getting the clicked row position
                RowID = oTable.fnGetData(position); // getting the value of the first (invisible) column
                window.location.href = "Award/Detail/" + submit;
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
					        url: 'Award/deleteAward/' + submit,
					        type: 'POST',
					        data: { value: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oTable = $('#tdefault').dataTable();
					        		oTable.fnDraw();
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
										layout: 'topRight', type: 'error', text: 'Failed to Delete Record!! ' + " ",
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
			$('#resourceadd').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					description: {
						required: true,
						minlength: 3
					},
					awarddate: {
						required: true
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
		$(document).ready(function () {
			$.mask.definitions['~']='[+-]';
			$('.input-mask-date').mask('99-99-9999');

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
			        "sAjaxSource": 'Award/getAwardListing',
			        "aoColumns": [
	                    { "mData": "awarddate", "bSortable": false }, 
	                    { "mData": "awardtitle", "bSortable": false }, 
	                    { "mData": "awardtype", "bSortable": false },
	                    { "mData": "awardby", "bSortable": false },
	                    { "mData": "country", "bSortable": false } ],
	                "aoColumnDefs": [
	            	{
				    	"aTargets": [ 0 ], "mData": "awarddate",
				    	"mRender": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{
				    	"aTargets": [ 5 ], "mData": "uniquecode",
				    	"mRender": function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<a href="#resourceedit" role="button" onClick=editrow('+ data +') class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterow('+ data +') class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
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
			        url: 'Award/postAward',
			        type: 'POST',
			        data: { awarddate: $("#awarddate").val(), description: $("#description").val(), awardtype: $("#awardtype").val(), country: $("#country").val(), awardby: $("#awardby").val(), awardtitle: $("#awardtitle").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tdefault').dataTable();
			        		oTable.fnDraw();
			        		$("#awarddate").val(''); $("#awardtype").val(''); $("#description").val(''); $("#country").val('');
			        		$("#awardby").val(''); $("#awardtitle").val('');
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
			        			{ txtMessage = 'Please check your entry again!'; }
			        		else if (data.responseJSON.ErrType == "EmptyValue")
			        			{ txtMessage = 'Please check your entry again as there is empty field!'; }
			        		else { txtMessage = 'Please check your entry!'; }
			        		$("#description").focus();
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
		    });		});
	</script>
@stop