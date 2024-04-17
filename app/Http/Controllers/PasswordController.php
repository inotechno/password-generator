<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\Passwords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $generator = new ComputerPasswordGenerator();

        $upper_case = false;
        $lower_case = false;
        $number = false;
        $symbol = false;
        $length = 0;

        if ($request->upper_case) {
            $upper_case = true;
        }

        if ($request->lower_case) {
            $lower_case = true;
        }

        if ($request->number) {
            $number = true;
        }

        if ($request->symbol) {
            $symbol = true;
        }

        if ($request->length) {
            $length = intval($request->length);
        }

        $generator
            ->setLength($length)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_UPPER_CASE, $upper_case)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_LOWER_CASE, $lower_case)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, $number)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_SYMBOLS, $symbol);

        $password = $generator->generatePassword();
        $response = [
            'success' => true,
            'data'  => $password
        ];
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data'  => $validator->errors()
            ];
            return response()->json($response);
        }

        try {
            Password::create([
                'title' => $request->title,
                'password' => $request->password
            ]);

            $response = [
                'success' => true,
                'data'  => 'Copy & Save Success'
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'data'  => $th
            ];
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search()
    {
        return view('search');
    }

    public function search_process(Request $request)
    {
        $passwords = Password::where('title', 'LIKE', '%' . $request->search . '%')->get();
        // dd($passwords);
        if (!empty($passwords)) {
            $response = [
                'success' => true,
                'data'  => $passwords
            ];
            return response()->json($response);
        } else {
            $response = [
                'success' => false,
                'data'  => 'Tidak ada data'
            ];
            return response()->json($response);
        }
    }
}
