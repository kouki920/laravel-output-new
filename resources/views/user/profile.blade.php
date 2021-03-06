@extends('layouts.app')

@section('content')

<div class="container mt-4 text-center">
    <form action="{{ route('user.edit',$auth->id) }}" method="GET">
        @csrf
        <div class="mb-4 text-right">
            <button class="btn btn-primary">編集</button>
        </div>
    </form>
    <div class="card-body">

        {{$auth->name}}&ensp;|&ensp;({{$auth->age}})&ensp;|&ensp;
        {{$gender}}
        <br>
        {{$auth->company}}
        <br>
        {{$auth->occupation}}&ensp;|&ensp;{{$auth->position}}
        <br>
    </div>

    <div class="card-body">

        <div class="card-header">
            自己紹介
        </div>
        <div class="card-body">
            <p class="card-text">
                {!! nl2br(e($auth->introduction)) !!}
            </p>
        </div>

        <div class="card-header">
            累計売上高(個人別)&ensp;&#047;&ensp;累計売上高(営業部)&ensp;&#047;&ensp;貢献度
        </div>
        <div class="card-body">
            <p class="card-text">
                ¥{{number_format($individual_sales)}}&ensp;&#047;&ensp;¥{{number_format($sales)}}&ensp;&#047;&ensp;{{$contribution}}%
            </p>
        </div>


        @foreach($posts as $post)
        <div class="card mb-4">
            <div class="card-header">
                タイトル: {{ $post->title }}&ensp;
                カテゴリ: {{ $post->category->name }}&ensp;

            </div>
            <div class="card-body">
                <p class="card-text">
                    単価:¥{{number_format($post->price)}}&ensp;販売数:{{number_format($post->count)}}&ensp;売上:¥{{number_format($post->total)}}
                    <br>
                    <br>
                    顧客:{{$post->client->type}}&ensp;
                    売上獲得方法:&ensp;{{$post->approach->method}}
                    <br>
                    <hr>
                    {!! nl2br(e(Str::limit($post->body, 140))) !!}
                    <!-- 文字数表示制限 -->
                </p>
            </div>
            <div class="card-footer">
                <span class="mr-2">
                    投稿日時 {{ $post->created_at }}
                </span>
                @if ($post->comments->count())
                <span class="badge badge-primary">
                    コメント {{ $post->comments->count() }}件
                </span>
                @endif
            </div>
            <div class="mb-1">
                <a href="{{route('board.show',['id' => $post->id])}}" class="btn btn-primary">詳細へ</a>
            </div>
        </div>
        @endforeach
        <div class="mt-2 center-block">
            {{$posts->links()}}
        </div>
    </div>
    @endsection