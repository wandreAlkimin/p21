@extends('layouts.app')

@section('content')


    <div class="container">
        <h2>Torcedor: {{$data->name}} ID:{{$data->id}}</h2>
        <br>

        <form action="{{ url('/fans',$data->id) }}" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @method('PUT')

            @include("site.fans._include._form")

            <button type="submit" class="btn btn-success"style="float: right">Atualizar</button>
        </form>

        <a href="/fans" class="btn btn-danger"style="float: left"> Voltar</a>
        <br>
        <br>
        <br>
    </div>
@endsection