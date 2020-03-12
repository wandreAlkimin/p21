<?php

namespace App;

use App\Models\Address;
use App\Models\Estate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * <b>Tabela</b>  Atributo responsável em definir qual respectiva tabela no banco de dados representa
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'document',
        'telephone',
        'active',
        'address_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
     */
    public $rules = [
        'name'      => 'bail|required',
        'email'     => 'bail|required',
        'document'  => 'bail|nullable',
        'telephone' => 'bail|nullable'
    ];

    /**
     * <b>custonAttributes</b>  Altera o nome do atributo.
     */
    public $custonAttributes = [
        'name' => 'nome'
    ];

    /*
     * Você também pode encontrar situações em que deseja atualizar um modelo existente ou criar um novo modelo
     * */
    public static function createUpdate($request ,$id = null){

        $user = User::updateOrCreate(
            ['id'   => $id], // Campo para comparação
            [
                'name'       => $request->input('name'),
                'email'      => $request->input('email'),
                'document'   => $request->input('document'),
                'telephone'  => $request->input('telephone'),
                'active'     => $request->input('active'),
                'address_id' => $request->input('address_id')
            ]
        );

        return $user;
    }


    /**
     * <b>Adress</b> Método responsável em definir o relacionamento entre as Models de User e Adress e suas
     * respectivas tabelas.
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
