@extends('admin.layout')

@section('header')
<h1>
    POSTS
    <small>Listado</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Posts</li>
</ol>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Listado de publicaciones</h3>
        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus"></i> Crear poblicación
        </button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="posts-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Extracto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->excerpt }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post) }}" 
                            class="btn btn-sm btn-default"
                            target="_blank"
                        ><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush

@push('scripts')
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#posts-table').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
            })
        })
    </script>
@endpush