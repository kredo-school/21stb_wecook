@extends('layouts.app')

@vite(['resources/sass/detailrecipe.scss'])
@section('content')
<div class="containe py-3">
    <div class="detailrecipe px-5 pb-5 mx-3">
        <!-- breadcrumb area -->
        <nav 
            aria-label="breadcrumb"
            class="mb-3"
        >
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item current-reciprname" aria-current="location">{{ $recipe->title }}</li>
            </ol>
        </nav>
        {{-- button for jumo to the comment/QA section --}}
        <div class="jump-comment">
            <a href="#comment-start" class="textdecoration-none">
                <i class="fa-regular fa-comments"></i>
                Jump to comments 
                <i class="fa-solid fa-arrow-turn-down"></i>
            </a>
        </div>

        <!-- recipe detail area -->
        <div class="recipe-detail detailrecipe pt-3">  
            <!-- avatar&writer's name -->
            <div class="mb-3">
                <a 
                    href="{{ route('writer',['post_id'=>$recipe->id, 'user_id'=>$recipe->user_id]) }}"
                    class="writer-name d-flex py-auto"
                >
                    @if ($recipe->user->avatar)
                        <img src="{{ $recipe->user->avatar }}" alt="{{ $recipe->user->name }}" class="chef-icon mr-2 rounded-circle">
                    @else
                        <img src="{{ asset('/images/profile_icon.png') }}" alt="{{ $recipe->user->name }}" class="chef-icon mr-2 rounded-circle">
                    @endif
                    <p class="h3 align-self-center fill-flex my-auto writer-username">&nbsp;{{ $recipe->user->name }}</p>
                </a>
            </div>
            <h1 class="recipe-title mb-4 pt-3">
                @auth
                    <a href="{{ route('bookmark.toggle',['post_id' => $recipe->id])}}" class="text-decoration-none">
                        <i class="fa-bookmark {{ $recipe->bookmarkedBy->contains(Auth::id()) ? 'fas bookmarked' : 'fa-regular' }}"></i>
                    </a>
                @endauth
                {{ $recipe->title }}
            </h1>
            <div class="row">
                <div class="col-6">
                    @if($recipe->photo)
                        <img 
                            src="{{ $recipe->photo }}" 
                            alt="{{ $recipe->title }}" 
                            class="food-photo"
                        >
                    @else
                        <img 
                            src="{{ asset('/images/recipe_photos/weCook.png') }}" 
                            alt="{{ $recipe->title }}" 
                            class="food-photo"
                        >
                    @endif
                </div>
                <div class="col-6">
                    <div class="detail-content">
                        <!-- dish-category here -->
                        <span 
                            class="badge badge-primary ms-0 me-auto"
                        >
                            {{ $recipe->dish->name }}
                        </span>

                        <!-- cooking_time here -->
                        <span class="cooking-time me-auto ms-3">
                            <i class="far fa-clock mr-2 fa-xl me-3"></i>
                            {{ $recipe->cooking_time }}
                        </span>

                        <!-- Edit button here -->
                        @if(Auth::check()&&Auth::user()->id === $recipe->user_id)
                            <a 
                                href="{{ route('editmyrecipe',['id'=>$recipe->id]) }}" 
                                class="ml-3"
                            >
                                <i class="fas fa-pencil-alt fa-2xl mx-4"></i>
                            </a>
                        @endif
                    
                    </div>              
                    <h3>Ingredients</h3>
                    <ul>
                        @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                            <li>{{ $ingredient }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <h3>Description</h3>
            <ol>
                @foreach(explode("\n", $recipe->description) as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ol>
        </div>
    </div>
    {{-- landed place from the "jumo to the comment" button --}}
    <h5 id="comment-start"></h5>
    <!-- comment/Q&A area -->
    @include('comment_question.comment_qa')
</div> 
@endsection
