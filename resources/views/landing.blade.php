@extends('layouts.master3')
@section('content')

    <main id="main">
        <!-- ======= Testimonials Section ======= -->
        <div id="testimonials" class="testimonials">
        <div class="container">

            <div class="testimonials-slider swiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                        <h3> هدفنا</h3>
                        
                        <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            <span>
                                تسهيل عملية الإتصال بين البائع والمشتري في سوريا ومساعدتك في الحصول على
                                بائعين/مشتريين محتملين , بالإضافة إلى ضمان عملية تجارية سلسة وعادلة لكلا الطرفين
                        </span>
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                        <h3> رؤيتنا</h3>
                        
                        <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    
                    من خلال الخبرة والدعم والمشورة , نهدف إلى تسهيل جميع الصفقات والعمليات الحسابية في سوريا من خلال اتخاذ جميع الإجراءات اللازمة لتقديم الأفضل ونسعى جاهدين لنكون رائدين في هذا المجال

                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                        <h3> نسعى جاهدين لنكون</h3>
                        
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                              منصة سورية تسويقية للغير في الجمهورية العربية السورية
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                
            </div>
            <div class="swiper-pagination"></div>
            </div>

        </div>
        </div><!-- End Testimonials Section -->
        <br>
        <br>
        <div class="suscribe-area">
        <div class="container">
            <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs=10 ">
                <div class="suscribe-text text-center">
                <h3>مرحبا بكم في خدمات</h3>
                <a class="sus-btn" href="#"> إبدأ الأن </a>
                </div>
            </div>
            </div>
        </div>
        </div><!-- End Suscribe Section -->

        <!-- ======= Contact Section ======= -->
        <div id="contact" class="contact-area">
        <div class="contact-inner area-padding">
            <div class="contact-overly"></div>
            <div class="container ">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2> تواصل معنا</h2>
                </div>
                </div>
            </div>
            <div class="row">
                <!-- Start contact icon column -->
                <div class="col-md-4">
                <div class="contact-icon text-center">
                    <div class="single-icon">
                    <i class="bi bi-phone"></i>
                    <p>
                        +963 969040382 : رقم الهاتف<br>
                      
                    </p>
                    </div>
                </div>
                </div>
                <!-- Start contact icon column -->
                <div class="col-md-4">
                <div class="contact-icon text-center">
                    <div class="single-icon">
                    <i class="bi bi-envelope"></i>
                    <p>
                         mouaz@gmail.com : الإيميل<br>
                      
                    </p>
                    </div>
                </div>
                </div>
                <!-- Start contact icon column -->
                <div class="col-md-4">
                <div class="contact-icon text-center">
                    <div class="single-icon">
                    <i class="bi bi-geo-alt"></i>
                    <p>
                       سوريا, دمشق<br>
                    </p>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">

                <!-- Start Google Map -->
                <div class="col-md-6">
                <!-- Start Map -->
                <img src="assets2\img\map.jpeg">
                <!-- End Map -->
                </div>
                <!-- End Google Map -->

                <!-- Start  contact -->
                <div class="col-md-6" >
                <div class="form contact-form" dir="rtl">
                <form action="/contacts_form" method="post" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                        <div class="form-group" >
                            <input type="text"  name="name" class="form-control" id="name" placeholder="ادخل اسمك" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="ادخل الإيميل" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="title" id="title" placeholder="عنوان الرسالة" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="content" rows="5" placeholder="الرسالة" required></textarea>
                        </div>
                        <br>                       
                        <div class="d-flex justify-content-center">
                             <button type="submit" class="btn btn-secondary">إرسال </button>
                        </div>

                    </form>
                </div>
                </div>
                <!-- End Left contact -->
            </div>
            </div>
        </div>
        </div><!-- End Contact Section -->

    </main>
    <!-- End #main -->

@endsection

