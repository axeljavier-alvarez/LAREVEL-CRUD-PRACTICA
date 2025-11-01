    <h1> {{  $modo }} empleado</h1>

    @if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
    @endforeach
        </ul>
    </div>

    @endif
<div class="form-group">
 <label for="Nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre') }}" id="nombre">
    </div>

    <br>
    <div class="form-group">
        <label for="ApellidoPaterno">Apellido Paterno</label>
    <input type="text"  class="form-control"  name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno') }}"id="ApellidoPaterno">
</div>
    <br>
<div class="form-group">
  <label for="ApellidoMaterno">Apellido Materno</label>
    <input type="text"  class="form-control"  name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno') }}" id="ApellidoMaterno">
</div>
    <br>
<div class="form-group">
   <label for="Correo">Correo</label>
    <input type="email"  class="form-control"  name="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo') }}" id="Correo">
    </div>
    <br>
<div class="form-group">
 <label for="Foto">Foto</label>

<!-- ver foto -->
<label for="Foto"></label>
@if(isset($empleado->Foto))
<img src="{{ asset('storage').'/'.$empleado->Foto }}" width="100">
@endif
<input class="form-control" type="file" name="Foto" value=""  id="Foto">

    </div>

    <br>
    <input class="btn btn-success" type="submit" value="{{ $modo}} datos">
<a class="btn btn-primary" href="{{ url('empleado') }}">Regresar</a>

