<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', [
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $newProduct = Product::create($request->all());

        var_dump($request->file('photo'));

        if (!empty($request->file('photo'))) {
            $newProduct->photo = $request->file('photo')->storeAs('products/' . $newProduct->id, str_replace('.', '', microtime(true)) . '.' . $request->file('photo')->extension());
            $newProduct->save();
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where("id", $id)->first();

        return view("products.edit", [
            "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::where("id", $id)->first();

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->inventory = $request->inventory;
        $product->price = $request->price;
        $product->save();

        if (!empty($request->file('photo'))) {
            $product->photo = $request->file('photo')->storeAs('product/' . $product->id, str_replace('.', '', microtime(true)) . '.' . $request->file('photo')->extension());
            $product->save();
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where("id", $id)->first();
        $product->delete();

        return redirect()->route('products.index');
    }

}
