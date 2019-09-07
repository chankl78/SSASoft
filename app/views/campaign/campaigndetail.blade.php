@extends('layout.master')
@section('jsheader')
	<link href="{{{ asset('assets/css/datepicker.css') }}}" rel="stylesheet">
@stop
@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i><a href="{{{ URL::action('DashboardController@getIndex') }}}">Home</a>
			</li>
			<li><a href="{{{ URL::action('CampaignController@getIndex') }}}">Campaign</a></li>
			<li class="active">{{ $pagetitle }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Campaign<small><i class="ace-icon fa fa-angle-double-right"></i> {{ $pagetitle }}</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="tabbable tabs-right">
					<ul class="nav nav-tabs" id="ModuleTab">
						<li class="active">
							<a data-toggle="tab" href="#home">
								<i class="blue fa fa-dashboard bigger-110"></i>
								Info
							</a>
						</li> <!-- Info -->
						<li>
							<a data-toggle="tab" href="#events">
								<i class="purple fa fa-calendar bigger-110"></i>
								Events
							</a>
						</li> <!-- Events -->
						@if ($RECP05R == 't') 
							<li>
								<a data-toggle="tab" href="#reports">
									<i class="green fa fa-user bigger-110"></i>
									Reports
								</a>
							</li>
						@endif <!-- Reports -->
					</ul>
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							@foreach ($result as $result)
								<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
									<div class="widget-box collapsed">
										<div class="widget-header widget-header-small">
											<h6 class="widget-title">
												<i class="icon-sort"></i>
												Campaign Information - {{ $result->description }}
											</h6>
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
										</div>
										<div class="widget-body">
											<div class="widget-main no-padding">
												{{ Form::open(array('action' => 'CampaignController@putResource', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
													<br />
													<div class="form-group">
														{{ Form::label('resourcedate', 'Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('resourcedate', date("m-d-Y",strtotime($result->resourcedate)), array('class' => 'date-picker col-xs-12 col-sm-9', 'data-date-format' => 'dd-mm-yyyy'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('description', 'Description:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::textarea('description' , $result->description, array('class' => 'col-xs-12 col-sm-9', 'rows' => '3'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('campaigntype', 'Campaign Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('campaigntype', $campaigntype_options, $result->campaigntype, array('class' => 'col-xs-12 col-sm-9', 'id' => 'campaigntype'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('divisiontype', 'Division Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('divisiontype', $divisiontype_options, $result->divisiontype, array('class' => 'col-xs-12 col-sm-9', 'id' => 'divisiontype'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('leveltype', 'Level Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('leveltype', $leveltype_options, $result->leveltype, array('class' => 'col-xs-12 col-sm-9', 'id' => 'leveltype'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('status', 'Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::select('status', $status_options, $result->status, array('class' => 'col-xs-12 col-sm-9', 'id' => 'status'));}}
															</div>
														</div>
													</div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowmemregistration', 'Allow Member Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowmemregistration', 'false', $result->memregistration, array('id' => 'allowmemregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowshqregistration', 'Allow SHQ Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowshqregistration', 'false', $result->shqregistration, array('id' => 'allowshqregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowregionregistration', 'Allow Region Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowregionregistration', 'false', $result->regionregistration, array('id' => 'allowregionregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowzoneregistration', 'Allow Zone Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowzoneregistration', 'false', $result->zoneregistration, array('id' => 'allowzoneregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowchapterregistration', 'Allow Chapter Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowchapterregistration', 'false', $result->chapterregistration, array('id' => 'allowchapterregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('allowdistrictregistration', 'Allow District Registration', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('allowdistrictregistration', 'false', $result->districtregistration, array('id' => 'allowdistrictregistration'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group" @if ($REEVGKA == 'f') hidden @endif>
														{{ Form::label('readonly', 'Read Only', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::checkbox('readonly', 'false', $result->readonly, array('id' => 'readonly'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('createby', 'Created By:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('createby', $result->createby, array('class' => 'col-xs-12 col-sm-9'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														{{ Form::label('createat', 'Created At:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('createat', $result->created_at, array('class' => 'col-xs-12 col-sm-9'));}}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														<div class="col-md-offset-5 col-xs-12 col-sm-12">
															<div class="clearfix">
																{{ Form::button('<i class="fa fa-check fa fa-on-right"></i> Save', array('type' => 'Search', 'class' => 'btn btn-info btn-lg' )); }}
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div hidden>
														<div class="form-group">
															{{ Form::label('uniquecode', 'Uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	{{ Form::text('uniquecode', $result->uniquecode, array('class' => 'col-xs-12 col-sm-9', 'id' => 'uniquecode'));}}
																</div>
															</div>
														</div>
													</div>
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div>
							@endforeach <!-- Campaign Information -->
							<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-green">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											Register By Level Type By Division
										</h6>
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
									</div>
									<div class="widget-body">
										<div class="widget-main no-padding">
											{{ Form::open(array('action' => 'CampaignDetailController@postLevelDistrict', 'id' => 'resourceinsertleveldivision', 'class' => 'form-horizontal')) }}
												<br />
												<div class="form-group">
													{{ Form::label('insert', 'Select Criteria:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('cdivisiontype', $divisiontype_options, '', array('class' => 'col-xs-12 col-sm-4', 'id' => 'cdivisiontype'));}}
															{{ Form::select('cleveltype', $leveltype_options, '', array('class' => 'col-xs-12 col-sm-4', 'id' => 'cleveltype'));}}
														</div>
													</div>
												</div>
												<div class="space-2"></div>
												<div class="form-group">
													<div class="col-md-offset-5 col-xs-12 col-sm-12">
														<div class="clearfix">
															{{ Form::button('<i class="fa fa-search fa fa-on-right"></i> Insert', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
														</div>
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Register Level Type -->
							<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
								<div class="widget-box collapsed widget-color-green">
									<div class="widget-header widget-header-small">
										<h6 class="widget-title">
											<i class="icon-sort"></i>
											Register Member By Name and NRIC
										</h6>
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
									</div>
									<div class="widget-body">
										<div class="widget-main no-padding">
											{{ Form::open(array('action' => 'CampaignDetailController@postNricSearch', 'id' => 'resourcenamesearch', 'class' => 'form-horizontal')) }}
												<br />
												<div class="form-group">
													{{ Form::label('namesearch', 'Search (Name / NRIC):', array('class' => 'control-label col-xs-12 col-sm-4 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('namesearch', '', array('class' => 'ui-autocomplete-input col-xs-12 col-sm-9 ', 'id' => 'namesearch', 'autocomplete' => 'off'));}}
														</div>
													</div>
												</div>
												<div class="space-2"></div>
												<div class="form-group">
													<div class="col-md-offset-5 col-xs-12 col-sm-12">
														<div class="clearfix">
															{{ Form::button('<i class="fa fa-search fa fa-on-right"></i> Search', array('type' => 'Search', 'class' => 'btn btn-warning btn-lg' )); }}
														</div>
													</div>
												</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div> <!-- Register Member By NRIC and Name -->
							<div class="col-sm-12 widget-container-span ui-sortable">
								<div class="widget-box widget-color-blue">
									<div class="widget-header">
										<h5 class="widget-title">Campaign Detail Information</h5>
										<div class="widget-toolbar">
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<table id="tdefault" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="hidden-480">Date</th>
														<th class="hidden-480">RHQ</th>
														<th class="hidden-480">Zone</th>
														<th class="hidden-480">Chapter</th>
														<th class="hidden-480">District</th>
														<th class="hidden-480">Value</th>
														<th class="hidden-480">Name</th>
														<th class="hidden-480">Division</th>
														<th class="hidden-480">Position</th>
														<th class="hidden-480">Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
										<div class="widget-toolbox padding-8 clearfix">
											<div class="col-md-offset-10 col-xs-12 col-sm-1">
												@if ($REEVGKA == 't' or $RECP01R == 't')
													{{ Form::open(array('action' => 'CampaignDetailController@deleteAll', 'id' => 'fDeleteAll', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-trash-o"></i> Delete All', array('type' => 'submit', 'class' => 'btn btn-xs bigger-120 btn-danger bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												@endif
											</div>
											<div class="col-xs-12 col-sm-1">
												@if ($REEVGKA == 't' or $RECP04A == 't')
													<a href="#btnmoduledetailadd" role="button" class="btn btn-xs btn-yellow bigger-120 pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add </a>
												@endif
											</div>
										</div>
									</div>
								</div>
							</div> <!-- Campaign Detail - Datatable-->
							<div id="btnmoduledetailadd" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'CampaignDetailController@postModuleDetail', 'id' => 'resourcedetailadd', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Add Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div class="form-group">
															{{ Form::label('aname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('name', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'aname'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('aposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('aposition', $memposition_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'aposition'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('adivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('adivision', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD', 'YC' => 'YC'), 'MD', array('class' => 'col-xs-12 col-sm-11', 'id' => 'adivision'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('cbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('rhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbrhq'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('cbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix" id="zonediv">
																	{{ Form::select('zone', $zone_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbzone'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('cbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix" id="chapterdiv">
																	{{ Form::select('chapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbchapter'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('adistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('adistrict', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'adistrict'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('avalue', 'Value:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('evalue', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'avalue'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('aremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::textarea('aremarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'aremarks', 'rows'=>'3'));}}
																</div>
															</div>
														</div>
														<div class="form-group" hidden>
															{{ Form::label('aresourcedetailuc', 'Uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('aresourcedetailuc', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'aresourcedetailuc'));}}
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
													{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourcedetailadd')); }}
												</div>
											</fieldset>
										{{ Form::close() }}
									</div>
								</div>
							</div> <!-- Add Module Detail -->
							<div id="btnmoduledetailedit" class="modal" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										{{ Form::open(array('action' => 'CampaignDetailController@putModuleDetail', 'id' => 'resourcedetailedit', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="blue bigger">Edit Record</h4>
												</div>
												<div class="modal-body overflow-visible">
													<div class="row">
														<div class="form-group">
															{{ Form::label('ename', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('name', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ename'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('eposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('eposition', $memposition_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eposition'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('edivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('edivision', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD', 'YC' => 'YC'), $result->division, array('class' => 'col-xs-12 col-sm-11', 'id' => 'edivision'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('cberhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('rhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cberhq'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('cbezone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('zone', $zone_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbezone'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('cbechapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::select('chapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbechapter'));}}
																</div>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('edistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('edistrict', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'edistrict'));}}
																</div>
															</div>
														</div>
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
															{{ Form::label('resourcedetailuc', 'Uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
															<div class="col-xs-12 col-sm-8">
																<div class="clearfix">
																	{{ Form::text('resourcedetailuc', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'resourcedetailuc'));}}
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
													{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourcedetailedit')); }}
												</div>
											</fieldset>
										{{ Form::close() }}
									</div>
								</div>
							</div> <!-- Edit Module Detail -->
						</div>
						<div id="events" class="tab-pane">
							<table id="tevent" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="hidden-480">Date</th>
										<th class="hidden-480">Event Type</th>
										<th class="hidden-480">Description</th>
										<th class="hidden-480">Location</th>
										<th class="hidden-480">Status</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div id="reports" class="tab-pane">
							@if ($REEVGKA == 't')
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Group Members Listing With Contacts (Excel)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'GroupDetailController@postGroupMembersListingWithContactsPrint', 'id' => 'fGroupMembersListingWithContacts', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Group Members Listing With Contacts (Excel) -->
							@endif
							@if ($RECP05R == 't')
								<div class="col-sm-12 widget-container-span ui-sortable">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title">Group Members Listing with Sensitive Data (Excel)</h5>
											<div class="widget-toolbar">
												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="well well-lg">
													{{ Form::open(array('action' => 'GroupDetailController@postGroupMembersListingWithSensitiveDataPrint', 'id' => 'fGroupMembersListingWithSensitiveData', 'class' => 'form-horizontal')) }}
														<fieldset>
															{{ Form::button('<i class="fa fa-print"></i> Print', array('type' => 'Search', 'class' => 'btn btn-success bigger pull-right' )); }}
														</fieldset>
													{{ Form::close() }}
												</div>
											</div>
										</div>
									</div>
								</div> <!-- Group Members Listing with Sensitive Data (Excel) -->
							@endif
						</div>
					</div>
				</div>
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery-ui.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript">
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})

		$('#resourceinsertleveldivision').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Searching Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postLevelDistrict/' + $("#uniquecode").val(),
		        type: 'POST',
		        data: { uniquecode: $("#uniquecode").val(), divisiontype: $("#cdivisiontype").val(), leveltype: $("#cleveltype").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();

		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Inserted!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
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
		    e.preventDefault();
	    });

	    $('#fDeleteAll').submit(function(e) {
			noty({
				layout: 'center', type: 'confirm', text: 'Do you want to delete record?',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000,
				buttons: [
				    {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
				    	$noty.close();
				    	noty({
							layout: 'topRight', type: 'warning', text: 'Deleting All Record ...',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
							timeout: 4000
						});
				    	$.ajax({
					        url: 'deleteAll/' + $('#uniquecode').val(),
					        type: 'POST',
					        data: { id: $('#uniquecode').val() },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		reloaddt();
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
			e.preventDefault();
		});

		$('#resourcedetailadd').submit(function(e){
			e.preventDefault();
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postModuleDetail/' + $("#uniquecode").val(),
		        type: 'POST',
		        data: { uniquecode: $("#uniquecode").val(), name: $("#aname").val(), rhq: $("#cbrhq").val(), zone: $("#cbzone").val(), chapter: $("#cbchapter").val(), district: $("#adistrict").val(), position: $("#aposition").val(), division: $("#adivision").val(), value: $("#avalue").val(), remarks: $("#aremarks").val(), memuniquecode: $("#aresourcedetailuc").val() },
		        dataType: 'json',
		        statusCode: {
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();

		        		$("#aname").val(''); $("#cbrhq").val(''); $("#cbzone").val('');
		        		$("#cbchapter").val(''); $("#adistrict").val(''); $("#aposition").val(''); $("#adivision").val('');
		        		$("#avalue").val('');
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Added!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#btnmoduledetailadd").modal('hide');
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		$("#ename").focus();
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
	    });

		$('#resourcedetailedit').submit(function(e){
			e.preventDefault();
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putModuleDetail/' + $('#resourcedetailuc').val(),
		        type: 'POST',
		        data: { uniquecode: $('#resourcedetailuc').val(), name: $("#ename").val(), rhq: $("#cberhq").val(), zone: $("#cbezone").val(), chapter: $("#cbechapter").val(), district: $("#edistrict").val(), position: $("#eposition").val(), division: $("#edivision").val(), value: $("#evalue").val(), remarks: $("#eremarks").val() },
		        dataType: 'json',
		        statusCode: {
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();

		        		$("#resourcedetailuc").val(''); $("#ename").val(''); $("#cberhq").val(''); $("#cbezone").val('');
		        		$("#cbechapter").val(''); $("#edistrict").val(''); $("#eposition").val(''); $("#edivision").val('');
		        		$("#evalue").val('');
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#btnmoduledetailedit").modal('hide');
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		$("#ename").focus();
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
	    });

		$('#resourceupdate').submit(function(e){
			if ($("#allowmemregistration").is(':checked')) { $("#allowmemregistration").val('1'); } else {$("#allowmemregistration").val('0'); }
			if ($("#allowshqregistration").is(':checked')) { $("#allowshqregistration").val('1'); } else {$("#allowshqregistration").val('0'); }
			if ($("#allowregionregistration").is(':checked')) { $("#allowregionregistration").val('1'); } else {$("#allowregionregistration").val('0'); }
			if ($("#allowzoneregistration").is(':checked')) { $("#allowzoneregistration").val('1'); } else {$("#allowzoneregistration").val('0'); }
			if ($("#allowchapterregistration").is(':checked')) { $("#allowchapterregistration").val('1'); } else {$("#allowchapterregistration").val('0'); }
			if ($("#allowdistrictregistration").is(':checked')) { $("#allowdistrictregistration").val('1'); } else {$("#allowdistrictregistration").val('0'); }
			if ($("#readonly").is(':checked')) { $("#readonly").val('1'); } else {$("#readonly").val('0'); }
			
			e.preventDefault();
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putResource/' + $('#uniquecode').val(),
		        type: 'POST',
		        data: { uniquecode: $('#uniquecode').val(), resourcedate: $("#resourcedate").val(), description: $("#description").val(), status: $("#status").val(), campaigntype: $("#campaigntype").val(), divisiontype: $("#divisiontype").val(), leveltype: $("#leveltype").val(), allowshqregistration: $("#allowshqregistration").val(), allowmemregistration: $("#allowmemregistration").val(), allowregionregistration: $("#allowregionregistration").val(), allowzoneregistration: $("#allowzoneregistration").val(), allowchapterregistration: $("#allowchapterregistration").val(), allowdistrictregistration: $("#allowdistrictregistration").val(), readonly: $("#readonly").val() },
		        dataType: 'json',
		        statusCode: {
		        	200:function(){
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		$("#name").focus();
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
	    });

	    $('#resourcenamesearch').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Searching Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postNricSearch',
		        type: 'POST',
		        data: { nricsearch: $("#namesearch").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		var now = moment(data).format("DD-MM-YYYY");
		        		$("#aname").val(data.name);
		        		$("#nric").val(data.nric);
		        		$("#adivision").val(data.division);
		        		$("#aposition").val(data.position);
		        		$("#cbrhq").val(data.rhq);
		        		$("#cbzone").val(data.zone);
		        		$("#cbchapter").val(data.chapter);
		        		$("#adistrict").val(data.district);
		        		$("#aresourcedetailuc").val(data.uniquecode);
		        		$("#namesearch").val("");
		        		$("#btnmoduledetailadd").modal('show');
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Found!! ' + data.name,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
	        			else if (data.responseJSON.ErrType == "Does Not Exist")
		        			{ txtMessage = 'NRIC does not Exist!  Please check again'; }
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
		    e.preventDefault();
	    });

		$('#namesearch').autocomplete({
			source: "../getNameSearch",
			minLength: 3	
		});
	</script>
	<script type="text/javascript">
	    function reloaddt(submit){ 
	    	var oTable = $('#tdefault').DataTable();
		    oTable.clearPipeline().draw();
	    }

	    function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
                $.ajax({
			        url: 'getModuleDetail/' + submit,
			        type: 'POST',
			        data: { id: submit },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(data){
			        		$("#resourcedetailuc").val(data.uniquecode);
			        		$("#eremarks").val(data.remarks);
			        		$("#ename").val(data.name);
			        		$("#eposition").val(data.position);
			        		$("#edivision").val(data.division);
			        		$("#ename").val(data.name);
			        		$("#cberhq").val(data.rhq);
			        		$("#cbezone").val(data.zone);
			        		$("#cbechapter").val(data.chapter);
			        		$("#edistrict").val(data.district);
			        		$("#evalue").val(data.value);
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
			    $("#btnmoduledetailedit").modal('show');
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
					        data: { dposition: submit },
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
				$('#cbrhq').change(function(){
	        		$.ajax({
	        			url: '../Detail/getZone/' + $('#cbrhq').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#zonediv').html(data);
	        					$('#cbchapter').val('');
	        				}
	        			}
	        		});
	        	});

			    $("body").delegate('#cbzone','change',function(){
	        		$.ajax({
	        			url: '../Detail/getChapter/' + $('#cbzone').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#chapterdiv').html(data);
	        				}
	        			}
	        		});
	        	});

				var oTable = $('#tdefault').DataTable({
					displayLength: 10, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "full_numbers",
			        responsive: false,
			        processing: true,
			        stateSave: true, // Remember paging & filters
			        autoWidth: true,
			        scrollCollapse: true,
			        processing: false,
			        serverSide: true,
			        searching: true,
			        order: [[ 0, "desc" ]],
			        ajax: $.fn.dataTable.pipeline({
			            url: 'getListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        columnDefs: [
			        {
				    	"targets": [ 0 ], "data": "created_at", "width": "170px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
					    }
			    	},
			        { targets: [ 1 ], "data": "rhq", "searchable": "true" },
			        { targets: [ 2 ], "data": "zone", "searchable": "true" },
			        { targets: [ 3 ], "data": "chapter", "searchable": "true" },
			        { targets: [ 4 ], "data": "district", "searchable": "true" },
			        { targets: [ 5 ], "data": "value", "searchable": "true" },
			        { targets: [ 6 ], "data": "name", "searchable": "true" },
			        { targets: [ 7 ], "data": "division", "searchable": "true" },
			    	{ targets: [ 8 ], "data": "position", "searchable": "true" },
			    	{
				    	targets: [ 9 ], "data": "uniquecode",
				    	render: function ( data, type, full ){
				    		// return '<span class="label label-danger arrowed-in">'+data+'</span>';
				    		return '<a href="#resourceedit" role="button" onClick=editrow("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    }); // Campaign Detail Information

				var oEventTable = $('#tevent').DataTable({
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
			            url: 'getEventListing/' + "{{ $rid }}",
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "eventdate", "width": "150px", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "eventtype", "searchable": "true" },
			    	{ "targets": [ 2 ], "data": "description", "searchable": "true" },
			    	{ "targets": [ 3 ], "data": "location", "searchable": "true" },
			    	{ 
			    		"targets": [ 4 ], "data": "status", "searchable": "true",
			    		"render": function ( data, type, full ){
						    if (data === 'Void'){
						    	return '<span class="label label-danger arrowed-in">'+data+'</span>';
						    }
						  	else if (data === 'Active'){
						    	return '<span class="label label-success arrowed">'+data+'</span>';
						    }
						    else if (data === 'Closed'){
						    	return '<span class="label label-info">'+data+'</span>';
						    }
			    		}
			    	}]
			    }); // Event Detail
			});
		});
	</script>
@stop