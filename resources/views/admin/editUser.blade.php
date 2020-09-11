@extends('adminlte::page')
@section('title', 'Admin Page')

@section('content')
    <div class="container">
        <div class="row">
            <hr>
            <div class="col-md-1"></div>
            <div class="col-md-9">
                <form method="POST" id="editUserForm" class="form-horizontal" action="{{ route('admin.updateUser', ['userId' => $user->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-3 form-group">
                        <div class="text-center">
                            <label for="avatar">
                            @if ($user->avatar == NULL)
                                <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" class="avatar img-circle edit-avatar-img" alt="avatar"></label>
                            @else
                                <img src="{{ asset(config('media.image') . $user->avatar) }}" class="avatar img-circle edit-avatar-img" alt="{{ trans('profile.user_avt') }}" id="avt-img-edit"></label>
                            @endif
                            <input id="avatar" type="file" name="avatar" class="btn-edit-avt">
                        </div>
                    </div>
                    <div class="col-md-9 personal-info info-style">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('edit.user_name') }}</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="text" id="name" name="name"  value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('edit.email') }}</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="email" id="email" name="email"  value="{{ $user->email }}">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('edit.address') }}</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" id="address" name="address" value="{{ $user->address }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-primary" id="btnChange" value="Save Changes">
                                <span></span>
                                <input type="reset" class="btn btn-default" id="btnCancel" value="Cancel">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
@stop
