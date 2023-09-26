{{-- @extends('main')

@section('header') --}}

    <aside id="sidebar" class="sidebar break-point-sm has-bg-image">
        <a id="btn-collapse" class="sidebar-collapser"><i class="ri-arrow-left-s-line"></i></a>
        <div class="image-wrapper">
            {{-- <img src="assets/images/sidebar-bg.jpg" alt="sidebar background" /> --}}
        </div>
        <div class="sidebar-layout">
            <div class="sidebar-header">
                <div class="pro-sidebar-logo">
                    <div><img src="{{ URL::asset('images/Domain Bird Logo.png') }}" /></div>
                    <h5>Domain Bird</h5>
                </div>
            </div>
            <div class="sidebar-content">
                <nav class="menu open-current-submenu">
                    <ul>
                        <li class="menu-header"><span> GENERAL </span></li>
                        <li class="menu-item sub-menu">
                            <a href="#">
                                <span class="menu-icon">
                                    <i class="ri-vip-diamond-fill"></i>
                                </span>
                                <span class="menu-title">Team</span>
                                <!-- <span class="menu-suffix">
                                    <span class="badge primary">Hot</span>
                                </span> -->
                            </a>
                            <div class="sub-menu-list">
                                <ul>
                                    <li class="menu-item">
                                        <a href="/register-team-member">
                                            <span class="menu-title">Add Team Member</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/team">
                                            <span class="menu-title">View Team Member</span>
                                        </a>
                                    </li>
                                    <!-- <li class="menu-item sub-menu">
                                        <a href="#">
                                            <span class="menu-title">Forms</span>
                                        </a>
                                        <div class="sub-menu-list">
                                            <ul>
                                                <li class="menu-item">
                                                    <a href="#">
                                                        <span class="menu-title">Input</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="#">
                                                        <span class="menu-title">Select</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item sub-menu">
                            <a href="#">
                                <span class="menu-icon">
                                    <i class="ri-bar-chart-2-fill"></i>
                                </span>
                                <span class="menu-title">Clients</span>
                            </a>
                            <div class="sub-menu-list">
                                <ul>
                                    <li class="menu-item">
                                        <a href="/register-client">
                                            <span class="menu-title">Add Client</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/clients">
                                            <span class="menu-title">View Clients</span>
                                        </a>
                                    </li>
                                    <!-- <li class="menu-item">
                                        <a href="#">
                                            <span class="menu-title">Bar chart</span>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item sub-menu">
                            <a href="#">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-diagram-project"></i>
                                </span>
                                <span class="menu-title">Projects</span>
                            </a>
                            <div class="sub-menu-list">
                                <ul>
                                    <li class="menu-item">
                                        <a href="/project">
                                            <span class="menu-title">View Projects</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/Project">
                                            <span class="menu-title">Create Project</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- <li class="menu-item sub-menu">
                            <a href="#">
                                <span class="menu-icon">
                                    <i class="ri-global-fill"></i>
                                </span>
                                <span class="menu-title">Maps</span>
                            </a>
                            <div class="sub-menu-list">
                                <ul>
                                    <li class="menu-item">
                                        <a href="#">
                                            <span class="menu-title">Google maps</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">
                                            <span class="menu-title">Open street map</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item sub-menu">
                            <a href="#">
                                <span class="menu-icon">
                                    <i class="ri-paint-brush-fill"></i>
                                </span>
                                <span class="menu-title">Theme</span>
                            </a>
                            <div class="sub-menu-list">
                                <ul>
                                    <li class="menu-item">
                                        <a href="#">
                                            <span class="menu-title">Dark</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">
                                            <span class="menu-title">Light</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-header" style="padding-top: 20px">
                            <span> EXTRA </span>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                <span class="menu-icon">
                                    <i class="ri-book-2-fill"></i>
                                </span>
                                <span class="menu-title">Documentation</span>
                                <span class="menu-suffix">
                                    <span class="badge secondary">Beta</span>
                                </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                <span class="menu-icon">
                                    <i class="ri-calendar-fill"></i>
                                </span>
                                <span class="menu-title">Calendar</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                <span class="menu-icon">
                                    <i class="ri-service-fill"></i>
                                </span>
                                <span class="menu-title">Examples</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div> -->
            <!-- <div class="sidebar-footer">
                <div class="footer-box">
                    <div>
                        <img class="react-logo" src="https://user-images.githubusercontent.com/25878302/213938106-ca8f0485-3f30-4861-9188-2920ed7ab284.png" alt="react" />
                    </div>
                    <div style="padding: 0 10px">
                        <span style="display: block; margin-bottom: 10px">Pro sidebar is also available as a react package
                        </span>
                        <div style="margin-bottom: 15px">
                            <img alt="preview badge" src="https://img.shields.io/github/stars/azouaoui-med/react-pro-sidebar?style=social" />
                        </div>
                        <div>
                            <a href="https://github.com/azouaoui-med/react-pro-sidebar" target="_blank">Check it out!</a>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </aside>

{{-- @endsection --}}


<script src="{{ URL::asset('js/header.js') }}"></script>
