
<!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        @php
                            $role = Auth::user()->role->name?? null;
                        @endphp
                        @if ($role ==='Admin')
                        <li> <a class="waves-effect waves-dark" href="../management/admin-dashboard" aria-expanded="false"><i class="mdi mdi-gauge "></i><span class="hide-menu text-wrap">Dashboard</span></a>
                        </li>
                        @endif

                        @if($role === 'Admin')
                            <li><a class="waves-effect waves-dark" href="../management/admin-information"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Information</span></a></li>
                        @endif
                        
                        @if(in_array($role, ['Admin', 'Booking manager']))
                            <li><a class="waves-effect waves-dark" href="../management/admin-booking"><i class="mdi mdi-account-check"></i><span class="hide-menu text-wrap">Booking</span></a></li>
                        @endif

                        @if(in_array($role, ['Admin', 'Statistics and reporting manager']))
                            <li><a class="waves-effect waves-dark" href="../management/admin-statistic"><i class="mdi mdi-table"></i><span class="hide-menu text-wrap">Statistics & Reporting</span></a></li>
                        @endif

                        @if(in_array($role, ['Admin', 'Packages manager']))
                            <li><a class="waves-effect waves-dark" href="../management/admin-package"><i class="mdi mdi-earth"></i><span class="hide-menu">Packages</span></a></li>
                        @endif

                        @if(in_array($role, ['Admin', 'Blogs manager']))
                            <li><a class="waves-effect waves-dark" href="../management/admin-blog"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Blogs</span></a></li>
                        @endif

                        @if(in_array($role, ['Admin', 'Contact manager']))
                            <li><a class="waves-effect waves-dark" href="../management/admin-contact"><i class="mdi mdi-help-circle"></i><span class="hide-menu">Contact</span></a></li>
                        @endif
                    </ul>
    
                </nav>
                <!-- End Sidebar navigation -->
            </div>
        
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->