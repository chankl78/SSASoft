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
			<li class="active"><a href="{{{ URL::action('LeadersPortalDiscussionMeetingListingController@getIndex') }}}">Discussing Meeting Listing</a></li>
			<li class="active">{{ $dmname }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Discussion Meeting<small><i class="ace-icon fa fa-angle-double-right"></i> {{ $dmname }}</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@if ($gakkaidistrict == 't' or $gakkaichapter == 't' or $gakkaizone == 't' or $gakkairegion == 't'or $gakkaishq == 't')
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">{{ $dmname }}</h5>
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
										<a href="#btnresourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add New Record</a>
										<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
										<a href="#btnhomevisitadd" role="button" class="btn btn-xs btn-success pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add Homevisit</a>
										<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
										<a href="#btnseniorldrsadd" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add SRZC Attendance</a>
									</div>
								</div>
								<div class="widget-main">
									<table id="tdistrict" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Name</th>
												<th>名字</th>
												<th>Chapter</th>
												<th>District</th>
												<th>Division</th>
												<th>Position</th>
												<th>Status</th>
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
										<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
										<a href="#btnhomevisitadd" role="button" class="btn btn-xs btn-success pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add Homevisit</a>
										<div class="widget-toolbox padding-8 clearfix pull-right"></div> <!-- For Blank Space -->
										<a href="#btnseniorldrsadd" role="button" class="btn btn-xs btn-info pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add SRZC Attendance</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">{{ $dmname }} - Statistic</h5>
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
										{{ Form::button('<i class="fa fa-refresh"></i> Refresh Statistic', array('type' => 'Submit', 'class' => 'btn btn-xs btn-danger pull-right', 'id' => 'resourcerefresh')); }}
									</div>
								</div>
								<div class="widget-main">
									<table id="tdistrictstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Div</th>
												<th>Ldrs</th>
												<th>Mems</th>
												<th>Bels</th>
												<th>NF</th>
												<th>SRZC</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot id="tdmstatsfoot">
											<tr>
								                <th>Total</th><th></th><th></th><th></th><th></th><th></th><th></th>
								            </tr>
										</tfoot>
									</table>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<div class="col-xs-12">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-green">
							<div class="widget-header">
								<h5 class="widget-title">{{ $dmname }} - Homevisit</h5>
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
										{{ Form::button('<i class="fa fa-refresh"></i> Refresh Statistic', array('type' => 'Submit', 'class' => 'btn btn-xs btn-danger pull-right', 'id' => 'resourcerefreshhv')); }}
									</div>
								</div>
								<div class="widget-main">
									<table id="tdistricthvstats" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>MD</th>
												<th>WD</th>
												<th>YMD</th>
												<th>YWD</th>
												<th>Total</th>
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
					<div id="btnresourceadd" class="modal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								{{ Form::open(array('action' => 'LeadersPortalDiscussionMeetingController@postNewAttendee', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
									<fieldset>
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="blue bigger">Add Record</h4>
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
													{{ Form::label('cbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::select('cbrhq', $rhq_options, $rhq, array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbrhq'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('cbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix" id="zonediv">
															{{ Form::select('cbzone', $zone_options, $zone, array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbzone'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('cbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix" id="chapterdiv">
															{{ Form::select('cbchapter', $chapter_options, $chapter, array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbchapter'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('district', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::select('district', array('-' => '-', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'), $district, array('class' => 'col-xs-12 col-sm-11', 'id' => 'district'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('position', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::select('position', $memposition_options, 'NF', array('class' => 'col-xs-12 col-sm-11', 'id' => 'position'));}}
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
													{{ Form::label('mobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('mobile', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'mobile'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('introducer', 'Introducer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('introducer', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'introducer'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('remarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::textarea('remarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'remarks', 'rows'=>'3'));}}
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
											{{ Form::button('<i class="icon-ok"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourceadd')); }}
										</div>
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
					<div id="btnresourceedit" class="modal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								{{ Form::open(array('action' => 'LeadersPortalDiscussionMeetingController@postEditAttendee', 'id' => 'resourceedit', 'class' => 'form-horizontal')) }}
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
															{{ Form::text('ename', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ename'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ecname', '名字:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('ecname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ecname'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ecbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::select('ecbrhq', $rhq_options, $rhq, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ecbrhq'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ecbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix" id="zonediv">
															{{ Form::select('ecbzone', $zone_options, $zone, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ecbzone'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ecbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix" id="chapterdiv">
															{{ Form::select('ecbchapter', $chapter_options, $chapter, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ecbchapter'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('edistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::select('ecbdistrict', array('-' => '-', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'), $district, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ecbdistrict'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('eposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::select('eposition', $position_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eposition'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('edivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::select('edivision', array('' => '', 'MD' => 'MD', 'WD' => 'WD', 'YM' => 'YMD', 'YW' => 'YWD', 'PD' => 'PD', 'YC' => 'YC'), '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'edivision'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('emobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('emobile', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'emobile'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('eintroducer', 'Introducer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-8">
														<div class="clearfix">
															{{ Form::text('eintroducer', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eintroducer'));}}
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
											{{ Form::button('<i class="fa fa-trash-o"></i> <strong>Delete</strong>', array('class' => 'btn btn-sm btn-danger', 'id' => 'resourcedelete')); }}
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
					@foreach ($result as $result)
						<div id="btnseniorldrsadd" class="modal" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									{{ Form::open(array('action' => 'LeadersPortalDiscussionMeetingController@postSRZCAttendance', 'id' => 'seniorldrsadd', 'class' => 'form-horizontal')) }}
										<fieldset>
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Add SRZC Attendance</h4>
											</div>
											<div class="modal-body overflow-visible">
												<div class="row">
													<div class="form-group">
														{{ Form::label('md', 'MD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('md', $result->srmd, array('class' => 'col-xs-12 col-sm-11', 'id' => 'md'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('wd', 'WD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('wd', $result->srwd, array('class' => 'col-xs-12 col-sm-11', 'id' => 'wd'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('ymd', 'YMD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('ymd', $result->srymd, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ymd'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('ywd', 'YWD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('ywd', $result->srywd, array('class' => 'col-xs-12 col-sm-11', 'id' => 'ywd'));}}
															</div>
														</div>
													</div>
													<div class="form-group" hidden>
														{{ Form::label('sruniquecode', 'UniqueCode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('sruniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'sruniquecode'));}}
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
						<div id="btnhomevisitadd" class="modal" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									{{ Form::open(array('action' => 'LeadersPortalDiscussionMeetingController@postHomevisit', 'id' => 'homevisitadd', 'class' => 'form-horizontal')) }}
										<fieldset>
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Add Homevisit</h4>
											</div>
											<div class="modal-body overflow-visible">
												<div class="row">
													<div class="form-group">
														{{ Form::label('hvmd', 'MD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('hvmd', $result->hvmd, array('class' => 'col-xs-12 col-sm-11', 'id' => 'hvmd'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('hvwd', 'WD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('hvwd', $result->hvwd, array('class' => 'col-xs-12 col-sm-11', 'id' => 'hvwd'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('hvymd', 'YMD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('hvymd', $result->hvymd, array('class' => 'col-xs-12 col-sm-11', 'id' => 'hvymd'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('hvywd', 'YWD:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-8">
															<div class="clearfix">
																{{ Form::text('hvywd', $result->hvywd, array('class' => 'col-xs-12 col-sm-11', 'id' => 'hvywd'));}}
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
					@endforeach
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
					dom: 'Bflrtip',
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
			        order: [[2, "asc"], [3, "asc"], [4, "asc"], [5, "asc"], [0, "asc"]],
			        ajax: 'getDiscussionMeetingAttendees/{{ $rid }}',
			        columnDefs: [
			        	{ responsivePriority: 1, targets: 0 },
			        	{ responsivePriority: 2, targets: -1 },
			        	{ responsivePriority: 3, targets: -2 },
            			{ responsivePriority: 4, targets: -3 },
            			{ responsivePriority: 5, targets: -4 },
		            	{ targets: [ 0 ], data: "name", searchable: true },
		            	{ targets: [ 1 ], data: "chinesename", searchable: true },
		            	{ targets: [ 2 ], data: "chapter", searchable: true },
		            	{ targets: [ 3 ], data: "district", searchable: true },
				    	{ targets: [ 4 ], data: "division", searchable: true },
				    	{ targets: [ 5 ], data: "position", searchable: true },
				    	{
					    	targets: [ 6 ], data: "attendancestatus",
					    	render: function ( data, type, full ){
							    if (data === "Absent"){
							    	return '';
							    }
							  	else if (data === "Attended"){
							    	return '<span class="label label-success arrowed">'+data+'</span>';
							    }
				    		}
			    		},
				    	{
					    	targets: [ 7 ], data: "uniquecode",
					    	render: function ( data, type, full ){
					    		return '<button type="submit" onClick=attendrow("'+ data +'") class="btn btn-xs btn-success"><i class="fa fa-thumbs-up bigger-120"></i></button> <button type="submit" onClick=absentrow("'+ data +'") class="btn btn-xs btn-warning"><i class="fa fa-thumbs-down bigger-120"></i></button> <button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button>'
						    }
				    	}
				    ]
			    });

				var oDistrictHVTable = $('#tdistricthvstats').DataTable({
			        displayLength: 10, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "first_last_numbers",
			        responsive: false,
			        stateSave: true, // Remember paging & filters
			        autoWidth: false,
			        info: false,
			        paging: true,
			        filter: false,
			        scrollCollapse: true,
			        processing: false,
			        serverSide: false,
			        searching: true,
			        deferRender: true,
			        order: [[0, "asc"]],
			        ajax: 'getDiscussionMeetingHomevisit/{{ $rid }}',
			        columnDefs: [
		            	{ targets: [ 0 ], data: "MD", searchable: true },
				    	{ targets: [ 1 ], data: "WD", searchable: true },
				    	{ targets: [ 2 ], data: "YMD", searchable: true },
				    	{ targets: [ 3 ], data: "YWD", searchable: true },
				    	{ targets: [ 4 ], data: "Total", searchable: true }
				    ]
			    });

				var oDistrictStats = $('#tdistrictstats').DataTable({
			        displayLength: 10, // Default No of Records per page on 1st load
			        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        pagingType: "first_last_numbers",
			        info: false,
			        paging: true,
			        autoWidth: false,
			        scrollCollapse: true,
			        processing: false,
			        filter: false,
			        deferRender: true,
			        serverSide: false,
			        ajax: 'getdistrictstatsListing/{{ $rid }}',
			        columnDefs: [
			        	{ targets: [ 0 ], data: "division" },
				    	{ targets: [ 1 ], data: "LDR" },
				    	{ targets: [ 2 ], data: "MEM"  },
				    	{ targets: [ 3 ], data: "BEL" },
				    	{ targets: [ 4 ], data: "NF" },
				    	{ targets: [ 5 ], data: "SRZC" },
				    	{ targets: [ 6 ], data: "Total" }],
	            	footerCallback: function (row, data, start, end, display) {
		                var api = this.api(), data

		                // Remove the formatting to get integer data for summation
			            var intVal = function ( i ) {
			                return typeof i === 'string' ?
			                    i.replace(/[\$,]/g, '')*1 :
			                    typeof i === 'number' ?
			                        i : 0;
			            };
		                columns = [1, 2, 3, 4, 5, 6]; // Add columns here

		       			for (var i = 0; i < columns.length; i++) {
		                    $('#tdmstatsfoot th').eq(columns[i]).html(api.column(columns[i], {filter: 'applied'}).data().sum());
		                }
		            }
			    }); // Discussion Meeting Attendance Statistic

			    $('#cbrhq').change(function(){
	        		$.ajax({
	        			url: '../BOEPortalEvent/getZone/' + $('#cbrhq').val(),
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
	        			url: '../BOEPortalEvent/getChapter/' + $('#cbzone').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#chapterdiv').html(data);
	        				}
	        			}
	        		});
	        	});
			});

			$('#resourceadd').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					name: { required: true, minlength: 3 },
					position: { required: true },
					division: { required: true },
					introducer: { required: true }
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
					$.ajax({
				        url: 'postNewAttendee/{{ $rid }}',
				        type: 'POST',
				        data: { name: $("#name").val(), cname: $("#cname").val(), mobile: $("#mobile").val(), position: $("#position").val(), division: $("#division").val(), id: "{{ $rid }}", introducer: $("#introducer").val(), remarks: $("#remarks").val(), rhq: $("#cbrhq").val(), zone: $("#cbzone").val(), chapter: $("#cbchapter").val(), district: $("#district").val()},
				        dataType: 'json',
				        statusCode: { 
				        	200:function(){
				        		var oDistrictTable = $('#tdistrict').DataTable();
			        			oDistrictTable.ajax.reload(null, false);

			        			var oDistrictStats = $('#tdistrictstats').DataTable();
			    				oDistrictStats.ajax.reload(null, false);

			    				$("#name").val(''); $("#position").val(''); $("#division").val(''); $("#cname").val(''); $("#mobile").val('');
			        			$("#introducer").val(''); $("#remarks").val('');

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
				        		else if (data.responseJSON.ErrType == "Over") 
	        						{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
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
			    e.preventDefault();
		    });

			$('#resourceedit').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					ename: { required: true, minlength: 3 },
					eposition: { required: true },
					edivision: { required: true }
				},
				messages: { },
				invalidHandler: function (event, validator) { ('.alert-danger', $('.resourceedit')).show(); },
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

			$('#resourceedit').submit(function(e){
				if(!$('#resourceedit').valid()) return false;
				else
				{
			    	$.ajax({
				        url: 'postEditAttendee/{{ $rid }}',
				        type: 'POST',
				        data: { name: $("#ename").val(), cname: $("#ecname").val(), mobile: $("#emobile").val(), division: $("#edivision").val(), position: $("#eposition").val(), id: "{{ $rid }}", introducer: $("#eintroducer").val(), remarks: $("#eremarks").val(), uniquecode: $("#euniquecode").val(), rhq: $("#ecbrhq").val(), zone: $("#ecbzone").val(), chapter: $("#ecbchapter").val(), district: $("#ecbdistrict").val()},
				        dataType: 'json',
				        statusCode: { 
				        	200:function(){
				        		var oDistrictTable = $('#tdistrict').DataTable();
			        			oDistrictTable.ajax.reload(null, false);

			        			var oDistrictStats = $('#tdistrictstats').DataTable();
			    				oDistrictStats.ajax.reload(null, false);

			    				$("#ename").val(''); $("#edivision").val(''); $("#ecname").val(''); $("#emobile").val('');
			        			$("#eintroducer").val(''); $("#eremarks").val('');
			        			$("#ecbrhq").val(''); $("#ecbzone").val(''); $("#ecbchapter").val('');
			        			$("#ecbdistrict").val('');

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
	        						{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
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
			    e.preventDefault();
		    });

			$('#seniorldrsadd').submit(function(e){
		    	$.ajax({
			        url: 'postSRZCAttendance/{{ $rid }}',
			        type: 'POST',
			        data: { md: $("#md").val(), wd: $("#wd").val(), ymd: $("#ymd").val(), ywd: $("#ywd").val(), uniquecode: "{{ $rid }}"},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oDistrictStats = $('#tdistrictstats').DataTable();
		    				oDistrictStats.ajax.reload(null, false);

			        		$("#btnseniorldrsadd").modal('hide');
	            			noty({
								layout: 'topRight', type: 'success', text: 'SRZC Attendance Updated!!',
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
	        					{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
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

			$('#homevisitadd').submit(function(e){
		    	$.ajax({
			        url: 'postHomevisit/{{ $rid }}',
			        type: 'POST',
			        data: { md: $("#hvmd").val(), wd: $("#hvwd").val(), ymd: $("#hvymd").val(), ywd: $("#hvywd").val(), uniquecode: "{{ $rid }}"},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oDistrictHVStats = $('#tdistricthvstats').DataTable();
		    				oDistrictHVStats.ajax.reload(null, false);
			        		$("#btnhomevisitadd").modal('hide');
	            			noty({
								layout: 'topRight', type: 'success', text: 'Homevisit Updated!!',
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
	        					{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
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

			$('#resourcedelete').click(function(e){
				noty({
					layout: 'center', type: 'confirm', text: 'Do you want to delete record? Once delete, this record will not be able to retrieve in this discussion meeting',
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
						        url: 'deleteAttendee/' + $("#euniquecode").val(),
						        type: 'POST',
						        data: { uniquecode: $("#euniquecode").val() },
						        dataType: 'json',
						        statusCode: { 
						        	200:function(){
						        		var oDistrictTable = $('#tdistrict').DataTable();
					        			oDistrictTable.ajax.reload(null, false);

					    				$("#ename").val(''); $("#edivision").val(''); $("#ecname").val(''); $("#emobile").val('');
					        			$("#eintroducer").val(''); $("#eremarks").val('');

						        		$("#btnresourceedit").modal('hide');

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
						        		else if (data.responseJSON.ErrType == "Over") 
		        							{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
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
			    e.preventDefault();
		    });

		    $('#resourcerefresh').click(function(e){
		    	$.ajax({
			        url: 'postdmstatistic/{{ $rid }}',
			        type: 'POST',
			        data: { uniquecode: "{{ $rid }}"},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oDistrictStats = $('#tdistrictstats').DataTable();
		    				oDistrictStats.ajax.reload(null, false);
			        		var oDistrictHVStats = $('#tdistricthvstats').DataTable();
		    				oDistrictHVStats.ajax.reload(null, false);
		    				noty({
								layout: 'topRight', type: 'success', text: 'Statistic Refresh!!',
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
	        					{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
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
		    });

		    $('#resourcerefreshhv').click(function(e){
		    	$.ajax({
			        url: 'postdmstatistic/{{ $rid }}',
			        type: 'POST',
			        data: { uniquecode: "{{ $rid }}"},
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oDistrictStats = $('#tdistrictstats').DataTable();
		    				oDistrictStats.ajax.reload(null, false);
			        		var oDistrictHVStats = $('#tdistricthvstats').DataTable();
		    				oDistrictHVStats.ajax.reload(null, false);
		    				noty({
								layout: 'topRight', type: 'success', text: 'Statistic Refresh!!',
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
	        					{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
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
		    });
		});

		function absentrow(submit){ 
			$.ajax({
		        url: 'putAbsentAttendee/' + submit,
		        type: 'POST',
		        data: { absent: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oDistrictTable = $('#tdistrict').DataTable();
		        		$('#tdistrict tbody').on( 'click', 'td', function () {
				    		var cell = oDistrictTable.cell(this, 6);
			    			cell.data('Absent').draw();
						});
		        		//oDistrictTable.ajax.reload(null, false);
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
	        			else if (data.responseJSON.ErrType == "Over") 
	        			{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
		        		else { txtMessage = 'Please check your entry!'; }
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

	    function attendrow(submit){
	    	$.ajax({
		        url: 'putAttendedAttendee/' + submit,
		        type: 'POST',
		        data: { attended: submit },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oDistrictTable = $('#tdistrict').DataTable();
				    	$('#tdistrict tbody').on( 'click', 'td', function () {
				    		var cell = oDistrictTable.cell(this, 6);
			    			cell.data('Attended').draw();
			    			//oDistrictTable.draw(false);
						});
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
	        			else if (data.responseJSON.ErrType == "Over") 
	        			{ txtMessage = 'Discussion Meeting had already over! If you want to add new friend or believer, please proceed to New Friend List or Believer List'; }
		        		else { txtMessage = 'Please check your entry!'; }
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

	    function reloaddt(submit){ 
	    	var oDistrictTable = $('#tdistrict').DataTable();
		    oDistrictTable.ajax.reload(null, false);
		    var oDistrictStats = $('#tdistrictstats').DataTable();
		    oDistrictStats.ajax.reload(null, false);
		    var oDistrictHVStats = $('#tdistricthvstats').DataTable();
		    oDistrictHVStats.ajax.reload(null, false);
	    }

	    function editrow(submit){
	    	$.ajax({
		        url: 'getAttendeeInfo/' + submit,
		        type: 'GET',
		        data: {},
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		$("#ename").val(data.name); $("#ecname").val(data.chinesename); 
		        		$("#edivision").val(data.division); $("#eremarks").val(data.remarks); 
		        		$("#eintroducer").val(data.introducer); $("#emobile").val(data.mobile); 
		        		$("#euniquecode").val(data.uniquecode); $("#eposition").val(data.position);
		        		$("#ecbrhq").val(data.rhq); $("#ecbzone").val(data.zone); 
		        		$("#ecbchapter").val(data.chapter); $("#ecbdistrict").val(data.district); 
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		if (data.responseJSON.ErrType == "NoAccess") 
	        			{ txtMessage = 'You do not have access to Update!'; }
		        		else { txtMessage = 'Please check your entry!'; }
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
	    	$("#btnresourceedit").modal('show');
	    }
	</script>
@stop