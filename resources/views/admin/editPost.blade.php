@extends('adminlte::page')
@section('title', 'Admin Page')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="list-group">   
                        <div class="post-content">
                            <div class="post-container">
                                <div class="post-detail">
                                    <div class="user-info">
                                        <h5>
                                            <strong>
                                                <a href="#" class="profile-link">{{ $user->name }}</a>
                                            </strong>
                                        </h5>
                                        <p class="text-muted">{{ $post->created_at->format('d-m-Y H:i') }}</p>
                                    </div>
                                    <div class="line-divider"></div>
                
                                    <form action="{{ route('admin.updatePost', ['postId' => $post->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="post-media media-layouts">
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-10">
                                                    @foreach ($post->media as $media)
                                                        <tr>
                                                            <td>
                                                                @foreach (json_decode($media->url) as $picture)
                                                                    <img class="media-styles" src="{{ asset(config('media.image') . $picture) }}"/>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-5">
                                                    <div class="tools">
                                                        <ul class="publishing-tools list-inline">
                                                            <li><i class="fa"></i></li>
                                                            <li><input type="file" class="form-control" name="url[]" multiple></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-text caption">
                                            <textarea name="caption" type="text"  cols="70" rows="6" class="form-control" >{{ $post->caption }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            {{ trans('admin.change') }}
                                        </button>
                                        <a href="{{ route('admin.users') }}">
                                            <button type="reset" class="btn btn-default pull-right">
                                                {{ trans('admin.reset') }}
                                            </button>
                                        </a>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
