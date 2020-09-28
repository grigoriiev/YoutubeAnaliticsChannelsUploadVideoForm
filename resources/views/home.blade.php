@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a class="mt-0 mb-1" href="/youtube">Youtube</a><br>
                        <a class="mt-0 mb-1" href="/youtube/create"> Youtube Create channel form</a><br>
                        <a class="mt-0 mb-1" href="/youtube/statistics/top-N">Youtube Statistics</a><br>
                        <a class="mt-0 mb-1" href="/youtube/upload">Youtube Upload</a><br>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
