<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::all();
        return ItemResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd

        // validate
        $request->validate([
            'codeno'=>'required|min:4',
            'name'=>'required',
            'photo'=>'required',
            'price'=>'required',
            'discount'=>'required',
            'des'=>'required',
            'brand'=>'required',
            'subcategory'=>'required',

        ]);

        // File upload
        $imageName=time().'.'.$request->photo->extension();

        $request->photo->move(public_path('backend/itemimg'),$imageName);
        $myfile='backend/itemimg/'.$imageName;

        // data insert
        $item=new Item;
        $item->codeno=$request->codeno;
        $item->name=$request->name;       
        $item->photo=$myfile;       
        $item->price=$request->price;       
        $item->discount=$request->discount;    
        $item->description=$request->des;    
        $item->brand_id=$request->brand;    
        $item->subcategory_id=$request->subcategory;  
        $item->save();

        // redirect
        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $item=Item::findOrFail($id);
        return new ItemResource($item);
        
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
}
