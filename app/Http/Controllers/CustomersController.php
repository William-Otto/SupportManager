<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function index()
    {
        $data = Customer::all();
        return Inertia::render('customers', ['data' => $data]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'city_id' => ['required']
        ])->validate();

        Customer::create($request->all());

        return redirect()->back()
        ->with('message', 'Cliente criado com sucesso!');
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'city_id' => ['required']
        ])->validate();

        if ($request->has('id')) {
            Customer::find($request->input('id'))->update($request->all());
            return redirect()->back()
            ->with('message', 'Cliente atualizado com sucesso!');
        }
    }

    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Customer::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
