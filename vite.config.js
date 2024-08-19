import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/_variables.scss',
                'resources/sass/admin.scss',
                'resources/sass/app.scss',
                'resources/sass/carousel.scss',
                'resources/sass/createrecipe.scss',
                'resources/sass/detailrecipe.scss',
                'resources/sass/editmyrecipe.scss',
                'resources/sass/footer.scss',
                'resources/sass/homepage.scss',
                'resources/sass/login.scss',
                'resources/sass/logout.scss',
                'resources/sass/mybookmark.scss',
                'resources/sass/mybookmark_tab.scss',
                'resources/sass/myrecipe.scss',
                'resources/sass/myrecipe_tab.scss',
                'resources/sass/navbar.scss',
                'resources/sass/profile_edit.scss',
                'resources/sass/recipe_card_homepage.scss',
                'resources/sass/register.scss',
                'resources/sass/search.scss',
                'resources/sass/status.scss',
                'resources/sass/style.scss',
                'resources/sass/writers.scss',
                'resources/sass/comments/answer_modal.scss',
                'resources/sass/comments/comment_modal.scss',
                'resources/sass/comments/comment_qestion.scss',
                'resources/sass/comments/question_modal.scss',

                'resources/js/app.js',
                'resources/js/bookmarks.js',
                'resources/js/bootstrap.js',
                'resources/js/comment_edit_old.js',
                'resources/js/comment_qa_tabs.js',
                'resources/js/logout_modal.js',
                'resources/js/mybookmark_tabs_pagination.js',
                'resources/js/mypage_tabs_pagination.js',
                'resources/js/search_keyword.js',
                'resources/js/search_tabs_pagination.js',
                'resources/js/search_tabs_page.js',
                'resources/js/tabs_paginate.js',
                'resources/js/tabs_pagination.js',
                'resources/js/tabs.js',
                'resources/js/tabs2.js',
                'resources/js/writer_tabs_pagination.js',
            ],
            refresh: true,
        }),
    ],
});
