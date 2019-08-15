<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);

        Route::resource('lessons', 'LessonsController', ['except' => ['create', 'edit']]);

        Route::resource('daily_challenges', 'DailyChallengesController', ['except' => ['create', 'edit']]);

        Route::resource('daily_challenge_flags', 'DailyChallengeFlagsController', ['except' => ['create', 'edit']]);

        Route::resource('daily_challenge_comments', 'DailyChallengeCommentsController', ['except' => ['create', 'edit']]);

        Route::resource('daily_challenge_comment_flags', 'DailyChallengeCommentFlagsController', ['except' => ['create', 'edit']]);

        Route::resource('discussions', 'DiscussionsController', ['except' => ['create', 'edit']]);

        Route::resource('discussion_flags', 'DiscussionFlagsController', ['except' => ['create', 'edit']]);

        Route::resource('discussion_comments', 'DiscussionCommentsController', ['except' => ['create', 'edit']]);

        Route::resource('discussion_viewers', 'DiscussionViewersController', ['except' => ['create', 'edit']]);

        Route::resource('courses', 'CoursesController', ['except' => ['create', 'edit']]);

        Route::resource('banners', 'BannersController', ['except' => ['create', 'edit']]);

        Route::resource('course_introductions', 'CourseIntroductionsController', ['except' => ['create', 'edit']]);

});
