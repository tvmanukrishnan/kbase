<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Stock;
use App\Unit;
use Illuminate\Http\Request;
use Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::getAllCategoriesOrdered();
        $items = Item::Join('categories', 'items.category_id', '=', 'categories.id')
            ->join('units', 'items.unit_id', '=', 'units.id')
            ->select('items.id', 'items.name', 'categories.name as category', 'units.name as unit', 'items.perishable')
            ->get();
        $units = Unit::all();
        return view('inventory.inventory_add', compact('categories', 'items', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'name' => 'required',
            'unit_id' => 'required|numeric',
        ]);
        if ($v->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('status', 'warning')
                ->with('message', $v->errors());
        } else {
            $item = new Item;
            $item->category_id = $request->category_id;
            $item->name = $request->name;
            $item->unit_id = $request->unit_id;
            $item->perishable = $request->perishable;
            if ($item->save()) {
                return redirect()->back()
                    ->with('status', 'success')
                    ->with('message', 'Item added succesfully');
            }
            return redirect()->back()
                ->withInput()
                ->with('status', 'danger')
                ->with('message', 'Failed adding Item');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource, based on camp.
     *
     * @return \Illuminate\Http\Response
     */
    public function stock(Request $request, $id, $camp_id)
    {
        $item = Item::find($id);
        if ($item) {
            $stock = $item->getStock($camp_id);
            if ($stock) {
                return view('inventory.inventory_camps', compact('categories', 'items', 'item', 'stock'));
            }
            return view('inventory.inventory_camps', compact('categories'))
                ->with('status', 'warning')
                ->with('message', 'No stock for item ' . $item->name);
        }
        return view('inventory.inventory_camps', compact('categories'));
    }

    /**
     * Update item stock for a camp.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockUpdate(Request $request, $id, $camp_id)
    {
        $v = Validator::make($request->all(), [
            'availability' => 'numeric|required_without_all:requirement',
            'requirement' => 'numeric|required_without_all:availability',
        ]);
        if ($v->fails()) {
            $data['meta']['status'] = 0;
            $data['meta']['message'] = "Failed updating Inventory item stock. Required fields are missing.";
            $data['data'] = $v->errors();
            return response($data, 400);
        } else {
            $item = Item::find($id);
            if ($item->updateStock($camp_id, $request->availability, $request->requirement)) {
                $data['meta']['status'] = 1;
                $data['meta']['message'] = "Stock status for camp updated successfully";
                return response($data, 200);
            }
            $data['meta']['status'] = 0;
            $data['meta']['message'] = "Failed updating stock status for camp";
            return response($data, 400);
        }
    }

    public function campStock(Request $request, $camp_id)
    {

    }

}
