@extends('layouts.youtube')
<div class="col-lg-6">
    <a class="mt-0 mb-1" href="/home">Home</a><br>
    <a class="mt-0 mb-1" href="/youtube">Youtube</a><br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Sum Like</th>
            <th scope="col">Sum Dislike</th>
        </tr>
        </thead>
        <tbody>
        @if($likesDislikeStatistics->all()!==[])
            <tr>
                <td scope="row">{{$likesDislikeStatistics[0]->channelID}}</td>
                <td scope="row">{{$likesDislikeStatistics[0]->channelTitle}}</td>
                <td scope="row">{{$likesDislikeStatistics[0]->youtubeChannelsSumLikeVideos}}</td>
              <td scope="row">{{$likesDislikeStatistics[0]->youtubeChannelsSumDislikeVideos}}</td>
            </tr>
        @else
            No channel found.
        @endif
        </tbody>
    </table>

</div>
