<!-- Main Sidebar -->
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="#" class="sidebar-brand">
                <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong
                            class="fz-15">Sunamganj College</strong></span>
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-avatar">
                    <a href="page_ready_user_profile.html">
                        <img src="{{ asset('assets/img/placeholders/avatars/avatar2.jpg') }}"
                             alt="avatar">
                    </a>
                </div>

                <?php
                $user = Sentinel::getUser();
                $username = $user->first_name . ' ' . $user->last_name;
                ?>

                <div class="sidebar-user-name">{{ $username }}</div>
                <div class="sidebar-user-links">
                    <a href="page_ready_user_profile.html" data-toggle="tooltip" data-placement="bottom"
                       title="Profile"><i class="gi gi-user"></i></a>
                    <a href="page_ready_inbox.html" data-toggle="tooltip" data-placement="bottom"
                       title="Messages"><i class="gi gi-envelope"></i></a>
                    <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                    <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings"
                       onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                    <a href="{{ route('logout') }}" data-toggle="tooltip" data-placement="bottom" title="Logout"><i
                                class="gi gi-exit"></i></a>
                </div>
            </div>
            <!-- END User Info -->

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="index.html"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span
                                class="sidebar-nav-mini-hide">Dashboard</span></a>
                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu">
                        <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="gi gi-shopping_cart sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Students</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('participant.index') }}">All</a>
                        </li>
                        <li>
                            <a href="{{ route('participant.index', 'former-students') }}">Former Students</a>
                        </li>
                        <li>
                            <a href="{{ route('participant.index', 'nrb-former-students') }}">Non Returning Bangladeshi Former Students</a>
                        </li>
                        <li>
                            <a href="{{ route('participant.index', 'current-students') }}">Current Students</a>
                        </li>

                    </ul>
                </li>

            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->
