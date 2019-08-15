<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 27, 'title' => 'lesson_access',],
            ['id' => 28, 'title' => 'lesson_create',],
            ['id' => 29, 'title' => 'lesson_edit',],
            ['id' => 30, 'title' => 'lesson_view',],
            ['id' => 31, 'title' => 'lesson_delete',],
            ['id' => 32, 'title' => 'user_lesson_access',],
            ['id' => 33, 'title' => 'user_lesson_create',],
            ['id' => 34, 'title' => 'user_lesson_edit',],
            ['id' => 35, 'title' => 'user_lesson_view',],
            ['id' => 36, 'title' => 'user_lesson_delete',],
            ['id' => 37, 'title' => 'daily_challenge_access',],
            ['id' => 38, 'title' => 'daily_challenge_create',],
            ['id' => 39, 'title' => 'daily_challenge_edit',],
            ['id' => 40, 'title' => 'daily_challenge_view',],
            ['id' => 41, 'title' => 'daily_challenge_delete',],
            ['id' => 47, 'title' => 'daily_challenge_flag_access',],
            ['id' => 48, 'title' => 'daily_challenge_flag_create',],
            ['id' => 49, 'title' => 'daily_challenge_flag_edit',],
            ['id' => 50, 'title' => 'daily_challenge_flag_view',],
            ['id' => 51, 'title' => 'daily_challenge_flag_delete',],
            ['id' => 52, 'title' => 'daily_challenge_comment_access',],
            ['id' => 53, 'title' => 'daily_challenge_comment_create',],
            ['id' => 54, 'title' => 'daily_challenge_comment_edit',],
            ['id' => 55, 'title' => 'daily_challenge_comment_view',],
            ['id' => 56, 'title' => 'daily_challenge_comment_delete',],
            ['id' => 57, 'title' => 'daily_challenge_comment_flag_access',],
            ['id' => 58, 'title' => 'daily_challenge_comment_flag_create',],
            ['id' => 59, 'title' => 'daily_challenge_comment_flag_edit',],
            ['id' => 60, 'title' => 'daily_challenge_comment_flag_view',],
            ['id' => 61, 'title' => 'daily_challenge_comment_flag_delete',],
            ['id' => 62, 'title' => 'discussion_access',],
            ['id' => 63, 'title' => 'discussion_create',],
            ['id' => 64, 'title' => 'discussion_edit',],
            ['id' => 65, 'title' => 'discussion_view',],
            ['id' => 66, 'title' => 'discussion_delete',],
            ['id' => 67, 'title' => 'discussion_flag_access',],
            ['id' => 68, 'title' => 'discussion_flag_create',],
            ['id' => 69, 'title' => 'discussion_flag_edit',],
            ['id' => 70, 'title' => 'discussion_flag_view',],
            ['id' => 71, 'title' => 'discussion_flag_delete',],
            ['id' => 72, 'title' => 'discussion_comment_access',],
            ['id' => 73, 'title' => 'discussion_comment_create',],
            ['id' => 74, 'title' => 'discussion_comment_edit',],
            ['id' => 75, 'title' => 'discussion_comment_view',],
            ['id' => 76, 'title' => 'discussion_comment_delete',],
            ['id' => 77, 'title' => 'discussion_viewer_access',],
            ['id' => 78, 'title' => 'discussion_viewer_create',],
            ['id' => 79, 'title' => 'discussion_viewer_edit',],
            ['id' => 80, 'title' => 'discussion_viewer_view',],
            ['id' => 81, 'title' => 'discussion_viewer_delete',],
            ['id' => 82, 'title' => 'course_access',],
            ['id' => 83, 'title' => 'course_create',],
            ['id' => 84, 'title' => 'course_edit',],
            ['id' => 85, 'title' => 'course_view',],
            ['id' => 86, 'title' => 'course_delete',],
            ['id' => 87, 'title' => 'banner_access',],
            ['id' => 88, 'title' => 'banner_create',],
            ['id' => 89, 'title' => 'banner_edit',],
            ['id' => 90, 'title' => 'banner_view',],
            ['id' => 91, 'title' => 'banner_delete',],
            ['id' => 92, 'title' => 'course_introduction_access',],
            ['id' => 93, 'title' => 'course_introduction_create',],
            ['id' => 94, 'title' => 'course_introduction_edit',],
            ['id' => 95, 'title' => 'course_introduction_view',],
            ['id' => 96, 'title' => 'course_introduction_delete',],
            ['id' => 97, 'title' => 'daily_motivation_access',],
            ['id' => 98, 'title' => 'group_discussion_access',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
