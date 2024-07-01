<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Review;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $sorts = [
            '新着順' => 'created_at desc',
            '価格が安い順' => 'start_price asc',
        ];

        $sort_query = [];
        $sorted = "created_at desc";

        if ($request->has('select_sort')) {
            $slices = explode(' ', $request->input('select_sort'));
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->input('select_sort');
        }

        if($request->category !== null && $keyword !== null)
        {
            $shops = Shop::where('category_id',$request->category)->where('name','like',"%{$keyword}%")->sortable($sort_query)->orderBy('created_at', 'desc')->paginate(16);
            $category = Category::find($request->category);
        }elseif($request->category !== null){
            $shops = Shop::where('category_id',$request->category)->sortable($sort_query)->orderBy('created_at', 'desc')->paginate(16);
            $category = Category::find($request->category);
        }elseif($keyword !== null){
            $shops = Shop::where('name','like',"%{$keyword}%")->sortable($sort_query)->orderBy('created_at', 'desc')->paginate(16);
            $category = null; 
        }else{
            $shops = Shop::sortable($sort_query)->orderBy('created_at', 'desc')->paginate(16);
            $category = null; 
        }

        $categories = Category::all();

        return view('shops.index',compact('shops','category','categories','keyword', 'sorts', 'sorted'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('shops.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = new Shop();
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->start_price = $request->input('start_price');
        $shop->category_id = $request->input('category_id');
        $shop->save();
 
         return to_route('shops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $user = Auth::user();
        $reviews = $shop->reviews()->paginate(8);

        return view('shops.show', compact('shop','reviews','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $categories = Category::all();

        return view('shops.edit', compact('shop','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shop $shop)
    {
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->start_price = $request->input('start_price');
        $shop->category_id = $request->input('category_id');
        $shop->update();
 
         return to_route('shops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(shop $shop)
    {
        $shop->delete();
  
        return to_route('shops.index');
    }

    
}
