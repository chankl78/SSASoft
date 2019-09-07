@extends('studentdivision.layout')

@section('content')
<div class="row">
    <h1>Register Member for Kenshu</h1>
    {{ Form::open(array(
        'action' => null,
        'id' => 'formSearchMember',
        'class' => 'form-horizontal'
        ))
    }}
    {{ Form::text('nric', '', array('class' => 'input-lg col-sm-6', 'placeholder' => 'Type or scan NRIC...', 'id' => 'nric' )); }}
    {{ Form::button(
        '<i class="fa fa-search" aria-hidden="true"></i> Register',
        array(
            'type' => 'search',
            'id' => 'btnSearch',
            'class' => 'btn btn-lg btn-primary',
            'data-loading-text' => '<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i> Loading...'
            )
        );
    }}
    {{ Form::close() }}
</div>
<div id="divSuccess" class="alert alert-success collapse" role="alert"></div>
<div id="divWarning" class="alert alert-warning collapse" role="alert"></div>

<div class="row">
    <table id="attendance" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="hidden-480">Name</th>
                <th class="hidden-480">Division</th>
                <th class="hidden-480">Paid</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="attendanceModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Attendance for SD Kenshu</h4>
            </div>
            {{ Form::open(array('action' => null, 'id' => 'formAttendance', 'class' => 'form-horizontal')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="control-label col-sm-4 col-xs-12">Name: </div>
                    <div class="col-sm-8 col-xs-12" name="attendanceMemberName"></div>
                </div>
                <div class="form-group">
					{{ Form::label('kenshupaid', 'Paid:', array('class' => 'control-label col-xs-4')); }}
                    <div class="col-xs-8 btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            {{ Form::radio('kenshupaid', 1, null, ['id' => 'kenshupaid-1']) }}
                            Yes
                        </label>
                        <label class="btn btn-primary active">
                            {{ Form::radio('kenshupaid', 0, true, ['id' => 'kenshupaid-0']) }}
                            No
                        </label>
                    </div>
				</div>
                {{ Form::hidden('memberid','') }};
                {{ Form::hidden('eventregid','') }};
            </div>
            <div class="modal-footer">
                <div id="divAttendanceFailure" class="alert alert-danger collapse" role="alert">
                Failed to add attendance!
                </div>
                {{ Form::submit('Add Attendance', array('class' => 'btn btn-info'));}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">

$(document).ready(function() {

    // Define attendance table
    var $attendanceTable = $('#attendance').DataTable({
        'ajax': {
            'url': '/StudentDivision/getAttendanceList',
            'type': 'GET'
        }
    });

    $('#formAttendance').submit(function (e) {
        
        $('#divAttendanceFailure').fadeOut();
        
        $.ajax({
            type: "POST",
            url: "/StudentDivision/addAttendance",
            data: $('#formAttendance').serialize(),
            success: function(data)
            {
                $('#attendanceModal').modal('hide');
                // Refresh the attendance datatable
                $attendanceTable.ajax.reload();
            },
            error: function(data)
            {
                $('#divAttendanceFailure').fadeIn();
            }
        })

        e.preventDefault();
    });

    $('#formSearchMember').submit(function (e) {
        // Reset the info divs
        $('#divSuccess').fadeOut();
        $('#divWarning').fadeOut();

        // Set the button to loading state
        var $btn = $('#btnSearch').button('loading');

        $.ajax({
            type: "POST",
            url: "/StudentDivision/checkNric",
            data: $('#formSearchMember').serialize(),
            success: function(data)
            {
                $btn.button('reset');
                $('#divSuccess').html('Already registered attendance!').fadeIn();
            },
            error: function(data)
            {
                $btn.button('reset');
                if (data.responseJSON.memberid == null) {
                    $('#divWarning').html('Member not in SSA database!').fadeIn();
                } else if (data.responseJSON.kenshuregistration == 0) {
                    $('#divWarning').html('Member not registered for SD Kenshu!').fadeIn();
                } else {
                    // Prepare the attendance modal
                    $('#attendanceModal').find('div[name="attendanceMemberName"]').html(data.responseJSON.name);
                    $('#attendanceModal').find('input[name="memberid"]').val(data.responseJSON.memberid);
                    $('#attendanceModal').find('input[name="eventregid"]').val(data.responseJSON.kenshuregistration);
                    $('#attendanceModal').modal('show');
                }
            }
        })

        e.preventDefault();
    });
});
</script>
@stop