<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("frontend.includes.head")
<body>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="index.html">Presento<span>.</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>-->

        @include("frontend.includes.navbar")

        <a href="#about" class="get-started-btn scrollto">Get Started</a>
    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <div class="row">
            <div class="col-xl-6">
                <h1>Bettter digital experience with Presento</h1>
                <h2>We are team of talented designers making websites with Bootstrap</h2>
                <a href="#about" class="btn-get-started scrollto">Get Started</a>
            </div>
        </div>
    </div>

</section><!-- End Hero -->
@yield("content")
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@include("frontend.includes.footer")
</div>
</body>
</html>
