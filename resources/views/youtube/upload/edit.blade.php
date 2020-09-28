@extends('layouts.youtube')
<a class="mt-0 mb-1" href="/home">Home</a><br>
<a class="mt-0 mb-1" href="/youtube/upload">Youtube Upload</a><br>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form  action="/youtube/upload/{{$localVideo->id}}" method="post" id="testform"  enctype="multipart/form-data" >
                            @method('PATCH')
                            @csrf
                            @include("youtube.upload._form")
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


