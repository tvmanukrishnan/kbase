<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\District;
use App\Area;

class MasterController extends Controller
{
    public function getState()
    {
        return State::all();
    }

    public function getDistrict($state_id)
    {
        return District::select('id', 'name')
            ->where('state_id', $state_id)
            ->get();
    }

    public function getArea($district_id)
    {
        return Area::select('id', 'name')
            ->where('district_id', $district_id)
            ->get();
    }
}
