@extends('layouts.app')
@section('content')

<div class="container h-screen">
    <div class="card h-4/5">
        <div class="card-header">Chats</div>
                <div class="w-full h-full overflow-y-auto">
                    <chat-messages :user="{{ Auth::user() }}"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
    </div>
</div>
@endsection
