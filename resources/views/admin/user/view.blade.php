@extends('layouts.admin_layout')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View User</h1>

    <table class="table table-bordered table-striped table-hover">
        <tr>
            <td>
                <b>Name</b>
            </td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>
                <b>Email</b>
            </td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>
                <b>Status</b>
            </td>
            <td>{{ $user->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
        </tr>

        <tr>
            <td>
                <b>Roles</b>
            </td>
            <td>
                @forelse($user->getRoleNames() as $role)

                    <b>{{ $role }}</b>
                    @if($loop->count > 1) 
                        {{ '|' }}
                    @endif
                @empty
                    -
                @endforelse
            </td>
        </tr>
    </table>
@endsection
