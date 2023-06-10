@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">Chats</div>
        <div class="panel-body">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
    </div>
</div>
@endsection
