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
			<li><a href="{{{ URL::action('CrisisManagementController@getIndex') }}}">Crisis Management</a></li>
			<li class="active">{{ $pagetitle }}</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>{{ $pagetitle }}<small><i class="ace-icon fa fa-angle-double-right"></i> Listing</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				@foreach ($result as $result)
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-orange">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Information - {{ $pagetitle }}
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
									{{ Form::open(array('action' => 'CrisisManagementDetailController@putResource', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('resourcedate', 'Date:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('resourcedate', date("d-M-Y",strtotime($result->resourcedate)), array('class' => 'date-picker col-xs-12 col-sm-9', 'data-date-format' => 'dd-M-yyyy'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('location', 'Location:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('location', $location_options, $result->location, array('class' => 'col-xs-12 col-sm-9', 'id' => 'location'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('shift', 'Shift:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('shift', $shift_options, $result->shift, array('class' => 'col-xs-12 col-sm-9', 'id' => 'shift'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('createbyname', 'Create By:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('createbyname', $result->createbyname, array('class' => 'col-xs-12 col-sm-9', 'id' => 'createbyname'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('nooffailed', 'No of Failed Cases:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('nooffailed', $result->nooffailed, array('class' => 'col-xs-12 col-sm-9', 'id' => 'nooffailed'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('noofdeclarationform', 'No of Declaration Forms Signed:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('noofdeclarationform', $result->noofdeclarationform, array('class' => 'col-xs-12 col-sm-9', 'id' => 'noofdeclarationform'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('createat', 'Created At:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('createat', $result->created_at, array('class' => 'col-xs-12 col-sm-9', 'id' => 'createat'));}}
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
										<div hidden>
											<div class="form-group">
												{{ Form::label('resourceuniquecode', 'Uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														{{ Form::text('resourceuniquecode', $result->uniquecode, array('class' => 'col-xs-12 col-sm-9', 'id' => 'resourceuniquecode'));}}
													</div>
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Crisis Information -->
					<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Equipment Stock Take
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
									{{ Form::open(array('action' => 'CrisisManagementDetailController@putResource', 'id' => 'resourceequipmentupdate', 'class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('equipthermometerwork', 'Thermometer (Works):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('equipthermometerwork', $result->equipthermometerwork, array('class' => 'col-xs-12 col-sm-9', 'id' => 'equipthermometerwork'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('equipthermometerspoilt', 'Thermometer (Spoilt):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('equipthermometerspoilt', $result->equipthermometerspoilt, array('class' => 'col-xs-12 col-sm-9', 'id' => 'equipthermometerspoilt'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('equipthermometerbatteries', 'Thermometer Batteries:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('equipthermometerbatteries', $result->equipthermometerbatteries, array('class' => 'col-xs-12 col-sm-9', 'id' => 'equipthermometerbatteries'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('equipmentsurgicalmask', 'Surgical Mask:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('equipmentsurgicalmask', $result->equipmentsurgicalmask, array('class' => 'col-xs-12 col-sm-9', 'id' => 'equipmentsurgicalmask'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('equipmentnninetyfive', 'N95 Mask:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('equipmentnninetyfive', $result->equipmentnninetyfive, array('class' => 'col-xs-12 col-sm-9', 'id' => 'equipmentnninetyfive'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('equipmentgloves', 'Gloves:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('equipmentgloves', $result->equipmentgloves, array('class' => 'col-xs-12 col-sm-9', 'id' => 'equipmentgloves'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('equipmenthandsanitizer', 'Hand Sanitizer:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('equipmenthandsanitizer', $result->equipmenthandsanitizer, array('class' => 'col-xs-12 col-sm-9', 'id' => 'equipmenthandsanitizer'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('equipmentantibacterialwipes', 'Bacterial Wipes / Alcohol Swap:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('equipmentantibacterialwipes', $result->equipmentantibacterialwipes, array('class' => 'col-xs-12 col-sm-9', 'id' => 'equipmentantibacterialwipes'));}}
												</div>
											</div>
										</div>
										<div class="space-2"></div>
										<div class="form-group">
											{{ Form::label('equipmentdeclarationforms', 'Declaration Forms (Empty):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('equipmentdeclarationforms', $result->equipmentdeclarationforms, array('class' => 'col-xs-12 col-sm-9', 'id' => 'equipmentdeclarationforms'));}}
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
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div> <!-- Stock Take Information -->
				@endforeach <!-- Crisis Management -->
				<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
					<div class="widget-box widget-color-red">
						<div class="widget-header widget-header-small">
							<h6 class="widget-title">
								<i class="icon-sort"></i>
								Search Member By Name
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
								<div class="form-group">
									{{ Form::label('namesearch', 'Search:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											{{ Form::text('namesearch', '', array('class' => 'ui-autocomplete-input col-xs-12 col-sm-9 ', 'id' => 'namesearch', 'autocomplete' => 'off'));}}
										</div>
									</div>
								</div>
								<br />
								<div class="space-6"></div>
								<div class="clearfix form-actions">
									<div class="col-md-offset-1 col-md-11">
										{{ Form::button('<i class="fa fa-user fa fa-on-right"></i> Duty Personnel', array('type' => 'Search', 'class' => 'btn btn-success btn-lg', 'id' => 'btnadddutypersonnel' )); }}
										{{ Form::button('<i class="fa fa-search fa fa-on-right"></i> Member', array('type' => 'Search', 'class' => 'btn btn-info ` btn-lg', 'id' => 'btnaddmember' )); }}
										{{ Form::button('<i class="fa fa-plus fa fa-on-right"></i> Visitor', array('type' => 'Search', 'class' => 'btn btn-danger ` btn-lg', 'id' => 'btnaddvisitor' )); }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Members Search -->
				<div class="col-xs-12 col-sm-6 widget-container-span ui-sortable">
					<div class="widget-box widget-color-red">
						<div class="widget-header widget-header-small">
							<h6 class="widget-title">
								<i class="icon-sort"></i>
								New Occurrence
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
								<div class="form-group">
									{{ Form::label('occurrence', 'Occurrence:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											{{ Form::textarea('occurrence', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'occurrence', 'rows'=>'3'));}}
										</div>
									</div>
								</div>
								<br /><br /><br />
								<div class="space-6"></div>
								<div class="clearfix form-actions">
									<div class="col-md-offset-5 col-md-11">
										{{ Form::button('<i class="fa fa-check fa fa-on-right"></i> Save', array('type' => 'Search', 'class' => 'btn btn-info ` btn-lg', 'id' => 'btnaddoccurrence' )); }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Add Occurrence -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Crisis Management Detail Listing</h5>
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
											<th>Created</th>
											<th>Role</th>
											<th>Name</th>
											<th>RHQ</th>
											<th>Zone</th>
											<th>Chap</th>
											<th>Dist</th>
											<th>Div</th>
											<th>Pos</th>
											<th>Position Level</th>
											<th>1st Temp Read</th>
											<th>2nd Temp Read</th>
											<th>3rd Temp Read</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
							</div>
						</div>
					</div>
				</div> <!-- Detail Listing -->
				<div class="col-sm-12 widget-container-span ui-sortable">
					<div class="widget-box widget-color-blue">
						<div class="widget-header">
							<h5 class="widget-title">Occurrence Listing</h5>
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
								<table id="toccurrence" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Created</th>
											<th>Name</th>
											<th>Occurrence</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
							</div>
						</div>
					</div>
				</div> <!-- Occurrence Listing -->
				<div id="btnresourcedetailadd" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'CrisisManagementDetailController@postResourceDetailVisitor', 'id' => 'resourceaddvisitor', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Add Visitor Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div class="form-group">
												{{ Form::label('nfname', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('nfname', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfname'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('nfposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('nfposition', $memposition_options, 'NF', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfposition'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('nfdivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('nfdivision', $division_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfdivision'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cbrhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('cbrhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbrhq'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cbzone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix" id="zonediv">
														{{ Form::select('cbzone', $zone_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbzone'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cbchapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix" id="chapterdiv">
														{{ Form::select('cbchapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbchapter'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('nfdistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('nfdistrict', array('-' => '-', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'), '-', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfdistrict'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('nfcontactno', 'Contact No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('nfcontactno', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfcontactno'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('nffirsttemperaturereading', '1st Temperature Reading:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('nffirsttemperaturereading', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nffirsttemperaturereading'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('nfsecondtemperaturereading', '2nd Temperature Reading:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('nfsecondtemperaturereading', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfsecondtemperaturereading'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('nfthirdtemperaturereading', '3rd Temperature Reading:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('nfthirdtemperaturereading', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfthirdtemperaturereading'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('nfremarks', 'Remarks:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::textarea('nfremarks', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'nfremarks', 'rows'=>'3'));}}
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
										{{ Form::button('<i class="icon-ok"></i> <strong>Add</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourcevisitoradd')); }}
									</div>
								</fieldset>
							{{ Form::close() }}
						</div>
					</div>
				</div> <!-- Add Visitor -->
				<div id="btnresourcedetailedit" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'CrisisManagementDetailController@putResourceDetailVisitor', 'id' => 'resourceeditvisitor', 'class' => 'form-horizontal')) }}
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
												{{ Form::label('eposition', 'Position:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('eposition', $memposition_options, 'e', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eposition'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('edivision', 'Division:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('edivision', $division_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'edivision'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cberhq', 'RHQ:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('cberhq', $rhq_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cberhq'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cbezone', 'Zone:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix" id="zonedivedit">
														{{ Form::select('cbezone', $zone_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbezone'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('cbechapter', 'Chapter:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix" id="chapterdivedit">
														{{ Form::select('cbechapter', $chapter_options, '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'cbechapter'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('edistrict', 'District:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::select('edistrict', array('-' => '-', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'), '-', array('class' => 'col-xs-12 col-sm-11', 'id' => 'edistrict'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('econtactno', 'Contact No:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('econtactno', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'econtactno'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('efirsttemperaturereading', '1st Temperature Reading:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('efirsttemperaturereading', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'efirsttemperaturereading'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('esecondtemperaturereading', '2nd Temperature Reading:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('esecondtemperaturereading', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'esecondtemperaturereading'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('ethirdtemperaturereading', '3rd Temperature Reading:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('ethirdtemperaturereading', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ethirdtemperaturereading'));}}
													</div>
												</div>
											</div>
											<div class="form-group" hidden>
												{{ Form::label('euniquecode', 'Detail Uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('euniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'euniquecode'));}}
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
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn btn-sm" data-dismiss="modal" id="btnclose">
											<i class="fa fa-remove"></i>
											Cancel
										</button>
										{{ Form::button('<i class="fa fa-check"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourcevisitoredit')); }}
									</div>
								</fieldset>
							{{ Form::close() }}
						</div>
					</div>
				</div> <!-- Edit Detail -->
				<div id="btnoccurrenceedit" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							{{ Form::open(array('action' => 'CrisisManagementDetailController@putOccurrence', 'id' => 'editoccurrence', 'class' => 'form-horizontal')) }}
								<fieldset>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="blue bigger">Edit Record</h4>
									</div>
									<div class="modal-body overflow-visible">
										<div class="row">
											<div class="form-group" hidden>
												{{ Form::label('eouniquecode', 'Detail Uniquecode:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::text('eouniquecode', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eouniquecode'));}}
													</div>
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('eoccurrence', 'Occurrence:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
												<div class="col-xs-12 col-sm-8">
													<div class="clearfix">
														{{ Form::textarea('eoccurrence', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'eoccurrence', 'rows'=>'3'));}}
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
										{{ Form::button('<i class="fa fa-check"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'resourcevisitoredit')); }}
									</div>
								</fieldset>
							{{ Form::close() }}
						</div>
					</div>
				</div> <!-- Edit Detail -->
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery-ui.min.js') }}}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(function() {
				$('#cbrhq').change(function(){
	        		$.ajax({
	        			url: 'getZone/' + $('#cbrhq').val(),
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
	        			url: 'getChapter/' + $('#cbzone').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#chapterdiv').html(data);
	        				}
	        			}
	        		});
				});

				$('#cberhq').change(function(){
	        		$.ajax({
	        			url: 'getZoneEdit/' + $('#cberhq').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#zonedivedit').html(data);
	        					$('#cbechapter').val('');
	        				}
	        			}
	        		});
	        	});

			    $("body").delegate('#cbezone','change',function(){
	        		$.ajax({
	        			url: 'getChapterEdit/' + $('#cbezone').val(),
	        			type: 'get',
	        			dataType: 'html',
	        			statusCode: { 
	        				200:function(data){
	        					$('#chapterdivedit').html(data);
	        				}
	        			}
	        		});
				});

				$('#resourceaddvisitor').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						nfname: { required: true, minlength: 3 },
						nfposition: { required: true },
						nfdivision: { required: true }
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

				$('#resourceeditvisitor').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						ename: { required: true, minlength: 3 },
						eposition: { required: true },
						edivision: { required: true }
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
			        ajax: 'getListing/{{ $rid }}',
			        columnDefs: [
						{ responsivePriority: 1, targets: 0 },
						{ responsivePriority: 2, targets: 1 },
						{ responsivePriority: 3, targets: 2 },
						{ responsivePriority: 4, targets: 5 },
						{ responsivePriority: 5, targets: 6 },
						{
							targets: [ 0 ], data: "created_at", width: "150px", searchable: true,
							render: function ( data, type, full ){
								return moment(data).format("YYYY-MM-DD HH:mm:ss");
							}
						},
						{ targets: [ 1 ], data: "role", searchable: true },
						{ targets: [ 2 ], data: "name", searchable: true },
						{ targets: [ 3 ], data: "rhq", searchable: true},
						{ targets: [ 4 ], data: "zone", searchable: true},
						{ targets: [ 5 ], data: "chapter", searchable: true},
						{ targets: [ 6 ], data: "district", searchable: true},
						{ targets: [ 7 ], data: "division", searchable: true},
						{ targets: [ 8 ], data: "position", searchable: true},
						{ targets: [ 9 ], data: "positionlevel", searchable: true, visible: false},
						{ targets: [ 10 ], data: "firsttemperaturereading", searchable: true},
						{ targets: [ 11 ], data: "secondtemperaturereading", searchable: true},
						{ targets: [ 12 ], data: "thirdtemperaturereading", searchable: true, visible: false},
						{ targets: [ 13 ], data: "status", searchable: true, visible: false},
						{
							targets: [ 14 ], data: "uniquecode",
							render: function ( data, type, full ){
								return '<a href="#resourceedit" role="button" onClick=editrow("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
							}
						}
					]
			    });

				var oOccurrenceTable = $('#toccurrence').DataTable({
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
			        ajax: 'getOccurrenceListing/{{ $rid }}',
			        columnDefs: [
						{
							targets: [ 0 ], data: "created_at", width: "150px", searchable: true,
							render: function ( data, type, full ){
								return moment(data).format("YYYY-MM-DD HH:mm:ss");
							}
						},
						{ targets: [ 1 ], data: "createdby", searchable: true },
						{ targets: [ 2 ], data: "occurrence", searchable: true},
						{
							targets: [ 3 ], data: "uniquecode",
							render: function ( data, type, full ){
								return '<a href="#resourceedit" role="button" onClick=editrowoccurrence("'+ data +'") class="btn btn-xs btn-info" data-toggle="modal"><i class="fa fa-edit bigger-120"></i></a> <button type="submit" onClick=deleterowoccurrence("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
							}
						}
					]
			    });
			});

			$('#resourceaddvisitor').submit(function(e){
				if(!$('#resourceaddvisitor').valid()) return false;
				else
				{
					noty({
						layout: 'topRight', type: 'warning', text: 'Adding Record ...',
						animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
						timeout: 2000
					});
					$.ajax({
						url: 'postResourceDetailVisitor/{{ $rid }}',
						type: 'POST',
						data: { name: $("#nfname").val(), rhq: $("#cbrhq").val(), zone: $("#cbzone").val(), chapter: $("#cbchapter").val(), district: $("#nfdistrict").val(), division: $("#nfdivision").val(), position: $("#nfposition").val(), contactno: $("#nfcontactno").val(), firsttemperaturereading: $("#nffirsttemperaturereading").val(), secondtemperaturereading: $("#nfsecondtemperaturereading").val(), thirdtemperaturereading: $("#nfthirdtemperaturereading").val(), thirdtemperaturereading: $("#nfthirdtemperaturereading").val(), remark: $("#nfremarks").val()},
						dataType: 'json',
						statusCode: { 
							200:function(data){
								noty({
									layout: 'topRight', type: 'success', text: 'Record Added for ' + $("#nfname").val(),
									animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
										},
									timeout: 4000
								});

								var oTable = $('#tdefault').DataTable();
								oTable.ajax.reload(null, false);

								$("#btnresourcedetailadd").modal('hide');
								$("#nfname").val(''); $("#nfcontactno").val(''); $("#nffirsttemperaturereading").val(''); $("#nfsecondtemperaturereading").val(''); $("#nfthirdtemperaturereading").val(''); $("#nfremarks").val('');
								$("#cbrhq").val('-'); $("#cbzone").val(''); $("#cbchapter").val(''); $("#nfdistrict").val('-'); $("#nfdivision").val('-'); $("#nfposition").val('NF');
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
				}
				e.preventDefault();
			});

			$('#resourceeditvisitor').submit(function(e){
				if(!$('#resourceeditvisitor').valid()) return false;
				else
				{
					noty({
						layout: 'topRight', type: 'warning', text: 'Updating Record ...',
						animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
						timeout: 2000
					});
					$.ajax({
						url: 'putResourceDetailVisitor/{{ $rid }}',
						type: 'POST',
						data: { uniquecode: $("#euniquecode").val(), name: $("#ename").val(), rhq: $("#cberhq").val(), zone: $("#cbezone").val(), chapter: $("#cbechapter").val(), district: $("#edistrict").val(), division: $("#edivision").val(), position: $("#eposition").val(), contactno: $("#econtactno").val(), firsttemperaturereading: $("#efirsttemperaturereading").val(), secondtemperaturereading: $("#esecondtemperaturereading").val(), thirdtemperaturereading: $("#ethirdtemperaturereading").val(), thirdtemperaturereading: $("#ethirdtemperaturereading").val(), remark: $("#eremarks").val()},
						dataType: 'json',
						statusCode: { 
							200:function(data){
								noty({
									layout: 'topRight', type: 'success', text: 'Record Updated for ' + $("#ename").val(),
									animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
										},
									timeout: 4000
								});

								var oTable = $('#tdefault').DataTable();
								oTable.ajax.reload(null, false);

								$("#btnresourcedetailedit").modal('hide');
								$("#ename").val(''); $("#econtactno").val(''); $("#efirsttemperaturereading").val(''); $("#esecondtemperaturereading").val(''); $("#ethirdtemperaturereading").val(''); $("#eremarks").val('');
								$("#cberhq").val('-'); $("#cbezone").val(''); $("#cbechapter").val(''); $("#edistrict").val('-'); $("#edivision").val('-'); $("#eposition").val('NF');
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
				}
				e.preventDefault();
			});

			$('#editoccurrence').submit(function(e){
				noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 2000
				});
				$.ajax({
					url: 'putOccurrence/{{ $rid }}',
					type: 'POST',
					data: { uniquecode: $("#eouniquecode").val(), occurrence: $("#eoccurrence").val()},
					dataType: 'json',
					statusCode: { 
						200:function(data){
							noty({
								layout: 'topRight', type: 'success', text: 'Record Updated for ' + $("#ename").val(),
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
									},
								timeout: 4000
							});

							var oOccurrenceTable = $('#toccurrence').DataTable();
		    				oOccurrenceTable.ajax.reload(null, false);

							$("#btnoccurrenceedit").modal('hide');
							$("#eoccurrence").val('');
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
		});

		$('#resourceupdate').submit(function(e){
			noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putResource/' + $("#resourceuniquecode").val(),
		        type: 'POST',
		        data: { resourcedate: $("#resourcedate").val(), location: $("#location").val(), shift: $("#shift").val(), nooffailed: $("#nooffailed").val(), noofdeclarationform: $("#noofdeclarationform").val(), equipthermometerwork: $("#equipthermometerwork").val(), equipthermometerspoilt: $("#equipthermometerspoilt").val(), equipthermometerbatteries: $("#equipthermometerbatteries").val(), equipmentsurgicalmask: $("#equipmentsurgicalmask").val(), equipmentnninetyfive: $("#equipmentnninetyfive").val(), equipmentgloves: $("#equipmentgloves").val(), equipmenthandsanitizer: $("#equipmenthandsanitizer").val(), equipmentantibacterialwipes: $("#equipmentantibacterialwipes").val(), equipmentdeclarationforms: $("#equipmentdeclarationforms").val() },
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
		    e.preventDefault();
	    });

		$('#resourceequipmentupdate').submit(function(e){
			noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putResource/' + $("#resourceuniquecode").val(),
		        type: 'POST',
		        data: { resourcedate: $("#resourcedate").val(), location: $("#location").val(), shift: $("#shift").val(), nooffailed: $("#nooffailed").val(), noofdeclarationform: $("#noofdeclarationform").val(), equipthermometerwork: $("#equipthermometerwork").val(), equipthermometerspoilt: $("#equipthermometerspoilt").val(), equipthermometerbatteries: $("#equipthermometerbatteries").val(), equipmentsurgicalmask: $("#equipmentsurgicalmask").val(), equipmentnninetyfive: $("#equipmentnninetyfive").val(), equipmentgloves: $("#equipmentgloves").val(), equipmenthandsanitizer: $("#equipmenthandsanitizer").val(), equipmentantibacterialwipes: $("#equipmentantibacterialwipes").val(), equipmentdeclarationforms: $("#equipmentdeclarationforms").val() },
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
		    e.preventDefault();
	    });

		$('#btnadddutypersonnel').click(function(){
			noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 2000
			});
			$.ajax({
		        url: 'postResourceDetail/{{ $rid }}/' + "duty",
		        type: 'POST',
		        data: { namesearch: $("#namesearch").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Added for ' + $("#namesearch").val(),
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});

						var oTable = $('#tdefault').DataTable();
		    			oTable.ajax.reload(null, false);

						$("#namesearch").val('');
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
		});

		$('#btnaddvisitor').click(function(){
			$("#btnresourcedetailadd").modal('show');
		});

		$('#btnaddmember').click(function(){
			noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 2000
			});
			$.ajax({
		        url: 'postResourceDetail/{{ $rid }}/' + "mem",
		        type: 'POST',
		        data: { namesearch: $("#namesearch").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Added for ' + $("#namesearch").val(),
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});

						var oTable = $('#tdefault').DataTable();
		    			oTable.ajax.reload(null, false);

						$("#namesearch").val('');
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
		});

		$('#btnaddoccurrence').click(function(){
			noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 2000
			});
			$.ajax({
		        url: 'postOccurrence/{{ $rid }}',
		        type: 'POST',
		        data: { occurrence: $("#occurrence").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(data){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Added! ',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});

						var oOccurrenceTable = $('#toccurrence').DataTable();
		    			oOccurrenceTable.ajax.reload(null, false);

						$("#occurrence").val('');
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
		});

		function editrow(submit){ 
	    	var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index();
                RowID = oTable.row(position).data();
				$("#ename").val(RowID.name);
				$("#eposition").val(RowID.position);
				$("#edivision").val(RowID.division);
				$("#cberhq").val(RowID.rhq);
				$("#cbezone").val(RowID.zone);
				$("#cbechapter").val(RowID.chapter);
				$("#edistrict").val(RowID.district);
				$("#efirsttemperaturereading").val(RowID.firsttemperaturereading);
				$("#esecondtemperaturereading").val(RowID.secondtemperaturereading);
				$("#ethirdtemperaturereading").val(RowID.thirdtemperaturereading);
				$("#euniquecode").val(submit);

				$.ajax({
			        url: 'getModuleDetail/' + submit,
			        type: 'POST',
			        data: { id: submit },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(data){
							$("#eremarks").val(data.remark);
			        		$("#econtactno").val(data.contactno);
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

				$("#btnresourcedetailedit").modal('show');
            });
		}

		function editrowoccurrence(submit){ 
	    	var RowID = "";
	        var oOccurrenceTable = $('#toccurrence').DataTable();
	        $("#toccurrence tbody tr").click(function () {
                var position = oOccurrenceTable.row(this).index();
                RowID = oOccurrenceTable.row(position).data();
				$("#eoccurrence").val(RowID.occurrence);
				$("#eouniquecode").val(submit);

				$("#btnoccurrenceedit").modal('show');
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
					        url: 'deleteResourceDetail/' + submit,
					        type: 'POST',
					        data: { uniquecode: submit },
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

		function deleterowoccurrence(submit){ 
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
					        url: 'deleteOccurrence/' + submit,
					        type: 'POST',
					        data: { uniquecode: submit },
					        dataType: 'json',
					        statusCode: { 
					        	200:function(){
					        		var oOccurrenceTable = $('#toccurrence').DataTable();
		    						oOccurrenceTable.ajax.reload(null, false);
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

		$('#namesearch').autocomplete({
			source: "../getNameSearch",
			minLength: 3,
			autoFocus: true
		});
	</script>
@stop