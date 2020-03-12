@extends('layouts.app')

@section('content')


    <div class="container">
        <h2>Adicionar um torcedor</h2>
        <br>

        <form action="{{ url('/fans') }}" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include("site.fans._include._form")

            <button type="submit" class="btn btn-success"style="float: right">Adicionar</button>
        </form>

        <a href="/fans" class="btn btn-danger"style="float: left"> Voltar</a>
        <br>
        <br>
        <br>
    </div>
@endsection