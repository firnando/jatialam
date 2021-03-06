<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Inventory;
use App\Item;

use DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $test = $request->input('test');
        $lists = Inventory::where('cat_delete', NULL)->orderBy('created_at','desc')->search($test)->paginate(10);
  

        return view ('inventory.index')->with('lists',$lists);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lists = new Inventory;
        $lists->cat_name = $request->input('cat_name');
        $lists->cat_code = $request->input('cat_code');
        $lists->length = $request->input('length');
        $lists->width = $request->input('width');
        $lists->keterangan = $request->input('keterangan');



 
        $lists->save();
 
        return redirect('/inventory')->with('success','Successfully Added');
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
    public function destroy(Request $request)
    {
      
    }

    public function delete(Request $request)
    {
      
        $date = date('Y-m-d');
        $delets = $request->delete;
        
       
    
      
    
        $deletes = DB::table('inventorylists')->where('id',$delets);
        $deletes->cat_delete = $date;

        $deletes = DB::table('inventorylists')->where('id',$delets)->delete();
      
        return redirect('/inventory')->with('success', 'Item removed');
    }
}
