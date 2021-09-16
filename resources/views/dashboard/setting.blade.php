@extends('dashboard.base')
@section('content')

    @php
        $user = $user ?? null;
        $action = route('profile.action');
    @endphp

    <div class="section-header">
        <h1> {{ $user ? 'Edit' : 'Tambah' }} User</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ $action }}" class="row" method="POST">
                @csrf

                @if ($user)
                    <input type="hidden" name="_method" value="PUT">
                @endif

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Nama </label>
                        <input type="text" class="form-control" name="name" id="" value="{{ $user ? $user->name : old('name') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Email </label>
                        <input type="email" class="form-control" name="email" id="" value="{{ $user ? $user->email : old('name') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Password </label>
                        <input type="password" class="form-control" name="password" id="">
                    </div>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-primary float-right ml-2" type="submit"> Edit </button>
                    <a href="{{ route('profile') }}" class="btn btn-danger float-right"> Batal </a>
                </div>
            </form>
        </div>
    </div>
@endsection