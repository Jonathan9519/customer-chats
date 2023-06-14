@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <!-- <example-component></example-component> -->
          
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::user()->user_type === 'buyer')
                      <posts-feed :user="{{ Auth::user() }}"></posts-feed>
                      @else
                      <conversations :user="{{ Auth::user() }}"></conversations>
                      @endif
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
