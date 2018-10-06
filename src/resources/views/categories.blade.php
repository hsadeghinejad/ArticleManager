<div class="row">
    @foreach($categories as $category)
    <div class="col-6">
        <h4 class="small"><a href="{{ route('category.view', ['category' => $category->slug]) }}">{{ $category->title }}</a></h4>
    </div>
    @endforeach
</div>