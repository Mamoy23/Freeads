<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required'
        ]);

        
        $file = $request->photo;
        $file2 = $request->photo2;
        $file3 = $request->photo3;
        $filename = $request->photo->getClientOriginalName();
        $filename2 = $request->photo2->getClientOriginalName();
        $filename3 = $request->photo3->getClientOriginalName();

        Storage::disk('public')->put($filename, File::get($file));
        Storage::disk('public')->put($filename2, File::get($file2));
        Storage::disk('public')->put($filename3, File::get($file3));

        $ad = Ad::create([
            'title' => $request->title,
            'details' => $request->details,
            'price' => $request->price,
            'photo' => $filename,
            'photo2' => $filename2,
            'photo3' => $filename3,
            'id_user' => $id_user,
            'category' => $request->category
        ]);
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
     * Search ads
     *  @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->search;
        $maxprice = $request->maxprice;
        $minprice = $request->minprice;
        $category = $request->category;

        $ads = Ad::where('title', 'like', '%'.$search.'%')
                ->when($maxprice, function ($query, $maxprice) {
                    return $query->where('price', '<=', $maxprice);
                })
                ->when($minprice, function ($query, $minprice) {
                    return $query->where('price', '>=', $minprice);
                })
                ->when($category, function ($query, $category) {
                    return $query->where('category', $category);
                })
                ->get();

        return view('ads.index', compact('ads'));
    }

    /**
     * Search recents ads.
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    public function searchRecent()
    {
        $ads = Ad::latest()->get();

        return view('ads.index', compact('ads'));
    }
    /**
     * Matching
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function matching(Request $request)
    {
        $match = $request->look;
        $maxprice = $request->maxprice;
        $is_post = $request->method() == 'POST';

        if($is_post){
            $ads = Ad::when($match, function ($query, $match) {
                return $query->where('category', $match);
            })
            //$ads = Ad::all()->where('category', $match)
            ->when($maxprice, function ($query, $maxprice) {
                return $query->where('price', '<=', $maxprice);
            })
            ->get();
        }
        return view('ads.match', compact('ads', 'is_post'));
    }
}
