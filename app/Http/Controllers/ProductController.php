<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use App\Models\Category;
use App\Models\PriceType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    private $_getColumns = (['id', 'category_id', 'name', 'slug', 'image', 'description', 'is_active']);

    public function index()
    {
        $products = Product::with('category','prices')->OrderByIdDescending()->get($this->_getColumns);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::FilterIsActive()->get(['id', 'name']);
        $priceTypes = PriceType::FilterIsActive()->get(['id', 'name']);

        return view('products.create', compact(['categories', 'priceTypes']));
    }

    public function store(StoreProductRequest $request)
    {
        try {
                DB::transaction(function () use($request) {

                    $imageName = NULL;

                    if($request->hasFile('image')){
                        $image = $request->file('image');
                        $imageName = $this->_getFileName($image->getClientOriginalExtension());
                        $image->move(public_path('product-images'), $imageName);
                    }

                    $product = new Product; 

                    $product->name = $request->name;
                    $product->category_id = $request->category_id;
                    $product->slug = Str::slug($request->name);
                    $product->image = $imageName;
                    $product->description = $request->description;

                    $product->save();

                    $getAllPrices = $request->amount;
                    $price_type_ids = $request->price_type_id;
                    $start_date = $request->start_date;
                    $end_date = $request->end_date;

                    $values = [];
                    $cd=date('Y-m-d H:i:s');

                    if(($getAllPrices !== NULL) && ($price_type_ids !== NULL)){
                        foreach ($getAllPrices as $index => $amount) {
                            $values[] = [
                                'product_id' => $product->id,
                                'amount' => $amount,
                                'price_type_id' => $price_type_ids[$index],
                                'start_date' => $start_date[$index],
                                'end_date' => $end_date[$index],
                                'created_at' => $cd,
                                'updated_at' => $cd,
                            ];
                        }
                    }

                    if ( ($amount !== NULL) && ($price_type_ids[$index] !== NULL) ){
                        $product->prices()->insert($values);
                    }
                });

            } catch (QueryException $e) {

                return redirect()->route('products.index')->with(['errorMsg' => $e->getMessage()]);
            }

        return redirect()->route('products.index')->with('status', 'Product has been created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::FilterIsActive()->get(['id', 'name']);
        $priceTypes = PriceType::FilterIsActive()->get(['id', 'name']);

        return view('products.edit', compact(['product', 'categories', 'priceTypes']));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::transaction(function () use($request, $product) {
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = $this->_getFileName($image->getClientOriginalExtension());
                    $image->move(public_path('product-images'), $imageName);

                    if ($product->image !== NULL) {
                        if (file_exists(public_path('product-images/'. $product->image ))) {
                            unlink(public_path('product-images/'. $product->image ));
                        }
                    }

                    $product->image = $imageName;
                }

                $product->name = $request->name;
                $product->category_id = $request->category_id;
                $product->slug = Str::slug($request->name);
                $product->description = $request->description;
                
                $product->update();

                $product_price_ids = $request->product_price_id;
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                
                $cd=date('Y-m-d H:i:s');

                if($product_price_ids){
                    for ($i = 0; $i < count($product_price_ids); $i++) {

                        $values = [
                            'product_id' => $product->id,
                            'amount' => $request->amount[$i],
                            'start_date' => $start_date[$i],
                            'end_date' => $end_date[$i],
                            'updated_at' => $cd
                        ];

                        $check_id = Price::find($product_price_ids[$i]);

                        if ($check_id) {
                            $product->prices()->where('id', $check_id->id)->update($values);
                        }
                    }
                }

                $price_type_new_ids = $request->price_type_new_id;
                $new_start_date = $request->new_start_date;
                $new_end_date = $request->new_end_date;

                    if($price_type_new_ids){
                        for ($i = 0; $i < count($price_type_new_ids); $i++) {
                            $values2 = [
                                'product_id' => $product->id,
                                'amount' => $request->new_amount[$i],
                                'price_type_id' => $request->price_type_new_id[$i],
                                'start_date' => $new_start_date[$i],
                                'end_date' => $new_end_date[$i],
                                'created_at' => $cd,
                                'updated_at' => $cd,
                            ];

                            if ( ($request->new_amount[$i] !== NULL) && ($request->price_type_new_id[$i] !== NULL) ){
                            $product->prices()->insert($values2);
                            }
                        }
                    }
                });

            } catch (QueryException $e) {

                return redirect()->route('products.index')->with(['errorMsg' => $e->getMessage()]);
            }

        return redirect()->route('products.index')->with('status','Product has been Updated Successfully !');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('status','Product has been deleted successfully !');
    }

    public function changeStatus(Product $product)
    {
        $product->is_active = !$product->is_active;
        
        $product->update();

        return redirect()->route('products.index')->with('status','Product active status has been changed successfully !');
    }

    public function priceListDestroy($price_id)
    {
        $price = Price::find($price_id);
        $price->delete();

        return redirect()->back()->with('status','Price has been changed successfully !');
    }

    private function _getFileName($fileExtension){

        // Image name format is - p-05042022121515.jpg
        return 'p-'. date("dmYhis") . '.' . $fileExtension;
    }
}
