@extends('admin.layout')

@section('header')
<h1>
    POSTS
    <small>Crear publicación</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Posts</a></li>
    <li class="active">Crear</li>
</ol>
@endsection

@section('content')
<div class="row">
    <form method="POST" action="{{ route('admin.posts.store') }}">
        {{ csrf_field() }}
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label>Título de la publicación</label>
                        <input name="title" class="form-control" placeholder="Ingresa aqui el titulo de la publicación">
                    </div>
                    <div class="form-group">
                        <label>Contenido publicación</label>
                        <textarea rows="10" name="body" id="editor" class="form-control" placeholder="Ingresa el contenido completo de la publicación"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label>Fecha de publicación:</label>
                        <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input name="published_at" type="text" class="form-control pull-right" id="datepicker">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Categorías</label>
                        <select name="category" class="form-control">
                            <option value="">Selecciona una categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Etiquetas</label>
                        <select name="tags[]" class="form-control select2" 
                            multiple="multiple" 
                            data-placeholder="Selecciona una o más etiquetas" style="width: 100%;">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>    
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Extracto publicación</label>
                        <textarea name="excerpt" class="form-control" placeholder="Ingresa un extracto de la publicación"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Guardar publicación</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
@endpush

@push('scripts')
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>
        $('#datepicker').datepicker({
            autoclose: true
        });
        $('.select2').select2();
        CKEDITOR.replace( 'editor' );
    </script>
@endpush