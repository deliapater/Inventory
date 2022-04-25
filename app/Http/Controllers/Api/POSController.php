<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DateTime;

class POSController extends Controller
{
    public function getProduct($id) {
        $product = DB::table('products')
            ->where('category_id',$id)
            ->get();
        return response()->json($product);
    }

    public function submitOrder(Request $request) {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'payBy' => 'required',
        ]);

        $data = array();
        $data['customer_id'] =  $request->customer_id;
        $data['qty'] =  $request->qty;
        $data['subtotal'] =  $request->subtotal;
        $data['vat'] =  $request->vat;
        $data['total'] =  $request->total;
        $data['pay'] =  $request->pay;
        $data['due'] =  $request->due;
        $data['payBy'] =  $request->payBy;
        $data['order_date'] =  date('d/m/Y');
        $data['order_month'] = date('F');
        $data['order_year'] =  date('Y');
        $order_id = DB::table('orders')->insertGetId($data);

        $contents = DB::table('p_o_s')->get();

        $orders_data = array();
        foreach($contents as $content) {
            $orders_data['order_id'] = $order_id;
            $orders_data['product_id'] = $content->pro_id;
            $orders_data['pro_qty'] = $content->pro_quantity;
            $orders_data['pro_price'] = $content->pro_price;
            $orders_data['subtotal'] = $content->subtotal;
            $orders_data['order_id'] = $order_id;
            DB::table('order_details')->insert($orders_data);

            DB::table('products')->where('id', $content->pro_id)
                ->update(['product_quantity' => DB::raw('product_quantity - ' . $content->pro_quantity)]);
        }
        DB::table('p_o_s')->delete();
        return response('Order submitted');
    }

    public function searchOrderDate(Request $request) {
        $orderDate = $request->date;
        $newDate = new DateTime($orderDate);
        $done = $newDate->format('d/m/Y');

        $order =  DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->select('customers.name', 'orders.*')
            ->where('orders.order_date', $done)
            ->get();
        return response()->json($order);
    }

    public function todaySell() {
        $date = date('d/m/Y');
        $sell = DB::table('orders')->where('order_date', $date)
            ->sum('total');   
            return response()->json($sell);
    }

    public function todayIncome() {
        $date = date('d/m/Y');
        $income = DB::table('orders')->where('order_date', $date)
            ->sum('pay');   
            return response()->json($income);
    }

    public function todayDue() {
        $date = date('d/m/Y');
        $due = DB::table('orders')->where('order_date', $date)
            ->sum('due');   
            return response()->json($due);
    }

    public function todayExpense() {
        $date = date('d/m/Y');
        $expense = DB::table('expenses')->where('expense_date', $date)
            ->sum('amount');   
            return response()->json($expense);
    }

    public function outOfStock() {
        $products = DB::table('products')->where('product_quantity', '<', '1')->get();
        return response()->json($products);
    }
}
