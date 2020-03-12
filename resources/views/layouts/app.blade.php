<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js">

    <script>
        window.Laravel ={!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body>

@include('layouts.topo')
@include('layouts.errors')
<main>
    @yield('content')
</main>
@include('layouts.rodape')

<!-- Scripts -->
<script src="/js/app.js"></script>
<script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.13'><\/script>".replace("HOST", location.hostname));
    //]]></script>


<script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.13'><\/script>".replace("HOST", location.hostname));
    //]]></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>

<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function(){
        $("#selecionarArquivo").click(function(){
            $("#submit").removeAttr('disabled');
        });

        setTimeout(function() {
            $('#msg').fadeOut('fast');
        }, 15000);

    }, false);


    $('select[name=estado]').change(function () {

        var idEstado = $(this).val();
        var idEstado1 = parseInt(idEstado);

        $.get('/getCidades/' + idEstado1, function (cidades) {
            $('select[name=cidade]').empty();

            $.each(cidades, function (key, value) {
                $('select[name=cidade]').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
    });

    // Filtro da tabela
    $(document).ready(function(){
        $("#searchTable").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableTorcedores tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

</script>



</body>
</html>

