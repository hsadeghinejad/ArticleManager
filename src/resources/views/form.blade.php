@extends('adminpanel::layout')

@section('title')
    {{ __('articlemanager::messages.Article form') }}
@endsection

@section('block-title')
    <i class="fas fa-file-alt ml-2"></i>
    {{ __('articlemanager::messages.Article form') }}
@endsection

@section('adminpanel_styles')
    <link rel="stylesheet" href="/articlemanager/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="/articlemanager/style.css">
@endsection

@section('body')
    @include('articlemanager::errors')

    @php
        $params = [];
        $route_name = 'admin.article.store';
        if ($article->id){
            $params['article'] = $article->id;
            $route_name = 'admin.article.update';
        }
    @endphp
    <form action="{{route($route_name, $params)}}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if($article->id)
            {{ method_field('PATCH') }}
        @endif

        <div class="form-group">
            <label for="title">{{ __('articlemanager::messages.Article title') }}</label>
            <input type="text" class="form-control"
                   name="title" value="{{ old('title', $article->title) }}"
                   placeholder="{{ __('articlemanager::messages.Article title') }} ...">
            <small class="form-text text-muted">{{ __('articlemanager::messages.Please enter article title') }}</small>
        </div>

        <div class="form-group">
            <label>{{ __('articlemanager::messages.Article categories') }}: </label>
            <select name="categories[]" class="multiselect" multiple>
                @foreach($categories as $id=>$category)
                    <option value="{{ $id }}"
                            {{ in_array($id, old('categories', ($article->id ? $article->categories()->pluck('id')->toArray() : [])))   ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('articlemanager::messages.Main image') }}: </label>
            <input class="form-control" name="image" type="file">
        </div>

        <div class="form-group">
            <label for="body">{{ __('articlemanager::messages.Article content') }}</label>
            <textarea type="text" class="form-control" name="body"
                      placeholder="{{ __('articlemanager::messages.Article content') }} ..."
                      rows="7">{{ old('body', $article->body) }}</textarea>
        </div>
        <div class="text-left">
            <button type="submit" class="btn btn-primary">{{ __('articlemanager::messages.Send article') }}</button>
            <a class="btn btn-secondary" href="{{route('admin.articles')}}">{{ __('articlemanager::messages.Cancel') }}</a>
        </div>
    </form>
@endsection

@section('adminpanel_scripts')
<script src="/articlemanager/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js"></script>
<script>
    $(document).ready(function(){
        $('select.multiselect').multiselect({
            buttonText: function(options, select) {
                if(options.length === 0) {
                    return '{{ __('articlemanager::messages.None selected') }}';
                }
                else if (options.length > 3) {
                    return '{{ __('articlemanager::messages.More than 3 items selected') }}';
                }
                else {
                    var labels = [];
                    options.each(function () {
                        if ($(this).attr('label') !== undefined) {
                            labels.push($(this).attr('label'));
                        }
                        else {
                            labels.push($(this).html());
                        }
                    });
                    return labels.join(', ') + '';
                }
            }
        });
    });
</script>
@endsection