@extends('layouts.app')
@section('content')
    <div class="row">
        @guest
            <div class="col card profile">
                <div class="card-body">
                    It looks like you aren't logged in. You need to login to chat.<br>
                    <a href="/login/google">Login with Google</a>
                </div>
            </div>
        @endguest

        @auth
            <div class="card profile mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Hi {{ Auth::user()->name }}!</h3>
                            <img src="{{ Auth::user()->avatar_original }}" alt="" class="avatar">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="/chat" class="btn btn-primary">Join Chat</a>
                            <a href="/logout" class="btn btn-primary">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
@endsection