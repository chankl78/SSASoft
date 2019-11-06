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
			<li class="active"><a href="{{{ URL::action('LeadersPortalNewFriendsController@getIndex') }}}">New Friends Listing</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>New Friends<small><i class="ace-icon fa fa-angle-double-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@if ($gakkaishq == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">New Friends Listing (SHQ)</h5>
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
									<table id="tshq" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Created</th>
												<th>Name</th>
												<th>名字</th>
												<th>RHQ</th>
												<th>Zone</th>
												<th>Chapter</th>
												<th>District</th>
												<th>Division</th>
												<th>Position</th>
												<th>B.Signed</th>
												<th>Chanting</th>
												<th>No of Mtg</th>
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
				@endif
				@if ($gakkairegion == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">New Friends Listing (RHQ)</h5>
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
									<table id="trhq" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Created</th>
												<th>Name</th>
												<th>名字</th>
												<th>RHQ</th>
												<th>Zone</th>
												<th>Chapter</th>
												<th>District</th>
												<th>Division</th>
												<th>Position</th>
												<th>B.Signed</th>
												<th>Chanting</th>
												<th>No of Mtg</th>
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
				@endif
				@if ($gakkaizone == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">New Friends Listing (Zone)</h5>
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
									<table id="tzone" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Created</th>
												<th>Name</th>
												<th>名字</th>
												<th>RHQ</th>
												<th>Zone</th>
												<th>Chapter</th>
												<th>District</th>
												<th>Division</th>
												<th>Position</th>
												<th>B.Signed</th>
												<th>Chanting</th>
												<th>No of Mtg</th>
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
				@endif
				@if ($gakkaichapter == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">New Friends Listing (Chapter)</h5>
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
									<table id="tchapter" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Created</th>
												<th>Name</th>
												<th>名字</th>
												<th>RHQ</th>
												<th>Zone</th>
												<th>Chapter</th>
												<th>District</th>
												<th>Division</th>
												<th>Position</th>
												<th>B.Signed</th>
												<th>Chanting</th>
												<th>No of Mtg</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
											<a href="#btnresourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add New Record</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
				@if ($gakkaidistrict == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">New Friends Listing (District)</h5>
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
									<table id="tdistrict" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Created</th>
												<th>Name</th>
												<th>名字</th>
												<th>RHQ</th>
												<th>Zone</th>
												<th>Chapter</th>
												<th>District</th>
												<th>Division</th>
												<th>Position</th>
												<th>B.Signed</th>
												<th>Chanting</th>
												<th>No of Mtg</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
										<div class="col-xs-12">
											<a href="#btnresourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add New Record</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
				<div id="btnnewfriendedit" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'LeadersPortalNewFriendsController@putNewFriend', 'id' => 'newfriendedit', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Edit Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div class="form-group">
												{{ Form::label('name', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('name', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'name'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cname', '名字:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('cname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cname'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('division', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('division', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD', 'YC' => 'YC'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'division'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('position', $position_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'position'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('believersigned', 'BEL Form Signed:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('believersigned', array('0' => 'No', '1' => 'Yes'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'believersigned'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('chanting', 'Started Chanting?:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('chanting', array('0' => 'No', '1' => 'Yes'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'chanting'));}}
													</div>
												</div>
											</div>
											<div class="form-group" hidden>
												{{ Form::label('uniquecode', 'UniqueCode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('uniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'uniquecode'));}}
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
										{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'seniorldrsadd')); }}
									</div>
								</fieldset>
							{{ Form::close() }}
						</div>
					</div>
				</div>
				<div id="btnresourceadd" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'LeadersPortalNewFriendsController@postNewAttendee', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Add Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div class="form-group">
												{{ Form::label('newname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('newname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'newname'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('newchinesename', '名字:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('newchinesename', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'newchinesename'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
													{{ Form::label('newdistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
																{{ Form::text('newdistrict', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'newdistrict'));}}
														</div>
													</div>
												</div>
											<div class="form-group">
												{{ Form::label('newposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('newposition', $position_options, 'NF', array('class' => 'col-xs-12 col-sm-11', 'id' => 'newposition'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('newdivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('newdivision', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'newdivision'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('newmobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('newmobile', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'newmobile'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('newintroducer', 'Introducer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('newintroducer', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'newintroducer'));}}
													</div>
												</div>
											</div>
											<div class="form-group" hidden>
												{{ Form::label('newuniquecode', 'UniqueCode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('newuniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'newuniquecode'));}}
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
				<div id="btnmeminfo" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'GroupDetailController@putMemberInfo', 'id' => 'fmeminfo', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Member Information</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div class="col-sm-12 widget-container-col">
												<div class="widget-box transparent">
													<div class="widget-header">
														<h4 class="widget-title lighter"></h4>
														<div class="widget-toolbar no-border">
															<ul class="nav nav-tabs" id="tabmemberinfo">
																<li>
																	<a data-toggle="tab" href="#mmeetingattended">Meeting Attended</a>
																</li>
															</ul>
														</div>
													</div>
													<div class="widget-body">
														<div class="widget-main padding-12 no-padding-left no-padding-right">
															<div class="tab-content padding-4">
																<div id="mmeetingattended" class="tab-pane in active">
																	<div class="scrollable" data-size="100">
																		<table id="tgroup" class="table table-striped table-bordered table-hover">
																			<thead>
																				<tr>
																					<th class="hidden-480">Date</th>
																					<th class="hidden-480">Event</th>
																					<th class="hidden-480">Remarks</th>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn btn-sm" data-dismiss="modal" id="close">
											<i class="icon-remove"></i>
											Close
										</button>
									</div>
								</fieldset>
							{{ Form::close() }}
						</div>
					</div>
				</div> <!-- Edit New Friend Info -->
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
				@if ($gakkaishq == 't')
					var oSHQTable = $('#tshq').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 8, "asc" ],[ 1, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalNewFriends/getNewFriendsListingSHQ',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
							{
								"targets": [ 0 ], "data": "created_at", "width": "100px", "searchable": "true",
								"render": function ( data, type, full ){
									return moment(data).format("DD-MMM-YYYY HH:mm:ss");
								}
							},
			            	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 2 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 8 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 9 ], "data": "believersigned",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">No</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">Yes</span>';
								    }
					    		}
				    		},
					    	{
						    	"targets": [ 10 ], "data": "chanting",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">'+'No'+'</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">'+'Yes'+'</span>';
								    }
					    		}
				    		},
				    		{ "targets": [ 11 ], "data": "noofmtg", "searchable": "true" },
					    	{
						    	"targets": [ 12 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button>'
							    }
					    	}
					    ]
				    });
				@endif

				@if ($gakkairegion == 't')
					var oRHQTable = $('#trhq').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 2, "asc" ],[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 0, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalNewFriends/getNewFriendsListingRHQ',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
							{
								"targets": [ 0 ], "data": "created_at", "width": "100px", "searchable": "true",
								"render": function ( data, type, full ){
									return moment(data).format("DD-MMM-YYYY HH:mm:ss");
								}
							},
			            	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 2 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 8 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 9 ], "data": "believersigned",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">No</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">Yes</span>';
								    }
					    		}
				    		},
					    	{
						    	"targets": [ 10 ], "data": "chanting",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">'+'No'+'</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">'+'Yes'+'</span>';
								    }
					    		}
				    		},
				    		{ "targets": [ 11 ], "data": "noofmtg", "searchable": "true" },
					    	{
						    	"targets": [ 12 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button>'
							    }
					    	}
					    ]
				    });
				@endif

				@if ($gakkaizone == 't')
					var oZoneTable = $('#tzone').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 8, "asc" ],[ 1, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalNewFriends/getNewFriendsListingZone',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
							{
								"targets": [ 0 ], "data": "created_at", "width": "100px", "searchable": "true",
								"render": function ( data, type, full ){
									return moment(data).format("DD-MMM-YYYY HH:mm:ss");
								}
							},
			            	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 2 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 8 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 9 ], "data": "believersigned",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">No</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">Yes</span>';
								    }
					    		}
				    		},
					    	{
						    	"targets": [ 10 ], "data": "chanting",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">'+'No'+'</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">'+'Yes'+'</span>';
								    }
					    		}
				    		},
				    		{ "targets": [ 11 ], "data": "noofmtg", "searchable": "true" },
					    	{
						    	"targets": [ 12 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button>'
							    }
					    	}
					    ]
				    });
				@endif

				@if ($gakkaichapter == 't')
					var oChapterTable = $('#tchapter').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 8, "asc" ],[ 1, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalNewFriends/getNewFriendsListingChapter',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
							{
								"targets": [ 0 ], "data": "created_at", "width": "100px", "searchable": "true",
								"render": function ( data, type, full ){
									return moment(data).format("DD-MMM-YYYY HH:mm:ss");
								}
							},
			            	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 2 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 8 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 9 ], "data": "believersigned",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">No</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">Yes</span>';
								    }
					    		}
				    		},
					    	{
						    	"targets": [ 10 ], "data": "chanting",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">'+'No'+'</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">'+'Yes'+'</span>';
								    }
					    		}
				    		},
				    		{ "targets": [ 11 ], "data": "noofmtg", "searchable": "true" },
					    	{
						    	"targets": [ 12 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button>'
							    }
					    	}
					    ]
				    });
				@endif

				@if ($gakkaidistrict == 't')
					var oDistrictTable = $('#tdistrict').DataTable({
				        "displayLength": 10, // Default No of Records per page on 1st load
				        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
				        "pagingType": "full_numbers",
				        "responsive": false,
				        "processing": true,
				        "stateSave": true, // Remember paging & filters
				        "autoWidth": true,
				        "scrollCollapse": true,
				        "serverSide": true,
				        "searching": true,
				        "order": [[ 3, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ],[ 7, "asc" ],[ 8, "asc" ],[ 1, "asc" ]],
				        "ajax": $.fn.dataTable.pipeline({
				            url: 'BOEPortalNewFriends/getNewFriendsListingDistrict',
				            pages: 5 // number of pages to cache
				        }),
				        "columnDefs": [
							{
								"targets": [ 0 ], "data": "created_at", "width": "100px", "searchable": "true",
								"render": function ( data, type, full ){
									return moment(data).format("DD-MMM-YYYY HH:mm:ss");
								}
							},
			            	{ "targets": [ 1 ], "data": "name", "searchable": "true" },
			            	{ "targets": [ 2 ], "data": "chinesename", "searchable": "true" },
					    	{ "targets": [ 3 ], "data": "rhq", "searchable": "true" },
					    	{ "targets": [ 4 ], "data": "zone", "searchable": "true" },
					    	{ "targets": [ 5 ], "data": "chapter", "searchable": "true" },
					    	{ "targets": [ 6 ], "data": "district", "searchable": "true" },
					    	{ "targets": [ 7 ], "data": "division", "searchable": "true" },
					    	{ "targets": [ 8 ], "data": "position", "searchable": "true" },
					    	{
						    	"targets": [ 9 ], "data": "believersigned",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">No</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">Yes</span>';
								    }
					    		}
				    		},
					    	{
						    	"targets": [ 10 ], "data": "chanting",
						    	render: function ( data, type, full ){
								    if (data === 0 || data === '0'){
								    	return '<span class="label label-danger arrowed-in">'+'No'+'</span>';
								    }
								  	else if (data === 1 || data === '1'){
								    	return '<span class="label label-success arrowed">'+'Yes'+'</span>';
								    }
					    		}
				    		},
				    		{ "targets": [ 11 ], "data": "noofmtg", "searchable": "true" },
					    	{
						    	"targets": [ 12 ], "data": "uniquecode",
						    	"render": function ( data, type, full ){
						    		return '<button type="submit" onClick=editdistrictrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=memberinforow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-puzzle-piece bigger-120"></i></button> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
							    }
					    	}
					    ]
				    });
				@endif
			});
		});

		function editdistrictrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdistrict').DataTable();
	        $("#tdistrict tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                $("#name").val(RowID.name);
                $("#cname").val(RowID.chinesename);
                $("#division").val(RowID.division);
                $("#position").val(RowID.position);
                $("#believersigned").val(RowID.believersigned);
                $("#chanting").val(RowID.chanting);
                $("#uniquecode").val(submit);
            });
            $("#btnnewfriendedit").modal('show');
	    }

	    $('#newfriendedit').submit(function(e){
	    	if ($("#position").val() == "BEL")
	    	{
	    		noty({
					layout: 'center', type: 'confirm', text: 'Do you want to change New Friend to Believer?',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000,
					buttons: [
					    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
					    	$noty.close();
					    	noty({
								layout: 'topRight', type: 'warning', text: 'Updating Record ...',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
								timeout: 4000
							});
					    	$.ajax({
						        url: 'BOEPortalNewFriends/putNewFriend/'  + $('#uniquecode').val(),
						        type: 'POST',
						        data: { position: $('#position').val(), name: $("#name").val(), chinesename: $("#cname").val(), division: $("#division").val(), believersigned: $("#believersigned").val(), chanting: $("#chanting").val(), uniquecode: $("#uniquecode").val() },
						        dataType: 'json',
						        statusCode: {
						        	200:function(){
						        		var oTable = $('#tdistrict').DataTable();
						        		oTable.clearPipeline().draw();
						        		$("#name").val(''); $("#cname").val(''); $("#position").val(''); $("#division").val(''); $("#uniquecode").val(''); $("#believersigned").val(''); $("#chanting").val('');
				            			noty({
											layout: 'topRight', type: 'success', text: 'Record Updated!!',
											animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
												},
											timeout: 4000
										});
										$("#btnnewfriendedit").modal('hide');
						        	},
						        	400:function(data){ 
						        		var txtMessage = 'Please check your entry!!';
						        		$("#evalue").focus();
						        		noty({
											layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
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
	    	else
	    	{
	    		noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'BOEPortalNewFriends/putNewFriend/'  + $('#uniquecode').val(),
			        type: 'POST',
			        data: { position: $('#position').val(), name: $("#name").val(), chinesename: $("#cname").val(), division: $("#division").val(), believersigned: $("#believersigned").val(), chanting: $("#chanting").val(), uniquecode: $("#uniquecode").val() },
			        dataType: 'json',
			        statusCode: {
			        	200:function(){
			        		var oTable = $('#tdistrict').DataTable();
			        		oTable.clearPipeline().draw();
			        		$("#name").val(''); $("#cname").val(''); $("#position").val(''); $("#division").val(''); $("#uniquecode").val(''); $("#believersigned").val(''); $("#chanting").val('');
	            			noty({
								layout: 'topRight', type: 'success', text: 'Record Updated!!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							});
							$("#btnnewfriendedit").modal('hide');
			        	},
			        	400:function(data){ 
			        		var txtMessage = 'Please check your entry!!';
			        		$("#evalue").focus();
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	}
			        }
			    });
	    	}
	    	e.preventDefault();
	    });

		function memberinforow(submit){ 
			$.ajax({
		        url: '/BOEPortalNewFriends/getNewFriendsInfo/' + submit,
		        type: 'GET',
		        data: { value: submit },
		        dataType: 'json',
		        statusCode: {
		        	200:function(data){
		        		var oGroupTable = $('#tgroup').DataTable();
		        		oGroupTable.destroy();
		        		oGroupTable = $('#tgroup').DataTable({
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
					            url: '/BOEPortalNewFriends/getNewFriendsInfo/' + submit,
					            pages: 5 // number of pages to cache
					        }),
					        "columnDefs": [
					        {
						    	"targets": [ 0 ], "data": "attendancedate", "width": "150px", "searchable": "true",
						    	"render": function ( data, type, full ){
						    		return moment(data).format("DD-MMM-YYYY");
							    }
					    	},
					    	{ "targets": [ 1 ], "data": "description", "searchable": "true" },
					    	{ "targets": [ 2 ], "data": "remarks", "searchable": "true" }]
					    }); // Group Members for Individual Person

						$("#btnmeminfo").modal('show');
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Retrieve Data!! ' + txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
			$("#btnmeminfo").modal('show');
	    }

	    $('#resourceadd').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			rules: {
				newname: { required: true, minlength: 3 },
				newposition: { required: true },
				newdivision: { required: true },
				newintroducer: { required: true }
			},
			messages: { },
			invalidHandler: function (event, validator) { ('.alert-danger', $('.resourceadd')).show(); },
			highlight: function (e) { $(e).closest('.form-group').removeClass('has-info').addClass('has-error'); },
			success: function (e) { $(e).closest('.form-group').removeClass('has-error').addClass('has-info'); $(e).remove(); },
			errorPlacement: function (error, element) 
			{
				if(element.is(':checkbox') || element.is(':radio'))
				{
					var controls = element.closest('div[class*="col-"]');
					if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
					else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
				}
				else if(element.is('.select2')) { error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)')); }
				else if(element.is('.chosen-select')) { error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)')); }
				else error.insertAfter(element.parent());
			}
		});

		$('#resourceadd').submit(function(e){
			if(!$('#resourceadd').valid()) return false;
			else
			{
				noty({
					layout: 'center', type: 'confirm', text: 'Do you want to add this record?',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000,
					buttons: [
					    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
					    	$noty.close();
					    	noty({
								layout: 'topRight', type: 'warning', text: 'Updating Record ...',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
								timeout: 4000
							});
					    	$.ajax({
						        url: '/BOEPortalNewFriends/postNewAttendee',
						        type: 'POST',
						        data: { name: $("#newname").val(), chinesename: $("#newchinesename").val(), district: $("#newdistrict").val(), position: $("#newposition").val(), division: $("#newdivision").val(), introducer: $("#newintroducer").val(), mobile: $("#newmobile").val()},
						        dataType: 'json',
						        statusCode: { 
						        	200:function(){
						        		var oDistrictTable = $('#tdistrict').DataTable();
					        			oDistrictTable.clearPipeline().draw();
						        		$("#newname").val(''); $("#newposition").val(''); $("#newdivision").val(''); $("#newchinesename").val(''); 
						        		$("#newmobile").val(''); $("#newdistrict").val('');
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
		    e.preventDefault();
	    });

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
					        url: 'BOEPortalNewFriends/deleteNewFriend/' + submit,
					        type: 'POST',
					        data: { uniquecode: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oTable = $('#tdistrict').DataTable();
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