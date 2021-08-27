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
        $cpfs = Cpf::select(['cpf', 'created_at'])->paginate();
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

        //verifíca se o cpf é válido
        if(!$cpf->validate($cpf->cpf)) {
            $content = [
                'type' => "InvalidCpfException",
                'message' => "CPF is not valid."
            ];

            return response()->json($content);

        }

        $cpf_exists = Cpf::where('cpf', $cpf->cpf)->get();

        if(count($cpf_exists) > 0) {
            $content = [
                'type' => "ExistsCpfException",
                'message' => "CPF exists."
            ];

            return response()->json($content);
        }

        $cpf->save();

        $content = ["cpf" => $cpf->cpf, "created_at" => $cpf->created_at];
        return response()->json($content, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cpf)
    {
        $document = new Cpf();

        //verifíca se o cpf é válido
        if(!$document->validate($this->document_clear($cpf))) {
            $content = [
                'type' => "InvalidCpfException",
                'message' => "CPF is not valid."
            ];

            return response()->json($content);

        }

        $cpf_exists = Cpf::where('cpf', $this->document_clear($cpf))->first();

        //verifíca se existe um cpf
        if(!$cpf_exists) {
            $content = [
                'type' => "NotFoundCpfException",
                'message' => "CPF not found."
            ];

            return response()->json($content, 404);
        }

        $content = [
            'cpf' => $cpf_exists['cpf'],
            'created_at' => $cpf_exists['created_at']
        ];

        return response()->json($content);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cpf)
    {
        $document = new Cpf();

        //verifíca se o cpf é válido
        if(!$document->validate($this->document_clear($cpf))) {
            $content = [
                'type' => "InvalidCpfException",
                'message' => "CPF is not valid."
            ];

            return response()->json($content);

        }

        $cpf = Cpf::where('cpf', $this->document_clear($cpf))->first();

        //verifíca se existe um cpf
        if(!$cpf) {
            $content = [
                'type' => "NotFoundCpfException",
                'message' => "CPF not found."
            ];

            return response()->json($content, 404);
        }

        $cpf->delete();

        return response()->json([], 200);
    }

    private function document_clear($cpf)
    {
        return preg_replace('/[^0-9]/is', '', $cpf);
    }
}
