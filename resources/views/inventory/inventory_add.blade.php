@extends('layouts.master')

@section('title', 'Add Item')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>New Item</strong>
    </div>

    <form action="{{route('inventory.item.create')}}" method="post" class="form-horizontal">
        <div class="card-body card-block">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="unit_id" class="form-control">
                            <option>Select Unit</option>
                            @foreach ($units as $unit)
                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">Perishable</label>
                            <input class="form-check-input" type="checkbox" name="perishable">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
            <button type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Reset
            </button>
        </div>
    </form>
</div>

<div class="card">
        <div class="card-header">
            <strong class="card-title">Item List</strong>
        </div>
        <div class="card-body">

            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Perishable</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->category}}</td>
                        <td>{{$item->unit}}</td>
                        <td>
                            @if ($item->perishable)
                            <span class="badge badge-danger">Yes</span>
                            @else
                            <span class="badge badge-success">No</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-outline-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
