@extends('studentdivision.layout')

@section('content')
<div class="row">
    <h1>Statistics - Total Kenshu Attendees</h1>
    <div class="col-md-6 col-xs-12">
        <h2>YMD</h2>
        <table id="ym_statistics" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="hidden-480">Institution</th>
                    <th class="hidden-480">Total</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-md-6 col-xs-12">
        <h2>YWD</h2>    
        <table id="yw_statistics" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="hidden-480">Institution</th>
                    <th class="hidden-480">Total</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
$(document).ready(function() {

    $('#ym_statistics').DataTable({
        paging: false,
        searching: false,
        ajax: {
            url: '/StudentDivision/getStatistics',
            data: {'division': 'YM'}
        }
    });

    $('#yw_statistics').DataTable({
        paging: false,
        searching: false,
        ajax: {
            url: '/StudentDivision/getStatistics',
            data: {'division': 'YW'}
        }
    })
});
</script>
@stop