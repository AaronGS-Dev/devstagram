<div>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ( $posts as $post)
            <div>
            <a href="{{ route('posts.show', $post)}}">
                <img class="rounded" src="{{ asset('uploads') . '/' . $post->image }}" alt="imagen del post {{$post->title}}">
            </a>
                
            </div>
        
        @endforeach
        
        <div class="my-10">
        {{ $posts->links('pagination::tailwind')}}
    </div>

@else
<p class="text-center">No hay post</p>
    
@endif 
</div>