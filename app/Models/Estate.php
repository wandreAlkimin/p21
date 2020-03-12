<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    /**
     * <b>Tabela</b>  Atributo responsável em definir qual respectiva tabela no banco de dados representa
     */
    protected $table = 'estates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
     */
    public $rules = [
        'name'   => 'bail|required',
    ];

    /**
     * <b>messages</b>  Atributo responsável em definir mensagem de validação de acordo com as regras especificadas no atributo $rules
     */
    public $messages = [
        'name'   => 'Por favor insira um nome.',
    ];

    /**
     * <b>city</b> Método responsável em definir o relacionamento entre as Models de City e Estate e suas
     * respectivas tabelas.
     */
    public function city()
    {
        return $this->hasMany(City::class);
    }
}
