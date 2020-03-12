@extends('layouts.app')

@section('content')


    <div class="container">
        <h2>Todos os tocedores serão notificar via email.</h2>
        <br>

        <form action="{{ url('/notificar-torcedores') }}" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-xs-12">
                <div class="form-group col-xs-7">
                    <label for="Nome">Assunto</label>
                    <input class="form-control input-sm" id="assunto" type="text" name="assunto" value="" required autofocus>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group col-xs-7">
                    <label for="Documento">Mensagem</label>
                    <textarea class="form-control" rows="5" id="mensagem" name="mensagem" required autofocus></textarea>
                    <br>

                </div>
            </div>
            <div class="form-group col-xs-8">
                <button data-toggle="modal" data-target="#carregando" type="submit" class="btn btn-success"style="float:left ">Enviar Mensagem</button>
            </div>

        </form>
        <div class="form-group col-xs-2">
            <a href="/fans" class="btn btn-danger" style="float:right;"> Voltar</a>
        </div>
    </div>

    <div class="container text-center">
        <div class="col-md-11 text-center"  >
            <div id="carregando" class="modal fade"  data-backdrop="static">
                <div class="modal-dialog" data-backdrop="static">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body">
                            <h3> Processando, aguarde... </h3>
                        </div>
                        <div >
                            <img src="{!! asset('img/loading.gif') !!}" height="140px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection