@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('lesson_access')
            <li>
                <a href="{{ route('admin.lessons.index') }}">
                    <i class="fa fa-bank"></i>
                    <span>@lang('global.lesson.title')</span>
                </a>
            </li>@endcan
            
            @can('user_lesson_access')
            <li>
                <a href="{{ route('admin.user_lessons.index') }}">
                    <i class="fa fa-book"></i>
                    <span>@lang('global.user-lesson.title')</span>
                </a>
            </li>@endcan
            
            @can('daily_motivation_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-asterisk"></i>
                    <span>@lang('global.daily-motivation.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('daily_challenge_access')
                    <li>
                        <a href="{{ route('admin.daily_challenges.index') }}">
                            <i class="fa fa-tasks"></i>
                            <span>@lang('global.daily-challenge.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('daily_challenge_flag_access')
                    <li>
                        <a href="{{ route('admin.daily_challenge_flags.index') }}">
                            <i class="fa fa-flag-o"></i>
                            <span>@lang('global.daily-challenge-flag.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('daily_challenge_comment_access')
                    <li>
                        <a href="{{ route('admin.daily_challenge_comments.index') }}">
                            <i class="fa fa-commenting-o"></i>
                            <span>@lang('global.daily-challenge-comment.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('daily_challenge_comment_flag_access')
                    <li>
                        <a href="{{ route('admin.daily_challenge_comment_flags.index') }}">
                            <i class="fa fa-flag-checkered"></i>
                            <span>@lang('global.daily-challenge-comment-flag.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('group_discussion_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fax"></i>
                    <span>@lang('global.group-discussion.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('discussion_access')
                    <li>
                        <a href="{{ route('admin.discussions.index') }}">
                            <i class="fa fa-comments"></i>
                            <span>@lang('global.discussion.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('discussion_flag_access')
                    <li>
                        <a href="{{ route('admin.discussion_flags.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            <span>@lang('global.discussion-flag.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('discussion_comment_access')
                    <li>
                        <a href="{{ route('admin.discussion_comments.index') }}">
                            <i class="fa fa-comment"></i>
                            <span>@lang('global.discussion-comment.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('discussion_viewer_access')
                    <li>
                        <a href="{{ route('admin.discussion_viewers.index') }}">
                            <i class="fa fa-eye"></i>
                            <span>@lang('global.discussion-viewer.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('course_access')
            <li>
                <a href="{{ route('admin.courses.index') }}">
                    <i class="fa fa-connectdevelop"></i>
                    <span>@lang('global.courses.title')</span>
                </a>
            </li>@endcan
            
            @can('banner_access')
            <li>
                <a href="{{ route('admin.banners.index') }}">
                    <i class="fa fa-archive"></i>
                    <span>@lang('global.banners.title')</span>
                </a>
            </li>@endcan
            
            @can('course_introduction_access')
            <li>
                <a href="{{ route('admin.course_introductions.index') }}">
                    <i class="fa fa-adjust"></i>
                    <span>@lang('global.course-introduction.title')</span>
                </a>
            </li>@endcan
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

