@extends('layouts.master')

@section('title', 'User Registration')

@section('content')
<div class="login-form">
    <form action="{{route('user.create')}}" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" placeholder="Full Name" name="name" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Password Again" name="password_confirmation" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control" placeholder="Phone Number" name="phone_no" required>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option>Select Gender</option>
                                <option value="m">Male</option>
                                <option value="f">Female</option>
                                <option value="t">Transgender</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" class="form-control" placeholder="Age" name="age">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" placeholder="Address" name="address" rows="3" required></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>State</label>
                    <select name="state" class="form-control" id="state">
                        <option>Select State</option>
                        @foreach ($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>District</label>
                    <select name="district" class="form-control" id="district">
                        <option>Select District</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-6 col-md-6">
                <div class="form-group">
                    <label>City/Area</label>
                    <select name="area" class="form-control" id="area">
                        <option>Select City/Area</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>GPS Coordinates</label>
                    <div class="row">
                        <div class="col col-xs-6">
                            <input type="text" class="form-control" placeholder="Latitude" name="lat">
                        </div>
                        <div class="col col-xs-6">
                            <input type="text" class="form-control" placeholder="Longitde" name="long">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option>Select Role</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Add User</button>
    </form>
</div>

@endsection

@section('scripts')
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
