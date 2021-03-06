<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Inventory;
use App\Item;

use DB;

class ItemController extends Controller 
{
    public function itemShow($id){

        $items = Inventory::find($id)->item;
    
        return view('inventory.item.show')->with(compact('items','status'));
       
    }

    public function store(Request $request) {
        $items = new Item;
        $items->item_name = $request->input('item_name');
        $items->item_measurement = $request->input('item_measurement'); 
        $items->inventory_id = $request->input('inventory_id');
        $items->item_qty = $request->input('item_qty');
        $items->item_length = $request->input('item_length');
        $items->item_width = $request->input('item_width');
        $items->item_height = $request->input('item_height');
        $items->item_assembly = $request->input('item_assembly');
        $items->item_description = $request->input('item_description');

        $items->save();
        return redirect('/inventory');
    }

    public function createe()
    {
        $lists = Inventory::all();

        if (count($lists != NULL)) {
           
           $lists = Inventory::where('cat_delete',NULL)->get();
           return View('inventory.item.create')->with('items',$lists); 
        } else {
            return view('inventory.create');
        }
       
       
    }

    

    
}
