<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <!-- Main -->
            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
            <li class="{{ Request::is(['dashboard']) ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
            <!-- User Management -->
            <li class="{{ Request::is(['users/*', 'users']) ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="icon-user-tie"></i> <span>User Management</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- /main navigation -->
