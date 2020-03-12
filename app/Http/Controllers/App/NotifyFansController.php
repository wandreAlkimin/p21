<?php

namespace App\Http\Controllers\App;

use App\User;
Use App\Notifications\NotificarTorcedores;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Notification;
use Session;

class NotifyFansController extends Controller
{

    public function index(){

        return view('site.fans.notify');
    }

    public function notificar(Request $request){

        $info['assunto'] = $request->input('assunto');
        $info['mensagem'] = $request->input('mensagem');

        $users = User::all();

        foreach($users as $key => $user){
            // Por motivos de testes só será enviado email para os 5 primeiros
            if($key < 5){
               $user->notify(new NotificarTorcedores($info));
               sleep(5);
            }

        }

        Session::flash('msg', 'Todos os torcedores foram notificados com sucesso.');
        return redirect('/notificar-torcedores');
    }

}
