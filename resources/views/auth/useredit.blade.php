@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mi Perfil</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if(!empty($user->image))
                                <img src="{{ URL::asset('/photos/'.$user->image)}}"
                                    class="profile-user-img img-fluid img-circle" alt="user">
                                @else
                                <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                                    alt="Sin Image">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $user->fullname }}</h3>

                            <p class="text-muted text-center">Rol {{ $user->rol }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Editar
                                        Datos</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Editar
                                        Password</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <form enctype="multipart/form-data" class="form-horizontal"
                                        action="{{ route('user.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <label for="fullname" class="col-sm-2 col-form-label">Nombre
                                                Completo</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="fullname" id="fullname"
                                                    value="{{ $user->fullname }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 col-form-label">Nombre de
                                                Usuario</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="username" id="username"
                                                    value="{{ $user->username }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="user_image" class="col-sm-2 col-form-label">Imagen</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="user_image" id="user_image" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Editar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="password">
                                    <form  class="form-horizontal"
                                        action="{{ route('pass.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Nueva
                                                Contraseña</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password" id="password"
                                                    placeholder="Nueva Contraseña">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-sm-2 col-form-label">Repetir
                                                Contraseña</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                                    placeholder="Repetir Contraseña">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Modificar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection