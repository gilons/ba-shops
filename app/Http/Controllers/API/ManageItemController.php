<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ManageItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function fetch()
    {
        return Item::with('picture')->latest()->take(100)->get();

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "string|required",
            "cost" => "numeric|min:1|required",
            "photo" => $request->id ? "" : "required",
        ]);
        $data = Item::updateOrCreate([
            'id' => $request->id ?? null,
        ], [
            'name' => $request->name,
            'description' => $request->description,
            'cost' => $request->cost,
            'user_id' => Auth::id(),
        ]);
        if (isset($request->photo)) {
            $url = $this->UpdatePicture($request);
            Picture::updateOrCreate([
                'item_id' => $data->id,
            ], [
                'url' => $url,
            ]);

            $data->photo = $url;

        }
        return $data;

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
        Picture::where('item_id',$id)->delete();
        $item = Item::findorfail($id);
        $item->delete();
    }

    public function UpdatePicture(Request $request)
    {

        $file = $request->file('photo');
        $imagePath = '/public/clients';
        $fileName = $file->getClientOriginalName();
        $file->move(public_path($imagePath), $fileName);
        return URL::asset($imagePath . '/' . $fileName);
    }

}
