<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    public function addToCart(Request $request, $id) {
        $product = DB::table('products')->where('id', $id)->first();

        $check = DB::table('p_o_s')->where('pro_id', $id)->first();

        if($check) {
            DB::table('p_o_s')->where('pro_id', $id)->increment('pro_quantity');

            $product = DB::table('p_o_s')->where('pro_id', $id)->first();
            $subtotal = $product->pro_quantity * $product->pro_price;
            DB::table('p_o_s')->where('pro_id', $id)->update(['subtotal' => $subtotal]);

        } else {
        $data = array();
        $data['pro_id'] = $id;
        $data['pro_name'] = $product->product_name;
        $data['pro_quantity'] = 1;
        $data['pro_price'] = $product->selling_price;
        $data['subtotal'] = $product->selling_price;

        DB::table('p_o_s')->insert($data);
        }
       
    }

    public function cartProduct() {
       $cart = DB::table('p_o_s')->get();
        return response()->json($cart);
    }

    public function removeCart($id) {
        DB::table('p_o_s')->where('id', $id)->delete();
        return response('Deleted');
    }

    public function increment($id) {
        $quantity = DB::table('p_o_s')->where('id', $id)->increment('pro_quantity');

        $product = DB::table('p_o_s')->where('id', $id)->first();
        $subtotal = $product->pro_quantity * $product->pro_price;
        DB::table('p_o_s')->where('id', $id)->update(['subtotal' => $subtotal]);
        return response('Incremented');
    }

    public function decrement($id) {
        $quantity = DB::table('p_o_s')->where('id', $id)->decrement('pro_quantity');

        $product = DB::table('p_o_s')->where('id', $id)->first();
        $subtotal = $product->pro_quantity * $product->pro_price;
        DB::table('p_o_s')->where('id', $id)->update(['subtotal' => $subtotal]);
        return response('Incremented');
    }

    public function vat() {
        $vats = DB::table('extras')->first();
        return response()->json($vats);
    }

    
}
