<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="footer-wrapper">
                <div class="col-md-3 col-sm-3">
                    <a href=""><img src="{{ asset('bower_components/bower-package/images/logo-black.png') }}" alt="" class="footer-logo" /></a>
                    <ul class="list-inline social-icons">
                        <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-2">
                    <h6>{{ trans('layouts.for-individuals') }}</h6>
                    <ul class="footer-links">
                        <li><a href="">{{ trans('layouts.signup') }}</a></li>
                        <li><a href="">{{ trans('layouts.login') }}</a></li>
                        <li><a href="">{{ trans('layouts.explore') }}</a></li>
                        <li><a href="">{{ trans('layouts.features') }}</a></li>
                        <li><a href="">{{ trans('layouts.language-settings') }}</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-2">
                    <h6>{{ trans('layouts.about') }}</h6>
                    <ul class="footer-links">
                        <li><a href="">{{ trans('layouts.about-us') }}</a></li>
                        <li><a href="">{{ trans('layouts.contact-us') }}</a></li>
                        <li><a href="">{{ trans('layouts.privacy-policy') }}</a></li>
                        <li><a href="">{{ trans('layouts.terms') }}</a></li>
                        <li><a href="">{{ trans('layouts.help') }}</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h6>{{ trans('layouts.contact-us') }}</h6>
                    <ul class="contact">
                        <li><i class="icon ion-ios-telephone-outline"></i>{{ trans('layouts.us-number-phone') }}</li>
                        <li><i class="icon ion-ios-email-outline"></i>{{ trans('layouts.us-email') }}</li>
                        <li><i class="icon ion-ios-location-outline"></i>{{ trans('layouts.us-addr') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>{{ trans('layouts.copyright') }}</p>
    </div>
</footer>
