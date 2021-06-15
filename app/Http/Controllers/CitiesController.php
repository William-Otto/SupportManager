<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class CitiesController extends Controller
{
    public function index()
    {
        $data = City::all();
        return Inertia::render('cities', ['data' => $data]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();

        City::create($request->all());

        return redirect()->back()
        ->with('message', 'Cidade criada com sucesso!');
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            City::find($request->input('id'))->update($request->all());
            return redirect()->back()
            ->with('message', 'Cidade atualizada com sucesso!');
        }
    }

    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            City::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
