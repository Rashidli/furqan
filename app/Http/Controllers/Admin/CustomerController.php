<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {

        $customers = Customer::paginate(10);
        return view('admin.customers.index', compact('customers'));

    }


    public function customerRegistrationsPerDay()
    {
        $registrations = Customer::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($registrations, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(Customer $customer)
//    {
//
//        $customer->delete();
//        return redirect()->route('customers.index')->with('message', 'Customer deleted successfully');
//
//    }
}
