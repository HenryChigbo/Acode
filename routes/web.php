<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('lessons', 'Admin\LessonsController');
    Route::post('lessons_mass_destroy', ['uses' => 'Admin\LessonsController@massDestroy', 'as' => 'lessons.mass_destroy']);
    Route::post('lessons_restore/{id}', ['uses' => 'Admin\LessonsController@restore', 'as' => 'lessons.restore']);
    Route::delete('lessons_perma_del/{id}', ['uses' => 'Admin\LessonsController@perma_del', 'as' => 'lessons.perma_del']);
    Route::resource('user_lessons', 'Admin\UserLessonsController');
    Route::post('user_lessons_mass_destroy', ['uses' => 'Admin\UserLessonsController@massDestroy', 'as' => 'user_lessons.mass_destroy']);
    Route::post('user_lessons_restore/{id}', ['uses' => 'Admin\UserLessonsController@restore', 'as' => 'user_lessons.restore']);
    Route::delete('user_lessons_perma_del/{id}', ['uses' => 'Admin\UserLessonsController@perma_del', 'as' => 'user_lessons.perma_del']);
    Route::resource('daily_challenges', 'Admin\DailyChallengesController');
    Route::post('daily_challenges_mass_destroy', ['uses' => 'Admin\DailyChallengesController@massDestroy', 'as' => 'daily_challenges.mass_destroy']);
    Route::post('daily_challenges_restore/{id}', ['uses' => 'Admin\DailyChallengesController@restore', 'as' => 'daily_challenges.restore']);
    Route::delete('daily_challenges_perma_del/{id}', ['uses' => 'Admin\DailyChallengesController@perma_del', 'as' => 'daily_challenges.perma_del']);
    Route::resource('daily_challenge_flags', 'Admin\DailyChallengeFlagsController');
    Route::post('daily_challenge_flags_mass_destroy', ['uses' => 'Admin\DailyChallengeFlagsController@massDestroy', 'as' => 'daily_challenge_flags.mass_destroy']);
    Route::post('daily_challenge_flags_restore/{id}', ['uses' => 'Admin\DailyChallengeFlagsController@restore', 'as' => 'daily_challenge_flags.restore']);
    Route::delete('daily_challenge_flags_perma_del/{id}', ['uses' => 'Admin\DailyChallengeFlagsController@perma_del', 'as' => 'daily_challenge_flags.perma_del']);
    Route::resource('daily_challenge_comments', 'Admin\DailyChallengeCommentsController');
    Route::post('daily_challenge_comments_mass_destroy', ['uses' => 'Admin\DailyChallengeCommentsController@massDestroy', 'as' => 'daily_challenge_comments.mass_destroy']);
    Route::post('daily_challenge_comments_restore/{id}', ['uses' => 'Admin\DailyChallengeCommentsController@restore', 'as' => 'daily_challenge_comments.restore']);
    Route::delete('daily_challenge_comments_perma_del/{id}', ['uses' => 'Admin\DailyChallengeCommentsController@perma_del', 'as' => 'daily_challenge_comments.perma_del']);
    Route::resource('daily_challenge_comment_flags', 'Admin\DailyChallengeCommentFlagsController');
    Route::post('daily_challenge_comment_flags_mass_destroy', ['uses' => 'Admin\DailyChallengeCommentFlagsController@massDestroy', 'as' => 'daily_challenge_comment_flags.mass_destroy']);
    Route::post('daily_challenge_comment_flags_restore/{id}', ['uses' => 'Admin\DailyChallengeCommentFlagsController@restore', 'as' => 'daily_challenge_comment_flags.restore']);
    Route::delete('daily_challenge_comment_flags_perma_del/{id}', ['uses' => 'Admin\DailyChallengeCommentFlagsController@perma_del', 'as' => 'daily_challenge_comment_flags.perma_del']);
    Route::resource('discussions', 'Admin\DiscussionsController');
    Route::post('discussions_mass_destroy', ['uses' => 'Admin\DiscussionsController@massDestroy', 'as' => 'discussions.mass_destroy']);
    Route::post('discussions_restore/{id}', ['uses' => 'Admin\DiscussionsController@restore', 'as' => 'discussions.restore']);
    Route::delete('discussions_perma_del/{id}', ['uses' => 'Admin\DiscussionsController@perma_del', 'as' => 'discussions.perma_del']);
    Route::resource('discussion_flags', 'Admin\DiscussionFlagsController');
    Route::post('discussion_flags_mass_destroy', ['uses' => 'Admin\DiscussionFlagsController@massDestroy', 'as' => 'discussion_flags.mass_destroy']);
    Route::post('discussion_flags_restore/{id}', ['uses' => 'Admin\DiscussionFlagsController@restore', 'as' => 'discussion_flags.restore']);
    Route::delete('discussion_flags_perma_del/{id}', ['uses' => 'Admin\DiscussionFlagsController@perma_del', 'as' => 'discussion_flags.perma_del']);
    Route::resource('discussion_comments', 'Admin\DiscussionCommentsController');
    Route::post('discussion_comments_mass_destroy', ['uses' => 'Admin\DiscussionCommentsController@massDestroy', 'as' => 'discussion_comments.mass_destroy']);
    Route::post('discussion_comments_restore/{id}', ['uses' => 'Admin\DiscussionCommentsController@restore', 'as' => 'discussion_comments.restore']);
    Route::delete('discussion_comments_perma_del/{id}', ['uses' => 'Admin\DiscussionCommentsController@perma_del', 'as' => 'discussion_comments.perma_del']);
    Route::resource('discussion_viewers', 'Admin\DiscussionViewersController');
    Route::post('discussion_viewers_mass_destroy', ['uses' => 'Admin\DiscussionViewersController@massDestroy', 'as' => 'discussion_viewers.mass_destroy']);
    Route::post('discussion_viewers_restore/{id}', ['uses' => 'Admin\DiscussionViewersController@restore', 'as' => 'discussion_viewers.restore']);
    Route::delete('discussion_viewers_perma_del/{id}', ['uses' => 'Admin\DiscussionViewersController@perma_del', 'as' => 'discussion_viewers.perma_del']);
    Route::resource('courses', 'Admin\CoursesController');
    Route::post('courses_mass_destroy', ['uses' => 'Admin\CoursesController@massDestroy', 'as' => 'courses.mass_destroy']);
    Route::post('courses_restore/{id}', ['uses' => 'Admin\CoursesController@restore', 'as' => 'courses.restore']);
    Route::delete('courses_perma_del/{id}', ['uses' => 'Admin\CoursesController@perma_del', 'as' => 'courses.perma_del']);
    Route::resource('banners', 'Admin\BannersController');
    Route::post('banners_mass_destroy', ['uses' => 'Admin\BannersController@massDestroy', 'as' => 'banners.mass_destroy']);
    Route::post('banners_restore/{id}', ['uses' => 'Admin\BannersController@restore', 'as' => 'banners.restore']);
    Route::delete('banners_perma_del/{id}', ['uses' => 'Admin\BannersController@perma_del', 'as' => 'banners.perma_del']);
    Route::resource('course_introductions', 'Admin\CourseIntroductionsController');
    Route::post('course_introductions_mass_destroy', ['uses' => 'Admin\CourseIntroductionsController@massDestroy', 'as' => 'course_introductions.mass_destroy']);
    Route::post('course_introductions_restore/{id}', ['uses' => 'Admin\CourseIntroductionsController@restore', 'as' => 'course_introductions.restore']);
    Route::delete('course_introductions_perma_del/{id}', ['uses' => 'Admin\CourseIntroductionsController@perma_del', 'as' => 'course_introductions.perma_del']);



 
});
