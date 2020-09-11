@extends('adminlte::page')
@section('title', 'Admin Page')

@section('content')
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ trans('admin.posts_list') }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>{{ trans('admin.id') }}</th>
                            <th>{{ trans('admin.caption') }}</th>
                            <th>{{ trans('admin.username') }}</th>
                            <th>{{ trans('admin.created_at') }}</th>
                            <th>{{ trans('admin.action') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->caption }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.editPost', ['postId' => $post->id]) }}">
                                            <button class="btn btn-primary btn-edit"><i class="fa fa-edit"></i></button>
                                        </a>
                                        <a href="{{ route('admin.deletePost', ['postId' => $post->id]) }}">
                                            <button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
