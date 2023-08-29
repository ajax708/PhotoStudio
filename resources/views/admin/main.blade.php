@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Accesos Directos</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @can('event.show')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Nº</h3>

                <p>Eventos</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="{{ route('event.show') }}" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          <!-- ./col -->
          @can('assign.show')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Nº</h3>

                <p>Asignaciones</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('assign.show') }}" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          <!-- ./col -->
          @if(auth()->user()->rol == 'Fotografo' || auth()->user()->rol == 'Admin' )
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Nº</h3>

                <p>Calendario de Eventos</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="{{ route('event.calendar') }}" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endif
          <!-- ./col -->
          @can('photo.showtoadmin')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Nº</h3>

                <p>Galeria de Fotos</p>
              </div>
              <div class="icon">
                <i class="ion ion-images"></i>
              </div>
              <a href="{{ route('photo.showtoadmin') }}" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          @can('detect.show')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>Nº</h3>

                <p>Mis Fotos</p>
              </div>
              <div class="icon">
                <i class="ion ion-images"></i>
              </div>
              <a href="{{ route('detect.show') }}" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          @can('photo.show')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Nº</h3>

                <p>Fotos</p>
              </div>
              <div class="icon">
                <i class="ion ion-camera"></i>
              </div>
              <a href="{{ route('photo.show') }}" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          @can('sale.create')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Nº</h3>

                <p>Tienda</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-cart"></i>
              </div>
              <a href="{{ route('sale.invoice') }}" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endcan
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection