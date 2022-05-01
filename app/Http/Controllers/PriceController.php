<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function listPrice(Request $request){
        $price = ProductPrice::paginate(10);

        return view('admin.price.list', compact('price'));
    }

    public function addPrice(Request $request){
        return view('admin.price.add');
    }

    public function addPricePost(Request $request){
        if($request->has('id')){
            $id = $request->get('id');
            $price = ProductPrice::where('id', $id)->update([
                'name' => $request->name,
                'min_price' => str_replace(',', '', $request->min_price),
                'max_price' => str_replace(',', '', $request->max_price),
            ]);

            return redirect()->route('admin.price.edit', ['id' => $id]);
        }else{
            $price = ProductPrice::create(
                [
                    'name' => $request->get('name'),
                    'min_price' => str_replace(',', '', $request->min_price),
                    'max_price' => str_replace(',', '', $request->max_price),
                ]
            );

            return redirect()->route('admin.price.edit', ['id' => $price->id]);
        }
    }

    public function editPrice(Request $request, $id){
        $price = ProductPrice::findOrFail($id);

        return view('admin.price.edit', compact('price'));
    }
}
