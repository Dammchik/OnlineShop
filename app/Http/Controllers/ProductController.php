<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->authorizeResource(Product::class);
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $name = $request->input('name');
//        $price = $request->input('price');
//        $description = $request->input('description');
//        $article = $request->input('article');
//
//        $product = new Product();
//        $product->name = $name;
//        $product->price = $price;
//        $product->description = $description;
//        $product->article = $article;
//        $product -> save();
//        Product::create([
//            'name' => $name,
//            'price' => $price,
//            'description' => $description,
//            'article' => $article
//        ]);

        $validated = \Validator::validate($request->input(), rules: [
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|min:3',
            'article' => 'required|unique:products,article'
        ]);


        $product = Product::create($validated);

        return redirect()->route('products.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.view')
            ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit')
            ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = \Validator::validate($request->input(), [
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|min:3',
            'article' => [
                'required',
                Rule::unique('products', 'article')->ignore($product->id),
            ]
        ]);

        $product->update($validated);
        return redirect()->route('products.edit', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('products.index'));
    }
}
