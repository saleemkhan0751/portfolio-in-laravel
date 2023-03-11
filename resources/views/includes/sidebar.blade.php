<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <!-- Main -->
            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
            <li class="{{ Request::is(['home']) ? 'active' : '' }}"><a href="{{ route('home') }}"><i
                        class="icon-home4"></i> <span>Dashboard</span></a></li>


            <!-- services Management -->
            <li class="{{ Request::is(['services/*', 'services']) ? 'active' : '' }}">
                <a href="{{ route('services.index') }}"><i class="icon-user-tie"></i> <span>services</span></a>
            </li>
            <!-- services Management -->

            <!-- testimonials Management -->
            <li class="{{ Request::is(['testimonials/*', 'testimonials']) ? 'active' : '' }}">
                <a href="{{ route('testimonials.index') }}"><i class="icon-user-tie"></i> <span>Testimonials</span></a>
            </li>
            <!-- testimonials Management -->

            <!-- teams Management -->
            <li class="{{ Request::is(['teams/*', 'teams']) ? 'active' : '' }}">
                <a href="{{ route('teams.index') }}"><i class="icon-user-tie"></i> <span>Teams</span></a>
            </li>
            <!-- teams Management -->

            <!-- portfolios Management -->
            <li class="{{ Request::is(['portfolios/*', 'portfolios']) ? 'active' : '' }}"   >
                <a href="{{ route('portfolios.index') }}"><i class="icon-user-tie"></i> <span>Portfolios</span></a>
            </li>
            <!-- portfolios Management -->
        </ul>
    </div>
</div>
<!-- /main navigation -->
