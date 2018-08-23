@extends('layouts.master')

@section('title', 'Users')

@section('styles')
<link rel="stylesheet" href="{{URL::asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <strong class="card-title">User List</strong>
    </div>
    <div class="card-body">

    <form method="get" action="{{route('user.list')}}">
            <div class="row">
                <div class="col col-xs-12 col-sm-3">
                    <select name="state" class="form-control" id="state">
                        <option>Select State</option>
                        @foreach ($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <select name="district" class="form-control" id="district">
                        <option>Select District</option>
                    </select>
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <select name="area" class="form-control" id="area">
                        <option>Select City/Area</option>
                    </select>
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <hr />
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Camps</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td></td>
                    <td></td>
                    <td>
                        <span class="badge badge-success">Active</span>
                        <span class="badge badge-success">Verified</span>
                    </td>
                    <td>
                        <a class="btn btn-outline-primary">Edit</a>
                        <a class="btn btn-outline-danger">Block</a>
                        <a class="btn btn-outline-warning">Reset Password</a>
                        <a class="btn btn-outline-info">Assign Camp</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{URL::asset('assets/js/lib/data-table/datatables.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/data-table/datatables-init.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#bootstrap-data-table').DataTable();
    });
</script>
<script>
    $ = jQuery.noConflict();

    $("#state").on('change', function(e){
        var state = $("#state").val();
        $.ajax({
            url : "/district/" + state,
            dataType: "json",
            success : function(data){
                $('#district').empty()
                $("#district").append('<option>Select District</option>');
                $.each(data, function(id, value){
                    $("#district").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });

    $("#district").on('change', function(e){
        var district = $("#district").val();
        $.ajax({
            url : "/area/" + district,
            dataType: "json",
            success : function(data){
                $('#area').empty()
                $("#area").append('<option>Select City/Area</option>');
                $.each(data, function(id, value){
                    $("#area").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
</script>
@endsection
