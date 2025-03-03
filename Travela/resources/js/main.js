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

        var new_pwd = $('.password').val();
        var confirmPassword = $('.confirm_password').val();

        if (new_pwd !== confirmPassword && confirmPassword != '') {
            $('.btn-submit-update').prop('disabled', true);
            $('.notification').removeClass('d-none');
        } else {
            $('.btn-submit-update').prop('disabled', false);
            $('.notification').addClass('d-none');
        }
        if (new_pwd.length < 8 && new_pwd.length >= 1) {
            $('.notification-limit').removeClass('d-none');
        } else {
            $('.notification-limit').addClass('d-none');
        }
    }
    /*----------------------------------------------------*/
    /*  End Password Confirm
    /*----------------------------------------------------*/


    /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    /*  Function Alert
    /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    /*----------------------------------------------------*/
    /*  Alert To Log In
    /*----------------------------------------------------*/
    // $('.alert_login').on('click', function () {
    //     Swal.fire({
    //         title: "You need to login to apply for this job.",
    //         showClass: {
    //             popup: `
    //                   animate__animated
    //                   animate__fadeInUp
    //                   animate__faster
    //                 `
    //         },
    //         hideClass: {
    //             popup: `
    //                   animate__animated
    //                   animate__fadeOutDown
    //                   animate__faster
    //                 `
    //         }
    //     });
    // })
    // /*----------------------------------------------------*/
    // /*  End Alert To Log In
    // /*----------------------------------------------------*/

    /*----------------------------------------------------*/
    /*  Alert
    /*----------------------------------------------------*/
    function alert_after_load(title, icon, text, reload) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon
        }).then(() => {
            if (reload === 'true') {
                location.reload();
            }
        });
    }
    /*----------------------------------------------------*/
    /*  Alert
    /*----------------------------------------------------*/
    function alert_after_load_2(title, icon, reload) {
        Swal.fire({
            position: "top-end",
            icon: icon,
            title: title,
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            if (reload === 'true') {
                location.reload();
            }
        });

    }
    // /*----------------------------------------------------*/
    // /*  Select2 Selected
    // /*----------------------------------------------------*/
    // function select2_selected(url, tag_id, type, id) {
    //     $.ajax({
    //         type: 'GET',
    //         url: url,
    //         data: {
    //             keyword: '',
    //             type: type
    //         },
    //         success: function(data) {
    //             if (Array.isArray(data)) {
    //                 var selectedItem = data.find(function (item) {
    //                     return item.id_data === id;
    //                 });
    //             }
    //             if (selectedItem) {
    //                 var option = new Option(selectedItem.name, selectedItem.id_data, true, true);
    //                 tag_id.append(option).trigger('change');
    //                 tag_id.trigger({
    //                     type: 'select2:select',
    //                     params: {
    //                         data: selectedItem
    //                     }
    //                 });
    //             } else {
    //             }
    //         }
    //     });
    // }
    // /*----------------------------------------------------*/
    // /*  Ajax Get Suggest
    // /*----------------------------------------------------*/
    // function select2_select_location(url, tag_id, type, placeholder){
    //     tag_id.select2({
    //         placeholder: placeholder,
    //         ajax: {
    //             url: url,
    //             dataType: 'json',
    //             delay: 250,
    //             data: function(params) {
    //                 return {
    //                     keyword: params.term,
    //                     type: type
    //                 };
    //             },
    //             processResults: function(data) {
    //                 return {
    //                     results: data.map(function(item) {
    //                         return { id: item.id_data, text: item.name};
    //                     })
    //                 };
    //             },
    //             cache: true
    //         }
    //     });
    // }
    //
    // /*----------------------------------------------------*/
    // /*  Alert Buy Service Package
    // /*----------------------------------------------------*/
    // function Alert_buy_service_package(){
    //     Swal.fire({
    //         title: "You have used up all your free job postings!",
    //         text: "Please purchase a service package to continue posting jobs!",
    //         icon: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#2db2ea",
    //         cancelButtonColor: "#d33",
    //         confirmButtonText: "Buy!"
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             Swal.fire({
    //                 title: "xx!",
    //                 text: "Your file has been deleted.",
    //                 icon: "success"
    //             });
    //         }
    //     });
    // }
    // /*----------------------------------------------------*/
    // /*  Alert Delete
    // /*----------------------------------------------------*/
    // function Alert_delete($url) {
    //     Swal.fire({
    //         title: "Are you sure?",
    //         text: "You won't be able to revert this!",
    //         icon: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#2db2ea",
    //         cancelButtonColor: "#d33",
    //         confirmButtonText: "Yes, delete it!"
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: $url,
    //                 type: 'DELETE',
    //                 data: {
    //                     _token: $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 success: function(response) {
    //                     Swal.fire({
    //                         position: "top-end",
    //                         icon: "success",
    //                         title: "Delete successfully!",
    //                         showConfirmButton: false,
    //                         timer: 1500
    //                     }).then(() => {
    //                         location.reload();
    //                     });
    //                 },
    //             });
    //         }
    //     });
    // }
    //
    // /*----------------------------------------------------*/
    // /*  Application Tabs
    // /*----------------------------------------------------*/
    // function adjustDiv2Height() {
    //     var $container = $('.message-content');
    //     var $div1 = $('.message-content-block');
    //     var $div2 = $('.message-send-block');
    //     var containerHeight = $container.height();
    //     var div2Height = $div2.outerHeight();
    //
    //     var div1Height = containerHeight - div2Height;
    //
    //     $div1.height(div1Height);
    // }
    //
    // /*----------------------------------------------------*/
    // /*  Messages Scroll To Last
    // /*----------------------------------------------------*/
    // function scrollToBottom() {
    //     var hasScrolled = false;
    //     if (!hasScrolled) {
    //         var main_messages = $('.message-content-block');
    //         main_messages.addClass('scroll-smooth');
    //         setTimeout(function() {
    //             main_messages.scrollTop(main_messages.prop("scrollHeight"));
    //             hasScrolled = true;
    //             main_messages.removeClass('scroll-smooth');
    //         }, 500);
    //     }
    // }
    /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    /*  End Function Alert
    /*----------------------------------------------------------------------------------------------------------------------------------------------------------------*/





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
    /*  Slide Show Images
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
    /*  Slide Show Images
    /*----------------------------------------------------*/

    /*
Conic gradients are not supported in all browsers (https://caniuse.com/#feat=css-conic-gradients), so this pen includes the CSS conic-gradient() polyfill by Lea Verou (https://leaverou.github.io/conic-gradient/)
*/

// Find al rating items
    const ratings = document.querySelectorAll(".circle-rating");

// Iterate over all rating items
    ratings.forEach((rating) => {
        // Get content and get score as an int
        const ratingContent = rating.innerHTML;
        const ratingScore = parseInt(ratingContent, 10);

        // Define if the score is good, meh or bad according to its value
        const scoreClass =
            ratingScore < 40 ? "bad" : ratingScore < 60 ? "meh" : "good";

        // Add score class to the rating
        rating.classList.add(scoreClass);

        // After adding the class, get its color
        const ratingColor = window.getComputedStyle(rating).backgroundColor;

        // Define the background gradient according to the score and color
        const gradient = `background: conic-gradient(${ratingColor} ${ratingScore}%, transparent 0 100%)`;

        // Set the gradient as the rating background
        rating.setAttribute("style", gradient);

        // Wrap the content in a tag to show it above the pseudo element that masks the bar
        rating.innerHTML = `<span>${ratingScore} ${
            ratingContent.indexOf("%") >= 0 ? "<small>%</small>" : ""
        }</span>`;
    });



})(jQuery);

