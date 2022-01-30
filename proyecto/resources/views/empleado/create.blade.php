@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-info">
                        {{Session::get('success')}}
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nuevo Empleado</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-container">
                            <form method="POST" action="{{ route('empleado.store') }}"  role="form">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 mb-3">
                                        <div class="form-group mb-4">
                                            <input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre del empleado">
                                        </div>
                                        <div class="form-group mb-4">
                                            <input type="text" name="puesto" id="puesto" class="form-control input-sm" placeholder="Puesto">
                                        </div>
                                        <div class="form-group mb-4">
                                            <input type="text" name="edad" id="edad" class="form-control input-sm" placeholder="Edad">
                                        </div>
                                        <div class="form-group mb-lg-4">
                                            <select class="form-control form-select" name="estado" aria-label="estados">
                                                <option selected>--Seleccionar Estado--</option>
                                                @foreach( $estados as $item)
                                                <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group mb-4">
                                            <input type="text" name="antiguedad" id="antiguedad" class="form-control input-sm" placeholder="Antiguedad">
                                        </div>
                                        
                                        <div class="form-group mb-4">
                                            <input type="text" name="sueldo" id="sueldo" class="form-control input-sm" placeholder="Sueldo">
                                        </div>
                                        <div class="form-group mb-4">
                                            <select class="form-control form-select" name="moneda" aria-label="monedas">
                                                <option selected>--Tipo de Moneda--</option>
                                                @foreach ($monedas as $item)
                                                    <option value="{{$item}}">{{$item}}</option>
                                                    
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                        <a href="{{ route('empleado.index') }}" class="btn btn-secondary btn-block" >Atrás</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>
@endsection