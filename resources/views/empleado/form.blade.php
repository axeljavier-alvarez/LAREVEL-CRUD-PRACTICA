    <label for="Nombre">Nombre</label>
    <input type="text" name="nombre" value="{{ isset($empleado->nombre)?$empleado->nombre:'' }}" id="nombre">
    <br>
    <label for="ApellidoPaterno">Apellido Paterno</label>
    <input type="text" name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:'' }}"id="ApellidoPaterno">
    <br>
    <label for="ApellidoMaterno">Apellido Materno</label>
    <input type="text" name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:'' }}" id="ApellidoMaterno">
    <br>
    <label for="Correo">Correo</label>
    <input type="email" name="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo:'' }}" id="Correo">
    <br>
    <label for="Foto">Foto</label>

<!-- ver foto -->
<label for="Foto"></label>
@if(isset($empleado->Foto))
<img src="{{ asset('storage').'/'.$empleado->Foto }}" width="100">
@endif
<input type="file" name="Foto" value=""  id="Foto">

    <br>
    <input type="submit" value="Guardar datos">
