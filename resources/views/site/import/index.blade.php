@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="jumbotron">
            <h2>Bem vindo a P21</h2>
            <p>Instruções: Faça o upload da lista excel ou atualize os dados fazendo o upload do XML</p>
        </div>
    </div>

    <div class="container text-center">

        <div class="col-md-11 text-center"  >
            <form  action="{{ route('importar-usuarios') }}"  method="post" enctype="multipart/form-data" class="form-horizontal" style="margin-top: 15px;padding: 10px; float: left;">
                {{ csrf_field() }}
                <input class="btn"  type="file" name="import_file" style="float: left" id="selecionarArquivo" required  readonly />
                <button class="btn btn-primary " data-toggle="modal" data-target="#carregando"  disabled="disabled" id="submit">Importar arquivo</button>
            </form>

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

    <br>

@endsection
