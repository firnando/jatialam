<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CuttingStage;
use App\Item;
use App\Status;

class CuttingStageController extends Controller
{
    public function index(){
        $cuttings = CuttingStage::where('deleted_at',NULL)->paginate(10);
        return view('CuttingStage.index')->with('cuttings',$cuttings);
    }

    public function create(){
        $items = Item::all();
        $status = Status::all();
        return view('CuttingStage.create')->with('items',$items)->with('status',$status);
    }

    public function store(Request $request){
        
        $item_array = array();
        $amount_array = array();
        $status_array = array();

        $item_array = $request->input('item_id');
        $amount_array = $request->input('amount');
        $status_array = $request->input('status');
        $time = time();
        $ref_id = srand($time);

        for($counter = 0; $counter < sizeof($item_array);$counter++){
            $cutting = new CuttingStage;
            $cutting->item_id = $item_array[$counter];
            $cutting->amount = $amount_array[$counter];
            $cutting->status = $status_array[$counter];
            $cutting->reference_id = $ref_id;
            $cutting->save();
        }
        
        return redirect('cuttings')->with('success','Process created');

    }
    
    public function show($reference_id){

        $cuttings = CuttingStage::where('reference_id',$reference_id)->where('deleted_at',NULL)->get();
        
        if($cuttings != NULL){
            return view('CuttingStage.show')->with('cuttings',$cuttings)->with('reference_id',$reference_id);
        }
        else{
            return redirect('cuttings')->with('error','Data not found');
        }

    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){
        $cuttings = CuttingStage::where('reference_id',$reference_id)->get();
        $date = date('Y-m-d H:i:s');
        foreach($cuttings as $cutting){
            $cutting->deleted_at = $date;
            $cutting->save();
        }

        return redirect('cuttings')->with('success','Item Deleted');
    }
}