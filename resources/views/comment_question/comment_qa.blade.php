@vite(['resources\sass\comments\comment_qestion.scss'])
@vite(['resources\js\comment_qa_tabs.js'])

<!-- tab menu area-->
<div 
  class="comment_qa ms-5 py-5"
  id="content-comment"
>
  <div class="mx-auto">
    <div 
      class="tab me-auto mt-5" 
      style="max-width: 97%;"
    >
      <ul class="tab_menu m-0 p-0">
        <li 
          class="tab_menu-item w-100 is-active" 
          data-tab="01"
        >
          <i class="fa-regular fa-comments me-1"></i>
            <span class="tab-comments_questions">
              Comments&nbsp;
            </span>
            <span class="counts">({{ $recipe->comment->count() }})</span>
        </li>
        <li 
          class="tab_menu-item w-100" 
          data-tab="02"
        >
          <i class="fa-solid fa-file-circle-question"></i>
            <span class="tab-comments_questions">
              Q&A&nbsp;
            </span>
            <span class="counts">({{ $recipe->questions()->count() }})</span>
        </li>
      </ul>

        <!-- tab_panel area/ text here! -->
      <div class="tab_panel">
        <!-- Comment area -->
        @include('comment_question.comment')
        <!-- Question area -->
        @include('comment_question.question')
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="bootstrap.min.css">
  <!-- <script src="jquery.js"></script>
  <script src="bootstrap-maxlength.js"></script> -->