@vite(['resources/sass/mybookmark_tab.scss'])

<div class="tab-content">
    <div class="container">
        <div class="row px-3 py-1">
            @forelse($appetizer_posts as $post)
            <div class="col-md-6 px-5 py-5">    
                <div class="card"> 
                    <div class="card-itself container-fluid">
                        <div class="myrecipe-header d-flex justify-content-between align-items-center">
                            <div>
                                <a 
                                href="{{ route('detailrecipe',
                                ['post_id'=>$post->id, 
                                'user_id'=>$post->user->id]) }}"
                                style="text-decoration: none"
                                >
                                    <p class="card-title">
                                        {{ \Illuminate\Support\Str::limit($post->title, 15) }}
                                    </p>
                                </a>
                            </div>
                            <div>
                                @if (Auth::user()->id === $post->user->id || Auth::user()->role_id === 1)
                                    <a href="{{ route('editmyrecipe', $post->id) }}">
                                        <i class="edit-icon fa-solid fa-pen"></i>
                                    </a>
                                @endif
                            </div>                                                        
                        </div>
                        <div class="image-container">
                            <a 
                            href="{{ route('detailrecipe',
                            ['post_id'=>$post->id, 
                            'user_id'=>$post->user->id]) }}"
                            style="text-decoration: none"
                            >
                                @if($post->photo)
                                    <img 
                                    src="{{ $post->photo }}" 
                                    alt="post-photo" 
                                    class="img-fluid"
                                    >
                                @else
                                    <img 
                                    src="{{ asset('/images/recipe_photos/weCook.png') }}" 
                                    alt="{{ $post->title }}" 
                                    class="food-photo img-fluid"
                                    >
                                @endif
                            </a>
                        </div>
                        <div class="myrecipe-footer d-flex justify-content-between align-items-center">
                            <div>
                                <a 
                                href="{{ route('detailrecipe', [$post->id, $post->user->id]) }}#comment-start"
                                style="text-decoration: none"
                                >
                                    <i class="comment-icon fa-regular fa-comments"></i>
                                    <!-- <span class="comment-text fw-bold">
                                        {{ $post->comments->count() }}
                                    </span> -->
                                <span class="comment-text fw-bold">{{ $post_counts[$post->id]['comments'] ?? 0 }}</span>
                                </a>
                            </div>
                            <div>
                                <i class="bookmark-icon fa-regular fa-bookmark"></i>
                                <!-- <span class="bookmark-text fw-bold">{{ $bookmark_counts[$post->id] ?? 0 }}</span> -->
                                <span class="bookmark-text fw-bold">{{ $post_counts[$post->id]['bookmarks'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-auto mx-auto">
                <p class="h2 sorry">Sorry! No Recipe Available.</p>
            </div>
            @endforelse
            <div class="pagination-wrapper">
                {{ $appetizer_posts->links() }}
            </div>
        </div>
    </div>
</div>