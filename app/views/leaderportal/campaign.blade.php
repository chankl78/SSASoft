@extends('layout.leadersportalmaster')

@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i><a href="{{{ URL::action('LeadersPortalDashboardController@getIndex') }}}">Home</a>
			</li>
			<li class="active"><a href="{{{ URL::action('LeadersPortalCampaignListingController@getIndex') }}}">Campaign</a></li>
			<li class="active">{{ $campaignname }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Campaign<small><i class="ace-icon fa fa-angle-double-right"></i> {{ $campaignname }}</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@if ($gakkaidistrict == 't' or $gakkaichapter == 't' or $gakkaizone == 't' or $gakkairegion == 't'or $gakkaishq == 't')
					<div class="col-xs-12 col-sm-6  widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Total Value </h5>
								<div class="widget-toolbar">
									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>
									<a href="#" data-action="reload" onClick=reloaddt()>
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<div class="well well-lg">
										<center><h1> <span id="spantotal"> {{$campaignvaluetotal}} </span> </h1></center>
									</div>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
									</div>
								</div>
							</div>
						</div>
					</div> <!-- Total Value -->
					@if ($campaignlevel == 'District' and $campaigntype == "Target")
						<div class="col-xs-12 col-sm-6  widget-container-span ui-sortable">
							<div class="widget-box widget-color-red">
								<div class="widget-header">
									<h5 class="widget-title">Not Submitted</h5>
									<div class="widget-toolbar">
										<a href="#" data-action="fullscreen" class="orange2">
											<i class="ace-icon fa fa-expand"></i>
										</a>
										<a href="#" data-action="reload" onClick=reloaddt()>
											<i class="fa fa-refresh"></i>
										</a>
									</div>
								</div>
								<div class="widget-body">
									<div class="widget-main">
										<div class="well well-lg">
											<center><h1> <span id="spannotsubmit"> {{$campaignvaluenotsubmmited}} </span> </h1></center>
										</div>
									</div>
									<div class="widget-toolbox padding-8 clearfix">
										<div class="col-xs-12">
										</div>
									</div>
								</div>
							</div>
						</div> <!-- Not Submitted -->
					@endif
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">{{ $campaignname }}</h5>
								<div class="widget-toolbar">
									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>
									<a href="#" data-action="reload" onClick=reloaddt()>
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
									</div>
								</div>
								<div class="widget-main">
									<table id="tdistrict" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Created At</th>
												<th>Name</th>
												<th>RHQ</th>
												<th>Zone</th>
												<th>Chapter</th>
												<th>District</th>
												<th>Division</th>
												<th>Position</th>
												<th>Value</th>
												<th>Remark</th>
												<th>Action</th>
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
					<div id="btnresourceedit" class="modal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								{{ Form::open(array('action' => 'LeadersPortalCampaignController@postEditModuleDetail', 'id' => 'resourceedit', 'class' => 'form-horizontal')) }}
									<fieldset>
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="blue bigger">Edit Record</h4>
										</div>
										<div class="modal-body overflow-visible">
											<div class="row">
												<div class="form-group">
													{{ Form::label('evalue', 'Value:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('evalue', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'evalue'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('eremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::textarea('eremarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eremarks', 'rows'=>'3'));}}
														</div>
													</div>
												</div>
												<div class="form-group" hidden>
													{{ Form::label('euniquecode', 'UniqueCode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('euniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'euniquecode'));}}
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-sm" data-dismiss="modal" id="btnclose">
												<i class="fa fa-remove"></i>
												Cancel
											</button>
											{{ Form::button('<i class="fa fa-check"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceedit')); }}
										</div>
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				@endif
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(function() {
				jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
				    return this.flatten().reduce( function ( a, b ) {
				        if ( typeof a === 'string' ) {
				            a = a.replace(/[^\d.-]/g, '') * 1;
				        }
				        if ( typeof b === 'string' ) {
				            b = b.replace(/[^\d.-]/g, '') * 1;
				        }
				        return a + b;
				    }, 0 );
				});

				var oDistrictTable = $('#tdistrict').DataTable({
					dom: 'Bfrtip',
					buttons: [ 'copyHtml5', 'excelHtml5', 'pdfHtml5' ],
			        displayLength: 100, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "first_last_numbers",
			        responsive: true,
			        stateSave: true, // Remember paging & filters
			        autoWidth: false,
			        paging: true,
			        scrollCollapse: true,
			        processing: false,
			        serverSide: false,
			        deferRender: true,
			        order: [[2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [6, "asc"], [7, "asc"], [1, "asc"]],
			        ajax: 'getModuleDetail/{{ $rid }}',
			        columnDefs: [
			        	{ responsivePriority: 1, targets: 0 },
			        	{ responsivePriority: 2, targets: -1 },
			        	{ responsivePriority: 3, targets: -3 },
            			{ responsivePriority: 4, targets: 5 },
            			{ responsivePriority: 5, targets: 4 },
            			{
					    	targets: [ 0 ], data: "created_at", width: "170px", searchable: true,
					    	render: function ( data, type, full ){
					    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
						    }
				    	},
		            	{ targets: [ 1 ], data: "name", searchable: true },
		            	{ targets: [ 2 ], data: "rhq", searchable: true },
		            	{ targets: [ 3 ], data: "zone", searchable: true },
		            	{ targets: [ 4 ], data: "chapter", searchable: true },
		            	{ targets: [ 5 ], data: "district", searchable: true },
				    	{ targets: [ 6 ], data: "division", searchable: true },
				    	{ targets: [ 7 ], data: "position", searchable: true },
				    	{ targets: [ 8 ], data: "value", searchable: true },
				    	{ targets: [ 9 ], data: "remarks", searchable: true },
				    	{
					    	targets: [ 10 ], data: "uniquecode",
					    	render: function ( data, type, full ){
					    		return '@if ($readonly == false)<button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>@endif'
						    }
				    	}
				    ]
			    });
			});
		});

	    function reloaddt(submit){ 
	    	var oDistrictTable = $('#tdistrict').DataTable();
		    oDistrictTable.ajax.reload(null, false);
	    }

	    function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdistrict').DataTable();
	        $("#tdistrict tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                $("#euniquecode").val(RowID.uniquecode);
                $("#evalue").val(RowID.value);
                $("#eremarks").val(RowID.remarks);

                $("#btnresourceedit").modal('show');
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
					        url: 'deleteModuleDetail/' + submit,
					        type: 'POST',
					        data: { deletevalue: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oDistrictTable = $('#tdistrict').DataTable();
		        					oDistrictTable.ajax.reload(null, false);
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

	    $('#resourceedit').submit(function(e){
			$.ajax({
		        url: 'postEditModuleDetail/{{ $rid }}',
		        type: 'POST',
		        data: { value: $("#evalue").val(), remarks: $("#eremarks").val(), uniquecode: $("#euniquecode").val()},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oDistrictTable = $('#tdistrict').DataTable();
    					oDistrictTable.ajax.reload(null, false);

	    				$("#evalue").val(''); $("#euniquecode").val(''); $("#eremarks").val('');

		        		$("#btnresourceedit").modal('hide');
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
		        			{ txtMessage = 'Record already existed!'; }
		        		else if (data.responseJSON.ErrType == "Failed")
		        			{ txtMessage = 'Please check your entry!'; }
		        		else if (data.responseJSON.ErrType == "Over") 
    						{ txtMessage = 'Failed to Update'; }
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
	    });
	</script>
@stop