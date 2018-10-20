@extends('adminpanel::layout')

@section('title')
{{ __('articlemanager::messages.Articles management') }}
@endsection

@section('block-title')
    <i class="fas fa-newspaper ml-2"></i>
    {{ __('articlemanager::messages.Articles management') }}
@endsection

@section('body')
    <a href="{{ route('admin.article.form') }}" class="btn btn-primary mb-3 float-left">
        {{ __('articlemanager::messages.Add new article') }}
    </a>
    <table class="table table-striped table-hover">
        <tr class="thead-dark">
            <th>#</th>
            <th>{{ __('articlemanager::messages.Title') }}</th>
            <th>{{ __('articlemanager::messages.Writer') }}</th>
            <th>{{ __('articlemanager::messages.Last updated') }}</th>
            <th>{{ __('articlemanager::messages.Categories') }}</th>
            <th></th>
        </tr>

        @php $i = $articles->perPage(); @endphp
        @foreach($articles as $article)
        <tr>
            <td>{{ ($articles->currentPage()*$articles->perPage()) - --$i }}</td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->user->name }}</td>
            <td>@article_date_ago($article->updated_at)</td>
            <td>
                @foreach($article->categories->pluck('title') as $category)
                    <span class="badge-pill badge badge-info">{{ $category }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('admin.article.form', ['article' => $article->id]) }}" class="btn btn-sm btn-warning">
                    {{ __('articlemanager::messages.Edit') }}
                </a>
                <a href="{{ route('admin.article.delete', ['article_id' => $article->id]) }}"
                   onclick="return confirm_delete()"
                   class="btn btn-sm btn-danger">
                    {{ __('articlemanager::messages.Delete') }}
                </a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $articles->links() }}
@endsection

@section('adminpanel_scripts')
<script>
    function confirm_delete() {
        if (confirm('{{ __('articlemanager::messages.Are you sure to delete this record?') }}')) return true;

        return false;
    }
</script>
@endsection