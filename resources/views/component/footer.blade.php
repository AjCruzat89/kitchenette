<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!--===============================================================================================-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!--===============================================================================================-->
<script>
    AOS.init();
</script>
<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<!--===============================================================================================-->
<script>
    let mySwiper = null;

    function initSwiper() {
        const screen_width = window.innerWidth;

        let effect = 'slide';
        if (screen_width < 568) {
            effect = 'fade';
        }

        mySwiper = new Swiper('.swiper', {
            direction: 'horizontal',
            slidesPerView: 1,
            centeredSlides: false,
            spaceBetween: 17,
            navigation: {
                prevEl: '.bi-caret-left-fill',
                nextEl: '.bi-caret-right-fill',
            },
            effect: effect,
            speed: 1000,
            autoplay: {
                delay: 1500,
                pauseOnMouseEnter: true,
                disableOnInteraction: false,
            },
            breakpoints: {
                568: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    }

    window.addEventListener('resize', function() {
        if (mySwiper) {
            clearInterval(interval);
            mySwiper.destroy();
            initSwiper();
        }
    });

    let interval = setInterval(function() {
        if (mySwiper) {
            clearInterval(interval);
            mySwiper.destroy();
            initSwiper();
        }
    }, 1000);

    initSwiper();
</script>
<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--===============================================================================================-->
<!-- Messenger Chat Plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat Plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "109985744175672");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v18.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
</body>

</html>