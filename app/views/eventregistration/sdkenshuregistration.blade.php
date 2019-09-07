<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>SSASoft - {{ $title }}</title>

		<meta name="description" content="SSASoft.">
		<meta name="author" content="Chan Kuan Leang, Tan Xuan You">
		<meta name="keyword" content="SSA, Office Automation, Singapore Soka Association, Soka, Soka Gakkai, SGI">
		
		<!-- start: Mobile Specific -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- basic styles -->

		<!-- bootstrap & fontawesome -->
		<link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">
		<link href="{{{ asset('assets/css/font-awesome.min.css') }}}" rel="stylesheet" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-fonts.css') }}}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace.min.css') }}}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-rtl.min.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/ace-skins.min.css') }}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{{ asset('assets/css/datepicker.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/chosen.css') }}}" />
		<link rel="stylesheet" href="{{{ asset('assets/css/animate.css') }}}" />
		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		
		<!-- Add to Calendar -->
		<link rel="stylesheet" href="{{{ asset('assets/css/addtocalendar/atc-style-blue.css') }}}" />
		
		<!--inline styles related to this page-->
		
	</head>

	<body class="no-skin">
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							SSASoft - {{ $title }}
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<div class="main-content">
				<div class="page-content">
					{{ Form::open(array('id' => 'sdKenshuForm', 'onsubmit' => 'formSubmit(); return false;', 'url' => 'javascript:void(0);', 'class' => 'form-horizontal')) }}
					<div class="hidden">
						{{ Form::text('sdKenshuForm__eventid', '20170201134021', array('readonly' => 'true', 'id' => 'sdKenshuForm__eventid')); }}
					</div>
					<div class="row"><!-- Event Information -->
						<h3 class="blue lighter align-center">
							Student Division Training Course (Kenshukai)
						</h3>
						<div class="col-sm-2 hidden-xs"></div>
						<div class="col-sm-8 col-xs-12">
							<div class="row panel panel-default">
								<h4 class="col-sm-4">SD Nationwide Pre-Kenshu Meeting</h4>
								<h4 class="col-sm-5">18 Feb, 2-4pm at Senja Soka Centre</h4>
								<div class="col-sm-3">
									<h4 class="addtocalendar atc-style-blue">
										<var class="atc_event">
											<var class="atc_date_start">2017-02-18 14:00:00</var>
											<var class="atc_date_end">2017-02-18 16:00:00</var>
											<var class="atc_timezone">Asia/Singapore</var>
											<var class="atc_title">SD Nationwide Pre-Kenshu Meeting</var>
											<var class="atc_description">SD Nationwide Pre-Kenshu Meeting</var>
											<var class="atc_location">Senja Soka Centre, 11 Senja Road, Singapore 677739</var>
											<var class="atc_organizer">SSA Student Division</var>
										</var>
									</h4>
								</div>
							</div>
							<div class="row panel panel-default">
								<h4 class="col-sm-4">SD Kenshu 2017</h4>
								<h4 class="col-sm-5">18 Mar 12nn till 19 Mar 1pm at Senja Soka Centre</h4>
								<div class="col-sm-3">
									<h4 class="addtocalendar atc-style-blue">
										<var class="atc_event">
											<var class="atc_date_start">2017-03-18 12:00:00</var>
											<var class="atc_date_end">2017-03-19 13:00:00</var>
											<var class="atc_timezone">Asia/Singapore</var>
											<var class="atc_title">SD Kenshu</var>
											<var class="atc_description">Student Division Training Course (Kenshukai)</var>
											<var class="atc_location">Senja Soka Centre, 11 Senja Road, Singapore 677739</var>
											<var class="atc_organizer">SSA Student Division</var>
										</var>
									</h4>
								</div>
							</div>
						</div>
						<div class="col-sm-2 hidden-xs"></div>
					</div><!-- End of Event Information -->
					<div class="row"><!-- Membership Information -->
						<h3 class="blue lighter align-center">Membership Information</h3>
						<div class="col-sm-10 col-xs-12">
							<div class="form-group">
								{{ Form::label('sdKenshuForm__nric', 'NRIC or FIN:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								<div class="input-group col-sm-4 col-xs-12">
									{{ Form::text('sdKenshuForm__nric', '', array('class' => 'form-control', 'placeholder'=>'Enter your NRIC or FIN...')); }}
									<span class="input-group-btn">
										<button id="sdKenshuForm__button-nricSearch" class="btn btn-default no-padding-top no-padding-bottom" type="button">
											<i class="fa fa-search fa fa-on-right"></i>
										</button>
									</span>
								</div>
								<div class="col-sm-4 hidden-xs"></div>
								<!-- Display the NRIC search results here -->
								<div id="sdKenshuForm__nricSearchResult" class="col-sm-8 col-xs-12"></div>
							</div>
							<div id="sdKenshuForm__memberLookupInfo" hidden>
								<div class="form-group">
									{{ Form::label('sdKenshuForm__name', 'Name:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									{{ Form::text('sdKenshuForm__name', '', array('class' => 'col-sm-8 col-xs-12'));}}
								</div>
								<div class="form-group">
									{{ Form::label('sdKenshuForm__email', 'Email:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									{{ Form::text('sdKenshuForm__email', '', array('class' => 'col-sm-8 col-xs-12'));}}
								</div>
								<div class="form-group">
									{{ Form::label('sdKenshuForm__mobilePhone', 'Contact (Mobile):', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									{{ Form::text('sdKenshuForm__mobilePhone', '', array('class' => 'col-sm-8 col-xs-12'));}}
								</div>
								<div class="form-group">
									{{ Form::label('sdKenshuForm__homePhone', 'Contact (Home):', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									{{ Form::text('sdKenshuForm__homePhone', '', array('class' => 'col-sm-8 col-xs-12'));}}
								</div>
								<div class="form-group">
									{{ Form::label('', 'Division:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									<div class="col-sm-8 col-xs-12">
										<label class="radio-inline">
											{{ Form::radio('sdKenshuForm__division', 'YM'); }}
											YMD
										</label>
										<label class="radio-inline">
											{{ Form::radio('sdKenshuForm__division', 'YW'); }}
											YWD
										</label>
									</div>
								</div>
								<div class="form-group">
									{{ Form::label('sdKenshuForm__region', 'Region:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									{{ Form::text('sdKenshuForm__region', '', array('class' => 'col-sm-8 col-xs-12'));}}
								</div>
								<div class="form-group">
									{{ Form::label('sdKenshuForm__zone', 'Zone:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									{{ Form::text('sdKenshuForm__zone', '', array('class' => 'col-sm-8 col-xs-12'));}}
								</div>
								<div class="form-group">
									{{ Form::label('sdKenshuForm__chapter', 'Chapter:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									{{ Form::text('sdKenshuForm__chapter', '', array('class' => 'col-sm-8 col-xs-12'));}}
								</div>
								<div class="form-group">
									{{ Form::label('sdKenshuForm__district', 'District:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									{{ Form::text('sdKenshuForm__district', '', array('class' => 'col-sm-8 col-xs-12'));}}
								</div>
								<div class="form-group">
									{{ Form::label('sdKenshuForm__yonshaPosition', '4 Division Position:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
									{{ Form::text('sdKenshuForm__yonshaPosition', '', array('class' => 'col-sm-8 col-xs-12'));}}
								</div>
								<div class="form-group hidden">
									{{ Form::text('sdKenshuForm__memberId', '', array('class' => 'col-sm-8 col-xs-12', 'id' => 'sdKenshuForm__memberId'));}}
								</div>
							</div>
						</div>
						<div class="col-sm-2 hidden-xs"></div>
					</div><!-- End of Membership Information -->
					<div class="row"><!-- Student Division Information -->
						<h3 class="blue lighter align-center">Student Division Membership Information</h3>
						<div class="col-sm-10 col-xs-12">
							<div class="form-group">
								{{ Form::label('sdKenshuForm__sdInstitution', 'Institution:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::select('sdKenshuForm__sdInstitution', $sd_inst_options, array('class' => 'col-sm-8 col-xs-12'));}}
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__sdPosition', 'SD Position:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::select('sdKenshuForm__sdPosition', $sd_pos_options, array('class' => 'col-sm-8 col-xs-12'));}}
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__sdSchool', 'School:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__sdSchool', '', array('class' => 'col-sm-8 col-xs-12'));}}
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__sdCourse', 'Course:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__sdCourse', '', array('class' => 'col-sm-8 col-xs-12'));}}
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__sdCourseStartDate', 'Course Start Date:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__sdCourseStartDate', '', array('class' => 'datepicker')); }}
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__sdCourseEndDate', 'Course End Date:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__sdCourseEndDate', '', array('class' => 'datepicker')); }}
							</div>
						</div>
						<div class="col-sm-2 hidden-xs"></div>
					</div><!-- End of Membership Information -->
					<div class="row"><!-- Emergency Contact -->
						<h3 class="blue lighter align-center">Emergency Contact</h3>
						<div class="col-sm-10 col-xs-12">
							<div class="form-group">
								{{ Form::label('sdKenshuForm__nokName', 'Next-of-Kin Name:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__nokName', '', array('class' => 'col-sm-8 col-xs-12'));}}
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__nokPhone', 'Next-of-Kin Phone:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__nokPhone', '', array('class' => 'col-sm-8 col-xs-12'));}}
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__nokRelationship', 'Next-of-Kin Relationship:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__nokRelationship', '', array('class' => 'col-sm-8 col-xs-12'));}}
							</div>
						</div>
						<div class="col-sm-2 hidden-xs"></div>
					</div><!-- End of Emergency Contact -->
					<div class="row"><!-- Logistics -->
						<h3 class="blue lighter align-center">Logistics</h3>
						<div class="col-sm-10 col-xs-12">
							<div class="form-group">
								{{ Form::label('sdKenshuForm__medical', 'Medical Conditions / Drug Allergy (if any):', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__medical', '', array('class' => 'col-sm-8 col-xs-12'));}}
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__diet', 'Special Dietary Requirements (if any):', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__diet', '', array('class' => 'col-sm-8 col-xs-12')); }}
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__overnight', 'Staying overnight from 18-19 Mar:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								<input id="sdKenshuForm__overnight" type="checkbox" class="ace ace-checkbox-1">
									<span class="lbl"></span>
								</input>
							</div>
							<div class="form-group" id="sdKenshuForm__sleepingBagDiv" hidden>
								{{ Form::label('sdKenshuForm__sleepingBag', 'Bringing your own sleeping bag:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								<input id="sdKenshuForm__sleepingBag" type="checkbox" class="ace ace-checkbox-1">
									<span class="lbl"></span>
								</input>
							</div>
							<div class="form-group">
								{{ Form::label('sdKenshuForm__remarks', 'My determination towards SD Kenshu 2017:', array('class' => 'control-label col-sm-4 col-xs-12')); }}
								{{ Form::text('sdKenshuForm__remarks', '', array('class' => 'col-sm-8 col-xs-12')); }}
							</div>
						</div>
						<div class="col-sm-2 hidden-xs"></div>
					</div><!-- End of Logistics -->
					<div class="row"><!-- Indemnity and Confirmation -->
						<h3 class="green align-center">Confirmation</h3>
						<div class="col-sm-2 hidden-xs"></div>
						<div class="col-sm-8 col-xs-12">
							<label>I have read and fully understood the conditions stated below:</label>
							<ol>
								<li>In the event of an accident or emergency, I permit the organizing committee to seek treatment for myself and I shall bear all medical expenses and related costs.</li>
								<li>I will not hold the Association liable in the event of any injury sustained as a result of my participation.</li>
								<li>I will abide by the organizing committee’s decision to withdraw my participation should I infringe on any of the rules and regulations of the organization including conduct and discipline.</li>
								<li>I consent to disclose the above-stated information to Singapore Soka Association to facilitate my participation in this event; and I agree to the organizing committee’s use of this information for the purpose of the event’s management and operation.</li>
								<li>I understand that photographs and videos of this event, including my participation, will be taken for the purpose of reporting in the official organ papers and website, and for historical archives.</li>
							</ol>
							{{ Form::label('sdKenshuForm__confirmation', 'I acknowledge and accept the above conditions :', array('class' => 'control-label col-xs-6')); }}
							<input id="sdKenshuForm__confirmation" type="checkbox" class="ace ace-checkbox-1">
								<span class="lbl"></span>
							</input>
						</div>
						<div class="col-sm-2 hidden-xs"></div>
					</div><!-- End of Indemnity and Confirmation -->
					<div class="row align-center">
						<button id="sdKenshuForm__button-submit" class="btn btn-success btn-next">
							Submit
							<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
						</button>
					</div>
					{{ Form::close() }}
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->
			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">SSASoft</span>
							Singapore Soka Association &copy; 2013-{{date("Y");}}
						</span>
					</div>
					<!-- /section:basics/footer -->
				</div>
			</div>
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{{{ asset('assets/js/bootstrap.min.js') }}}"></script>

		<!-- page specific plugin scripts -->
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.validate.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/additional-methods.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/jquery.maskedinput.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/select2.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/bootbox.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/moment.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/noty/packaged/jquery.noty.packaged.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}}"></script>
		
		<!-- ace scripts -->
		<script type="text/javascript" src="{{{ asset('assets/js/ace-extra.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/ace-elements.min.js') }}}"></script>
		<script type="text/javascript" src="{{{ asset('assets/js/ace.min.js') }}}"></script>

		<!-- Add to Calendar -->
		<script type="text/javascript" src="{{{ asset('assets/js/addtocalendar/atc.min.js') }}}"></script>
		

		<!-- inline scripts related to this page -->
		<script type="text/javascript">

			function fillMemberInfo(data) {
				$("#sdKenshuForm__name").val(data.name);
				$("#sdKenshuForm__email").val(data.email);
				$("#sdKenshuForm__mobilePhone").val(data.mobile);
				$("#sdKenshuForm__homePhone").val(data.tel);
				$("#sdKenshuForm__region").val(data.rhq);
				$("#sdKenshuForm__zone").val(data.zone);
				$("#sdKenshuForm__chapter").val(data.chapter);
				$("#sdKenshuForm__district").val(data.district);
				$("#sdKenshuForm__yonshaPosition").val(data.position);
				$("#sdKenshuForm__memberId").val(data.id);

				// Special handling for division
				if (data.division == "YM") {
					$("input[name=sdKenshuForm__division][value=YM]").attr('checked', true);
				} else if (data.division == "YW") {
					$("input[name=sdKenshuForm__division][value=YW]").attr('checked', true);
				}
			}

			function clearMemberInfo() {
				$("#sdKenshuForm__name").val("");
				$("#sdKenshuForm__email").val("");
				$("#sdKenshuForm__mobilePhone").val("");
				$("#sdKenshuForm__homePhone").val("");
				$("#sdKenshuForm__region").val("");
				$("#sdKenshuForm__zone").val("");
				$("#sdKenshuForm__chapter").val("");
				$("#sdKenshuForm__district").val("");
				$("#sdKenshuForm__yonshaPosition").val("");
				$("#sdKenshuForm__memberId").val("");

				$("input[name=sdKenshuForm__division][value=YMD]").attr('checked', false);
				$("input[name=sdKenshuForm__division][value=YWD]").attr('checked', false);
			}

			function resetForm($form) {
				// Save the eventid
				$eventid = $('#sdKenshuForm__eventid').val();
				$form.find('input:text, input:password, input:file, select, textarea').val('');
				$form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
				// Restore the eventid
				$('#sdKenshuForm__eventid').val($eventid);
			}

			function formSubmit() {
				// Disable the submit button while processing
				$("#sdKenshuForm__button-submit").prop("disabled", true);
				
				// Notify user that we are adding the record
				noty({
					layout: 'topRight', type: 'warning', text: 'Adding Record ...',
					animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
					timeout: 4000
				});

				// Resolve the boolean parameters
				if ($("#sdKenshuForm__overnight").is(':checked')) { $("#sdKenshuForm__overnight").val('1'); } else {$("#sdKenshuForm__overnight").val('0'); }
				if ($("#sdKenshuForm__sleepingBag").is(':checked')) { $("#sdKenshuForm__sleepingBag").val('1'); } else {$("#sdKenshuForm__sleepingBag").val('0'); }
				if ($("#sdKenshuForm__confirmation").is(':checked')) { $("#sdKenshuForm__confirmation").val('1'); } else {$("#sdKenshuForm__overnight").val('0'); }

				$.ajax({
					url: 'eventregistration/postRegisterForEvent',
					type: 'POST',
					data: { // Map the data from the form here
						eventid: $("#sdKenshuForm__eventid").val(),
						memberid: $("#sdKenshuForm__memberId").val(),
						ssagroup: "Student Division",
						ssagroupid: "3",
						ssagroupcontact: $("#sdKenshuForm__sdInstitution").val(),
						name: $("#sdKenshuForm__name").val(),
						rhq: $("#sdKenshuForm__region").val(),
						zone: $("#sdKenshuForm__zone").val(),
						chapter: $("#sdKenshuForm__chapter").val(),
						district: $("#sdKenshuForm__district").val(),
						position: $("#sdKenshuForm__yonshaPosition").val(),
						division: $("input[name=sdKenshuForm__division]:checked").val(),
						nric: $("#sdKenshuForm__nric").val(),
						tel: $("#sdKenshuForm__homePhone").val(),
						mobile: $("#sdKenshuForm__mobilePhone").val(),
						email: $("#sdKenshuForm__email").val(),
						medicalhistory: $("#sdKenshuForm__medical").val(),
						dietary: $("#sdKenshuForm__diet").val(),
						emergencyname: $("#sdKenshuForm__nokName").val(),
						emergencyrelationship: $("#sdKenshuForm__nokRelationship").val(),
						emergencymobile: $("#sdKenshuForm__nokPhone").val(),
						pdpa: $("#sdKenshuForm__confirmation").val(),
						kenshuovernight: $("#sdKenshuForm__overnight").val(),
						costume8: $("#sdKenshuForm__sleepingBag").val(),
						remarks: $('#sdKenshuForm__remarks').val()
					},
					dataType: 'json',
					statusCode: { 
						200:function() {
							resetForm($("#sdKenshuForm"));
							
							noty({
								layout: 'center', type: 'success', text: 'Registration success!',
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
								closeWith: ['click'],
								timeout: 4000
							});
						},
						400:function(data) {
							var txtMessage;
							if (data.responseJSON.ErrType == "Duplicate") 
								{ txtMessage = 'You have already registered!';  }
							else if (data.responseJSON.ErrType == "Failed")
								{ txtMessage = 'Please check your entry!'; }
							else if (data.responseJSON.ErrType == "CannotUpdate")
								{ txtMessage = 'Unable to Update.  Please check your entry!'; }
							else { txtMessage = 'Please check your entry!'; }
							
							noty({
								layout: 'topRight', type: 'error', text: txtMessage,
								animation: { open: 'animated tada', close: 'animated hinge', easing: 'swing', speed: 500 },
								timeout: 4000
							});

							bootbox.dialog({
								message: "You have already registered in our Event " + $('#eventselected').val(), 
								buttons: {
									"danger" : {
										"label" : "Cancel",
										"className" : "btn-sm btn-danger"
									}
								}
							});
						}
					}
				});

				// Re-enable the submit button
				$("#sdKenshuForm__button-submit").prop("disabled", false);
			}

			jQuery(function($){
				// Button on to search for membership information by NRIC
				$("#sdKenshuForm__button-nricSearch").click(function(){
					// Clear the current member info
					clearMemberInfo();

					// Hide the member info
					$("#sdKenshuForm__memberLookupInfo").hide("fast");

					// Disable the NRIC search button and show loading
					$("#sdKenshuForm__nric").prop("disabled", true);
					$("#sdKenshuForm__button-nricSearch").prop("disabled", true);
					$("#sdKenshuForm__nricSearchResult").text("Searching...");
					
					// Validate the NRIC

					// AJAX search for the member
					$.ajax({
				        url: 'eventregistration/postSearchByNric',
				        type: 'POST',
				        data: { nric: $("#sdKenshuForm__nric").val() },
				        dataType: 'json',
				        statusCode: { 
							200:function(data){
								$("#sdKenshuForm__nricSearchResult").text('');

								// Populate the form with the received data
								fillMemberInfo(data);

								// Show the member information
								$("#sdKenshuForm__memberLookupInfo").show("fast");
							},
							400:function(data){ 
								var txtMessage = 'Please check your entry.';
								if (data.responseJSON.ErrType == "NoAccess") 
								{ txtMessage = 'Access denied.'; }
								else if (data.responseJSON.ErrType == "Does Not Exist")
									{ txtMessage = 'NRIC not found in database.'; }
								else { txtMessage = 'Please check your entry.'; }
								$("#sdKenshuForm__nricSearchResult").text(txtMessage);
							}
						}
					});

					// Re-enable the NRIC search button
					$("#sdKenshuForm__nric").prop("disabled", false);
					$("#sdKenshuForm__button-nricSearch").prop("disabled", false);
				});

				

				// Hide/reveal the sleeping bag column based on overnight
				$("#sdKenshuForm__overnight").change(function(){
					if ($(this).is(":checked")) {
                        $("#sdKenshuForm__sleepingBagDiv").show("fast");
                    } else {
                        $("#sdKenshuForm__sleepingBagDiv").hide("fast");
						$("#sdKenshuForm__sleepingBag").prop("checked", false);
                    }
				});
				$("#sdKenshuForm__overnight").prop("checked", false);

				// Activate all datepickers
				$('.datepicker').datepicker({
					format: 'd M yyyy'
				});
			}); // End of jQuery function

			/*
			$(document).ready(function () {
				//documentation : http://docs.jquery.com/Plugins/Validation/validate
				$.mask.definitions['~']='[+-]';
				
				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");

				jQuery.validator.addMethod("mobile", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");

				$('#resourceaddfriend').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						imembername: {
							required: true,
							minlength: 3
						}
					},
					
					messages: {
						
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.resourcenricesearch')).show();
					},
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is(':checkbox') || element.is(':radio')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					}
				});

				$('#resourcenricesearchintroducer').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						nricsearchintroducer: {
							required: true,
							minlength: 8
						}
					},
			
					messages: {
						
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.resourcenricesearch')).show();
					},
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is(':checkbox') || element.is(':radio')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					}
				});

				$('#resourceaddmember').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					rules: {
						membername: {
							required: true,
							minlength: 3
						},
						position: {
							required: true
						},
						division: {
							required: true
						},
						mobile: {
							required: true
						},
						email: {
							email:true
						}
					},
			
					messages: {
						
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $('.resourceaddmember')).show();
					},
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is(':checkbox') || element.is(':radio')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					}
				});
			})
			jQuery(function($) {
				var $validation = false;
				$('#fuelux-wizard')
				.ace_wizard({
					//step: 2 //optional argument. wizard will jump to step "2" at first
				})
				.on('change' , function(e, info) {
				})
				.on('finished', function(e) {
					if ($("#iagree").is(':checked')) { $("#iagree").val('1'); } else {$("#iagree").val('0'); }
					var wizard = $('#fuelux-wizard').data('wizard')
					
					if(!$('#resourceaddmember').valid()) return false;
					else
					
				.on('stepclick', function(e){
					//e.preventDefault();//this will prevent clicking and selecting steps
				});
			
				// fuelux: jump to a step
				$('#step-jump').on('click', function() {
					var wizard = $('#fuelux-wizard').data('wizard')
					wizard.currentStep = 3;
					wizard.setState();
				});
			})
			*/
		</script>
	</body>
</html>