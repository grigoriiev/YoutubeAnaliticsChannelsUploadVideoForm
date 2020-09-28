@extends('layouts.youtube')
<div class="col-lg-6">
    <a class="mt-0 mb-1" href="/home">Home</a><br>
    <a class="mt-0 mb-1" href="/youtube">Youtube</a><br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ChannelsTitle</th>
            <th scope="col">id</th>
            <th scope="col">Difference between likes and dislikes</th>
        </tr>
        </thead>
        <tbody>
        @forelse($topNlDiffLikesStatistics as $topNlDiffLikesStatistic)
            <tr>
                <td scope="row">{{$topNlDiffLikesStatistic->channelsTitle}}</td>
                <td scope="row">{{$topNlDiffLikesStatistic->channelsID}}</td>
                <td scope="row">{{$topNlDiffLikesStatistic->youtubeChannelsDiffSumLikeDislikeVideos}}</td>
                <td scope="row">
                    <a href="/youtube/{{$topNlDiffLikesStatistic->channelsID}}/statistics"> Youtube channel statistics</a>
                </td>
            </tr>
        @empty
            No channel found.
        @endforelse
        </tbody>
    </table>
</div>
