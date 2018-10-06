@extends('adminpanel::layout')

@section('title')
مدیریت مقالات
@endsection

@section('block-title')
    <i class="fas fa-newspaper ml-2"></i>
    مدیریت مقالات
@endsection

@section('body')
    <a href="{{ route('admin.article.form') }}" class="btn btn-primary mb-3 float-left">افزودن مقاله جدید</a>
    <table class="table table-striped table-hover">
        <tr class="thead-dark">
            <th>#</th>
            <th>عنوان</th>
            <th>نویسنده</th>
            <th>آخرین بروزرسانی</th>
            <th>دسته بندی [ها]</th>
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
                    ویرایش
                </a>
                <a href="{{ route('admin.article.delete', ['article_id' => $article->id]) }}"
                   onclick="return confirm_delete()"
                   class="btn btn-sm btn-danger">
                    حذف
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
        if (confirm('آیا مایل به حذف این رکورد هستید؟')) return true;

        return false;
    }
</script>
@endsection