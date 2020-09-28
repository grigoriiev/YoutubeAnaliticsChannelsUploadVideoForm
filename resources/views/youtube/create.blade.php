@extends('layouts.youtube')
<a class="mt-0 mb-1" href="/home">Home</a><br>
<a class="mt-0 mb-1" href="/youtube">Youtube</a><br>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/youtube" method="post" id="testform">
                            @csrf
                            @include('youtube._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

