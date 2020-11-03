<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        $id = request()->route('id');
        return view('manage-product',['id' => $id]);
    }
    public function fetch(){
        $id = request()->route('id');
        $data = Item::with('picture')->where('id',$id)->get();
        return $data;
    }
}
