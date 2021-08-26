<?php

namespace App\Http\Controllers\api;

use App\Models\Cpf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CpfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cpfs = Cpf::paginate(10);
        return response()->json($cpfs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cpf = new Cpf();

        $cpf->cpf = $request->cpf;
        $cpf->validate($cpf->cpf);

        $cpf_exists = Cpf::select('cpf')->where('cpf', $cpf->clearField($cpf->cpf))->get();

        if($cpf_exists) {
            return response()->json('ExistsCpfException');
        }

        $cpf->save();

        return response()->json($cpf, 200);
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
}
