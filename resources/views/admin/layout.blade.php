<!DOCTYPE html>
<html lang="en">

<head>

    <!-- begin::NexLink Meta Basic -->
    <meta charset="utf-8">
    <meta name="theme-color" content="#4B5563">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Kava Team">
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords"
        content="Kava, Kava Admin, Kava Dashboard, Kava Platform, Blockchain Admin, Crypto Dashboard, Admin Template">
    <meta name="description"
        content="Kava is a modern blockchain admin dashboard designed to manage and analyze blockchain-based projects, Kava platform data, and team performance with a seamless user experience and responsive layout.">
    <!-- end::Kava Meta Basic -->

    <!-- begin::Kava Meta Social -->
    <meta property="og:url" content="https://kava.example.com/">
    <meta property="og:site_name" content="Kava | Blockchain Admin Dashboard">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    <meta property="og:title" content="Kava | Blockchain Admin Dashboard">
    <meta property="og:description"
        content="Kava is a blockchain admin dashboard for managing, monitoring, and analyzing blockchain activities and project performance with an intuitive interface.">
    <meta property="og:image" content="https://kava.example.com/preview.png">
    <!-- end::Kava Meta Social -->

    <!-- begin::Kava Meta Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="https://kava.example.com/">
    <meta name="twitter:creator" content="@kavateam">
    <meta name="twitter:title" content="Kava | Blockchain Admin Dashboard">
    <meta name="twitter:description"
        content="Kava is an intuitive platform for managing and analyzing your blockchain and crypto projects in a unified and responsive admin dashboard.">
    <!-- end::Kava Meta Twitter -->

    <!-- begin::NexLink Website Page Title -->
    <title>KavaSwap | CRM Admin Dashboard Template</title>
    <!-- end::NexLink Website Page Title -->

    <!-- begin::NexLink Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end::NexLink Mobile Specific -->

    <!-- begin::NexLink Favicon Tags -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <!-- end::NexLink Favicon Tags -->

    <!-- begin::NexLink Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <!-- end::NexLink Google Fonts -->

    <!-- begin::NexLink Required Stylesheet -->
    <link rel="stylesheet" href="{{ asset('manager/assets/libs/flaticon/css/all/all.css') }}">
    <link rel="stylesheet" href="{{ asset('manager/assets/libs/lucide/lucide.css') }}">
    <link rel="stylesheet" href="{{ asset('manager/assets/libs/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('manager/assets/libs/simplebar/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('manager/assets/libs/node-waves/waves.css') }}">
    <link rel="stylesheet" href="{{ asset('manager/assets/libs/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('manager/assets/libs/flatpickr/flatpickr.min.css') }}">
    <!-- end::NexLink Required Stylesheet -->

    <!-- begin::NexLink CSS Stylesheet -->
    <link rel="stylesheet" href="{{ asset('manager/assets/libs/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('manager/assets/css/styles.css') }}">
    <!-- end::NexLink CSS Stylesheet -->



</head>

<body>
    <div class="page-layout">

        <!-- begin::NexLink Page Header -->
        <header class="app-header">
            <div class="app-header-inner">

                <div class="vr my-3"></div>
                <div class="dropdown text-end ms-sm-3 ms-2 ms-lg-4">
                    <a href="#" class="d-flex align-items-center py-2" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-expanded="true">
                        <div class="text-end me-2 d-none d-lg-inline-block">
                            <div class="fw-bold text-dark">Robert Brown</div>
                            <small class="text-body d-block lh-sm">
                                <i class="fi fi-rr-angle-down text-3xs me-1"></i> Manager
                            </small>
                        </div>
                        <div class="avatar avatar-sm rounded-circle avatar-status-success">
                            <img src="assets/images/avatar/avatar1.webp" alt="">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end w-225px mt-1">
                        <li class="d-flex align-items-center p-2">
                            <div class="avatar avatar-sm rounded-circle">
                                <img src="assets/images/avatar/avatar1.webp" alt="">
                            </div>
                            <div class="ms-2">
                                <div class="fw-bold text-dark">Robert Brown </div>
                                <small class="text-body d-block lh-sm">robert@gmail.com</small>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider my-1"></div>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="profile.html">
                                <i class="fi fi-rr-user scale-1x"></i> View Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="task-management.html">
                                <i class="fi fi-rr-note scale-1x"></i> My Task
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="settings.html">
                                <i class="fi fi-rr-settings scale-1x"></i> Account Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="pages/pricing.html">
                                <i class="fi fi-rr-usd-circle scale-1x"></i> Upgrade Plan
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider my-1"></div>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                href="authentication/login-basic.html">
                                <i class="fi fi-sr-exit scale-1x"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
    </header>
    <!-- end::NexLink Page Header -->

    <!-- begin::NexLink Sidebar Menu -->
    <aside class="app-menubar-tabs" id="appMenubar">
        <div class="app-tab-content">
            <div class="app-side-brands">
                <a class="navbar-brand-text" href="index.html">Kava Manager </a>
            </div>
            <div class="app-content-inner">
                <div class="tab-content" id="appMenubarTabsContent">
                    <div class="tab-pane fade show active" id="dashboardTab" role="tabpanel" tabindex="0">
                        <nav class="app-navbar" data-simplebar>
                            <ul class="side-menubar">
                                <li class="menu-heading">
                                    <span class="menu-label">Dashboard</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('customer.statistic') }}" role="button">
                                        <i class="fi fi-rr-percent-100"></i>
                                        <span class="menu-label">Sales Dashboard</span>
                                    </a>
                                </li>
                                <!-- <li class="menu-item">
                                    <a class="menu-link" href="finance.html" role="button">
                                        <i class="fi fi-rr-growth-chart-invest"></i>
                                        <span class="menu-label">Finance Dashboard</span>
                                    </a>
                                </li> -->
                                <!-- <li class="menu-item">
                                    <a class="menu-link" href="{{ route('customer.bot') }}" role="button">
                                        <i class="fi fi-rr-circle-user"></i>
                                        <span class="menu-label">BOT Management</span>
                                    </a>
                                </li> -->
                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane fade" id="appsTab" role="tabpanel" tabindex="0">
                        <nav class="app-navbar" data-simplebar>
                            <ul class="side-menubar">
                                <li class="menu-heading">
                                    <span class="menu-label">Apps</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="chat.html">
                                        <i class="fi fi-rr-comment"></i>
                                        <span class="menu-label">Chat</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="calendar.html">
                                        <i class="fi fi-rr-calendar"></i>
                                        <span class="menu-label">Calendar</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">Email</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="email/inbox.html">
                                        <i class="fi fi-rr-inbox-in"></i>
                                        <span class="menu-label">Inbox</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="email/compose.html">
                                        <i class="fi fi-rr-pen-field"></i>
                                        <span class="menu-label">Compose</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="email/read-email.html">
                                        <i class="fi fi-rr-envelope"></i>
                                        <span class="menu-label">Read email</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane fade" id="pagesTab" role="tabpanel" tabindex="0">
                        <nav class="app-navbar" data-simplebar>
                            <ul class="side-menubar">
                                <li class="menu-heading">
                                    <span class="menu-label">Pages</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/pricing.html">
                                        <i class="fi fi-rs-usd-circle"></i>
                                        <span class="menu-label">Pricing</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">Blog</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/blog.html">
                                        <i class="fi fi-rr-blog-text"></i>
                                        <span class="menu-label">Blog Grid</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/blog-list.html">
                                        <i class="fi fi-rr-blog-text"></i>
                                        <span class="menu-label">Blog List</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/blog-details.html">
                                        <i class="fi fi-rr-blog-text"></i>
                                        <span class="menu-label">Blog Details</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">Error</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/error-404.html">
                                        <i class="fi fi-rs-404"></i>
                                        <span class="menu-label">Basic</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/error-404-cover.html">
                                        <i class="fi fi-rs-404"></i>
                                        <span class="menu-label">Cover</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/error-404-full.html">
                                        <i class="fi fi-rs-404"></i>
                                        <span class="menu-label">Full</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">Under Construction</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/under-construction.html">
                                        <i class="fi fi-rr-under-construction"></i>
                                        <span class="menu-label">Basic</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/under-construction-cover.html">
                                        <i class="fi fi-rr-under-construction"></i>
                                        <span class="menu-label">Cover</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="pages/under-construction-full.html">
                                        <i class="fi fi-rr-under-construction"></i>
                                        <span class="menu-label">Full</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane fade" id="authenticationTab" role="tabpanel" tabindex="0">
                        <nav class="app-navbar" data-simplebar>
                            <ul class="side-menubar">
                                <li class="menu-heading">
                                    <span class="menu-label">Login</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/login-basic.html">
                                        <i class="fi fi-rr-unlock"></i>
                                        <span class="menu-label">Basic</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/login-cover.html">
                                        <i class="fi fi-rr-unlock"></i>
                                        <span class="menu-label">Cover</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/login-frame.html">
                                        <i class="fi fi-rr-unlock"></i>
                                        <span class="menu-label">Frame</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">Register</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/register-basic.html">
                                        <i class="fi fi-rr-enter"></i>
                                        <span class="menu-label">Basic</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/register-cover.html">
                                        <i class="fi fi-rr-enter"></i>
                                        <span class="menu-label">Cover</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/register-frame.html">
                                        <i class="fi fi-rr-enter"></i>
                                        <span class="menu-label">Frame</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">Forgot Password</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/forgot-password-basic.html">
                                        <i class="fi fi-rs-otp"></i>
                                        <span class="menu-label">Basic</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/forgot-password-cover.html">
                                        <i class="fi fi-rs-otp"></i>
                                        <span class="menu-label">Cover</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/forgot-password-frame.html">
                                        <i class="fi fi-rs-otp"></i>
                                        <span class="menu-label">Frame</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">New Password</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/new-password-basic.html">
                                        <i class="fi fi-rr-password-alt"></i>
                                        <span class="menu-label">Basic</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/new-password-cover.html">
                                        <i class="fi fi-rr-password-alt"></i>
                                        <span class="menu-label">Cover</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="authentication/new-password-frame.html">
                                        <i class="fi fi-rr-password-alt"></i>
                                        <span class="menu-label">Frame</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane fade" id="componentsTab" role="tabpanel" tabindex="0">
                        <nav class="app-navbar" data-simplebar>
                            <ul class="side-menubar">
                                <li class="menu-heading">
                                    <span class="menu-label">UI Components</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/accordion.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Accordion</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/alerts.html">
                                        <i class="fi fi-rs-bell"></i>
                                        <span class="menu-label">Alerts</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/badge.html">
                                        <i class="fi fi-rr-tags"></i>
                                        <span class="menu-label">Badge</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/breadcrumb.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Breadcrumb</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/buttons.html">
                                        <i class="fi fi-rr-toggle-on"></i>
                                        <span class="menu-label">Buttons</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/typography.html">
                                        <i class="fi fi-rr-text"></i>
                                        <span class="menu-label">Typography</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/button-group.html">
                                        <i class="fi fi-rr-toggle-on"></i>
                                        <span class="menu-label">Button Group</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/card.html">
                                        <i class="fi fi-rr-credit-card"></i>
                                        <span class="menu-label">Card</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/collapse.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Collapse</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/carousel.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Carousel</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/dropdowns.html">
                                        <i class="fi fi-rs-settings-sliders"></i>
                                        <span class="menu-label">Dropdowns</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/modal.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Modal</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/navbar.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Navbar</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/list-group.html">
                                        <i class="fi fi-rr-list"></i>
                                        <span class="menu-label">List Group</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/tabs.html">
                                        <i class="fi fi-rr-tab-folder"></i>
                                        <span class="menu-label">Tabs</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/offcanvas.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Offcanvas</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/pagination.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Pagination</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/popovers.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Popovers</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/progress.html">
                                        <i class="fi fi-sr-bars-progress"></i>
                                        <span class="menu-label">Progress</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/scrollspy.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Scrollspy</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/spinners.html">
                                        <i class="fi fi-br-loading"></i>
                                        <span class="menu-label">Spinners</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/toasts.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Toasts</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="components/tooltips.html">
                                        <i class="fi fi-rr-flux-capacitor"></i>
                                        <span class="menu-label">Tooltips</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane fade" id="extendedTab" role="tabpanel" tabindex="0">
                        <nav class="app-navbar" data-simplebar>
                            <ul class="side-menubar">
                                <li class="menu-heading">
                                    <span class="menu-label">Extended UI</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="extended-ui/avatar.html">
                                        <i class="fi fi-rr-circle-user"></i>
                                        <span class="menu-label">Avatar</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="extended-ui/card-action.html">
                                        <i class="fi fi-rr-credit-card"></i>
                                        <span class="menu-label">Card action</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="extended-ui/drag-and-drop.html">
                                        <i class="fi fi-rr-arrows"></i>
                                        <span class="menu-label">Drag & drop</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="extended-ui/simplebar.html">
                                        <i class="fi fi-rr-star"></i>
                                        <span class="menu-label">Simplebar</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="extended-ui/swiper.html">
                                        <i class="fi fi-rr-sliders-h-square"></i>
                                        <span class="menu-label">Swiper</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">Icons</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="icons/flaticon.html">
                                        <i class="fi fi-rr-star"></i>
                                        <span class="menu-label">Flaticon</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="icons/lucide.html">
                                        <i class="fi fi-rr-star"></i>
                                        <span class="menu-label">Lucide</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="icons/fontawesome.html">
                                        <i class="fi fi-rr-star"></i>
                                        <span class="menu-label">Font Awesome</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane fade" id="formElementsTab" role="tabpanel" tabindex="0">
                        <nav class="app-navbar" data-simplebar>
                            <ul class="side-menubar">
                                <li class="menu-heading">
                                    <span class="menu-label">Forms</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="forms/form-elements.html">
                                        <i class="fi fi-rr-form"></i>
                                        <span class="menu-label">Form Elements</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="forms/form-floating.html">
                                        <i class="fi fi-rr-form"></i>
                                        <span class="menu-label">Form Floating</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="forms/form-input-group.html">
                                        <i class="fi fi-rr-form"></i>
                                        <span class="menu-label">Form Input Group</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="forms/form-layout.html">
                                        <i class="fi fi-rr-form"></i>
                                        <span class="menu-label">Form Layout</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="forms/form-validation.html">
                                        <i class="fi fi-rr-form"></i>
                                        <span class="menu-label">Form Validation</span>
                                    </a>
                                </li>

                                <li class="menu-heading">
                                    <span class="menu-label">Forms Plugins</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="forms/flatpickr.html">
                                        <i class="fi fi-rr-calendar-lines"></i>
                                        <span class="menu-label">Flatpickr</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="forms/tagify.html">
                                        <i class="fi fi-rr-tags"></i>
                                        <span class="menu-label">Tagify</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">Table</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="table/tables-basic.html">
                                        <i class="fi fi-rr-table-list"></i>
                                        <span class="menu-label">Table</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="table/tables-datatable.html">
                                        <i class="fi fi-rr-table"></i>
                                        <span class="menu-label">Datatable</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="tab-pane fade" id="chartsTab" role="tabpanel" tabindex="0">
                        <nav class="app-navbar" data-simplebar>
                            <ul class="side-menubar">
                                <li class="menu-heading">
                                    <span class="menu-label">Charts</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="chart/apexchart.html">
                                        <i class="fi fi-br-chart-histogram"></i>
                                        <span class="menu-label">Apex Chart</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="chart/chartjs.html">
                                        <i class="fi fi-rr-chart-pie-alt"></i>
                                        <span class="menu-label">Chart JS</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="menu-divider"></div>
                                </li>
                                <li class="menu-heading">
                                    <span class="menu-label">Maps</span>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="maps/jsvectormap.html">
                                        <i class="fi fi-rr-marker"></i>
                                        <span class="menu-label">JS Vector Map</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="maps/leaflet.html">
                                        <i class="fi fi-rr-map-marker"></i>
                                        <span class="menu-label">Leaflet</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- end::NexLink Sidebar Menu -->

    <main class="app-wrapper">
        @yield('body')
    </main>

    <!-- begin::NexLink Footer -->
    <footer class="footer-wrapper bg-body">
        <div class="container-fluid">
            <div class="row g-2">
                <div class="col-lg-6 col-md-7 text-center text-md-start">
                    <p class="mb-0">© <span class="currentYear">2025</span> </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- end::NexLink Footer -->

    </div>

    <!-- begin::NexLink Page Scripts -->
    <script src="{{ asset('manager/assets/libs/global/global.min.js') }}"></script>
    <script src="{{ asset('manager/assets/libs/sortable/Sortable.min.js') }}"></script>
    <script src="{{ asset('manager/assets/libs/chartjs/chart.js') }}"></script>
    <script src="{{ asset('manager/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('manager/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('manager/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('manager/assets/js/dashboard/dashboard.js') }}"></script>
    <script src="{{ asset('manager/assets/js/plugins/todolist.js') }}"></script>
    <script src="{{ asset('manager/assets/js/appSettings.js') }}"></script>
    <script src="{{ asset('manager/assets/js/dashboard/sales.js') }}"></script>
    @yield('js')

    <!-- <script src="{{ asset('manager/assets/js/main.js') }}"></script> -->
    <!-- end::NexLink Page Scripts -->
</body>

</html>