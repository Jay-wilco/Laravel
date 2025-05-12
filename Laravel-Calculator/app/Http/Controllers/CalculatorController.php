<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Calculator;


class CalculatorController extends Controller
{
    //

    public function showForm()

    {
        return view('calculator.calculator');
    }

    public function calculate(Request $request)
    {

        $validatedData = $request->validate([

            'operand1' => 'required|numeric',

            'operand2' => 'required|numeric',

            'operator' => 'required|in:add, subtract, multiply, divide',

        ]);

        $calculator = new Calculator($validatedData['operand1'], $validatedData['operand2']);


        $result = $calculator->{$validatedData['operator']}();

        return view('calculator.result', ['result' => $result]);
    }
}
