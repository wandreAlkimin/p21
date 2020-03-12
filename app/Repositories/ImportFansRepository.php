<?php

namespace App\Repositories;

use App\Imports\UsersImport;
use App\Models\Address;
use App\Models\City;
use App\Models\Estate;
use App\User;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class ImportFansRepository
{

    public function verifications($request){

        // Verifica se existe um arquivo é se ele é do tipo XML
        if($request->hasFile('import_file') && Input::file('import_file')->getClientOriginalExtension() == "xml" ) {

            //Pega o caminho real e faz a leitura do arquivo
            $path = Input::file('import_file')->getRealPath();
            $data = file_get_contents($path);
            $xml = simplexml_load_string($data);

            //Verifica se o documento é valido.
            if(isset($xml->torcedor[0])){

                $xml1 = $xml->torcedor;
                $list = [];

                // Recria a lista transformando em string
                foreach($xml1 as $key1 => $row){
                    foreach($row->attributes() as $key2 => $item){
                        $item = (string) $item;
                        $list[$key1][$key2] = $item;
                    }
                }

                return $list;
            }

            
        }

        // Verifica se o arquivo é um xlsx
        if(Input::hasFile('import_file') && Input::file('import_file')->getClientOriginalExtension() == "xlsx" ) {

            $data = Excel::toArray(new UsersImport,Input::file('import_file'));

            // Verifica se os campos estão na ordem certa
            if($data[0][0][0] == "NOME" &&  $data[0][0][9] == "ATIVO"){

                $list = [];
                // Renomeia os campos
                foreach ($data[0] as $key => $user){

                    if($key > 0){

                        $user[1] = substr($user[1], 2);

                        $list[$key]['nome']      = $user[0];
                        $list[$key]['documento'] = $user[1];
                        $list[$key]['cep']       = $user[2];
                        $list[$key]['endereco']  = $user[3];
                        $list[$key]['bairro']    = $user[4];
                        $list[$key]['cidade']    = $user[5];
                        $list[$key]['uf']        = $user[6];
                        $list[$key]['telefone']  = $user[7];
                        $list[$key]['email']     = $user[8];


                        if($user[9] == "SIM"){
                            $list[$key]['ativo'] = "1";
                        }else{
                            $list[$key]['ativo'] = "0";
                        }
                    }
                }

                //Destroi a variavel
                unset($data);

                return $list;

            }

        }

        return false;
    }

    public function creatUpdateList($row){
        
        // Cria ou atualiza o modelo Estate
        $estate = Estate::updateOrCreate(
            ['name' => $row['uf']], // Campo para comparação
            [
                'name' => $row['uf']
            ]
        );

        // Cria ou atualiza o modelo City
        $city = City::updateOrCreate(
            ['name' => $row['cidade']], // Campo para comparação
            [
                'name' => $row['cidade'],
                'estate_id' => $estate->id
            ]
        );

        // Cria ou atualiza o modelo Address
        $address = Address::updateOrCreate(
            ['name' => $row['endereco']], // Campo para comparação
            [
                'name'         => $row['endereco'],
                'neighborhood' => $row['bairro'],
                'cep'          => $row['cep'],
                'city_id'      => $city->id
            ]
        );

        // Cria ou atualiza o modelo User
        $user = User::updateOrCreate(
            ['document' => $row['documento']], // Campo para comparação
            [
                'name'       => $row['nome'],
                'email'      => $row['email'],
                'document'   => $row['documento'],
                'telephone'  => $row['telefone'],
                'active'     => $row['ativo'],
                'address_id' => $address->id
            ]
        );

        return $user;        
    }

    public function replace($row){
       
        foreach($row as $key => $item){
            // Retira cacacteres especiais dos numeros
            if($key == 'documento'| $key == 'telefone' | $key == 'cep' ){
                $row[$key] = preg_replace('/\D/', '', $item);
            }

            // Retorna 0, caso o campo venha vazio.
            if(empty($item)){
                $row[$key] = '0';
            }           
        }

        //Retorna os ultimos 11 caracteres.
        $row['documento'] = substr($row['documento'], -11);

        return $row;
    }

    public function processEstate($row)
    {
        $estate = Estate::query()
            ->where('name', $row['uf'])
            ->get()
            ->first();

        if (!$estate) {
            $estate = Estate::create([
                'name' => $row['uf']
            ]);
        }

        return $estate;
    }


    public function processCity($row,$estate)
    {
        $city = City::query()
            ->where('name', $row['cidade'])
            ->get()
            ->first();

        if (!$city) {
            $city = City::create([
                'name'      => $row['cidade'],
                'estate_id' => $estate->id
            ]);
        }

        return $city;
    }

    public function processAddress($row,$city)
    {
        $address = Address::query()
            ->where('name', $row['endereco'])
            ->get()
            ->first();

        if (!$address) {
            $address = Address::create([
                'name'         => $row['endereco'],
                'neighborhood' => $row['bairro'],
                'cep'          => $row['cep'],
                'city_id'      => $city->id
            ]);
        }
        else{

            // Atualiza os dados existentes.
            $address->name         = $row['endereco'];
            $address->neighborhood = $row['bairro'];
            $address->cep          = $row['cep'];
            $address->save();
        }

        return $address;
    }

    public function processUser($row,$address)
    {
        $user = User::query()
            ->where('document', $row['documento'])
            ->get()
            ->first();

        if (!$user) {
            $user = User::create([
                'name'       => $row['nome'],
                'email'      => $row['email'],
                'document'   => $row['documento'],
                'telephone'  => $row['telefone'],
                'active'     => $row['ativo'],
                'address_id' => $address->id
            ]);

        }else{

            // Atualiza os dados existentes.
            $user->name      = $row['nome'];
            $user->email     = $row['email'];
            $user->telephone = $row['telefone'];
            $user->active    = $row['ativo'];
            $user->save();
        }

        return $user;
    }


}