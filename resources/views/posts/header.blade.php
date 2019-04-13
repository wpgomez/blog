<header class="container-flex space-between">
    <div class="date">
        <span class="c-gray-1">
            {{ optional($post->published_at)->format('M d') }} / {{ $post->owner->name }}
        </span>
    </div>
    @if ($post->category)
        <div class="post-category">
            <a href="{{ route('categories.show', $post->category) }}">
                <span class="category text-capitalize">{{ $post->category->name }}</span>
            </a>
        </div>
    @endif
</header>