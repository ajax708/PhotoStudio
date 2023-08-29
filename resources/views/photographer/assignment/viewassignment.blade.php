@php
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\EventController;
@endphp
@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>EVENTOS Y FOTOGRAFOS</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Listado de eventos con sus respectivos fotografos</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            #
                                        </th>
                                        <th style="width: 20%">
                                            Nombre del Evento
                                        </th>
                                        <th style="width: 30%">
                                            Fotografos Asignados
                                        </th>
                                        <th>
                                            Horas de Trabajo
                                        </th>
                                        <th style="width: 8%" class="text-center">
                                            Estado
                                        </th>
                                        <th style="width: 20%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                {{ $event->event_name }}
                                            </a>
                                            <br />
                                            <small>
                                                {{ $event->event_startdate }} - {{ $event->event_endate }}
                                            </small>
                                        </td>
                                        <td>
                                            <?php
                                                $photographers = AssignmentController::auxiliar($event->id)
                                            ?>
                                            <ul class="list-inline">
                                                @foreach($photographers as $photographer)
                                                <li class="list-inline-item">
                                                    @if(!empty($photographer->user->image))
                                                    <img src="{{ URL::asset('/photos/'.$photographer->user->image)}}"
                                                        class="table-avatar" alt="user">
                                                    @else
                                                    <img src="{{asset('img/user2-160x160.jpg')}}" class="table-avatar"
                                                        alt="Sin Image">
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a>
                                                <?php echo EventController::subhours($event->event_starthour, $event->event_endhour)?>
                                            </a>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">
                                                <?php echo AssignmentController::auxiliar2($event->event_startdate, $event->event_endate, $event->id)?>
                                            </span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('assign.profile', $event->id) }}">
                                                <i class="fas fa-users">
                                                </i>
                                                Perfiles
                                            </a>
                                            @can('assign.destroy')
                                            <form action="{{ route('assign.destroy', $event->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection