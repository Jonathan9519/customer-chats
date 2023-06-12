@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">Chats</div>
        <div class="panel-body">
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
