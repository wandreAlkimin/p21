<div class="container">
    <div  id="msg">
        @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissable">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{Session::get('msg')}}
            </div>
        @endif
        @if(Session::has('msgErro'))
            <div class="alert alert-danger alert-dismissable">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{Session::get('msgErro')}}
            </div>
        @endif
    </div>

    @if(isset($errors) && count($errors) > 0)
        <br>
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{$erro}}</li>
                @endforeach
            </ul>
        </div>
        <br>
    @endif

</div>
