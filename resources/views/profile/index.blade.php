@extends('layouts.app')
@section('content')
<div class="container">
    <div class="timeline">
        <div class="timeline-cover">
            <div class="timeline-nav-bar hidden-sm hidden-xs">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-info">
                            @if ($user->avatar == NULL)
                                <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" alt="" class="img-responsive profile-photo" />
                            @else
                                <img src="{{ asset(config('media.image') . $user->avatar) }}" alt="" class="img-responsive profile-photo" />
                            @endif
                            <h3><strong>{{ $user->name }}</strong></h3> 
                            <p class="text-muted">{{ trans('profile.status') }}{{ $user->address }}</p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <ul class="list-inline profile-menu">
                            <li>
                                <a href="#" class="active">{{ trans('profile.timeline') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('profile.about') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('profile.album') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('profile.friends') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.followers', ['userId' => $user->id]) }}" class="active">{{ trans('profile.followers') }}
                                    <span class="badge badge-primary">{{ $user->followers()->get()->count() }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile.following', ['userId' => $user->id]) }}" class="active">{{ trans('profile.following') }}
                                    <span class="badge badge-primary">{{ $user->following()->get()->count() }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="follow-me list-inline">    
                            @if (Auth::id() != $user->id)
                                @if (auth()->user()->isFollowing($user))
                                    <li>
                                        <form method="POST" class="form-horizontal" action="{{ route('profile.unfollow', ['userId' => $user->id]) }}">
                                            @csrf
                                            <input type="hidden" name="userId" value={{ $user->id }}>
                                            <button type="submit" class="btn-primary">{{ trans('profile.unfollow') }}</button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <form method="POST" class="form-horizontal" action="{{ route('profile.follow', ['userId' => $user->id]) }}">
                                            @csrf
                                            <input type="hidden" name="userId" value={{ $user->id }}>
                                            <button type="submit" class="btn-primary">{{ trans('profile.follow') }}</button>
                                        </form>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navbar-mobile hidden-lg hidden-md">
                <div class="profile-info">
                    <img src="{{ asset(config('media.image') . Auth::user()->avatar) }}" alt="" class="img-responsive profile-photo" />
                    <h3>{{ $user->name }}</h3>  
                    {{ trans('profile.status') }}
                </div>
                <div class="mobile-menu">
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="active">{{ trans('profile.timeline') }}</a>
                        </li>
                        <li>
                            <a href="#">{{ trans('profile.about') }}</a>
                        </li>
                        <li>
                            <a href="#">{{ trans('profile.album') }}</a>
                        </li>
                        <li>
                            <a href="#">{{ trans('profile.friends') }}</a>
                        </li>
                    </ul>
                    <button class="btn-primary">{{ trans('profile.follow') }}</button>
                </div>
            </div>
        </div>
        <div id="page-contents">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    <div class="create-post">
                        <div class="card">
                            @if (Auth::id() == $user->id)
                                <div class="card-header">
                                    <h4>
                                        <img src="{{ asset(config('media.image') . Auth::user()->avatar) }}" alt="" class="profile-photo-md" />
                                        <span>
                                            <strong>{{ $user->name }}</strong>
                                        </span>
                                    </h4>
                                </div>
                                <form action="{{ route('post.store') }}" id="createForm" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <textarea name="caption" id="caption" cols="70" rows="6" value="" class="form-control" placeholder="{{ trans('profile.write-post') }}"></textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="tools">
                                            <ul class="publishing-tools list-inline">
                                                <li><i class="fa fa-camera"></i></li>
                                                <li><input type="file" id="media" value="" class="form-control" name="url[]" multiple></li>
                                                <button type="submit" id="btn-save" value="create" class="btn btn-primary pull-right">
                                                    {{ trans('profile.publish') }}
                                                </button>
                                            </ul>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="list-group">
                        @forelse ($posts as $post)
                            <div class="post-content">
                                <div class="post-date hidden-xs hidden-sm">
                                    <h5>
                                        <strong>{{ $user->name }}</strong>
                                    </h5>
                                    <p class="text-grey">{{ $post->created_at->format('d-m-Y') }}</p>
                                </div>
                                <div class="post-container">
                                    <img src="{{ asset(config('media.image') . $post->user->avatar) }}" alt="user" class="profile-photo-md pull-left" />
                                    <div class="post-detail">
                                        <div class="user-info">
                                            <h5>
                                                <strong>
                                                    <a href="#" class="profile-link">{{ $user->name }}</a>
                                                </strong>
                                            </h5>
                                            <p class="text-muted">{{ $post->created_at->format('d-m-Y H:i') }}</p>
                                        </div>
                                        <div class="reaction">
                                            {{-- <a class="btn text-green" href="#">
                                                <i class="icon ion-thumbsup"></i> {{ trans('profile.like') }}
                                            </a>
                                            <a class="btn text-red">
                                                <i class="fa fa-thumbs-down"></i> {{ trans('profile.dislike') }}
                                            </a> --}}
                                            @if(Auth::id() == $post->user_id)
                                                <a class="btn text-blue" href="{{ route('post.edit', ['postId' => $post->id]) }}">
                                                    {{ trans('profile.edit') }}
                                                </a>
                                                <a class="btn text-red" href="{{ route('post.delete', ['postId' => $post->id]) }}">
                                                    {{ trans('profile.delete') }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="line-divider"></div>
                                        <div class="post-media media-layouts">
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
                                        <div class="line-divider"></div>
                                        <div class="post-text caption">
                                            <p><strong>{{ $post->caption }}</strong></p>
                                        </div>
                                        
                                        @include('post.commentDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
                                        
                                        <div class="line-divider"></div>
                                        <div class="post-comment">
                                            <form method="post" action="{{ route('comment.store') }}">
                                                @method('POST')
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-md-1 avatar-user">
                                                        <img src="{{ asset(config('media.image') . Auth::user()->avatar) }}" class="profile-photo-sm" />
                                                    </div>
                                                    <div class="col-md-11 layout-comment-input">
                                                        <a href="#" class="profile-link">{{ Auth::user()->name }}</a>
                                                        <input class="form-control comment-input-style" name="comment" placeholder="{{ trans('profile.post-comment') }}" autocomplete="off">
                                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                                                        <button type="submit" class="btn btn-primary" value="Comment"><i class="fa fa-comment" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>           
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{ trans('profile.no_post') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
