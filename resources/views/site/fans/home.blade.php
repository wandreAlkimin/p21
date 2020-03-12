@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="col-md-11">
            <h1> Torcedores </h1>
            <p>Quantidade: {{count($data)}}</p>

            <a href="/fans/create" class="btn btn-success"style="float: left"> Adicionar</a>

            <form action="/exportar" method="get">
                <button type="submit" class="btn btn-warning" style="float: right">Exportar torcedores</button>
            </form>
            <br>
            <br>
            <br>
        </div>


        <input class="form-control" id="searchTable" type="text" placeholder="Search..">
        <br>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Documento</th>
                <th>Telefone</th>
                <th>Editar</th>
            </tr>
            </thead>
            <tbody id="tableTorcedores">
            @foreach($data as $list)
                <tr>
                    <td>{{$list->name}}</td>
                    <td>{{$list->email}}</td>
                    <td data-mask="000.000.000-00" minlength="14">{{$list->document}}</td>
                    <td data-mask="(00) 0 0000-0000" minlength="16" >{{$list->telephone}}</td>

                    <td>
                        <form action="{{ url('/fans',$list->id) }}" method="GET" >
                            <button type="submit" class="btn btn-success">Editar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
@endsection