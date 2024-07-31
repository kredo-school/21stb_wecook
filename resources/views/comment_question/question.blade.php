<div 
  class="tab_panel-box" 
  data-panel="02"
>
 <!-- add question&answer -->
  <div class="tab_panel-text">
    @if(Auth::check()&&Auth::user()->id !== $recipe->user->id)
      <!-- add question --> 
      <form 
        action="{{ route('question',$recipe->id) }}" 
        method="post" 
        class="px-5 d-flex my-5"
      >
        @csrf 
        <input 
          type="text" 
          name="question" 
          id="question" 
          class="w-100 p-1" 
          placeholder="Your question here"
        >
        <button 
          type="submit" 
          class="ms-1 p-1 border-0 rounded add" 
        >
          Add Qestion
        </button>
      </form>
      @if ($all_questions->count() == 0)
        <div class="col-auto text-center mt-5">
          <p class="h2 sorry">No questions yet!</p>
        </div>
      @endif
    @elseif(!Auth::user()) 
      <h3 
        class="text-center my-5"
      >
        Adding Comment is for auth users only, <a href="{{ route('register') }}"">Register</a> or <a href="{{ route('login') }}"">Login</a>
      </h3>
    @elseif(Auth::check()&&Auth::user()->id === $recipe->user->id)
      @if ($all_questions->count() == 0)
        <div class="col-auto text-center mt-5">
          <p class="h2 sorry">No questions yet!</p>
        </div>
      @endif
    @endif
      
    <!-- Q&A area -->
    <div class="p-3 mx-5 mb-3 questions">
      @foreach($all_questions as $question)
        <div class="row user_question ms-0">
          <!-- edit&delete button --> 
          <div class="col-auto p-0 h-25 my-auto">
            @if(Auth::user() && Auth::user()->id === $question->user_id )
              <button 
                type="button" 
                class="edit-btn ms-3 px-4"
                data-bs-toggle="modal" 
                data-bs-target="#questionEdit-{{ $question->id }}"
              >
                Edit
              </button>
              @include('comment_question.modal.question_update')

              <form 
                action="{{ route('delete.question', $question->id) }}" 
                method="post"
                class="delete-btn d-inline-flex"
              >
                @csrf
                @method('DELETE')
                <button 
                  type="submit" 
                  class="px-4 ms-2 me-0 mt-2"
                >
                  Delete
                </button>
              </form>
            @endif
          </div>
          <div class="col-sm-1 p-0 h-25 mt-5 ms-auto text-end">
            <p 
              class="text-uppercase small ms-auto pt-4" 
              style="color: #4D1F0191;"
            >
            {{ date('M d, Y', strtotime($question->created_at)) }}
            </p>
          </div>
          <div class="col-8 question_body px-4 ms-2">
            <div class="my-auto p-1 q-content">
              <i class="fa-solid fa-q fa-3x q_icon"></i>
              <p class="qa_body text-start"> {{ $question->body}} </p>
            </div>
          </div>
          <div class="col-1 text-start user_account p-0 ms-0">
            @if($question->user->avatar)
              <img src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}" class="ms-3">
              <p class="username my-auto p-1">{{ $question->user->name}}</p>
            @else
              <div class="ps-1">
                <img src="{{ asset('images\profile_icon.png') }}" alt="">
              </div>
              <p class="username my-auto p-1">{{ $question->user->name}}</p>
            @endif 
          </div>
        </div>
        <!-- answer area -->
        <div class="row user_answer mb-3">
          @if($question->answers->count() > 0)
            <div class="col-1 text-start user_account p-0 me-0 ms-0">
              @if($recipe->user->avatar)
                <img src="{{ $recipe->user->avatar }}" alt="" class="ms-3">
                <p class="username my-auto p-1">
                  {{$recipe->user->name }}
                </p>
              @else
                <div class="ps-1">
                  <img src="{{ asset('images\profile_icon.png') }}" alt="">
                </div>
                <p class="username my-auto p-1">
                  {{ $recipe->user->name }}
                </p>
              @endif 
            </div>
            <div class="col-8 answer_body me-0">
              <div class="my-auto p-1 a-content">
                <i class="fa-solid fa-a fa-3x a_icon"></i>
                <p class="qa_body">
                  {{ $question->answer($question->id)->body }} 
                </p>
              </div>
            </div>
            <div class="col-1 mt-5 me-auto">
              <p 
                class="text-uppercase small pt-4" 
                style="color: #4D1F0191;"
              >
                {{ date('M d, Y', strtotime($question->answer($question->id)->created_at)) }}
              </p>
            </div>
            <!-- edit&delete button -->
            <div class="col-auto p-0 h-25 mt-5">
              @if(Auth::user() && Auth::user()->id === $recipe->user_id)
                <button 
                  type="button" 
                  class="edit-btn ms-3 px-4"
                  data-bs-toggle="modal" 
                  data-bs-target="#answerEdit-{{ $question->answer($question->id)->id }}"
                >
                  Edit
                </button>
                @include('comment_question.modal.answer_update')

                <form 
                  action="{{ route('delete.answer', $question->answer($question->id)->id) }}" 
                  method="post"
                  class="delete-btn d-inline-flex"
                >
                  @csrf
                  @method('DELETE')
                  <button 
                    type="submit" 
                    class="px-4 ms-2 me-0 mt-2"
                  >
                    Delete
                  </button>
                </form>
              @endif
            </div>
          @else
            <!-- add answer -->
            @if(Auth::check() && Auth::user()->id === $recipe->user->id)
              <form 
                action="{{ route('answer',$question->id) }}" 
                method="post"
                class="px-5 d-flex my-5"
              >
                @csrf 
                <input 
                  type="text" 
                  name="answer" 
                  id="answer" 
                  class="w-100 p-1" 
                  placeholder="Your answer here"
                >
                <button 
                  type="submit" 
                  class="ms-1 p-1 border-0 rounded add" 
                >
                  Add Answer
                </button>
              </form>
            @endif
          @endif
        </div>
      @endforeach
    </div>
  </div>
  <div class="mx-auto py-1">
    {{ $all_questions->links() }}
  </div>
  
</div>