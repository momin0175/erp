<?php

namespace App\Http\Controllers;

use App\Models\Production_product;
use Illuminate\Http\Request;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;
class ProductionProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'product & service')->get()->pluck('name', 'id');
        $category->prepend('Select Category', '');
        $productServices = ProductService::where('created_by', '=', \Auth::user()->creatorId())->with(['category', 'unit'])->get();
        $products = Production_product::join('product_services', 'production_products.product_id', '=', 'product_services.id')
        ->where('product_services.created_by', \Auth::user()->creatorId())
        ->orderBy('production_products.production_date', 'desc')
        ->select('production_products.*', 'product_services.name')
        ->get();
        return view('production_product.index', compact('products', 'productServices', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'product & service')->get()->pluck('name', 'id');
       
        $productServices = ProductService::where('created_by', '=', \Auth::user()->creatorId())->get();
       
      
        return view('production_product.create',  compact('productServices', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       
        $productService = ProductService::find($request->product_id);

        if ($productService) {
            // Add new quantity to old quantity
            $productService->quantity += $request->quantity;
            $productService->save(); // Save updated quantity
        }

        $selected_date = date('Y-m-d', strtotime($request->select_date));
        $production_product = new Production_product();
        $production_product->product_id = $request->product_id;
        $production_product->thikness = $request->thikness;
        $production_product->gsm = $request->gsm;
        $production_product->weight = $request->weight;
        $production_product->dia = $request->dia;
        $production_product->size = $request->size;
        $production_product->proter_sort = $request->porter_sort;
        $production_product->qty = $request->quantity;
        $production_product->production_date = $selected_date;
        $production_product->shift = $request->shift;
        $production_product->save();
        return redirect()->route('production.index')->with('success', __('Production data successfully inserted.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Production_product $production_product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {


        $category = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 'product & service')->get()->pluck('name', 'id');
        $category->prepend('Select Category', '');
        $productServices = ProductService::where('created_by', '=', \Auth::user()->creatorId())->with(['category', 'unit'])->get();
        

       
      
       $production_product_data = Production_product::join('product_services', 'production_products.product_id', '=', 'product_services.id')
        ->where('production_products.id', $id)
        ->select('production_products.*', 'product_services.name')
        ->get(); 
        return view('production_product.edit', compact('productServices', 'category', 'production_product_data'));
           
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $request->validate([
        'product_id' => 'required|exists:product_services,id',
        'select_date' => 'required|date',
        'quantity' => 'required|numeric',
        // add other validation rules as needed
        ]);

        $productService = ProductService::find($request->product_id);
        if ($productService) {
            // Add new quantity to old quantity
            $productService->quantity -= $request->old_qty;
            $productService->save(); // Save updated quantity
        }

        if ($productService) {
            // Add new quantity to old quantity
            $productService->quantity += $request->quantity;
            $productService->save(); // Save updated quantity
        }



        $selected_date = date('Y-m-d', strtotime($request->select_date));

        // Find the existing production_product by ID
        $production_product = Production_product::findOrFail($id);

        // Update its fields
        $production_product->product_id = $request->product_id;
        $production_product->thikness = $request->thikness;
        $production_product->gsm = $request->gsm;
        $production_product->weight = $request->weight;
        $production_product->dia = $request->dia;
        $production_product->size = $request->size;
        $production_product->proter_sort = $request->porter_sort;
        $production_product->qty = $request->quantity;
        $production_product->production_date = $selected_date;
        $production_product->shift = $request->shift;

        // Save the updated model
        $production_product->save();

        // Optional: redirect or return success
        return redirect()->back()->with('success', 'Production Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
         $production_product = Production_product::find($id);

        $productService = ProductService::find($production_product->product_id);
        if ($productService) {
            // Add new quantity to old quantity
            $productService->quantity -= $production_product->qty;
            $productService->save(); // Save updated quantity
        }

        if (\Auth::user()->can('delete product & service')) {
            $production_product = Production_product::find($id);
            $production_product->delete();
            return redirect()->back()->with('success', __('Production Product successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
