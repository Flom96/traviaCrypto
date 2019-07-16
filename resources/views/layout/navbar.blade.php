<!DOCTYPE html>
<html lang="en">

<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>TriviaCrypto</title>    
        <!-- Plugins CSS -->
        <link href="/css/plugins/plugins.css" rel="stylesheet">
        <!-- REVOLUTION STYLE SHEETS -->
        <link rel="stylesheet" type="text/css" href="/revolution/css/settings.css">
        <!-- REVOLUTION LAYERS STYLES -->
        <link rel="stylesheet" type="text/css" href="/revolution/css/layers.css">
        <!-- REVOLUTION NAVIGATION STYLES -->
        <link rel="stylesheet" type="text/css" href="/revolution/css/navigation.css">
        <!-- load css for cubeportfolio -->
        <link rel="stylesheet" type="text/css" href="/cubeportfolio/css/cubeportfolio.min.css">     
        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/my.css" rel="stylesheet">
</head>

    <body>

        <div id="preloader">
            <div id="preloader-inner"></div>
        </div><!--/preloader-->

        
        <!-- Site Overlay -->
        <div class="site-overlay"></div>

        <nav class="navbar navbar-expand-lg navbar-light navbar-transparent bg-faded nav-sticky">
            
            <div class="container">

                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" style="margin-right: -80px">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img class='logo logo-dark' src="/images/new.jpeg" alt="" height="40" width="150">
                    <img class='logo logo-light hidden-md-down' src="/images/new.jpeg" alt="" height="40" width="150">
                   
                </a>
                <div  id="navbarNavDropdown" class="navbar-collapse collapse">
                    <ul class="navbar-nav ml-auto">
                        
                        @if(Auth::guest())
                            <li class="nav-item" id="reg">
                                <a class="nav-link" href="/register" aria-haspopup="true" aria-expanded="false">
                                    Register 
                                </a>
                            </li>
                            <li class="nav-item" id="login">
                                <a class="nav-link" href="/login" aria-haspopup="true" aria-expanded="false">
                                    Login
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown active" id="quiz">
                                <a class="nav-link" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">quiz</a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-item" href="/category">
                                            <span>New Quiz</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/previous_quiz">
                                            <span>Previous Quiz</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @if($pend > 0)
                                <li class="nav-item" id="pending">
                                    <a class="nav-link" href="/pending" aria-haspopup="true" aria-expanded="false">
                                        Pending
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item" id="reg">
                                <a class="nav-link" href="/profile" aria-haspopup="true" aria-expanded="false">
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item" id="not">
                                <a class="nav-link" href="/notification" aria-haspopup="true" aria-expanded="false">
                                    Notification <span class="badge badge-default" style="font-size: 12px">{{$not}}</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown active" id="tran">
                                <a class="nav-link" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                    Transactions
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-item" href="/credit">
                                            <span>Credit Account</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="dropdown-item" data-toggle="modal" data-target="#myModal">
                                            <span>Debit Account</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/transaction_history">
                                            <span>Transaction History</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item dropdown active" id="login">
                                <a class="nav-link  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><img class="img-class" style="border: 2px solid #fff; border-radius: 100px; width: 30px; height: 30px; float:left" src="/userImages/{{Auth::User()->img}}"></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </ul>        
                </div>
            </div>
        </nav>
        @yield('content')
        
        @if(session()->has('success'))
            @if(session()->get('success') == 'Insufficient fund')
                <script>
                    alert("{{ session()->get('success') }}");
                    window.location.href = '/credit';
                </script>
            @else 
                <script>
                    alert("{{ session()->get('success') }}");
                </script>
            @endif
        @endif

        @if(!Auth::guest())
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Wallet Balance: {{Auth::User()->wal_let}} btc
                            </h5>
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            
                        </div>
                        <form action="/sendBitcoin" method="post">
                            <div class="modal-body">
                                <h5 id="msg"><h5>
                                <input type="text" id="address" name="address" class="form-control" placeholder="Enter Bitcoin Address" required>
                                <br>
                                <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter amount to withdraw" required onkeyup="che($('#amount').val())">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Withdraw</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <footer class="footer footer-dark pt50 pb30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6  ml-auto mr-auto text-center">
                        <ul class="social-icons list-inline">
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fa fa-facebook"></i>Facebook
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fa fa-twitter"></i>twitter
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fa fa-instagram"></i>instagram
                                </a>
                            </li>
                        </ul>
                        <h4><i class="fa fa-phone"></i> 1800-355-4322</h4>
                        <h4><i class="fa fa-envelope"></i> support@TriviaCrypto.com</h4>
                        <p>&copy; Copyright 2018.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!--back to top-->
        <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script type="text/javascript" src="/js/plugins/plugins.js"></script> 
        <script type="text/javascript" src="/js/assan.custom.js"></script> 
        <!-- load cubeportfolio -->
        <script type="text/javascript" src="/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
        <!-- REVOLUTION JS FILES -->
        <script type="text/javascript" src="/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script type="text/javascript" src="/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->    
        <script type="text/javascript" src="/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script type="text/javascript" src="/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
        <script type="text/javascript" src="/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
        <script type="text/javascript" src="/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script type="text/javascript" src="/revolution/js/extensions/revolution.extension.migration.min.js"></script>
        <script type="text/javascript" src="/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script type="text/javascript" src="/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
        <script type="text/javascript" src="/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script type="text/javascript" src="/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script type="text/javascript" src="/js/my.js"></script>
        <script>
            /**Hero  script**/
            var tpj = jQuery;

            var revapi1078;
            tpj(document).ready(function () {
                if (tpj("#rev_slider_1078_1").revolution == undefined) {
                    revslider_showDoubleJqueryError("#rev_slider_1078_1");
                } else {
                    revapi1078 = tpj("#rev_slider_1078_1").show().revolution({
                        sliderType: "standard",
                        jsFileLocation: "/revolution/js/",
                        sliderLayout: "auto",
                        dottedOverlay: "none",
                        delay: 8000,
                        navigation: {
                            arrows: {
                                enable: true,
                                style: 'uranus',
                                tmp: '',
                                rtl: false,
                                hide_onleave: false,
                                hide_onmobile: true,
                                hide_under: 600,
                                hide_over: 9999,
                                hide_delay: 200,
                                hide_delay_mobile: 1200,
                                left: {
                                    container: 'slider',
                                    h_align: 'left',
                                    v_align: 'center',
                                    h_offset: 0,
                                    v_offset: 0
                                },
                                right: {
                                    container: 'slider',
                                    h_align: 'right',
                                    v_align: 'center',
                                    h_offset: 0,
                                    v_offset: 0
                                }
                            }
                        },
                        viewPort: {
                            enable: true,
                            outof: "pause",
                            visible_area: "80%",
                            presize: false
                        },
                        responsiveLevels: [1240, 1024, 778, 480],
                        visibilityLevels: [1240, 1024, 778, 480],
                        gridwidth: [1140, 992, 700, 465],
                        gridheight: [600, 600, 500, 480],
                        lazyType: "none",
                        parallax: {
                            type: "mouse",
                            origo: "slidercenter",
                            speed: 2000,
                            levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50, 46, 47, 48, 49, 50, 55]
                        },
                        shadow: 0,
                        spinner: "off",
                        stopLoop: "off",
                        stopAfterLoops: -1,
                        stopAtSlide: -1,
                        shuffle: "off",
                        autoHeight: "off",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll: "off",
                            nextSlideOnWindowFocus: "off",
                            disableFocusListener: false
                        }
                    });
                }
            }); /*ready*/
            //cube portfolio init
            (function ($, window, document, undefined) {
                'use strict';

                // init cubeportfolio
                $('#js-grid-mosaic-flat').cubeportfolio({
                    filters: '#js-filters-mosaic-flat',
                    layoutMode: 'mosaic',
                    sortToPreventGaps: true,
                    mediaQueries: [{
                            width: 1500,
                            cols: 6
                        }, {
                            width: 1100,
                            cols: 4
                        }, {
                            width: 800,
                            cols: 3
                        }, {
                            width: 480,
                            cols: 2,
                            options: {
                                caption: '',
                                gapHorizontal: 15,
                                gapVertical: 15
                            }
                        }],
                    defaultFilter: '*',
                    animationType: 'fadeOutTop',
                    gapHorizontal: 0,
                    gapVertical: 0,
                    gridAdjustment: 'responsive',
                    caption: 'fadeIn',
                    displayType: 'fadeIn',
                    displayTypeSpeed: 100,
                    // lightbox
                    lightboxDelegate: '.cbp-lightbox',
                    lightboxGallery: true,
                    lightboxTitleSrc: 'data-title',
                    lightboxCounter: '<div class="cbp-popup-lightbox-counter"></div>',
                    plugins: {
                        loadMore: {
                            selector: '#js-loadMore-mosaic-flat',
                            action: 'click',
                            loadItems: 3
                        }
                    }
                });
            })(jQuery, window, document);
        </script> 
        <script>
            $(function() {
                $('#{{$id}}').addClass('active');
            })
                
              
        </script>
    </body>
</html>
