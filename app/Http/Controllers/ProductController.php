<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list of datas form db, create page and navigate 5 rows per page by page
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        //create a new product
        Product::create($request->all());

        //redirect the user send friendly message
        return redirect()->route('products.index')->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, Product $product)
    {
        //update all data with put
        //validate the input
        try{
            DB::beginTransaction();
            $request->validate([
                'name' => 'required',
                'detail' => 'required'
            ]);

            //create a new product
            $product->update($request->all());

            //redirect the user send friendly message
            DB::commit();
            return redirect()->route('products.index')->with('success','Product Updated successfully');
        }catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //delete product
        try{
            DB::beginTransaction();
            $product->delete();
            DB::commit();
            return redirect()->route('products.index')->with('success','Product deleted successfully');

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }

    }
}
