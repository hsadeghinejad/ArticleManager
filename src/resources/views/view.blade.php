@extends('layout')

@section('title')
    {{$article->title}}
@endsection

@section('content')
    <div class="article mt-5">
        <div class="article-header">
            <h1 class="h2">{{$article->title}}</h1>
            <div class="text-muted mb-2">
                ارسال شده توسط {{$article->user->name}}
            </div>
            <small class="text-muted">
                <i class="far fa-clock"></i>
                ارسال شده در تاریخ {{Verta::instance($article->created_at)}}
                ({{(new Verta($article->created_at))->formatDifference(verta())}})
            </small>
        </div>
        <div class="article-body">
            <hr>
            <img class="img-fluid my-2 rounded" src="holder.js/900x300" alt="Post image">
            <hr>
            <p>{{$article->body}}</p>
            <div class="categories text-right">
                @foreach($article->categories()->pluck('title', 'slug') as $slug=>$category)
                    <a class="badge badge-pill badge-info"
                       href="{{ route('category.view', ['category' => $slug]) }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <hr class="mb-5">

    <div class="send-comment">
                <div class="block block-search jumbotron mb-3">
                    <h6>نظر شما: </h6>
                    <hr>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <form method="POST" action="{{route('comment.store', ['article' => $article->slug])}}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="body">متن :</label>
                                <textarea class="form-control" name="body" placeholder="لطفا نظر خود را وارد نمایید ..."></textarea>
                            </div>
                            <div class="text-left">
                                <button class="btn btn-info">ارسال</button>
                            </div>
                        </form>
                    @else
                        <div class="text-center">
                            <span class="lead text-muted">جهت ثبت نظر باید عضو وب سایت باشید!</span>
                            <div class="w-50 mx-auto d-flex mt-3">
                                <a class="btn btn-primary btn-sm btn-block ml-3" href="{{ route('login') }}">ورود</a>
                                <a class="btn btn-success btn-block btn-sm mt-0" href="{{ route('register') }}">ثبت نام</a>
                            </div>
                        </div>
                    @endif
                </div>
    </div>

    <hr>

    <div class="comments">

    @foreach($article->comments as $comment)
        <div class="comment mb-4">
            <div class="d-flex align-items-center mb-2">
                <h6 class="mb-0">{{ $comment->user->name }}</h6>
                <small class="text-muted mr-2">ارسال شده در تاریخ {{Verta::instance($comment->created_at)}}</small>
            </div>
            <p>{{ $comment->body }}</p>
            <hr>
        </div>
    @endforeach

    </div>
@endsection