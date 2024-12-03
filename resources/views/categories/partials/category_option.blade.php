<option value="{{ $category->id }}">
    {{ str_repeat('--', $loop->depth) }} {{ $category->name }}
</option>

@foreach($category->children as $child)
    @include('categories.partials.category_option', ['category' => $child])
@endforeach
