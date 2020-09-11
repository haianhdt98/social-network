@extends('adminlte::page')
@section('title', 'Admin Page')

@section('content')
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ trans('admin.users_list') }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>{{ trans('admin.id') }}</th>
                            <th>{{ trans('admin.name') }}</th>
                            <th>{{ trans('admin.email') }}</th>
                            <th>{{ trans('admin.avt') }}</th>
                            <th>{{ trans('admin.addr') }}</th>
                            <th>{{ trans('admin.role') }}</th>
                            <th>{{ trans('admin.action') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->avatar == null)
                                            <img src="{{ asset('bower_components/bower-package/images/users/user-1.jpg') }}" class="mx-auto d-block w-50 p-3" />
                                        @else
                                            <img src="{{ asset(config('media.image') . $user->avatar) }}" class="mx-auto d-block w-50 p-3" />
                                        @endif
                                    </td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.editUser', ['userId' => $user->id]) }}">
                                            <button class="btn btn-primary btn-edit"><i class="fa fa-edit"></i></button>
                                        </a>
                                        <a href="{{ route('admin.deleteUser', ['userId' => $user->id]) }}">
                                            <button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
