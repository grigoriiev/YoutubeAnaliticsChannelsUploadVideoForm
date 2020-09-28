@extends('layouts.youtube')
<div class="col-lg-6">
    <a class="mt-0 mb-1" href="/home">Home</a><br>
    <a class="mt-0 mb-1" href="/youtube">Youtube</a><br>
    <a class="mt-0 mb-1" href="/youtube/upload/create">Youtube upload video</a><br>
    <div class="table-responsive">
    <table class="table table-responsive">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">VideoId youtube</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category Id</th>
            <th scope="col">Updated</th>
            <th scope="col">Created</th>
            <th scope="col">Delete</th>
            <th scope="col">Edit</th>
        </tr>
        </thead>
        <tbody>
        @forelse($LocalVideos as $localVideo)
            <tr>
                <td scope="row">{{$localVideo->id}}</td>
                <td scope="row">{{$localVideo->video_id}}</td>
                <td scope="row">{{$localVideo->title}}</td>
                <td scope="row">{{$localVideo->description}}</td>
                <td scope="row">{{$localVideo->category_id}}</td>
                <td scope="row">{{$localVideo->updated_at}}</td>
                <td scope="row">{{$localVideo->created_at}}</td>
                <td scope="row">
                    <form action="/youtube/upload/{{$localVideo->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button  type="submit" class="btn btn-primary my-1">Delete</button>
                    </form>
                </td>
                <td scope="row">
                    <a href="/youtube/upload/{{$localVideo->id}}/edit">Edit Youtube</a>
                </td>
            </tr>
        @empty
            No channel found.
        @endforelse
        </tbody>
    </table>
    </div>
</div>

