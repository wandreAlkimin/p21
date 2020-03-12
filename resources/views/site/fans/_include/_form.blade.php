@php
    if(!isset($data)){
        $data = null;
    }
@endphp


<div class="form-group col-xs-7">
    <label for="Nome">Nome</label>
    <input class="form-control input-sm" id="nome" type="text" name="name" minlength="4" value="{{old('name')}} @isset($data->name){{$data->name}}@endisset"  autofocus>
</div>
<div class="form-group col-xs-5">
    <label for="Documento">Documento</label>
    <input class="form-control input-sm" id="documento" type="text" name="document" data-mask="000.000.000-00" minlength="14" maxlength="14" value="@isset($data->document){{$data->document?: ''}}@endisset" >
</div>
<div class="form-group col-xs-7">
    <label for="email">Email</label>
    <input class="form-control input-sm" id="email" type="email" name="email" value="@isset($data->email){{$data->email?: ''}}@endisset" required autofocus>
</div>
<div class="form-group col-xs-3">
    <label for="telefone">Telefone</label>
    <input class="form-control input-sm" id="telefone" type="text" name="telephone" data-mask="(00) 0 0000-0000" minlength="16" maxlength="16" value="@isset($data->telephone){{$data->telephone?: ''}}@endisset" required autofocus>
</div>

<div class="form-group col-xs-2">
    <label for="Ativo">Ativo</label>
    <select class="form-control input-sm"  name="active" data-mask-selectonfocus="true"  >
        <option value="0" @isset($data->active) @if($data->active == 0)selected @endif @endisset> Não</option>
        <option value="1" @isset($data->active) @if($data->active == 1)selected @endif @endisset> Sim </option>
    </select>
</div>

<div class="form-group col-xs-7">
    <label for="endereco">Endereco</label>
    <input class="form-control input-sm" id="endereco" type="text" name="addressName"  value="@isset($data->address->name){{$data->address->name?: ''}}@endisset" required autofocus >
    <input class="form-control input-sm" id="endereco" type="hidden" name="address_id"  value="@isset($data->address->id){{$data->address->id?: ''}}@endisset" >
</div>
<div class="form-group col-xs-5">
    <label for="bairro">Bairro</label>
    <input class="form-control input-sm" id="bairro" type="text" name="neighborhood"  value="@isset($data->address->neighborhood){{$data->address->neighborhood?: ''}}@endisset" required autofocus>
</div>

<div class="form-group col-xs-4">
    <label for="Estado">Estado</label>
    <select class="form-control input-sm"  name="estado" required autofocus data-mask-selectonfocus="true">
        <option value=" @isset($data->address->city->state->id) {{$data->address->city->state->id?: ''}}@endisset" selected> @isset($data->address->city->state->name) {{$data->address->city->state->name?: ''}}@endisset</option>
        @isset($data['estados'])
            @foreach($data['estados'] as $key =>$estado)
                <option value="{{$estado->id}}">{{$estado->name}}</option>
            @endforeach
        @endisset
    </select>
</div>

<div class="form-group col-xs-4">
    <label for="Cidade">Cidade</label>
    <select required class="form-control input-sm"  name="cidade"   >
        <option value=" @isset($data->address->city->id) {{$data->address->city->id?: ''}}@endisset" selected> @isset($data->address->city->name){{$data->address->city->name?: ''}}@endisset</option>
        <option> </option>
    </select>
</div>


<div class="form-group col-xs-4">
    <label for="cep">CEP</label>
    <input class="form-control input-sm" id="cep" type="text" name="cep" data-mask="00000-000" minlength="9" maxlength="9" value="@isset($data->address->cep){{$data->address->cep?: ''}}@endisset" required autofocus>
</div>