<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link
            href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
            rel="stylesheet"
        />

        @include('includes.adminstyle')
    </head>

    <body>
        <section id="body-pd">
            <header class="header d-flex justify-content-between" id="header">
                <div class="header_toggle">
                    <i class="bx bx-menu" id="header-toggle"></i>
                    <span class="fw-bold">Dashboard </span>
                </div>

                <div class="d-flex justify-content-between">
                    <a class="btn site-btn" href="logout"
                        >Log Out
                        <i class="bi bi-box-arrow-left" style="font-size: medium"></i>
                    </a>
                </div>
            </header>
            <div class="l-navbar mb-5" id="nav-bar">
                <nav class="nav">
                    <div>
                        <a href="#" class="nav_logo">
                            <i class="bx bx-dish nav_logo-icon"></i>
                            <span class="nav_logo-name">Delicious</span>
                        </a>
                        <div class="nav_list">
                            <a href="{{ route('admin.dashboard') }}" class="nav_link active">
                                <i class="bx bx-grid-alt nav_icon"></i>
                                <span class="nav_name">Dashboard</span>
                            </a>

                            <a href="#" class="nav_link">
                                <i class="bx bx-user nav_icon"></i>
                                <span class="nav_name">Users</span>
                            </a>

                            <a href="{{ route('admin.categories') }}" class="nav_link">
                                <i class="bi bi-ui-checks-grid nav_icon"></i>
                                <span class="nav_name">Dish Category</span>
                            </a>

                            <a href="{{ route('admin.dishes') }}"  class="nav_link">
                                <i class="bx bx-dish nav_icon"></i>
                                <span class="nav_name">Dishes</span>
                            </a>

                            <a href="#" class="nav_link">
                                <i class="bx bx-book-bookmark nav_icon"></i>
                                <span class="nav_name">Bookings</span>
                            </a>

                            <a href="#" class="nav_link">
                                <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                                <span class="nav_name">Stats</span>
                            </a>
                        </div>
                    </div>
                    <a href="logout" class="nav_link">
                        <i class="bi bi-box-arrow-left nav_icon"></i>
                        <span class="nav_name">Log Out</span>
                    </a>
                </nav>
            </div>
            <!--Container Main start-->
            <div class="container ps-5" style="padding-top: 50px">
                @yield('contentadmin')
            </div>

            <!--Container Main end-->
            <script
                type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            ></script>
            @include('includes.adminjs')
        </section>
    </body>
</html>
