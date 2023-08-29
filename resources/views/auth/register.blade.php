@extends('layouts.layoutfront')
@section('content')
<div class="container">
  <div class="heading_container">
    <h2>
      Registro de Nuevo Usuario
    </h2>
  </div>
  <div class="">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <form action="{{ route('register.store') }}" method="POST">
          @csrf
          <div class="contact_form-container">
            <div>
              <div>
                <input type="text" id="fullname" name="fullname" placeholder="Nombre Completo" required>
              </div>
              @error('fullname')
              <small class="text-danger">¡Solo se permiten letras!</small>
              @enderror
              <div>
                <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required>
              </div>
              <div>
                <input type="password" id="password" name="password" placeholder="Password" required>
              </div>
              <div>
                <input type="password" id="password_confirmation" name="password_confirmation"
                  placeholder="Repetir Password" required>
              </div>
              @error('password')
              <div style="text-align:center">
                <span style="color: red">¡Contraseñas No Coinciden, Intente de Nuevo!</span>
              </div>
              @enderror
              <div>
                <label for="rol">Rol</label>
                <select name="rol" id="rol">
                  <option value="Admin">Admin</option>
                  <option value="Fotografo">Fotografo</option>
                  <option value="Cliente">Cliente</option>
                </select>
              </div>
              <div class=" d-flex justify-content-center ">
                <button type="submit">
                  Registrar
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection