@extends('studentdivision.layout')

@section('content')
<div class="row">
    <h1>Add SSA Members to SD and Kenshu</h1>
    {{ Form::open(array(
        'action' => null,
        'id' => 'formSearchMember',
        'class' => 'form-horizontal'
        ))
    }}
    {{ Form::text('query', '', array('class' => 'input-lg col-sm-6', 'placeholder' => 'Search for members by name', 'id' => 'query' )); }}
    {{ Form::button(
        '<i class="fa fa-search" aria-hidden="true"></i> Search',
        array(
            'type' => 'search',
            'id' => 'btnSearch',
            'class' => 'btn btn-lg btn-primary',
            'data-loading-text' => '<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i> Searching...'
            )
        );
    }}
    {{ Form::close() }}
</div>
<div id="divWarning" class="alert alert-warning collapse" role="alert">
    
</div>
<div class="row">
    <table id="members" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="hidden-480">Name</th>
                <th class="hidden-480">R</th>
                <th class="hidden-480">Z</th>
                <th class="hidden-480">C</th>
                <th class="hidden-480">D</th>
                <th class="hidden-480">Pos</th>
                <th class="hidden-480">Div</th>
                <th class="hidden-480">NRIC</th>
                <th class="hidden-480">Home</th>
                <th class="hidden-480">Mobile</th>
                <th class="hidden-480">SD</th>
                <th class="hidden-480">Kenshu</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div><!--/row-->

<!-- Add to SD Modal -->
<div id="addToSdModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Member to Student Division</h4>
            </div>
            {{ Form::open(array('action' => null, 'id' => 'formAddMemberToSd', 'class' => 'form-horizontal')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="control-label col-sm-4 col-xs-12">Name: </div>
                    <div class="col-sm-8 col-xs-12" name="addToSdMemberName"></div>
                </div>
                <div class="form-group">
					{{ Form::label('institution', 'Institution:', array('class' => 'control-label col-xs-4')); }}
                    <div class="col-xs-8">
					    {{ Form::select('institution', $sd_inst_options, null, array('class' => 'form-control'));}}
                    </div>
				</div>
                <div class="form-group">
                    {{ Form::label('sdPosition', 'SD Position:', array('class' => 'control-label col-xs-4')); }}
                    <div class="col-xs-8">
                        {{ Form::select('sdPosition', $sd_pos_options, null, array('class' => 'form-control'));}}
                    </div>
                </div>
                {{ Form::hidden('memberid','') }};
            </div>
            <div class="modal-footer">
                <div id="divAddMemberFailure" class="alert alert-danger collapse" role="alert">
                Failed to add member!
                </div>
                {{ Form::submit('Add Member', array('class' => 'btn btn-info'));}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<!-- Add to Kenshu Modal -->
<div id="addToKenshuModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Member to SD Kenshu 2017</h4>
            </div>
            {{ Form::open(array('action' => null, 'id' => 'formAddMemberToKenshu', 'class' => 'form-horizontal')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="control-label col-sm-4 col-xs-12">Name: </div>
                    <div class="col-sm-8 col-xs-12" name="addToKenshuMemberName"></div>
                </div>
                <div class="form-group">
					{{ Form::label('kenshuovernight', 'Overnight:', array('class' => 'control-label col-xs-4')); }}
                    <div class="col-xs-8 btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            {{ Form::radio('kenshuovernight', 1, null, ['id' => 'kenshuovernight-1']) }}
                            Staying Overnight
                        </label>
                        <label class="btn btn-primary active">
                            {{ Form::radio('kenshuovernight', 0, true, ['id' => 'kenshuovernight-0']) }}
                            Not Staying Overnight
                        </label>
                    </div>
				</div>
                {{ Form::hidden('memberid','') }};
            </div>
            <div class="modal-footer">
                <div id="divAddToKenshuFailure" class="alert alert-danger collapse" role="alert">
                Failed to add!
                </div>
                {{ Form::submit('Add Member To Kenshu', array('class' => 'btn btn-info'));}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">

$(document).ready(function() {

    // Callbacks when modals are shown
    $('#addToSdModal').on('show.bs.modal', function(e){
        // Get data-name
        var name = $(e.relatedTarget).data('name');
        $(e.currentTarget).find('div[name="addToSdMemberName"]').html(name);
        // Get data-memberid
        var id = $(e.relatedTarget).data('memberid');
        $(e.currentTarget).find('input[name="memberid"]').val(id);
    });
    $('#addToKenshuModal').on('show.bs.modal', function(e){
        // Get data-name
        var name = $(e.relatedTarget).data('name');
        $(e.currentTarget).find('div[name="addToKenshuMemberName"]').html(name);
        // Get data-memberid
        var id = $(e.relatedTarget).data('memberid');
        $(e.currentTarget).find('input[name="memberid"]').val(id);
    });

    // Define members table
    var $membersTable = $('#members').DataTable({
        "paging": false,
        "searching": false,
        "columnDefs": [
            { "targets": [ 0 ], "data": "name"},
            { "targets": [ 1 ], "data": "rhq"},
            { "targets": [ 2 ], "data": "zone"},
            { "targets": [ 3 ], "data": "chapter"},
            { "targets": [ 4 ], "data": "district"},
            { "targets": [ 5 ], "data": "position"},
            { "targets": [ 6 ], "data": "division"},
            { "targets": [ 7 ], "data": "nric"},
            { "targets": [ 8 ], "data": "tel"},
            { "targets": [ 9 ], "data": "mobile"},
            { "targets": [ 10 ], "data": "sd",
                "render": function (data, type, row) {
                    var a = JSON.parse(data);
                    if (a.length == 0) {
                        html = "<button type='button' data-toggle='modal' data-target='#addToSdModal' ";
                        html += "data-name='" + row.name + "'";
                        html += "data-memberid='" + row.id + "'";
                        html += "class='btn open-AddToSd'>Add to SD</button>"; 
                        return html;
                    } else {
                        return a[0].contactgroup + ' ' + a[0].position;
                    }
                }
            },
            { "targets": [ 11 ], "data": "kenshu",
                "render": function (data, type, row) {
                    var a = JSON.parse(data);
                    if (a.kenshuovernight == null && a.kenshupaid == null) {
                        html = "<button type='button' data-toggle='modal' data-target='#addToKenshuModal' ";
                        html += "data-name='" + row.name + "'";
                        html += "data-memberid='" + row.id + "'";
                        html += "class='btn open-AddToKenshu'>Add to Kenshu</button>"; 
                        return html;
                    } else {
                        html = 'Registered'
                        if (a.kenshuovernight) {
                            html += ', Staying Overnight'
                        } else {
                            html += ', No Overnight'
                        }
                        html += ', ' + a.kenshupaid;
                        return html;
                    }
                }
            }
        ]
    });

    $('#formSearchMember').submit(function (e) {
        // Reset the warning
        $('#divWarning').fadeOut();

        // Set the button to loading state
        var $btn = $('#btnSearch').button('loading');

        $.ajax({
            type: "POST",
            url: "/StudentDivision/searchSsaMembers",
            data: $('#formSearchMember').serialize(),
            success: function(data)
            {
                $btn.button('reset');
                $membersTable.clear().draw();
                $membersTable.rows.add(data).draw();

                if (data.length == 0) {
                    $('#divWarning').html('Warning: 0 members found.').fadeIn();
                } else if (data.length == 6) {
                    $('#divWarning').html('Warning: More than 5 members found, not showing the rest.').fadeIn();
                }
            }
        })

        e.preventDefault();
    });

    $('#formAddMemberToSd').submit(function (e) {
        
        $('#divAddMemberFailure').fadeOut();
        
        $.ajax({
            type: "POST",
            url: "/StudentDivision/addSdMember",
            data: $('#formAddMemberToSd').serialize(),
            success: function(data)
            {
                $('#addToSdModal').modal('hide');
                // Refresh the search datatable
                $('#formSearchMember').trigger('submit');
            },
            error: function(data)
            {
                $('#divAddMemberFailure').fadeIn();
            }
        })

        e.preventDefault();
    });

    $('#formAddMemberToKenshu').submit(function (e) {
        $('#divAddToKenshuFailure').fadeOut();
        $.ajax({
            type: "POST",
            url: "/StudentDivision/addMemberToSdKenshu",
            data: $('#formAddMemberToKenshu').serialize(),
            success: function(data)
            {
                $('#addToKenshuModal').modal('hide');
                // Refresh the search datatable
                $('#formSearchMember').trigger('submit');
            },
            error: function(data)
            {
                $('#divAddToKenshuFailure').fadeIn();
            }
        })

        e.preventDefault();
    });
});
</script>
@stop