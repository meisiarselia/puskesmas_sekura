@php
    $kontak = App\Models\Kontak::first();
@endphp
<footer class="footer section gray-bg" id="kontak">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-title text-center">
                    <h2>Kontak Kami</h2>
                    <div class="divider mx-auto my-4"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-12">
                <div class="widget mb-5 mb-lg-0">
                    <p>
                        Ikuti kami di sosial media untuk mendapatkan informasi terbaru dan bermanfaat
                    </p>

                    <ul class="list-inline footer-socials mt-4">
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/themefisher">
                                <i class="icofont-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://twitter.com/themefisher">
                                <i class="icofont-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.pinterest.com/themefisher/">
                                <i class="icofont-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="widget mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Lokasi</h4>
                    <div class="divider mb-4"></div>
                    <p class=" footer-menu lh-35">
                        {{ $kontak->alamat }}
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="widget widget-contact mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Get in Touch</h4>
                    <div class="divider mb-4"></div>

                    <div class="footer-contact-block mb-4">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-email mr-3"></i>
                            <span class="h6 mb-0">Email</span>
                        </div>
                        <h4 class="mt-2">
                            <a href="mailto:{{ $kontak->email }}">
                                {{ $kontak->email }}
                            </a>
                        </h4>
                    </div>

                    <div class="footer-contact-block">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-support mr-3"></i>
                            <span class="h6 mb-0">Customer Service</span>
                        </div>
                        <h4 class="mt-2"><a href="tel:+{{ $kontak->no_tlp }}">+{{ $kontak->no_tlp }}</a></h4>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4">
                <a class="backtop js-scroll-trigger" href="#top">
                    <i class="icofont-long-arrow-up"></i>
                </a>
            </div>
        </div>
    </div>
    </div>
</footer>
