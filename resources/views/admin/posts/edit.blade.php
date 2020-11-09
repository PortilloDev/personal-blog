@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Entrada

                </div>

                <div class="panel-body">
                   {!! Form::model($posts, ['route' => ['posts.update', $posts->id], 'method' => 'PUT', 'files' => true])!!}

                        @include('admin.posts.partials.form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
