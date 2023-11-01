{{-- @extends('main')

@section('header') --}}


    <aside id="sidebar" class="sidebar break-point-sm has-bg-image">
        <a id="btn-collapse" class="sidebar-collapser"><i class="ri-arrow-left-s-line" style="text-decoration: none;"></i></a>
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
                <nav class="menu open-current-submenu" style="font-size:0.9em;">
                    <ul>
                        <li class="menu-header"><span> GENERAL </span></li>
                        <li class="menu-item sub-menu">
                            <a href="#" style="text-decoration: none;">
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
                                        <a href="/register-team-member" style="text-decoration: none;">
                                            <span class="menu-title">Add Team Member</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/team" style="text-decoration: none;">
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
                            <a href="#" style="text-decoration: none;">
                                <span class="menu-icon">
                                    <i class="ri-bar-chart-2-fill"></i>
                                </span>
                                <span class="menu-title">Clients</span>
                            </a>
                            <div class="sub-menu-list">
                                <ul>
                                    <li class="menu-item">
                                        <a href="/register-client" style="text-decoration: none;">
                                            <span class="menu-title">Add Client</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/clients" style="text-decoration: none;">
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
                            <a href="#" style="text-decoration: none;">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-diagram-project"></i>
                                </span>
                                <span class="menu-title">Projects</span>
                            </a>
                            <div class="sub-menu-list">
                                <ul >
                                    <li class="menu-item">
                                        <a href="/project" style="text-decoration: none;">
                                            <span class="menu-title">View Projects</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/Project"  style="text-decoration: none;">
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
<style>
    @import url(./Theme.css);

.layout {
    z-index: 1;
}
.layout .header {
    display: flex;
    align-items: center;
    padding: 20px;
}
.layout .content {
    padding: 0px 35px;
    margin: 0;
    /* padding: 0; */
    display: flex;
    flex-direction: column;
}
.layout .footer {
    text-align: center;
    margin-top: auto;
    /* margin-bottom: 20px; */
    /* padding: 20px; */
    height: auto;
    min-height: auto;
}
.sidebar {
    color: #3a3a3a;
    overflow-x: hidden !important;
    position: relative;
}
.sidebar::-webkit-scrollbar-thumb {
    border-radius: 4px;
}
.sidebar:hover::-webkit-scrollbar-thumb {
    background-color: #00C514;
}
.sidebar::-webkit-scrollbar {
    width: 6px;
    background-color: #00C514;
}
.sidebar .image-wrapper {
    overflow: hidden;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    display: none;
}
.sidebar .image-wrapper > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
.sidebar.has-bg-image .image-wrapper {
    display: block;
}
.sidebar .sidebar-layout {
    height: auto;
    min-height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    background-color: var(--sidebar-bg-color);
    z-index: 2;
}
.sidebar .sidebar-layout .sidebar-header {
    height: 100px;
    min-height: 100px;
    display: flex;
    align-items: center;
    padding: 0 20px;
}
.sidebar .sidebar-layout .sidebar-header > span {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.sidebar .sidebar-layout .sidebar-content {
    flex-grow: 1;
    padding: 10px 0;
}
.sidebar .sidebar-layout .sidebar-footer {
    height: 230px;
    min-height: 230px;
    display: flex;
    align-items: center;
    padding: 0 20px;
}
.sidebar .sidebar-layout .sidebar-footer > span {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
@keyframes swing {
    0%,
    30%,
    50%,
    70%,
    100% {
        transform: rotate(0deg);
    }
    10% {
        transform: rotate(10deg);
    }
    40% {
        transform: rotate(-10deg);
    }
    60% {
        transform: rotate(5deg);
    }
    80% {
        transform: rotate(-5deg);
    }
}
.layout .sidebar .menu ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}
.layout .sidebar .menu .menu-header {
    font-weight: 600;
    padding: 10px 25px;
    font-size: 0.8em;
    letter-spacing: 2px;
    transition: opacity 0.3s;
    opacity: 0.5;
}
.layout .sidebar .menu .menu-item a {
    display: flex;
    align-items: center;
    height: 50px;
    padding: 0 20px;
    color: #3a3a3a;
}
.layout .sidebar .menu .menu-item a .menu-icon {
    font-size: 1.2rem;
    width: 35px;
    min-width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    display: inline-block;
    margin-right: 10px;
    border-radius: 2px;
    transition: color 0.3s;
}
.layout .sidebar .menu .menu-item a .menu-icon i {
    display: inline-block;
}
.layout .sidebar .menu .menu-item a .menu-title {
    font-size: 0.9em;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    flex-grow: 1;
    transition: color 0.3s;
}
.layout .sidebar .menu .menu-item a .menu-prefix,
.layout .sidebar .menu .menu-item a .menu-suffix {
    display: inline-block;
    padding: 5px;
    opacity: 1;
    transition: opacity 0.3s;
}
.layout .sidebar .menu .menu-item a:hover .menu-title {
    color: #00C514;
}
.layout .sidebar .menu .menu-item a:hover .menu-icon {
    color: #00C514;
}
.layout .sidebar .menu .menu-item a:hover .menu-icon i {
    animation: swing ease-in-out 0.5s 1 alternate;
}
.layout .sidebar .menu .menu-item a:hover::after {
    border-color: #00C514 !important;
}
.layout .sidebar .menu .menu-item.sub-menu {
    position: relative;
}
.layout .sidebar .menu .menu-item.sub-menu > a::after {
    content: "";
    transition: transform 0.3s;
    border-right: 2px solid currentcolor;
    border-bottom: 2px solid currentcolor;
    width: 5px;
    height: 5px;
    transform: rotate(-45deg);
}
.layout .sidebar .menu .menu-item.sub-menu > .sub-menu-list {
    padding-left: 20px;
    display: none;
    overflow: hidden;
    z-index: 999;
}
.layout .sidebar .menu .menu-item.sub-menu.open > a {
    color: #3a3a3a;
}
.layout .sidebar .menu .menu-item.sub-menu.open > a::after {
    transform: rotate(45deg);
}
.layout .sidebar .menu .menu-item.active > a .menu-title {
    color: #dee2ec;
}
.layout .sidebar .menu .menu-item.active > a::after {
    border-color: #dee2ec;
}
.layout .sidebar .menu .menu-item.active > a .menu-icon {
    color: #dee2ec;
}
.layout .sidebar .menu > ul > .sub-menu > .sub-menu-list {
    background-color: #E2E2E2;
}
.layout .sidebar .menu.icon-shape-circle .menu-item a .menu-icon,
.layout .sidebar .menu.icon-shape-rounded .menu-item a .menu-icon,
.layout .sidebar .menu.icon-shape-square .menu-item a .menu-icon {
    background-color: #E2E2E2;
}
.layout .sidebar .menu.icon-shape-circle .menu-item a .menu-icon {
    border-radius: 50%;
}
.layout .sidebar .menu.icon-shape-rounded .menu-item a .menu-icon {
    border-radius: 4px;
}
.layout .sidebar .menu.icon-shape-square .menu-item a .menu-icon {
    border-radius: 0;
}
.layout
    .sidebar:not(.collapsed)
    .menu
    > ul
    > .menu-item.sub-menu
    > .sub-menu-list {
    visibility: visible !important;
    position: static !important;
    transform: translate(0, 0) !important;
}
.layout .sidebar.collapsed .menu > ul > .menu-header {
    opacity: 0;
}
.layout .sidebar.collapsed .menu > ul > .menu-item > a .menu-prefix,
.layout .sidebar.collapsed .menu > ul > .menu-item > a .menu-suffix {
    opacity: 0;
}
.layout .sidebar.collapsed .menu > ul > .menu-item.sub-menu > a::after {
    content: "";
    width: 5px;
    height: 5px;
    background-color: currentcolor;
    border-radius: 50%;
    display: inline-block;
    position: absolute;
    right: 10px;
    top: 50%;
    border: none;
    transform: translateY(-50%);
}
.layout .sidebar.collapsed .menu > ul > .menu-item.sub-menu > a:hover::after {
    background-color: #E2E2E2;
}
.layout .sidebar.collapsed .menu > ul > .menu-item.sub-menu > .sub-menu-list {
    transition: none !important;
    width: 200px;
    margin-left: 3px !important;
    border-radius: 4px;
    display: block !important;
}
.layout .sidebar.collapsed .menu > ul > .menu-item.active > a::after {
    background-color: #E2E2E2;
}
.layout .sidebar.has-bg-image .menu.icon-shape-circle .menu-item a .menu-icon,
.layout .sidebar.has-bg-image .menu.icon-shape-rounded .menu-item a .menu-icon,
.layout .sidebar.has-bg-image .menu.icon-shape-square .menu-item a .menu-icon {
    background-color: #bbbbbbd3;
}
.layout
    .sidebar.has-bg-image:not(.collapsed)
    .menu
    > ul
    > .sub-menu
    > .sub-menu-list {
    background-color: #bbbbbbd3;
}
.layout.rtl .sidebar .menu .menu-item a .menu-icon {
    margin-left: 10px;
    margin-right: 0;
}
.layout.rtl .sidebar .menu .menu-item.sub-menu > a::after {
    transform: rotate(135deg);
}
.layout.rtl .sidebar .menu .menu-item.sub-menu > .sub-menu-list {
    padding-left: 0;
    padding-right: 20px;
}
.layout.rtl .sidebar .menu .menu-item.sub-menu.open > a::after {
    transform: rotate(45deg);
}
.layout.rtl .sidebar.collapsed .menu > ul > .menu-item.sub-menu a::after {
    right: auto;
    left: 10px;
}
.layout.rtl
    .sidebar.collapsed
    .menu
    > ul
    > .menu-item.sub-menu
    > .sub-menu-list {
    margin-left: -3px !important;
}
* {
    box-sizing: border-box;
}
body {
    margin: 0;
    height: 100vh;
    font-family: "Poppins", sans-serif;
    color: #3a3a3a;
    font-size: 0.9rem;
}
a {
    text-decoration: none;
}
@media (max-width: 576px) {
    #btn-collapse {
        display: none;
    }
}
.layout .sidebar .pro-sidebar-logo {
    display: flex;
    align-items: center;
}
.layout .sidebar .pro-sidebar-logo > div {
    width: 35px;
    min-width: 35px;
    height: 35px;
    min-height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: white;
    font-size: 24px;
    font-weight: 700;
    background-color: transparent;
    margin-right: 10px;
}
.layout .sidebar .pro-sidebar-logo > h5 {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    font-size: 20px;
    line-height: 30px;
    transition: opacity 0.3s;
    opacity: 1;
}
.layout .sidebar .footer-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 0.8em;
    padding: 20px 0;
    border-radius: 8px;
    width: 180px;
    min-width: 190px;
    margin: 0 auto;
    background-color: #E2E2E2;
}
.layout .sidebar .footer-box img.react-logo {
    width: 40px;
    height: 40px;
    margin-bottom: 10px;
}
.layout .sidebar .footer-box a {
    color: #fff;
    font-weight: 600;
    margin-bottom: 10px;
}
.layout .sidebar .sidebar-collapser {
    transition: left, right, 0.3s;
    position: fixed;
    left: 260px;
    top: 40px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #00C514;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    justify-content: center;
    font-size: 1.2em;
    transform: translateX(50%);
    z-index: 111;
    cursor: pointer;
    color: white;
    box-shadow: 1px 1px 4px #0c1e35;
}
.layout .sidebar.collapsed .pro-sidebar-logo > h5 {
    opacity: 0;
}
.layout .sidebar.collapsed .footer-box {
    display: none;
}
.layout .sidebar.collapsed .sidebar-collapser {
    left: 60px;
}
.layout .sidebar.collapsed .sidebar-collapser i {
    transform: rotate(180deg);
}
.badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    color: #fff;
    background-color: #6c757d;
}
.badge.primary {
    background-color: #ab2dff;
}
.badge.secondary {
    background-color: #079b0b;
}
.sidebar-toggler {
    position: fixed;
    right: 20px;
    top: 20px;
}
.social-links a {
    margin: 0 10px;
    color: #3a3a3a;
}

</style>

<script src="{{ URL::asset('js/header.js') }}"></script>
{{-- <link rel="stylesheet" href="{{ asset('css/header.css') }}"> --}}

