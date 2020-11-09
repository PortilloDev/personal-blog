@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ver Entrada

                </div>

                <div class="panel-body">
                    <p><strong>Nombre</strong> {{$posts->name}}</p>
                    <p><strong>Slug</strong> {{$posts->slug}}</p>
                    <p><strong>Contenido</strong> {{$posts->body}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
