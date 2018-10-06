@extends('layout')

@section('title')
    مقالات
@endsection

@section('content')
    <div class="d-flex align-items-center">
        <h3 class="mt-5">مقالات سایت</h3>
        @if(isset($category))
            <h5 class="mt-5 mr-3 text-info">{{ $category->title }}</h5>
        @endif
    </div>
    <hr class="mb-5">
    @foreach($articles as $article)
        <div class="article">
            <div class="article-header">
                <h4>
                    <a href="{{route('article.view', ['article' => $article->slug])}}">
                        {{$article->title}}
                    </a>
                </h4>
                <div class="text-muted mb-2">
                    ارسال شده توسط {{$article->user->name}}
                </div>
                <small class="text-muted">
                    <i class="far fa-clock"></i>
                    ارسال شده در تاریخ
                    @date($article->created_at)
                    (@date_ago($article->created_at))
                </small>
            </div>
            <div class="article-body">
                <hr>
                <img class="img-fluid my-2 rounded" src="holder.js/900x300" alt="Post image">
                <hr>
                <p>{!! $article->body !!}</p>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="categories">
                    @foreach($article->categories()->pluck('title', 'slug') as $slug=>$category)
                        <a class="badge badge-pill badge-info"
                            href="{{ route('category.view', ['category' => $slug]) }}">
                            {{ $category }}
                        </a>
                    @endforeach
                    </div>
                    <a href="{{ route('article.view', ['article' => $article->slug]) }}" class="btn btn-info">
                        <div class="d-flex align-items-center">
                            ادامه مطلب
                            <i class="far fa-arrow-alt-circle-left mr-1"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @if(!$loop->last)
            <hr class="mb-5">
        @endif
    @endforeach

    <hr class="mt-5">
    <div class="pagination justify-content-center">
        {{$articles->links()}}
    </div>
@endsection