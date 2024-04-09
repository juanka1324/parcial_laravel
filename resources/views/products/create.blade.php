@extends('layouts.base')
@section('title', 'Crear Nuevo Producto')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Crear Nuevo Producto</div>

                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}">
                        </div>

                        <div class="form-group">
                            <label for="quantity_available">Cantidad Disponible</label>
                            <input type="number" name="quantity_available" id="quantity_available" class="form-control" value="{{ old('quantity_available') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="row mt-2">
        <div class="col-md-8 offset-md-2">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
@endsection
