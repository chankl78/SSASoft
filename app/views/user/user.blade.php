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
			<li class="active">User Profile</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>User Profile</h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div>
					<div id="user-profile-3" class="user-profile row">
						<div class="col-sm-offset-1 col-sm-10">
							<div class="space"></div>
							<div class="tabbable">
								<ul class="nav nav-tabs padding-16">
									<li class="active">
										<a data-toggle="tab" href="#edit-basic">
											<i class="green icon-edit bigger-125"></i>
											Basic Info
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#edit-settings">
											<i class="purple icon-cog bigger-125"></i>
											Settings
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#edit-password">
											<i class="blue icon-key bigger-125"></i>
											Password
										</a>
									</li>
								</ul>
								<div class="tab-content profile-edit-tab-content">
									<div id="edit-basic" class="tab-pane in active">
										<h4 class="header blue bolder smaller">General</h4>
										<div class="row">
											<div class="col-xs-12 col-sm-4">
												<input type="file" />
											</div>
											<div class="vspace-xs"></div>
											<div class="col-xs-12 col-sm-8">
												{{ Form::open(array('action' => 'UserController@postUser', 'id' => 'user', 'class' => 'form-horizontal')) }}
													<fieldset>
														<div class="form-group">
															{{ Form::label('username', 'Username:', array('class' => 'control-label col-xs-12 col-sm-2 no-padding-right')); }}
															<div class="col-xs-12 col-sm-10">
																<label class="block clearfix">
																	<span class="block input-icon input-icon-right">
																		{{ Form::text('username', Auth::user()->username, array('class' => 'form-control', 'placeholder' => 'Username', 'id' => 'username', 'disabled', 'style' => 'font-weight: bold; color:black;')); }}
																		<i class="icon-user"></i>
																	</span>
																</label>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('name', 'Name:', array('class' => 'control-label col-xs-12 col-sm-2 no-padding-right')); }}
															<div class="col-xs-12 col-sm-10">
																<label class="block clearfix">
																	<span class="block input-icon input-icon-right">
																		{{ Form::text('name', Auth::user()->name, array('class' => 'form-control', 'placeholder'=>'Name', 'id' => 'name')); }}
																		<i class="icon-user-md"></i>
																	</span>
																</label>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('email', 'Email:', array('class' => 'control-label col-xs-12 col-sm-2 no-padding-right')); }}
															<div class="col-xs-12 col-sm-10">
																<label class="block clearfix">
																	<span class="block input-icon input-icon-right">
																		{{ Form::text('email', Auth::user()->email, array('class' => 'form-control', 'placeholder' => 'Email', 'id' => 'email')); }}
																		<i class="icon-envelope"></i>
																	</span>
																</label>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('phone', 'Phone:', array('class' => 'control-label col-xs-12 col-sm-2 no-padding-right')); }}
															<div class="col-xs-12 col-sm-10">
																<label class="block clearfix">
																	<span class="block input-icon input-icon-right">
																		{{ Form::text('phone', Auth::user()->tel, array('class' => 'form-control', 'placeholder' => 'Telephone', 'id' => 'phone')); }}
																		<i class="icon-phone"></i>
																	</span>
																</label>
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('mobile', 'Mobile:', array('class' => 'control-label col-xs-12 col-sm-2 no-padding-right')); }}
															<div class="col-xs-12 col-sm-10">
																<label class="block clearfix">
																	<span class="block input-icon input-icon-right">
																		{{ Form::text('mobile', Auth::user()->mobile, array('class' => 'form-control', 'placeholder' => 'Mobile', 'id' => 'mobile')); }}
																		<i class="icon-mobile-phone"></i>
																	</span>
																</label>
															</div>
														</div>
														<div class="clearfix form-actions">
															<div class="col-md-offset-5 col-md-9">
																{{ Form::button('<i class="icon-ok bigger-110"></i> <strong>Save</strong>', array('type' => 'Submit', 'class' => 'btn btn-info', 'id' => 'userupdate')); }}
															</div>
														</div>
													</fieldset>
												{{ Form::close() }}
											</div>
										</div>
										<hr />
										<h4 class="header blue bolder smaller">Recent Activities</h4>
										<div class="row">
											<table id="tUserLogs" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="hidden-480">Date</th>
														<th class="hidden-480">Log Type</th>
														<th class="hidden-480">Description</th>
														<th class="hidden-480">Status</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
									<div id="edit-settings" class="tab-pane">
										<div class="space-10"></div>

										<div>
											<label class="inline">
												<input type="checkbox" name="form-field-checkbox" class="ace" />
												<span class="lbl"> Make my profile public</span>
											</label>
										</div>

										<div class="space-8"></div>

										<div>
											<label class="inline">
												<input type="checkbox" name="form-field-checkbox" class="ace" />
												<span class="lbl"> Email me new updates</span>
											</label>
										</div>

										<div class="space-8"></div>

										<div>
											<label class="inline">
												<input type="checkbox" name="form-field-checkbox" class="ace" />
												<span class="lbl"> Keep a history of my conversations</span>
											</label>

											<label class="inline">
												<span class="space-2 block"></span>

												for
												<input type="text" class="input-mini" maxlength="3" />
												days
											</label>
										</div>
									</div>
									<div id="edit-password" class="tab-pane">
										<div class="space-10"></div>
										{{ Form::open(array('action' => 'UserController@postPassword', 'id' => 'userchangepassword', 'class' => 'form-horizontal')) }}
											<fieldset>
												<div class="form-group">
													{{ Form::label('newpassword', 'New Password:', array('class' => 'control-label col-xs-12 col-sm-2 no-padding-right')); }}
													<div class="col-xs-12 col-sm-10">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::password('newpassword', '', array('class' => 'form-control', 'placeholder'=>'New Password', 'id' => 'newpassword'));}}
																<i class="icon-lock"></i>
															</span>
														</label>
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('conpassword', 'Repeat Password:', array('class' => 'control-label col-xs-12 col-sm-2 no-padding-right')); }}
													<div class="col-xs-12 col-sm-10">
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																{{ Form::password('conpassword', '', array('class' => 'form-control', 'placeholder'=>'Repeat Password', 'id' => 'conpassword'));}}
																<i class="icon-retweet"></i>
															</span>
														</label>
													</div>
												</div>
												<div class="clearfix form-actions">
													<div class="col-md-offset-5 col-md-9">
														{{ Form::button('<i class="icon-ok bigger-110"></i> <strong>Save</strong>', array('type' => 'submit', 'class' => 'btn btn-info')); }}
													</div>
												</div>
											</fieldset>
										{{ Form::close() }}
									</div>
								</div>
							</div>
						</div><!-- /span -->
					</div><!-- /user-profile -->
				</div>
				<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
	<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			$.mask.definitions['~']='[+-]';
			$('#phone').mask('9999 9999');
			$('#mobile').mask('9999 9999');

			jQuery.validator.addMethod("phone", function (value, element) {
				return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
			}, "Enter a valid phone number.");

			jQuery.validator.addMethod("mobile", function (value, element) {
				return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
			}, "Enter a valid mobile number.");
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#userchangepassword').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					newpassword: {
						required: true,
						minlength: 6
					},
					conpassword: {
						required: true,
						minlength: 6,
						equalTo: "#newpassword"
					},
				},
				messages: {
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
			$('#user1').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: false,
				rules: {
					email: {
						required: true,
						email:true
					},
					name: {
						required: true,
						minlength: 3
					},
					mobile: {
						required: true,
						minlength: 3
					},
					phone: {
						minlength: 8
					}
				},
		
				messages: {
					email: {
						required: "Please provide a valid email.",
						email: "Please provide a valid email."
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
			$(function() {
				var oTable = $('#tUserLogs').dataTable({
			        "iDisplayLength": 10, // Default No of Records per page on 1st load
			        "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]], // Set no of records in per page
			        //"aaSorting": [[0, "desc"]], // Default 1st column sorting
			        "bStateSave": true, // Remember paging & filters
			        "bAutoWidth": true,
			        "bScrollCollapse": true,
			        "bServerSide": true,
			        "bDeferRender": true,
			        "fnServerData": fnDataTablesPipeline,
			        "sPaginationType": "bootstrap", // Include page number
			        "sAjaxSource": 'UserProfile/getUserLogs',
			        "aoColumns": [
	                    { "mData": "created_at" }, { "mData": "logtype" }, { "mData": "description" }, { "mData": "status"}],
	                "aoColumnDefs": [
	                	{
					    	"aTargets": [ 0 ], "mData": "created_at",
					    	"mRender": function ( data, type, full ){
					    		return moment(data).format("DD-MMM-YYYY HH:mm:ss");
						    }
				    	},
				    	{
					    	"aTargets": [ 2 ], "mData": "description",
					    	"mRender": function ( data, type, full ){
					    		return data.substring(0, 97) + ' ...';
						    }
				    	},
				    	{
					    	"aTargets": [ 3 ], "mData": "status",
					    	"mRender": function ( data, type, full ){
							    if (data === 'Failed'){
							    	return '<span class="label label-danger arrowed-in">'+data+'</span>';
							    }
							  	else if (data === 'Success'){
							    	return '<span class="label label-success arrowed">'+data+'</span>';
							    }
				    		}
				    }]
			    });
			});

			$("#user").submit(function(e){
				noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'UserProfile',
			        type: 'POST',
			        data: { name: $("#name").val(), email: $("#email").val(), phone: $("#phone").val(), mobile: $("#mobile").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(){
			        		var oTable = $('#tUserLogs').dataTable();
			        		oTable.fnDraw();
                			noty({
								layout: 'topRight', type: 'success', text: 'Record Updated!!',
								animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	},
			        	400:function(){ 
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Update!!  Please check your entry.',
								animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	}
			        }
			    });
			    e.preventDefault();
			});

			$("#userchangepassword").submit(function(e){
				noty({
					layout: 'topRight', type: 'warning', text: 'Updating Record ...',
					animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
					timeout: 4000
				});
				$.ajax({
			        url: 'UserProfile/postPassword',
			        type: 'POST',
			        data: { newpassword: $("#newpassword").val(), conpassword: $("#conpassword").val() },
			        dataType: 'json',
			        statusCode: { 
			        	200:function(data){
			        		// console.log(data);
			        		var oTable = $('#tUserLogs').dataTable();
			        		oTable.fnDraw();
			        		noty({
								layout: 'topRight', type: 'success', text: 'Password Updated!!',
								animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	},
			        	400:function(){ 
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Update!!  Please check your entry.',
								animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
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
	<script type="text/javascript">
		$('#user-profile-3')
			.find('input[type=file]').ace_file_input({
				style:'well',
				btn_choose:'Change avatar',
				btn_change:null,
				no_icon:'icon-picture',
				thumbnail:'large',
				droppable:true,
				before_change: function(files, dropped) {
					var file = files[0];
					if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
						if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
					}
					else {//file is a File object
						var type = $.trim(file.type);
						if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
								|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
							) return false;
		
						if( file.size > 110000 ) {//~100Kb
							return false;
						}
					}
					return true;
				}
			})
	</script>
@stop