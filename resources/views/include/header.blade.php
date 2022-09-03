<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">

    <div class="container d-flex justify-content-between">

    <div class="logo">
        <h1><a href="index.html"><span>  k</span>hadamat</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        {{-- <a href=""><img src="assets2/img/logo.png" alt="" class="img-fluid"></a> --}}
    </div>

    <nav id="navbar" class="navbar">
        <ul>
        <li><a class="nav-link scrollto active" href="#hero">الصفحة الرئيسية</a></li>
        <li><a class="nav-link scrollto" href="#about">حول خدمات</a></li>
        <li><a class="nav-link scrollto" href="#services">خدماتنا</a></li>
        <li class="dropdown"><a href="#">الأقسام <i class="bi bi-chevron-down"></i></a>
            <ul>
            <li><a href="#portfolio">Portfolio</a></li>
            <li><a href="#team">super provider</a></li>
            </ul>
        </li>
        <li><a class="nav-link scrollto" href="#contact">تواصل معنا</a></li>
        <li class="dropdown"><a href="#">GO START <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a  href="{{ route('login') }}">تسجيل الدخول</a></li>
                <li><a  href="{{ route('register') }}">انشاء حساب</a></li>
                <li><a  href="{{ route('logout') }}" 
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">تسجيل الخروج</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                </form>
            </ul>
        </li>
            @can('لوحة التحكم')
                    <li><a class="nav-link scrollto" href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
            @endcan
    </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
    <!-- .navbar -->

    </div>
</header><!-- End Header -->

