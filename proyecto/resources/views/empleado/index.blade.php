@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left"><h3>Lista Empleados</h3></div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="{{ route('empleado.create') }}" class="btn btn-secondary" >Añadir Empleado</a>
                            </div>
                        </div>
                        <div class="table-container">
                            <table id="mytable" class="table table-bordred table-striped">
                                <thead>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Edad</th>
                                <th>Antiguedad</th>
                                <th>Estado</th>
                                <th>sueldo</th>
                                <th>Moneda</th>
                                <th>--</th>
                                <th>--</th>
                                </thead>
                                <tbody>
                                @if($empleados->count())
                                    @foreach($empleados as $empleado)
                                        <tr>
                                            <td>{{$empleado->nombre}}</td>
                                            <td>{{$empleado->puesto}}</td>
                                            <td>{{$empleado->edad}}</td>
                                            <td>{{$empleado->antiguedad}}</td>
                                            <td>{{$empleado->estado}}</td>
                                            <td>{{$empleado->sueldo}}</td>
                                            <td>{{$empleado->moneda}}</td>
                                            
                                            <td><a class="btn btn-primary btn-xs" href="{{url('empleado/'.$empleado->id.'/edit')}}" >Editar</a></td>
                                            <td>
                                                <form action="{{ url('empleado', [$empleado->id]) }}" method="post">
                                                    {{csrf_field()}}
                                                    <input name="_method" type="hidden" value="DELETE">

                                                    <button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">No hay registro !!</td>
                                    </tr>
                                @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                    {{ $empleados->links() }}
                </div>
            </div>
    </div>
</div>

@endsection