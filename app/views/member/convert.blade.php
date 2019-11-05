@extends('layout.master')

@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i><a href="{{{ URL::action('DashboardController@getIndex') }}}">Home</a>
			</li>
			<li><a href="{{{ URL::action('MemberController@getIndex') }}}">Members</a></li>
			<li class="active">Convert Members</li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Convert <small><i class="icon-double-angle-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				{{ Form::open(array('action' => 'MemberController@postConvert', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Convert', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@post2019Members', 'id' => 'resource2019Members', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Update 2019 Membership', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@postConvertNricHash', 'id' => 'resourceadd', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Convert NRIC Hash', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@postConvertFront', 'id' => 'resourceaddfront', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Convert Front', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
								{{ Form::text('txtStart', '1', array('class' => 'col-xs-1 col-sm-1', 'id' => 'txtStart'));}}
								{{ Form::text('txtEnd', '50000', array('class' => 'col-xs-1 col-sm-1', 'id' => 'txtEnd'));}}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@putCNameDOB', 'id' => 'resourceupdate', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Update Chinese Name and DOB', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@DatabaseUpdate', 'id' => 'databaseupdate', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Update Database', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@putEncryptAddress', 'id' => 'addressupdate', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Encrypt Address', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@putNricSearchCode', 'id' => 'searchcodeupdate', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Search Code', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@posteventdetail', 'id' => 'inserteventdetail', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Insert Event Detail', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@posteventfddetail', 'id' => 'inserteventfddetail', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Insert Event FD Detail', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@posteventpddetail', 'id' => 'inserteventpddetail', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Insert Event PD Detail', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@posteventknightdetail', 'id' => 'insertknightdetail', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Insert Event Soka Knight Detail', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@posteventancdetail', 'id' => 'insertancdetail', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Insert arts and culture Detail', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				{{ Form::open(array('action' => 'MemberController@postzonedm', 'id' => 'insertzonedm', 'class' => 'form-horizontal')) }}
					<fieldset>
						<div class="form-group">
							<div class=col-sm-12>
								{{ Form::button('<i class="icon-plus Add"></i> Insert Sembawang Zone', array('type' => 'submit', 'class' => 'btn btn-xs btn-yellow bigger' )); }}
							</div>
						</div>
					</fieldset>
				{{ Form::close() }}
				<!-- PAGE CONTENT ENDS HERE -->
			</div>
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript">
		$('#resourceadd').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'postConvert',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Created!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

		$('#resource2019Members').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'post2019Members',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

	    $('#resourceaddfront').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});

			for (var i = $("#txtStart").val(); i < $("#txtEnd").val(); i++)
			{
				$.ajax({
			        url: 'postConvertfront/' + i,
			        type: 'POST',
			        dataType: 'json',
			        statusCode: { 
			        	200:function(data){
			        		var txtMessage = data.ErrType + ' is added!';

			        		noty({
								layout: 'topRight', type: 'success', text: txtMessage,
								animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	},
			        	400:function(data){ 
			        		noty({
								layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
								animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
									},
								timeout: 4000
							}); 
			        	}
			        }
			    });
			    e.preventDefault();
			}
	    });

	    $('#resourceupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'putCNameDOB',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Record Updated!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

	    $('#databaseupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'DatabaseUpdate',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Database Updated!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

	    $('#addressupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'AddressUpdate',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Address Updated!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Create!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

	    $('#searchcodeupdate').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'NricSearchCode',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Search Code Updated!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

	    $('#inserteventdetail').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'EventDetailInsert',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Event Detail Inserted!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

	    $('#inserteventfddetail').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'EventFDDetailInsert',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Event FD Detail Inserted!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

	    $('#inserteventpddetail').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'EventPDDetailInsert',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Event FD Detail Inserted!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

	    $('#insertknightdetail').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'EventKnightDetailInsert',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Event Soka Knight Detail Inserted!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });

	    $('#insertancdetail').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'EventANCInsert',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Event ANC Inserted!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	}
		        }
		    });
		    e.preventDefault();
	    });
		
		$('#insertzonedm').submit(function(e){
	    	noty({
				layout: 'topRight', type: 'warning', text: 'Updating Record ...',
				animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 },
				timeout: 4000
			});
			$.ajax({
		        url: 'EventZoneDM',
		        type: 'POST',
		        dataType: 'json',
		        statusCode: { 
		        	200:function(){
		        		noty({
							layout: 'topRight', type: 'success', text: 'Discussion Meeting Inserted!!',
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
								},
							timeout: 4000
						}); 
		        	},
		        	400:function(data){ 
		        		var txtMessage = 'Please check your entry!!';
		        		noty({
							layout: 'topRight', type: 'error', text: 'Failed to Update!! ' + txtMessage,
							animation: { open: {height: 'toggle'}, close: {height: 'toggle'}, easing: 'swing', speed: 500 
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