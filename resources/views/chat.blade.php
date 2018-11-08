@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col publisher-col">
            <div class="card mx-auto chat-card mr-1 publisher">
                <div class="card-body">
                    <div id="publisher">
                    </div>
                </div>
            </div>
        </div>
        <div class="col subscriber-col" style="display:none">
            <div class="card mx-auto chat-card ml-1 subscriber">
                <div class="card-body">
                    <div id="subscriber">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="card profile mx-auto">
            <div class="card-body">
                <a href="/chat" class="btn btn-primary">Join Chat</a>
                <a href="/logout" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const openTokConfig = {
            'apiKey': '{{ $apiKey }}',
            'token': '{{ $token }}',
            'sessionId': '{{ $sessionId }}'
        }
    </script>
@endsection
