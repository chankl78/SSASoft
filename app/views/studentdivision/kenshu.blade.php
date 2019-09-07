@extends('studentdivision.layout')

@section('content')
<div class="row">
    <table id="members" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="hidden-480">Name</th>
                <th class="hidden-480">Age</th>
                <th class="hidden-480">Division</th>
                <th class="hidden-480">Institution</th>
                <th class="hidden-480">Position</th>
                <th class="hidden-480">Registered</th>
                <th class="hidden-480">Attended</th>
                <th class="hidden-480">Paid</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function() {
    // Define members table
    var $membersTable = $('#members').DataTable({
        dom: 'lBfrtip',
        ajax: {
            'url': '/StudentDivision/sdMembers',
            'type': 'GET'
        },
        buttons: [
            'excel'
        ]
    });
});
</script>
@stop