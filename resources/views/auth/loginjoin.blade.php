@extends('layouts.layoutfront')
@section('content')
<div class="container">
  <div class="heading_container">
    <h2>
      Ingresar al Estudio
    </h2>
  </div>
  <div class="">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <form action="{{ route('login.authjoin') }}" method="POST">
          @csrf
          <div class="contact_form-container">
            <div>
              <div>
                <input type="text" id="username" name="username" placeholder="Nombre de usuario">
              </div>
              <div>
                <input type="password" id="password" name="password" placeholder="Password">
              </div>
              @error('message')
              <div style="text-align:center">
                <span style="color: red">¡Datos Incorrectos, Intente de Nuevo!</span>
              </div>
              @enderror
              <div class=" d-flex justify-content-center ">
                <button type="submit">
                  Login
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
