<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * <b>Tabela</b>  Atributo responsável em definir qual respectiva tabela no banco de dados representa
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'estate_id'
    ];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
     */
    public $rules = [
        'name'      => 'bail|required',
        'estate_id' => 'bail|required',
    ];

    /**
     * <b>messages</b>  Atributo responsável em definir mensagem de validação de acordo com as regras especificadas no atributo $rules
     */
    public $messages = [
        'name'      => 'Por favor um seu nome.',
        'estate_id' => 'É nescessario um estado.',
    ];

    /**
     * <b>address</b> Método responsável em definir o relacionamento entre as Models de City e Address e suas
     * respectivas tabelas.
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }

    /**
     * <b>state</b> Método responsável em definir o relacionamento entre as Models de State e City e suas
     * respectivas tabelas.
     */
    public function state()
    {
        return $this->belongsTo(Estate::class, "estate_id");
    }
}
