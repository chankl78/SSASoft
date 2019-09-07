@extends('layout.master')

@section('content')
	@foreach ($result as $result)
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
			</script>
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i><a href="{{{ URL::action('DashboardController@getIndex') }}}">Home</a>
				</li>
				<li><a href="{{{ URL::action('AccessRightsController@getIndex') }}}">Access Rights</a></li>
				<li class="active"><a href="#">{{ $result->name }}</a></li>
			</ul><!--.breadcrumb-->
		</div><!--#breadcrumbs-->
		<div class="page-content" id="page-content">
			<div class="page-header">
				<h1>Access Rights <small><i class="icon-double-angle-right"></i> Overview</small></h1>
			</div><!--/.page-header-->
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS HERE -->
					<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									User Information
								</h6>
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
								<div class="widget-main no-padding">
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('name', 'Name:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('name', $result->name, array('class' => 'col-xs-12 col-sm-9', 'id' => 'name'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('username', 'Username:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('username', $result->username, array('class' => 'col-xs-12 col-sm-9', 'id' => 'username', 'readonly'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('roleid', 'Role:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('roleid', $role_options, $result->roleid, array('class' => 'col-xs-12 col-sm-9', 'id' => 'roleid'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('status', 'Status:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::select('status', $status_options, $result->status, array('class' => 'col-xs-12 col-sm-9', 'id' => 'status'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Contact Information
								</h6>
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
								<div class="widget-main no-padding">
									{{ Form::open(array('class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('tel', 'Tel (H):', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('tel', $result->tel, array('class' => 'col-xs-12 col-sm-9', 'id' => 'tel'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('mobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('mobile', $result->mobile, array('class' => 'col-xs-12 col-sm-9', 'id' => 'mobile'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('email', 'Email:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('email', $result->email, array('class' => 'col-xs-12 col-sm-9', 'id' => 'email'));}}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
						<div class="widget-box widget-color-red">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="icon-sort"></i>
									Forced Reset Password
								</h6>
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
								<div class="widget-main no-padding">
									{{ Form::open(array('action' => 'AccessRightsController@putUserResetPassword', 'id' => 'fReset', 'class' => 'form-horizontal')) }}
										<br />
										<div class="form-group">
											{{ Form::label('password', 'Password:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													{{ Form::text('password', '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'password', 'placeholder' => 'Please enter a password'));}}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12 col-sm-12">
												<div align='center'>
													{{ Form::button('<i class="icon-exclamation icon-on-right"></i> Reset', array('type' => 'Search', 'class' => 'btn btn-danger btn-lg' )); }}
												</div>
											</div>
										</div>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box transparent">
							<div class="widget-main no-padding">
								<div class="well well-lg">
									{{ Form::open(array('action' => 'AccessRightsController@putUserACDetail', 'id' => 'fSave', 'class' => 'form-horizontal')) }}
										<fieldset>
											<div align='center'>
												{{ Form::button('<i class="icon-ok icon-on-right"></i> Save', array('type' => 'Search', 'class' => 'btn btn-info btn-lg' )); }}
											</div>
										</fieldset>
									{{ Form::close() }}
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 widget-container-span ui-sortable">
						<div class="widget-box widget-color-blue">
							<div class="widget-header">
								<h5 class="widget-title">Access Rights for {{ $result->name }}</h5>
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
												<th class="hidden-480">Code</th>
												<th class="hidden-480">Access Type</th>
												<th class="hidden-480">Group ID</th>
												<th class="hidden-480">Event ID</th>
												<th class="hidden-480">Event Item</th>
												<th class="hidden-480">Create</th>
												<th class="hidden-480">Read</th>
												<th class="hidden-480">Update</th>
												<th class="hidden-480">Delete</th>
												<th class="hidden-480">Void</th>
												<th class="hidden-480">Unvoid</th>
												<th class="hidden-480">Print</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="widget-toolbox padding-8 clearfix">
									<a href="#resourceadd" role="button" class="btn btn-xs btn-warning pull-right" data-toggle="modal"><i class="fa fa-plus add bigger-120"></i> Add</a>
								</div>
							</div>
						</div>
					</div>
					<div id="uuseraccessrights" class="modal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								{{ Form::open(array('action' => 'AccessRightsController@postAccessRightsUpdate', 'id' => 'useraccessrightsupdate', 'class' => 'form-horizontal')) }}
									<fieldset>
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="blue bigger">Update Record</h4>
										</div>
										<div class="modal-body overflow-visible">
											<div class="row">
												<div hidden>
													<div class="form-group">
														{{ Form::label('uuserid', 'UserID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('uuserid', $rid, array('class' => 'col-xs-12 col-sm-11', 'id' => 'uuserid', 'disabled'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('uroleid', 'RoleID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('uroleid', $acroleid, array('class' => 'col-xs-12 col-sm-11', 'id' => 'uroleid', 'disabled'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('uid', 'ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('uid', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'uid', 'disabled'));}}
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('uresourcecode', 'Resource:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('uresourcecode', $resourcecode_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'uresourcecode'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('uaccesstypeid', 'Access Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('uaccesstypeid', $accesstype_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'uaccesstypeid'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ueventid', 'Event ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('ueventid', $event_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'ueventid'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ugroupid', 'Group ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('ugroupid', $group_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'ugroupid'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ueventitem', 'Event Item:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::text('ueventitem', '', array('class' => 'col-xs-12 col-sm-11', 'id' => 'ueventitem'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('ucreate', 'Create:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('ucreate', '', false, array('id' => 'ucreate'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('uread', 'Read:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('uread', 'false', false, array('id' => 'uread'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('uupdate', 'Update:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('uupdate', 'false', false, array('id' => 'uupdate'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('udelete', 'Delete:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('udelete', 'false', false, array('id' => 'udelete'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('uvoid', 'Void:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('uvoid', 'false', false, array('id' => 'uvoid'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('uunvoid', 'Unvoid:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('aunvoid', 'false', false, array('id' => 'uunvoid'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('uprint', 'Print:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('uprint', 'false', false, array('id' => 'uprint'));}}
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i>Cancel</button>
											{{ Form::button('<i class="fa fa-check"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'btnresourceupdate')); }}
										</div>
									</fieldset>
								{{ Form::close() }}
							</div>
						</div>
					</div>
					<div id="resourceadd" class="modal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								{{ Form::open(array('action' => 'AccessRightsController@postAccessRightsAdd', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
									<fieldset>
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="blue bigger">Add Record</h4>
										</div>
										<div class="modal-body overflow-visible">
											<div class="row">
												<div hidden>
													<div class="form-group">
														{{ Form::label('auserid', 'UserID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('auserid', $rid, array('class' => 'col-xs-12 col-sm-11', 'id' => 'auserid', 'disabled'));}}
															</div>
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('aroleid', 'RoleID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																{{ Form::text('aroleid', $acroleid, array('class' => 'col-xs-12 col-sm-11', 'id' => 'aroleid', 'disabled'));}}
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('aresourcecode', 'Resource:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('aresourcecode', $resourcecode_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'aresourcecode'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('aaccesstypeid', 'Access Type:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('aaccesstypeid', $accesstype_options, array('class' => 'col-xs-12 col-sm-12', 'id' => 'aaccesstypeid'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('aeventid', 'Event ID:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::select('aeventid', $event_options, '', array('class' => 'col-xs-12 col-sm-9', 'id' => 'aeventid'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('acreate', 'Create:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('acreate', '', false, array('id' => 'acreate'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('aread', 'Read:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('aread', 'false', false, array('id' => 'aread'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('aupdate', 'Update:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('aupdate', 'false', false, array('id' => 'aupdate'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('adelete', 'Delete:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('adelete', 'false', false, array('id' => 'adelete'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('avoid', 'Void:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('avoid', 'false', false, array('id' => 'avoid'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('aunvoid', 'Unvoid:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('aunvoid', 'false', false, array('id' => 'aunvoid'));}}
														</div>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('aprint', 'Print:', array('class' => 'control-label col-xs-12 col-sm-3 no-padding-right')); }}
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															{{ Form::checkbox('aprint', 'false', false, array('id' => 'aprint'));}}
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i>Cancel</button>
											{{ Form::button('<i class="fa fa-check"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-sm btn-primary', 'id' => 'btnresourceadd')); }}
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
	@endforeach
@stop
@section('js')
	<script type="text/javascript">
		function editrow(submit){ 
			var RowID = "";
	        var oTable = $('#tdefault').DataTable();
	        $("#tdefault tbody tr").click(function () {
                var position = oTable.row(this).index(); // getting the clicked row position
                RowID = oTable.row(position).data(); // getting the value of the first (invisible) column
                if (RowID.create == 1) { $("#ucreate").attr('checked','checked'); }
                if (RowID.read == 1) { $("#uread").attr('checked','checked'); }
                if (RowID.update == 1) { $("#uupdate").attr('checked','checked'); }
                if (RowID.delete == 1) { $("#udelete").attr('checked','checked'); }
                if (RowID.void == 1) { $("#uvoid").attr('checked','checked'); }
                if (RowID.unvoid == 1) { $("#uunvoid").attr('checked','checked'); }
                if (RowID.print == 1) { $("#uprint").attr('checked','checked'); }
                $("#uresourcecode").val(RowID.resourcecode);
                $("#uaccesstypeid").val(RowID.accesstypeid);
                $("#ueventid").val(RowID.eventid);
                $("#ueventitem").val(RowID.eventitem);
                $("#ugroupid").val(RowID.groupid);
                $("#uid").val(RowID.uniquecode);
            });
		    $('#uuseraccessrights').modal('show');
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
					        url: 'deleteRights/' + submit,
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

	    $('#resourceadd').submit(function(e){
	    	if ($("#acreate").is(':checked')) { $("#acreate").val('1'); } else {$("#acreate").val('0'); }
	    	if ($("#aread").is(':checked')) { $("#aread").val('1'); } else {$("#aread").val('0'); }
	    	if ($("#aupdate").is(':checked')) { $("#aupdate").val('1'); } else {$("#aupdate").val('0'); }
	    	if ($("#adelete").is(':checked')) { $("#adelete").val('1'); } else {$("#adelete").val('0'); }
	    	if ($("#avoid").is(':checked')) { $("#avoid").val('1'); } else {$("#avoid").val('0'); }
	    	if ($("#aunvoid").is(':checked')) { $("#aunvoid").val('1'); } else {$("#aunvoid").val('0'); }
	    	if ($("#aprint").is(':checked')) { $("#aprint").val('1'); } else {$("#aprint").val('0'); }
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Adding Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postAccessRightsAdd',
		        type: 'POST',
		        data: { auserid: $("#auserid").val(), aroleid: $("#aroleid").val(), aaccesstypeid: $("#aaccesstypeid").val(), aresourcecode: $("#aresourcecode").val(), acreate: $("#acreate").val(), aread: $("#aread").val(), aupdate: $("#aupdate").val(), adelete: $("#adelete").val(), avoid: $("#avoid").val(), aunvoid: $("#aunvoid").val(), aprint: $("#aprint").val(), roleid: $("#roleid").val(), aeventid: $("#aeventid").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Created!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
						$("#resourceadd").modal('hide');
		        	},
		        	400:function(data){ 
		        		var txtMessage;
		        		if (data.responseJSON.ErrType == "Exist") 
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
		
		$('#useraccessrightsupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			if ($("#ucreate").is(':checked')) { $("#ucreate").val('1'); } else {$("#ucreate").val('0'); }
	    	if ($("#uread").is(':checked')) { $("#uread").val('1'); } else {$("#uread").val('0'); }
	    	if ($("#uupdate").is(':checked')) { $("#uupdate").val('1'); } else {$("#uupdate").val('0'); }
	    	if ($("#udelete").is(':checked')) { $("#udelete").val('1'); } else {$("#udelete").val('0'); }
	    	if ($("#uvoid").is(':checked')) { $("#uvoid").val('1'); } else {$("#uvoid").val('0'); }
	    	if ($("#uunvoid").is(':checked')) { $("#uunvoid").val('1'); } else {$("#uunvoid").val('0'); }
	    	if ($("#uprint").is(':checked')) { $("#uprint").val('1'); } else {$("#uprint").val('0'); }

			$.ajax({
		        url: 'postAccessRightsUpdate',
		        type: 'POST',
		        data: { uuserid: $("#uuserid").val(), uroleid: $("#uroleid").val(), accesstypeid: $("#uaccesstypeid").val(), uresourcecode: $("#uresourcecode").val(), ucreate: $("#ucreate").val(), uread: $("#uread").val(), uupdate: $("#uupdate").val(), udelete: $("#udelete").val(), uvoid: $("#uvoid").val(), uunvoid: $("#uunvoid").val(), uprint: $("#uprint").val(), roleid: $("#roleid").val(), uid: $("#uid").val(), ugroupid: $("#ugroupid").val(), ueventid: $("#ueventid").val(), ueventitem: $("#ueventitem").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		var oTable = $('#tdefault').DataTable();
		        		oTable.clearPipeline().draw();
            			noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
						$("#uuseraccessrights").modal('hide');
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

		$('#fSave').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putUserACDetail/{{ $rid }}',
		        type: 'POST',
		        data: { name: $("#name").val(), tel: $("#tel").val(), mobile: $("#mobile").val(), email: $("#email").val(), roleid: $("#roleid").val(), status: $("#status").val() },
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
		        		var txtMessage;
		        		if (data.responseJSON.ErrType == "Failed")
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

		$('#fReset').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Resetting Password ...',
				animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'ResetPassword/{{ $rid }}',
		        type: 'POST',
		        data: { password: $("#password").val() },
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		$("#password").val('');
		        		noty({
							layout: 'topRight', type: 'success', text: 'Password Resetted!!',
							animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 
								},
							timeout: 4000
						});
		        	},
		        	400:function(data){ 
		        		var txtMessage;
		        		if (data.responseJSON.ErrType == "Failed")
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
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(function() {
				var oTable = $('#tdefault').DataTable({
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
			            url: 'getUserAccessRightsListing/{{ $rid }}',
			            pages: 5 // number of pages to cache
			        }),
			        "columnDefs": [
	            	{
				    	"targets": [ 0 ], "data": "created_at", "searchable": "true",
				    	"render": function ( data, type, full ){
				    		return moment(data).format("DD-MMM-YYYY");
					    }
			    	},
			    	{ "targets": [ 1 ], "data": "resourcecode", "searchable": "true" },
			    	{
				    	"targets": [ 2 ], "data": "accesstypeid",
				    	"render": function ( data, type, full ){
				    		if (data == 1){ return 'Module'; }
						  	else if (data == 2){ return 'Temporany'; }
						    else if (data == 3){ return 'Time-Based'; }
						    else { return 'Master'; }
					    }
			    	},
			    	{ "targets": [ 3 ], "data": "groupid", "searchable": "true" },
			    	{ "targets": [ 4 ], "data": "eventid", "searchable": "true" },
			    	{ "targets": [ 5 ], "data": "eventitem", "searchable": "true" },
			    	{ "targets": [ 6 ], "data": "create", "searchable": "true" },
			    	{ "targets": [ 7 ], "data": "read", "searchable": "true" },
			    	{ "targets": [ 8 ], "data": "update", "searchable": "true" },
			    	{ "targets": [ 9 ], "data": "delete", "searchable": "true" },
			    	{ "targets": [ 10 ], "data": "void", "searchable": "true" },
			    	{ "targets": [ 11 ], "data": "unvoid", "searchable": "true" },
			    	{ "targets": [ 12 ], "data": "print", "searchable": "true" },
			    	{
				    	"targets": [ 13 ], "data": "uniquecode",
				    	"render": function ( data, type, full ){
				    		return '<button type="submit" onClick=editrow("'+ data +'") class="btn btn-xs btn-info"><i class="fa fa-edit bigger-120"></i></button> <button type="submit" onClick=deleterow("'+ data +'") class="btn btn-xs btn-danger"><i class="fa fa-trash-o bigger-120"></i></button>'
					    }
			    	}]
			    });
			});
		});
	</script>
@stop