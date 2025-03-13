@extends('layout')
@section('title')
    - @yield('formName')
@endsection
@section('body')
@if($errors->any())
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <p><b><i class="fa-solid fa-times"></i> Errores</b></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
    <div class ="row">
        <div class ="row">
        <div class ="col-12">
            <div class="card">
                <div class="card-header">@yield('formName')</div>
                <div class="card-body">
                <form action="{{ isset($game) ? route('games.update', $game->id) : route('games.store') }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf
    @if(isset($game))
        @method('PUT')
    @endif

    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-gamepad"></i></span>
        <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ old('name', $game->name ?? '') }}" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-gamepad"></i></span>
        <input type="text" name="levels" class="form-control" placeholder="Niveles" value="{{ old('levels', $game->levels ?? '') }}" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
        <input type="date" name="release" class="form-control" value="{{ old('release', $game->release ?? '') }}" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
        <input type="file" name="image" class="form-control" {{ isset($game) ? '' : 'required' }}>
    </div>

    <button class="btn btn-success" type="submit">
        {{ isset($game) ? 'Actualizar' : 'Guardar' }}
    </button>
</form>

                </div>
            </div>
    </div>
        </div>
    </div>
@endsection