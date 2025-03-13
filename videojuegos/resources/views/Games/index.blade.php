@extends('layout')

@section('title', 'Listado de Videojuegos')

@section('body')

    {{-- Mensaje de éxito con animación de desaparición --}}
    @if($msj = Session::get('success'))
        <div class="row" id="alerta">
            <div class="col-md-4 offset-md-4">
                <div class="alert alert-success">
                    <p><i class="fa-solid fa-check"></i> {{ $msj }}</p>
                </div>
            </div>
        </div>
        @php Session::forget('success'); @endphp
    @endif

    <style>
        #alerta {
            animation: fadeOut 0.5s ease-in-out 2.5s forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                visibility: hidden;
            }
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>NIVELES</th>
                            <th>LANZAMIENTO</th>
                            <th>IMAGEN</th>
                            <th>EDITAR</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $i => $row)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->levels }}</td>
                                <td>{{ $row->release }}</td>
                                <td>
                                    <img class="img-fluid" src="{{ asset('storage/' . $row->image) }}" width="120" alt="Imagen de {{ $row->name }}">
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('games.edit', $row->id) }}">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form id="frm_{{$row->id}}" method="POST" action="{{ route('games.destroy', $row->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button data-bs-toggle="modal" data-bs-target="#modalConfirmacion"
                                                onclick="setInfo({{ $row->id }}, '{{ addslashes($row->name) }}')"
                                                type="button" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="modalConfirmacion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¿Seguro de eliminar?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><i class="fa-solid fa-warning fs-3 text-warning"></i></p>
                    <label id="lbl_nombre"></label> 
                </div>
                <div class="modal-footer">
                    <button data-bs-toggle="modal" data-bs-target="#modalConfirmacion"
                            type="button" class="btn btn-success">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminar">Sí, eliminar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- @section('js')
    @vite('resources/js/index.js')
@endsection  -->
<!-- <script type="module" src="{{ asset('resources/js/Games/index.js') }}"></script>
 -->
 <script src="{{ asset('js/Games/index.js') }}" defer></script>

