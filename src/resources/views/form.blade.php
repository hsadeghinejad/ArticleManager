@extends('adminpanel::layout')

@section('title')
    ثبت مقاله
@endsection

@section('block-title')
    <i class="fas fa-file-alt ml-2"></i>
    ثبت مقاله
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
    <form action="{{route($route_name, $params)}}" method="POST">
        {!! csrf_field() !!}
        @if($article->id)
            {{ method_field('PATCH') }}
        @endif

        <div class="form-group">
            <label for="title">عنوان مقاله</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}" placeholder="عنوان مقاله ...">
            <small class="form-text text-muted">لطفا عنوان مقاله را وارد نمایید</small>
        </div>

        <div class="form-group">
            <label>دسته بندی: </label>
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
            <label for="body">متن مقاله</label>
            <textarea type="text" class="form-control" name="body" placeholder="متن مقاله ..." rows="7">{{ old('body', $article->body) }}</textarea>
        </div>
        <div class="text-left">
            <button type="submit" class="btn btn-primary">ثبت مقاله</button>
            <a class="btn btn-secondary" href="{{route('admin.articles')}}">انصراف</a>
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
                    return 'بدون انتخاب';
                }
                else if (options.length > 3) {
                    return 'بیش از 3 آیتم انتخاب شد';
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