<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    public function paid(Request $request, $id) {
        $validateData = $request->validate([
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = DB::table('salaries')->where('employee_id', $id)->where('salary_month', $month)
        ->first();
        if($check){
            return response()->json('Salary already paid');
        }
        else {
            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->salary;
            $data['salary_date'] = date('d/m/Y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');
            DB::table('salaries')->insert($data);
        }
    }

    public function allSalaries() {
        $salary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->
        get();

        return response()->json($salary);
    }

    public function viewSalary($id) {
        $month = $id;
        $salary = DB::table('salaries')
        ->join('employees', 'salaries.employee_id', 'employees.id')
        ->select('employees.name', 'salaries.*')
        ->where('salaries.salary_month', $month)->get();
        return response()->json($salary);
    }

    public function editSalary($id) {
    
        $salary = DB::table('salaries')
        ->join('employees', 'salaries.employee_id', 'employees.id')
        ->select('employees.name', 'employees.email', 'salaries.*')
        ->where('salaries.id', $id)->first();
        return response()->json($salary);
    }

    public function updateSalary(Request $request, $id) {
        $data = array();
        $data['employee_id'] = $request->employee_id;
        $data['amount'] = $request->amount;
        $data['salary_month'] = $request->salary_month;

        DB::table('salaries')->where('id', $id)->update($data);
    }

    // public function updateStock(Request $request, $id) {
    //     $data = array();
    //     $data['product_quantity'] = $request->product_quantity;
    //     DB::table('products')->where('id', $id)->update($data);
    // }
}
