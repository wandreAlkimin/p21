<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * <b>Tabela</b>  Atributo responsável em definir qual respectiva tabela no banco de dados representa
     */
    protected $table = 'adresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'neighborhood',
        'cep',
        'city_id'
    ];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
     */
    public $rules = [
        'name'          => 'bail|nullable',
        'neighborhood'  => 'bail|nullable',
    ];

    /**
     * <b>messages</b>  Atributo responsável em definir mensagem de validação de acordo com as regras especificadas no atributo $rules
     */
    public $messages = [
        'name'         => 'Por favor insira seu nome.',
        'neighborhood' => 'Por favor insira seu bairro.'
    ];


    /*
     * Você também pode encontrar situações em que deseja atualizar um modelo existente ou criar um novo modelo
     * */
    public static function createUpdate($request,$id = null){

        $data = Address::updateOrCreate(
            ['id'   => $id], // Campo para comparação
            [
                'name'         => $request->input('addressName'),
                'neighborhood' => $request->input('neighborhood'),
                'cep'          => $request->input('cep'),
                'city_id'      => $request->input('cidade')
            ]
        );

        return $data;
    }


    /**
     * <b>user</b> Método responsável em definir o relacionamento entre as Models de User e Address e suas
     * respectivas tabelas.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * <b>city</b> Método responsável em definir o relacionamento entre as Models de Address e City e suas
     * respectivas tabelas.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
