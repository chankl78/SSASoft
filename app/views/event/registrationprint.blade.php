<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="description" content="Singapore Soka Association Office Automation.">
		<meta name="author" content="Chan Kuan Leang">
		<meta name="keyword" content="SSA, Office Automation, Singapore Soka Association, Soka, Soka Gakkai, SGI">
		
		<!-- basic styles -->
		<link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">

		<link rel="stylesheet" href="{{{ asset('assets/css/ace-fonts.css') }}}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{{ asset('assets/css/ace.min.css') }}}" />

		<style type="text/css">
            label {
                font: normal 8pt !important;
            }
            input[type="text"] {
			    font-size:10pt
			}
			textarea {
			   font-size: 10pt;
			} 
        </style>
	</head>
	<body>
		@foreach ($result as $result)
			<table width="100%">
				<tr>
					<td width="15%"><img src="{{asset('assets/images/SSAlogo.gif')}}" alt="SSA" id="SSA-logo" width="150%" height="30%"/></td>
					<td width="75%" align="center">
						<table width="100%">
							<tr>
								<td width="10%">
									
								</td>
								<td width="80%" align="center">
									<h3>Culture Event Recruitment Form</h3>
									<h5>文化活动报名表格</h5>
									<h5>National Day Parade 2014 年国庆庆典 2014</h5>
								</td>
								<td width="10%" align="right">
									
								</td>
							</tr>
						</table>
					</td>
					<td width="5%">
						<table width="100%" border="1" cellspacing="0" cellpadding="5px">
							<tr>
								<td width="20%">Fitness</td>
								<td width="80%" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td width="20%">Doctor's Consent</td>
								<td width="80%" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<div class="col-xs-12 col-sm-12">
				<div class="widget-box">
					<div class="widget-header widget-header-small">
						<h5>Participant Information</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<div class="col-xs-12 col-sm-4">
								<label for="name"> Name (As in NRIC)</label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->name}}' />
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="chinesename"> 中文姓名</label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->chinesename}}' />
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="nric"> NRIC No. 身分证号码 </label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->nric}}' />
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="email">Email 电邮地址</label><br />
								@if($result->email == 'NIL')
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='' />
								@else
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->email}}' />
								@endif
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="tel">Tel 住家号码</label><br />
								@if($result->tel == 'NIL')
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='' />
								@else
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->tel}}' />
								@endif
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="mobile">Hp 手机号码</label><br />
								@if($result->mobile == 'NIL')
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='' />
								@else
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->mobile}}' />
								@endif
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="dateofbirth"> Date of Birth 出生日期</label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->dateofbirth}}' />
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="bloodgroup"> Blood Group 血型</label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->bloodgroup}}' />
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="nationality"> Nationality 国籍</label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->nationality}}' />
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="countryofbirth"> Country of Birth 出生地</label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->countryofbirth}}' />
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="race"> Race 种族</label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->race}}' />
							</div>
							<div class="col-xs-12 col-sm-4">
								<label for="occupation"> Occupation 职业</label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->occupation}}' />
							</div>
						</div>
					</div>
				</div>
			</div><!-- /span -->
			<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable ">
				<div class="widget-box">
					<div class="widget-header widget-header-small">
						<h5>Personal Address / Organisation Infomation</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<div class="col-xs-12 col-sm-3">
								<label for="buildingname">Building Name</label><br />
								@if($result->buildingname == 'NIL')
									<input type="text" class="input-small"  style="width: 350px; padding: 2px" value='' />
								@else
									<input type="text" class="input-small"  style="width: 350px; padding: 2px" value='{{$result->buildingname}}' />
								@endif
							</div>
							<div class="col-xs-12 col-sm-5">
								<label for="address"> Address 地址</label><br />
								@if($result->address == 'NIL')
									<input type="text" class="input-small"  style="width: 350px; padding: 2px" value='' />
								@else
									<input type="text" class="input-small"  style="width: 350px; padding: 2px" value='{{$result->address}}' />
								@endif
							</div>
							<div class="col-xs-12 col-sm-2">
								<label for="unitno">Unit No</label><br />
								@if($result->unitno == 'NIL')
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='' />
								@else
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->unitno}}' />
								@endif
							</div>
							<div class="col-xs-12 col-sm-2">
								<label for="postalcode">P. Code 邮区</label><br />
								@if($result->postalcode == 'NIL')
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='' />
								@else
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->postalcode}}' />
								@endif
							</div>
							<div class="col-xs-12 col-sm-2">
								<label for="rhq"> RHQ 区域</label><br />
								<input type="text" class="input-small"  style="width: 50px; padding: 2px" value='{{$result->rhq}}' />
							</div>
							<div class="col-xs-12 col-sm-2">
								<label for="zone"> Zone 本部</label><br />
								<input type="text" class="input-small"  style="width: 50px; padding: 2px" value='{{$result->zone}}' />
							</div>
							<div class="col-xs-12 col-sm-2">
								<label for="chapter"> Chapter 支部</label><br />
								<input type="text" class="input-small"  style="width: 50px; padding: 2px" value='{{$result->chapter}}' />
							</div>
							<div class="col-xs-12 col-sm-2">
								<label for="district"> District 地区</label><br />
								<input type="text" class="input-small"  style="width: 50px; padding: 2px" value='{{$result->district}}' />
							</div>
							<div class="col-xs-12 col-sm-2">
								<label for="position"> Position</label><br />
								<input type="text" class="input-small"  style="width: 50px; padding: 2px" value='{{$result->position}}' />
							</div>
							<div class="col-xs-12 col-sm-2">
								<label for="division"> Division 部别: </label><br />
								<input type="text" class="input-small"  style="width: 50px; padding: 2px" value='{{$result->division}}' />
							</div>
						</div>
					</div>
				</div>
			</div><!-- /span -->
			<div class="col-xs-12 col-sm-12 widget-container-span ui-sortable ">
				<div class="widget-box">
					<div class="widget-header widget-header-small">
						<h5>Emergency Contact 亲属资料</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<div class="col-xs-12 col-sm-3">
								<label for="emergencyname"> Name 名字</label><br />
								<input type="text" class="input-small"  style="width: 350px; padding: 2px" value='{{$result->emergencyname}}' />
							</div>
							<div class="col-xs-12 col-sm-3">
								<label for="emergencyrelationship">  Relationship 关系</label><br />
								<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->emergencyrelationship}}' />
							</div>
							<div class="col-xs-12 col-sm-3">
								<label for="emergencytel">Tel 联络号码</label><br />
								@if($result->emergencytel == 'NIL')
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='' />
								@else
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->emergencytel}}' />
								@endif
							</div>
							<div class="col-xs-12 col-sm-3">
								<label for="emergencymobile"> Mobile 联络号码</label><br />
								@if($result->emergencymobile == 'NIL')
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='' />
								@else
									<input type="text" class="input-small"  style="width: 200px; padding: 2px" value='{{$result->emergencymobile}}' />
								@endif
							</div>
						</div>
					</div>
				</div>
			</div><!-- /span -->
			<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable ">
				<div class="widget-box">
					<div class="widget-header widget-header-small">
						<h5>Drug Allegery / Injury </h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<div class="col-xs-12 col-sm-12">
								<label for="drugallergy"> Drug Allergy 药物敏感</label>
								<textarea class="form-control" id="fodrugallergy" style="width: 200px; height: 100px;" / >{{$result->drugallergy}}</textarea>
								<label for="injury"> Injury 伤势或身体情况</label>
								<textarea class="form-control" id="injury" style="width: 200px; height: 100px;"/ >{{$result->medicalhistory}} </textarea>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /span -->
			<div class="col-xs-12 col-sm-8 widget-container-span ui-sortable ">
				<div class="widget-box">
					<div class="widget-header widget-header-small">
						<h5>Others</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<div class="col-xs-12 col-sm-12">
								<br />
								<div class="well well-sm">
									<p style="font-size:12px">
										Are you able to commit to trainings on Wednesdays (from May) and Saturdays (from April)? Yes / No
										<br>
										你是否能配合每个周三（自5月份开始）与周六（自4月份开始）的练习日期与时间?   能/不能
										<br>
										If your answer is "No", kindly understand that the organising commitee will review your application
										<br>
										如是您的答案是“不能”的话，请了解筹委会将检讨您的报名申请
									</p>
								</div>
								<div class="well well-sm">
									<p style="font-size:12px">
										Do you need to travel overseas between 29th March 2014 and 9th August 2014? Yes / No
										<br>
										您自2014年3月29日到8月九日是否需要出国公干？需要 / 不需要   
										<br>
										If your answer is "Yes", kindly stat the period(s) you will be away.
										如果是“需要”，请注明出国的时期:       
									</p>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /span -->
		@endforeach
	</body>
</html>
