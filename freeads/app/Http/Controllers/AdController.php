<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Ad;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::all();

        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $id_user = Auth::id();

            $this->validate($request, [
                'title' => 'required|max:255',
                'details' => 'required|max:255',
                'price' => 'required',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            //$request->photo->store('public/images');
            $file = $request->photo;
            $filename = $request->photo->getClientOriginalName();
            //$extension = $request->photo->getClientOriginalExtension();

            Storage::disk('public')->put($filename, File::get($file));

            $ad = Ad::create([
                'title' => $request->title,
                'details' => $request->details,
                'price' => $request->price,
                'photo' => $filename,
                'id_user' => $id_user
            ]);
            //dd($request->photo->getClientOriginalExtension());
            $ad->save();

            return redirect()->route('ad.index')->with('success', 'Your ad is online !');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::find($id);

        return view('ads.show', compact('ad'));
    }
        /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $ads = Ad::where('id_user', $id_user = Auth::id())->get();
        return view('ads.list', compact('ads'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = Ad::find($id);
        
        return view('ads.edit', compact('ad'));
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'details' => 'required|max:255',
            'price' => 'required',
            //'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $ad = Ad::find($id);
        $ad->title = $request->title;
        $ad->details = $request->details;
        $ad->price = $request->price;
            // 'photo' => $filename,
            // 'id_user' => $id_user
       
        //dd($request->photo->getClientOriginalExtension());
        $ad->save();

        return redirect()->route('ad.list')->with('success', 'Ad updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ad::find($id);
        $ad->delete();

        return redirect()->route('ad.list')->with('success', 'Ad deleted !');
    }
        /**
     * Remove the specified resource from storage.
     *  @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        dd('caca');
        $ads = Ad::where('title', 'LIKE', '%'.$request->search.'%')->get();

        //return view('ads.index', compact($ads));
        return redirect()->route('ad.search');
    }
}
