<?php

namespace App\Http\Controllers\App;

use App\Models\Address;
use App\Models\Estate;
use App\User;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;

class FansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('name', 'asc')->get();

        return view("site.fans.home", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['estados'] = Estate::all();
        return view("site.fans.create", compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $this->replace($request);

        $address = Address::createUpdate($request);

        $request->merge(['address_id' => $address->id]);

        $user    = User::createUpdate($request);


        // Session flash: Armazena itens apenas para a proxima solicitação.
        Session::flash('msg', 'Inserido com sucesso');
        return redirect("/fans");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);

        return view("site.fans.show", compact('data'));
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
        $request = $this->replace($request);

        $user    = User::createUpdate($request,$id);

        $address = Address::createUpdate($request,$request->input('address_id'));


        // Session flash: Armazena itens apenas para a proxima solicitação.
        Session::flash('msg', 'Atualizado com sucesso');
        return redirect("/fans");
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

    /**
     * replace function.
     * @param $request
     * @return Request
     */
    public function replace($request)
    {
        $documento = preg_replace('/\D/', '', $request->input('document'));
        $telephone = preg_replace('/\D/', '', $request->input('telephone'));
        $cep       = preg_replace('/\D/', '', $request->input('cep'));

        $request->merge(['document'  => $documento]);
        $request->merge(['telephone' => $telephone]);
        $request->merge(['cep'       => $cep]);

        return $request;
    }

        /**
     * Retorna as cidades de um estado.
     * getCidades function.
     * @return array
     */
    public function getCidades($idEstado)
    {
        $estados = Estate::find($idEstado);
        $cidades = $estados->city()->getQuery()->get(['id', 'name']);
        foreach ($cidades as $key => $state) {
            $cidades[$key]['id'] = $state->id;
            $cidades[$key]['name'] = mb_convert_case($state->name, MB_CASE_TITLE, "UTF-8");
        }

        return Response::json($cidades);
    }
}
