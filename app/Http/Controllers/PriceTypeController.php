<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use Illuminate\Http\Request;
use App\Http\Requests\PriceType\StorePriceTypeRequest;
use App\Http\Requests\PriceType\UpdatePriceTypeRequest;

class PriceTypeController extends Controller
{
    private $_getColumns = (['id', 'name', 'is_active']);
    
    public function index()
    {
        $priceTypes = PriceType::get($this->_getColumns);

        return view('price-types.index', compact('priceTypes'));
    }

    public function create()
    {
        return view('price-types.create');
    }

    public function store(StorePriceTypeRequest $request)
    {
        $priceType = new PriceType; 

        //insert data
        $priceType->name = $request->name;

        //save to database
        $priceType->save();

        return redirect()->route('priceTypes.index')->with('status', 'Price Type has been created successfully.');
    }

    public function show(PriceType $priceType)
    {
        return view('price-types.show', compact('priceType'));
    }

    public function edit(PriceType $priceType)
    {
        return view('price-types.edit', compact('priceType'));
    }

    public function update(UpdatePriceTypeRequest $request, PriceType $priceType)
    {
        //insert data
        $priceType->name = $request->name;

        //save to database
        $priceType->update();

        return redirect()->route('priceTypes.index')->with('status', 'Price Type has been updated successfully.');
    }

    public function destroy(PriceType $priceType)
    {
        $priceType->delete();

        return redirect()->route('priceTypes.index')->with('status','Price Type has been deleted successfully !');
    }

    public function changeStatus(PriceType $priceType)
    {
        
        $priceType->is_active = !$priceType->is_active;
        

        $priceType->update();

        return redirect()->route('priceTypes.index')->with('status','Price Type active status has been changed successfully !');
    }
}
