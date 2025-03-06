(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });
    // Sticky Navbar
    $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();
        var windowHeight = $(this).height();
        var documentHeight = $(document).height();
        var scrollBottom = documentHeight - (scrollTop + windowHeight);

        if (scrollTop > 500 && scrollBottom > 200) {
            $('.tour-box').addClass('fixed-tour-box shadow-sm');
        } else {
            $('.tour-box').removeClass('fixed-tour-box shadow-sm');
        }
    });


    // International Tour carousel
    $(".InternationalTour-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : false,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });


    // packages carousel
    $(".packages-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });


    // testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    /*----------------------------------------------------*/
    /*  Check Password Confirm
    /*----------------------------------------------------*/
    let typingTimer;
    const typingInterval = 500; // 3 giây

    $('.confirm_password, .password').on('input', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(checkPasswords, typingInterval);
    });

    function checkPasswords() {

        var new_pwd = $('.reg .password').val();
        var confirmPassword = $('.reg .confirm_password').val();

        if (new_pwd !== confirmPassword && confirmPassword != '') {
            console.log('123')
            $('.reg .btn-submit-update').prop('disabled', true);
            $('.reg .notification').removeClass('d-none');
        } else {
            $('.reg .btn-submit-update').prop('disabled', false);
            $('.reg .notification').addClass('d-none');
        }
        if (new_pwd.length < 8 && new_pwd.length >= 1) {
            $('.reg .notification-limit').removeClass('d-none');
        } else {
            $('.reg .notification-limit').addClass('d-none');
        }
    }
    /*----------------------------------------------------*/
    /*  End Password Confirm
    /*----------------------------------------------------*/




    /*----------------------------------------------------*/
    /*  Logout
    /*----------------------------------------------------*/
    $("#logoutBtn").click(function() {
        console.log('123');
        var url = $(this).data('url-logout');
        $.ajax({
            url: url,
            type: "POST",
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                console.log(response); // Kiểm tra phản hồi
                alert("Bạn đã đăng xuất thành công!");
                window.location.href = "/";
            },
            error: function(xhr) {
                alert("Lỗi đăng xuất: " + xhr.responseJSON.message);
            }
        });
    });

    /*----------------------------------------------------*/
    /*  End Logout
    /*----------------------------------------------------*/


    /*----------------------------------------------------*/
    /*  Slide Show Images
    /*----------------------------------------------------*/
    const IMAGES = [
        {
            img: "https://picsum.photos/id/27/600/600",
            title: "The Sea",
        },
        {
            img: "https://picsum.photos/id/58/600/600",
            title: "Lighthouse",
        },
        {
            img: "https://picsum.photos/id/96/600/600",
            title: "Bike by a shed",
        },
        {
            img: "https://picsum.photos/id/85/600/600",
            title: "Tractor in a field",
        },
        {
            img: "https://picsum.photos/id/129/600/600",
            title: "On a bench",
        },
        {
            img: "https://picsum.photos/id/211/600/600",
            title: "Boat",
        },
        {
            img: "https://picsum.photos/id/301/600/600",
            title: "Autumn leaves",
        },
        {
            img: "https://picsum.photos/id/389/600/600",
            title: "Climbing Stairs",
        },
        {
            img: "https://picsum.photos/id/505/600/600",
            title: "Sunset",
        }
    ];

    // selectors
    const galleryMainImg = document.getElementById("gallery-main-img");
    const galleryThumbsEl = document.getElementById("gallery-thumbs");
    const slider = document.getElementById("slider");
    const sliderButtons = document.querySelectorAll("[btn-slider]");
    const dialogEl = document.getElementById('slider-dialog');
    const dialogBtnOpen = document.getElementById('gallery-main-img');
    const dialogBtnClose = document.getElementById('btn-dialog-close');

    // settings
    const animationTime = 320;

    // function - render thumbnails
    function renderThumbs() {
        galleryThumbsEl.innerHTML = "";

        IMAGES.forEach((el, index) => {
            // Create and append the thumbnail button
            const btn = document.createElement("button");
            btn.type = "button";
            const img = document.createElement("img");
            img.src = el.img;
            img.alt = el.title;
            btn.append(img);
            galleryThumbsEl.append(btn);

            // Set up the thumbnail click event to open the slideshow
            btn.addEventListener("click", () => openSlideShow(index));
        });
    }

    // add thumbnails to page
    renderThumbs();

    // function - click outside dialog
    function handleDialogClickOutside(event) {
        if (event.target === dialogEl) {
            dialogEl.close();
        }
    }

    // function - open slideshow at specified image
    function openSlideShow(startImg = 0) {
        // Ensure the `startImg` index is within bounds
        if (startImg < 0 || startImg >= IMAGES.length) return;

        slider.innerHTML = "";

        // Reorder the IMAGES array to start from the specified image
        const reorderedImages = [
            ...IMAGES.slice(startImg),
            ...IMAGES.slice(0, startImg)
        ];

        // add images to slideshow
        reorderedImages.forEach(el => {
            const d = document.createElement("div");
            d.dataset.title = el.title;
            const img = document.createElement("img");
            img.src = el.img;
            img.alt = el.title;
            d.append(img);
            slider.append(d);
        });

        // Open the slideshow dialog
        dialogEl.showModal();
        // add the event handler to close the dialog when clicking outside
        dialogEl.addEventListener("click", handleDialogClickOutside);
    }

    // event handlers
    dialogBtnOpen.addEventListener('click', openSlideShow);
    dialogBtnClose.addEventListener('click', () => dialogEl.close());
    dialogEl.addEventListener('close', () => dialogEl.removeEventListener('click', handleDialogClickOutside));

    /* SLIDER */
    /* slider code adapted from https://codepen.io/cbolson/pen/vYoZQme*/

// slider navigation
    function slideShowControls(){
        sliderButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                // disable all buttons during the animation
                sliderButtons.forEach(button => button.disabled = true);

                const isNext = btn.getAttribute("btn-slider") === "next";
                const el = isNext ? slider.querySelector("div:first-child") : slider.querySelector("div:last-child");
                const animationClass = isNext ? "slider-next" : "slider-prev";

                // move element immediately for "prev"
                if (!isNext) slider.prepend(el);

                el.classList.add(animationClass);
                requestAnimationFrame(() => {
                    setTimeout(() => { /* yes, I know that this would be better using transitionEnd but I was having issue when trying to use the "prev" button */
                        // move element after animation for "next"
                        if (isNext) slider.append(el);

                        // remove class
                        el.classList.remove(animationClass);

                        // re-enable the buttons
                        sliderButtons.forEach(button => button.disabled = false);
                    }, isNext ? animationTime : 1); // delay for each direction
                });
            });
        });
    }
    slideShowControls();
    /*----------------------------------------------------*/
    /*  End Slide Show Images
    /*----------------------------------------------------*/




    /*----------------------------------------------------*/
    /*  Tour box
    /*----------------------------------------------------*/
    let value_top = 0, value_middle = 0, value_bottom = 0;
    function updateTotal() {
        let total = value_top + value_middle + value_bottom;
        let formattedTotal = total.toLocaleString('vi-VN');
        $('.total-price').text(formattedTotal + " VNĐ");
    }
    // Xử lý khi bấm nút + hoặc -
    $(".tour-top button").click(function () {
        let quantityElement_top = $(this).siblings("span");
        let quantity_top = parseInt(quantityElement_top.text());

        if ($(this).text() === "+" && quantity_top < 20) {
            quantity_top++;
        } else if ($(this).text() === "-" && quantity_top > 0) {
            quantity_top--;
        }
        $('.tour-top span.value').text(quantity_top);
        $('.tour-top span.price').text("X 50.000.000");
        value_top = quantity_top*50000000;
        updateTotal();

    });
    $(".tour-middle button").click(function () {
        let quantityElement_middle = $(this).siblings("span");
        let quantity_middle = parseInt(quantityElement_middle.text());

        if ($(this).text() === "+" && quantity_middle < 25) {
            quantity_middle++;
        } else if ($(this).text() === "-" && quantity_middle > 0) {
            quantity_middle--;
        }
        $('.tour-middle span.value').text(quantity_middle);
        $('.tour-middle span.price').text("X 30.000.000");
        value_middle = quantity_middle*30000000;
        updateTotal();
    });
    $(".tour-bottom button").click(function () {
        let quantityElement_bottom = $(this).siblings("span");
        let quantity_bottom = parseInt(quantityElement_bottom.text());

        if ($(this).text() === "+" && quantity_bottom < 30) {
            quantity_bottom++;
        } else if ($(this).text() === "-" && quantity_bottom > 0) {
            quantity_bottom--;
        }

        $('.tour-bottom span.value').text(quantity_bottom);
        $('.tour-bottom span.price').text("X 10.000.000");
        value_bottom = quantity_bottom*10000000;
        updateTotal();
    });

    /*----------------------------------------------------*/
    /*  End Tour box
    /*----------------------------------------------------*/





    /*----------------------------------------------------*/
    /*  Rating
    /*----------------------------------------------------*/
    const ratings = document.querySelectorAll(".circle-rating");
    ratings.forEach((rating) => {
        const ratingContent = rating.innerHTML;
        const ratingScore = parseInt(ratingContent, 10);
        const scoreClass =
            ratingScore < 40 ? "bad" : ratingScore < 60 ? "meh" : "good";
        rating.classList.add(scoreClass);
        const ratingColor = window.getComputedStyle(rating).backgroundColor;
        const gradient = `background: conic-gradient(${ratingColor} ${ratingScore}%, transparent 0 100%)`;
        rating.setAttribute("style", gradient);
        rating.innerHTML = `<span>${ratingScore} ${
            ratingContent.indexOf("%") >= 0 ? "<small>%</small>" : ""
        }</span>`;
    });
    /*----------------------------------------------------*/
    /*  End Rating
    /*----------------------------------------------------*/





})(jQuery);

