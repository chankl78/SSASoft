@extends('layout.master')
@section('jsheader')
	<link rel="stylesheet" href="{{{ asset('assets/css/fullcalendar.css') }}}" />
@stop
@section('content')
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i><a href="{{{ URL::action('DashboardController@getIndex') }}}">Home</a>
			</li>
			<li><a href="{{{ URL::action('VehicleController@getIndex') }}}">Vehicle Booking</a></li>
		</ul><!--.breadcrumb-->
	</div><!--#breadcrumbs-->
	<div class="page-content" id="page-content">
		<div class="page-header">
			<h1>Vehicle Booking <small><i class="icon-double-angle-right"></i> Overview</small></h1>
		</div><!--/.page-header-->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS HERE -->
				<div class="col-xs-3 widget-container-span ui-sortable">
					<div class="widget-box">
						<div class="widget-header header-color-blue">
							<h5>SGK7939E</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="1 icon-chevron-up bigger-125"></i>
								</a>
							</div>
							<div class="widget-toolbar no-border open">
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<br />
								<br />
								<div id="calendar"></div>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 widget-container-span ui-sortable">
					<div class="widget-box">
						<div class="widget-header header-color-green">
							<h5>SFY9830J</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="1 icon-chevron-up bigger-125"></i>
								</a>
							</div>
							<div class="widget-toolbar no-border open">
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<br />
								<br />
								<div id="calendar2"></div>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 widget-container-span ui-sortable">
					<div class="widget-box">
						<div class="widget-header header-color-red">
							<h5>GBB4915A</h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="1 icon-chevron-up bigger-125"></i>
								</a>
							</div>
							<div class="widget-toolbar no-border open">
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								<br />
								<br />
								<div id="calendar3"></div>
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 widget-container-span ui-sortable">
					<div class="widget-box">
						<div class="widget-header header-color-orange">
							<h5>New Booking </h5>
							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="1 icon-chevron-up bigger-125"></i>
								</a>
							</div>
							<div class="widget-toolbar no-border open">
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main">
								{{ Form::open(array('action' => 'LoginController@postRegister', 'id' => 'register')) }}
									<fieldset>
										<div class="form-group">
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													{{ Form::text('gname', '', array('class' => 'form-control', 'placeholder'=>'Vehicle No', 'id' => 'gname'));}}
													<i class="icon-user-md"></i>
												</span>
											</label>
										</div>
										<div class="form-group">
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													{{ Form::text('gusername', '', array('class' => 'form-control', 'placeholder' => 'Event', 'id' => 'gusername'));}}
													<i class="icon-user"></i>
												</span>
											</label>
										</div>
										<div class="form-group">
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													{{ Form::password('gpassword', array('class' => 'form-control', 'placeholder' => 'Request Date', 'id' => 'gpassword'));}}
													<i class="icon-lock"></i>
												</span>
											</label>
										</div>
										<div class="form-group">
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													{{ Form::password('gpassword2', array('class' => 'form-control', 'placeholder' => 'Start Time', 'id' => 'gpassword2'));}}
													<i class="icon-retweet"></i>
												</span>
											</label>
										</div>
										<div class="form-group">
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													{{ Form::text('gemail', '', array('class' => 'form-control', 'placeholder' => 'End Time', 'id' => 'gemail'));}}
													<i class="icon-envelope"></i>
												</span>
											</label>
										</div>
										<div class="form-group">
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													{{ Form::text('gphone', '', array('class' => 'form-control', 'placeholder' => 'Remark', 'id' => 'gphone'));}}
													<i class="icon-phone"></i>
												</span>
											</label>
										</div>
										<div class="form-group">
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													{{ Form::text('gmobile', '', array('class' => 'form-control', 'placeholder' => 'Route', 'id' => 'gmobile'));}}
													<i class="icon-mobile-phone"></i>
												</span>
											</label>
										</div>
										<div class="clearfix">
											{{ Form::button('Book <i class="icon-arrow-right icon-on-right"></i>', array('type' => 'submit', 'class' => 'width-65 pull-right btn btn-sm btn-success')) }}
										</div>
									</fieldset>
								{{ Form::close() }}
							</div>
							<div class="widget-toolbox padding-8 clearfix">
								
							</div>
						</div>
					</div>
				</div>
				<!-- PAGE CONTENT ENDS HERE -->
			</div><!-- /.col -->
		</div><!--/row-->
	</div><!--/#page-content-->
@stop
@section('js')
	<script type="text/javascript" src="{{{ asset('assets/js/fullcalendar.min.js') }}}"></script>
	<script type="text/javascript">
		jQuery(function($) {

			/* initialize the calendar
			-----------------------------------------------------------------*/

			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();

			var calendar = $('#calendar').fullCalendar({
				defaultView: 'agendaDay',
				height: 650,
				buttonText: {
					prev: '<i class="icon-chevron-left"></i>',
					next: '<i class="icon-chevron-right"></i>'
				},
			
				header: {
					left: 'prev,next today',
					center: '',
					right: 'agendaDay'
				},
				events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1),
					className: 'label-important'
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2),
					className: 'label-success'
				},
				{
					title: 'Some Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				}]
				,
				selectable: true,
				selectHelper: true,
				select: function(start, end, allDay) {
					
					bootbox.prompt("New Event Title:", function(title) {
						if (title !== null) {
							calendar.fullCalendar('renderEvent',
								{
									title: title,
									start: start,
									end: end,
									allDay: allDay
								},
								true // make the event "stick"
							);
						}
					});
					

					calendar.fullCalendar('unselect');
				}
				,
				eventClick: function(calEvent, jsEvent, view) {

					var form = $("<form class='form-inline'><label>Change event name &nbsp;</label></form>");
					form.append("<input class='middle' autocomplete=off type=text value='" + calEvent.title + "' /> ");
					form.append("<button type='submit' class='btn btn-sm btn-success'><i class='icon-ok'></i> Save</button>");
					
					var div = bootbox.dialog({
						message: form,
					
						buttons: {
							"delete" : {
								"label" : "<i class='icon-trash'></i> Delete Event",
								"className" : "btn-sm btn-danger",
								"callback": function() {
									calendar.fullCalendar('removeEvents' , function(ev){
										return (ev._id == calEvent._id);
									})
								}
							} ,
							"close" : {
								"label" : "<i class='icon-remove'></i> Close",
								"className" : "btn-sm"
							} 
						}
					});
					form.on('submit', function(){
						calEvent.title = form.find("input[type=text]").val();
						calendar.fullCalendar('updateEvent', calEvent);
						div.modal("hide");
						return false;
					});
				}	
			});

			var calendar = $('#calendar2').fullCalendar({
				defaultView: 'agendaDay',
				height: 650,
				buttonText: {
					prev: '<i class="icon-chevron-left"></i>',
					next: '<i class="icon-chevron-right"></i>'
				},
			
				header: {
					left: 'prev,next today',
					center: '',
					right: 'agendaDay'
				},
				events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1),
					className: 'label-important'
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2),
					className: 'label-success'
				},
				{
					title: 'Some Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				}]
				,
				selectable: true,
				selectHelper: true,
				select: function(start, end, allDay) {
					
					bootbox.prompt("New Event Title:", function(title) {
						if (title !== null) {
							calendar.fullCalendar('renderEvent',
								{
									title: title,
									start: start,
									end: end,
									allDay: allDay
								},
								true // make the event "stick"
							);
						}
					});
					

					calendar.fullCalendar('unselect');
				}
				,
				eventClick: function(calEvent, jsEvent, view) {

					var form = $("<form class='form-inline'><label>Change event name &nbsp;</label></form>");
					form.append("<input class='middle' autocomplete=off type=text value='" + calEvent.title + "' /> ");
					form.append("<button type='submit' class='btn btn-sm btn-success'><i class='icon-ok'></i> Save</button>");
					
					var div = bootbox.dialog({
						message: form,
					
						buttons: {
							"delete" : {
								"label" : "<i class='icon-trash'></i> Delete Event",
								"className" : "btn-sm btn-danger",
								"callback": function() {
									calendar.fullCalendar('removeEvents' , function(ev){
										return (ev._id == calEvent._id);
									})
								}
							} ,
							"close" : {
								"label" : "<i class='icon-remove'></i> Close",
								"className" : "btn-sm"
							} 
						}
					});
					form.on('submit', function(){
						calEvent.title = form.find("input[type=text]").val();
						calendar.fullCalendar('updateEvent', calEvent);
						div.modal("hide");
						return false;
					});
				}	
			});
			
			var calendar = $('#calendar3').fullCalendar({
				defaultView: 'agendaDay',
				height: 650,
				buttonText: {
					prev: '<i class="icon-chevron-left"></i>',
					next: '<i class="icon-chevron-right"></i>'
				},
			
				header: {
					left: 'prev,next today',
					center: '',
					right: 'agendaDay'
				},
				events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1),
					className: 'label-important'
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2),
					className: 'label-success'
				},
				{
					title: 'Some Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				}]
				,
				selectable: true,
				selectHelper: true,
				select: function(start, end, allDay) {
					
					bootbox.prompt("New Event Title:", function(title) {
						if (title !== null) {
							calendar.fullCalendar('renderEvent',
								{
									title: title,
									start: start,
									end: end,
									allDay: allDay
								},
								true // make the event "stick"
							);
						}
					});
					

					calendar.fullCalendar('unselect');
				}
				,
				eventClick: function(calEvent, jsEvent, view) {

					var form = $("<form class='form-inline'><label>Change event name &nbsp;</label></form>");
					form.append("<input class='middle' autocomplete=off type=text value='" + calEvent.title + "' /> ");
					form.append("<button type='submit' class='btn btn-sm btn-success'><i class='icon-ok'></i> Save</button>");
					
					var div = bootbox.dialog({
						message: form,
					
						buttons: {
							"delete" : {
								"label" : "<i class='icon-trash'></i> Delete Event",
								"className" : "btn-sm btn-danger",
								"callback": function() {
									calendar.fullCalendar('removeEvents' , function(ev){
										return (ev._id == calEvent._id);
									})
								}
							} ,
							"close" : {
								"label" : "<i class='icon-remove'></i> Close",
								"className" : "btn-sm"
							} 
						}
					});
					form.on('submit', function(){
						calEvent.title = form.find("input[type=text]").val();
						calendar.fullCalendar('updateEvent', calEvent);
						div.modal("hide");
						return false;
					});
				}	
			});
		})
	</script>
@stop