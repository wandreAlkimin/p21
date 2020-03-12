<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;


class Export implements FromArray
{

    public function array(): array
    {
        $users = User::with('address:id,name,neighborhood,cep,city_id','address.city','address.city.state')->select('name','document','telephone','address_id')->first()->get();

        $list = [];

        $list[-1]["NOME"]      = "NOME";
        $list[-1]["DOCUMENTO"] = "DOCUMENTO";
        $list[-1]["CEP"]       = "CEP";
        $list[-1]["ENDEREÇO"]  = "ENDEREÇO";
        $list[-1]["BAIRRO"]    = "BAIRRO";
        $list[-1]["CIDADE"]    = "CIDADE";
        $list[-1]["UF"]        = "UF";
        $list[-1]["TELEFONE"]  = "TELEFONE";
        $list[-1]["E-MAIL"]    = "E-MAIL";
        $list[-1]["ATIVO"]     = "ATIVO";

        foreach ($users as $key => $user){

            $list[$key]["nome"]      = isset($user->name)                      ?$user->name:"";
            $list[$key]["documento"] = isset($user->document)                  ?$user->document:"";
            $list[$key]["cep"]       = isset($user->address->cep)              ?$user->address->cep:"";
            $list[$key]["endereco"]  = isset($user->address->name)             ?$user->address->name:"";
            $list[$key]["bairro"]    = isset($user->address->neighborhood)     ?$user->address->neighborhood:"";
            $list[$key]["cidade"]    = isset($user->address->city->name)       ?$user->address->city->name:"";
            $list[$key]["uf"]        = isset($user->address->city->state->name)?$user->address->city->state->name:"";
            $list[$key]["telefone"]  = isset($user->telephone)                 ?$user->telephone:"";
            $list[$key]["email"]     = isset($user->email)                     ?$user->email:"";

            if($user->active == 1){
                $list[$key]["ativo"] = "SIM";
            }else{
                $list[$key]["ativo"] = "Não";
            }

        }

        return $list;
    }
}