@extends('layouts.youtube')
<div class="col-lg-6">
    @if (session('delete'))
        <div class="alert alert-danger">
            {{ session('delete') }}
        </div>
    @endif
    @if (session('update'))
            <div class="alert alert-success">
                {{ session('update') }}
            </div>
     @endif
     @if (session('store'))
            <div class="alert alert-success">
                {{ session('store') }}
            </div>
     @endif
        <a class="mt-0 mb-1" href="/home">Home</a><br>
    <a class="mt-0 mb-1" href="/youtube">Youtube</a><br>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">View count</th>
        </tr>
        </thead>
        <tbody>
        @forelse($YoutubeChannels as $YoutubeChannel)
            <tr>
                <td scope="row">{{$YoutubeChannel->id}}</td>
                <td scope="row">{{$YoutubeChannel->title}}</td>
                <td scope="row">{{$YoutubeChannel->description}}</td>
                <td scope="row">{{$YoutubeChannel->viewCount}}</td>
                <td scope="row">
                    <form action="/youtube/{{$YoutubeChannel->id}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button>Delete</button>
                    </form>
                </td>
                <td scope="row">
                    <a class="mt-0 mb-1" href="/youtube/{{$YoutubeChannel->id}}/statistics">Youtube Channel Statistics</a><br>
                </td>
            </tr>
        @empty
            No channel found.
        @endforelse
        </tbody>
    </table>

</div>

