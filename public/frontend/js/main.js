

(function ($) {
    "use strict";
    $(document).ready(function () {
        // Code của bạn ở đây

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
        // const IMAGES = [
        //     {
        //         img: "https://picsum.photos/id/27/600/600",
        //         title: "The Sea",
        //     },
        //     {
        //         img: "https://picsum.photos/id/58/600/600",
        //         title: "Lighthouse",
        //     },
        //     {
        //         img: "https://picsum.photos/id/96/600/600",
        //         title: "Bike by a shed",
        //     },
        //     {
        //         img: "https://picsum.photos/id/85/600/600",
        //         title: "Tractor in a field",
        //     },
        //     {
        //         img: "https://picsum.photos/id/129/600/600",
        //         title: "On a bench",
        //     },
        //     {
        //         img: "https://picsum.photos/id/211/600/600",
        //         title: "Boat",
        //     },
        //     {
        //         img: "https://picsum.photos/id/301/600/600",
        //         title: "Autumn leaves",
        //     },
        //     {
        //         img: "https://picsum.photos/id/389/600/600",
        //         title: "Climbing Stairs",
        //     },
        //     {
        //         img: "https://picsum.photos/id/505/600/600",
        //         title: "Sunset",
        //     }
        // ];
        //
        // // selectors
        // const galleryMainImg = document.getElementById("gallery-main-img");
        // const galleryThumbsEl = document.getElementById("gallery-thumbs");
        // const slider = document.getElementById("slider");
        // const sliderButtons = document.querySelectorAll("[btn-slider]");
        // const dialogEl = document.getElementById('slider-dialog');
        // const dialogBtnOpen = document.getElementById('gallery-main-img');
        // const dialogBtnClose = document.getElementById('btn-dialog-close');
        //
        // // settings
        // const animationTime = 320;
        //
        // // function - render thumbnails
        // function renderThumbs() {
        //     galleryThumbsEl.innerHTML = "";
        //
        //     IMAGES.forEach((el, index) => {
        //         // Create and append the thumbnail button
        //         const btn = document.createElement("button");
        //         btn.type = "button";
        //         const img = document.createElement("img");
        //         img.src = el.img;
        //         img.alt = el.title;
        //         btn.append(img);
        //         galleryThumbsEl.append(btn);
        //
        //         // Set up the thumbnail click event to open the slideshow
        //         btn.addEventListener("click", () => openSlideShow(index));
        //     });
        // }
        //
        // // add thumbnails to page
        // renderThumbs();
        //
        // // function - click outside dialog
        // function handleDialogClickOutside(event) {
        //     if (event.target === dialogEl) {
        //         dialogEl.close();
        //     }
        // }
        //
        // // function - open slideshow at specified image
        // function openSlideShow(startImg = 0) {
        //     // Ensure the `startImg` index is within bounds
        //     if (startImg < 0 || startImg >= IMAGES.length) return;
        //
        //     slider.innerHTML = "";
        //
        //     // Reorder the IMAGES array to start from the specified image
        //     const reorderedImages = [
        //         ...IMAGES.slice(startImg),
        //         ...IMAGES.slice(0, startImg)
        //     ];
        //
        //     // add images to slideshow
        //     reorderedImages.forEach(el => {
        //         const d = document.createElement("div");
        //         d.dataset.title = el.title;
        //         const img = document.createElement("img");
        //         img.src = el.img;
        //         img.alt = el.title;
        //         d.append(img);
        //         slider.append(d);
        //     });
        //
        //     // Open the slideshow dialog
        //     dialogEl.showModal();
        //     // add the event handler to close the dialog when clicking outside
        //     dialogEl.addEventListener("click", handleDialogClickOutside);
        // }
        //
        // // event handlers
        // dialogBtnOpen.addEventListener('click', openSlideShow);
        // dialogBtnClose.addEventListener('click', () => dialogEl.close());
        // dialogEl.addEventListener('close', () => dialogEl.removeEventListener('click', handleDialogClickOutside));
        //
        // /* SLIDER */
        // /* slider code adapted from https://codepen.io/cbolson/pen/vYoZQme*/
        //
        // // slider navigation
        // function slideShowControls(){
        //     sliderButtons.forEach(btn => {
        //         btn.addEventListener("click", () => {
        //             // disable all buttons during the animation
        //             sliderButtons.forEach(button => button.disabled = true);
        //
        //             const isNext = btn.getAttribute("btn-slider") === "next";
        //             const el = isNext ? slider.querySelector("div:first-child") : slider.querySelector("div:last-child");
        //             const animationClass = isNext ? "slider-next" : "slider-prev";
        //
        //             // move element immediately for "prev"
        //             if (!isNext) slider.prepend(el);
        //
        //             el.classList.add(animationClass);
        //             requestAnimationFrame(() => {
        //                 setTimeout(() => { /* yes, I know that this would be better using transitionEnd but I was having issue when trying to use the "prev" button */
        //                     // move element after animation for "next"
        //                     if (isNext) slider.append(el);
        //
        //                     // remove class
        //                     el.classList.remove(animationClass);
        //
        //                     // re-enable the buttons
        //                     sliderButtons.forEach(button => button.disabled = false);
        //                 }, isNext ? animationTime : 1); // delay for each direction
        //             });
        //         });
        //     });
        // }
        // slideShowControls();
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



        /*----------------------------------------------------*/
        /*  Ajax Provinces
        /*----------------------------------------------------*/
        // $(document).ready(function () {
        $('#searchInput').on('input', function () {
            let query = $(this).val().trim();

            if (query.length === 0) {
                $('#results').hide();
                return;
            }

            $.ajax({
                url: '/api/search',
                type: 'GET',
                data: { q: query },
                success: function (data) {
                    let resultsDiv = $('#results');
                    resultsDiv.empty();

                    if (data.length === 0) {
                        resultsDiv.hide();
                        return;
                    }

                    $.each(data, function (index, item) {
                        resultsDiv.append(`<div class="dropdown-item">${item.name}</div>`);
                    });

                    resultsDiv.show();
                },
                error: function (xhr) {
                    console.error('Lỗi khi gọi API:', xhr);
                }
            });
        });

        $(document).on('click', '.dropdown-item', function () {
            $('#searchInput').val($(this).text());

            $('#results').hide();
        });

        $(document).click(function (e) {
            if (!$(e.target).closest('#searchInput, #results').length) {
                $('#results').hide();
            }
        });
        /*----------------------------------------------------*/
        /*  End Ajax Provinces
        /*----------------------------------------------------*/


        /*----------------------------------------------------*/
        /*  Chosen Plugin
        /*----------------------------------------------------*/

        var config = {
            '.chosen-select': {disable_search_threshold: 10, width: "100%"},
            '.chosen-select-deselect': {allow_single_deselect: true, width: "100%"},
            '.chosen-select-no-single': {disable_search_threshold: 10, width: "100%"},
            '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
            '.chosen-select-width': {width: "95%"}
        };
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
        $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
        /*----------------------------------------------------*/
        /*  End Chosen Plugin
        /*----------------------------------------------------*/



        setTimeout(function() {
            $('.slick-track').css('transform', 'translate3d(-756px, 0px, 0px)');
        }, 500);

        /*----------------------------------------------------*/
        /*  Ajax Build Schedule
        /*----------------------------------------------------*/
        $('#generateSchedule').click(function () {
            let placeNames = $(this).data('place-names');
            var url = $('#get-url-schedule').attr('data-url');
            $('#btn-build-schedule').remove();
            $('#spinner2').removeClass('d-none').addClass('d-flex');

            $.ajax({
                url: url,
                type: "GET",
                data: { placeNames: placeNames },
                success: function (data) {

                    var $data = $(data);
                    $('#schedule-response').html($data);
                    updateRouteButtons();
                    $('.schedule-carousel').slick({
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 3,
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    arrows: true,
                                    centerMode: true,
                                    centerPadding: '0px',
                                    slidesToShow: 3
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    arrows: true,
                                    centerMode: true,
                                    centerPadding: '0px',
                                    slidesToShow: 1
                                }
                            }
                        ]
                    });
                    $('#spinner2').removeClass('d-flex').addClass('d-none');
                    initScheduleScrollHandler();
                },
                error: function (xhr, status, error) {
                    console.error("Lỗi status:", status);  // Lỗi HTTP (404, 500, v.v.)
                    console.error("Lỗi từ server:", xhr.responseText);  // Nội dung lỗi
                    console.error("Chi tiết lỗi:", error);  // Mô tả lỗi

                    alert("Có lỗi xảy ra: " + xhr.status + " - " + error);
                }
            });
        });
        let isManualClick = false;
        $(document).on('init','.schedule-carousel', function(event, slick) {
            $('.slick-prev').on('click', function () {
                isManualClick = true;
                slickAfterChange();
                console.log(isManualClick)
            });

            $('.slick-next').on('click', function () {
                isManualClick = true;
                slickAfterChange();
                console.log(isManualClick)
            });
        });
        /*----------------------------------------------------*/
        /*  End Ajax Build Schedule
        /*----------------------------------------------------*/



        /*----------------------------------------------------*/
        /*  Smooth Scroll To Detail Schedule
        /*----------------------------------------------------*/
        function slickAfterChange(){
            var targetId = $('.slick-current').data('target');

            const $parent = $('#schedule-content');
            var targetSelector = '#' + targetId;

            const offsetTop = $(targetSelector).offset().top - $parent.offset().top + $parent.scrollTop();


            if ($(targetSelector).length) {

                $parent.animate({
                    scrollTop: offsetTop
                }, 500);

            } else {
                console.warn('Không tìm thấy phần tử mục tiêu với ID:', targetId);
            }
            isManualClick = false;
        }

        $(document).on('click', '.target-day', function(event) {

            var targetId = $(this).data('target');
            var index = $(this).data('slick-index');

            const $parent = $('#schedule-content');
            var targetSelector = '#' + targetId;

            //const offsetTop = $(targetSelector).position().top;
            const offsetTop = $(targetSelector).offset().top - $parent.offset().top + $parent.scrollTop();


            $('.schedule-carousel').slick('slickGoTo', index);

            if ($(targetSelector).length) {

                $parent.animate({
                    scrollTop: offsetTop
                }, 500);

            } else {
                console.warn('Không tìm thấy phần tử mục tiêu với ID:', targetId);
            }
        });

        let lastVisibleDay = null;
        let isSlickAnimating = false;
        function initScheduleScrollHandler() {

            $('#schedule-content').off('scroll');

            $('#schedule-content').on('scroll', function () {
                if (isManualClick) return;


                const scrollContainer = this;
                // let newVisibleDay = null;
                let currentVisibleDay = null;
                let minDistanceFromTop = Infinity;

                $('.day-content', scrollContainer).each(function () {
                    const rect = this.getBoundingClientRect();
                    const containerRect = scrollContainer.getBoundingClientRect();

                    const distanceFromContainerTop = rect.top - containerRect.top;

                    if (rect.bottom > containerRect.top && rect.top < containerRect.bottom) {
                        if (distanceFromContainerTop < minDistanceFromTop) {
                            minDistanceFromTop = distanceFromContainerTop;
                            currentVisibleDay = $(this).data('day');
                        }
                    }
                });

                if (currentVisibleDay !== null && currentVisibleDay !== lastVisibleDay) {
                    // console.log('Before scroll (x):', lastVisibleDay);
                    // console.log('After scroll (y):', currentVisibleDay);

                    let newSlideIndex = -1;
                    const slickInstance = $('.schedule-carousel').slick('getSlick');

                    if (slickInstance) { // Đảm bảo Slick đã được khởi tạo
                        slickInstance.$slides.each(function(index) {
                            if ($(this).data('target') === ('myTarget' + currentVisibleDay)) {
                                newSlideIndex = index;
                                return false;
                            }
                        });

                        const currentSlickSlideIndex = slickInstance.slickCurrentSlide();

                        if (newSlideIndex !== -1 && newSlideIndex !== currentSlickSlideIndex) {
                            console.log(newSlideIndex)
                            isSlickAnimating = true;
                            slickInstance.slickGoTo(newSlideIndex);
                        }
                    }
                    lastVisibleDay = currentVisibleDay;
                }
            });
            console.log('Sự kiện scroll cho #schedule-content đã được gắn lại.');
        }

        /*----------------------------------------------------*/
        /*  End Smooth Scroll To Detail Schedule
        /*----------------------------------------------------*/









        /*----------------------------------------------------*/
        /*  Ajax Get Event And Activity
        /*----------------------------------------------------*/
        $('#getEvent').click(function () {
            let address = $(this).data('address');
            var url = $('#get-url-event').attr('data-url');
            $('#btn-get-event').remove();
            $('#spinner3').removeClass('d-none').addClass('d-flex');

            $.ajax({
                url: url,
                type: "GET",
                data: { address: address },
                success: function (data) {
                    // $('.schedule-carousel').html(response.html);


                    var $data = $(data);
                    $('#event-response').html($data);
                    $('.schedule-carousel').slick({
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 3,
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    arrows: true,
                                    centerMode: true,
                                    centerPadding: '0px',
                                    slidesToShow: 3
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    arrows: true,
                                    centerMode: true,
                                    centerPadding: '0px',
                                    slidesToShow: 1
                                }
                            }
                        ]
                    });
                    $('#spinner2').removeClass('d-flex').addClass('d-none');
                },
                error: function (xhr, status, error) {
                    console.error("Lỗi status:", status);  // Lỗi HTTP (404, 500, v.v.)
                    console.error("Lỗi từ server:", xhr.responseText);  // Nội dung lỗi
                    console.error("Chi tiết lỗi:", error);  // Mô tả lỗi

                    alert("Có lỗi xảy ra: " + xhr.status + " - " + error);
                }
            });
        });
        /*----------------------------------------------------*/
        /*  End Ajax Get Event And Activity
        /*----------------------------------------------------*/









        /*----------------------------------------------------*/
        /*  Chatbot
        /*----------------------------------------------------*/
        const $themeToggle = $('.theme-toggle');
        const $containerChatbot = $('.container-chatbot');
        const $chatContainer = $('#chatContainer');
        const $chatContainerParent = $('#chatContainer-parent');
        const $messageInput = $('.message-input');
        const $sendButton = $('.send-button');
        const $typingIndicator = $('.typing-indicator');
        const $toggleChatbotButton = $('.ai-chatbot');
        const $themeToggleButton = $('.theme-toggle-hide');
        const $toggleIcon = $themeToggleButton.find('i');

        // Theme toggling
        let isDarkTheme = false;
        $themeToggle.on('click', function () {
            isDarkTheme = !isDarkTheme;
            $containerChatbot.attr('data-theme', isDarkTheme ? 'dark' : 'light');
            $themeToggle.html(isDarkTheme
                ? '<i class="fas fa-sun"></i>'
                : '<i class="fas fa-moon"></i>');
        });

        // Chat functionality
        function createMessageElement(content, isUser = false) {
            const className = isUser ? 'user-message' : 'bot-message';
            return $(`
            <div class="message ${className}">
                <div class="message-bubble">${content}</div>
            </div>
        `);
        }

        function addMessage(content, isUser = false) {
            const $messageElement = createMessageElement(content, isUser);
            $chatContainer.append($messageElement);
            $chatContainerParent.scrollTop($chatContainer[0].scrollHeight);
        }

        function showTypingIndicator() {
            $typingIndicator.show();
            $chatContainer.scrollTop($chatContainer[0].scrollHeight);
        }

        function hideTypingIndicator() {
            $typingIndicator.hide();
        }

        function simulateBotResponse(userMessage) {
            showTypingIndicator();
            $.ajax({
                url: $('#get_route_chatbot').attr('data-url'),
                method: 'POST',
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({ message: userMessage }),
                success: function (data) {
                    hideTypingIndicator();
                    addMessage(data.reply);
                },
                error: function () {
                    hideTypingIndicator();
                    console.error('Lỗi khi gửi yêu cầu đến AI');
                    addMessage("Xin lỗi, có lỗi xảy ra khi liên hệ trợ lý AI.");
                }
            });
        }

        function handleSendMessage() {
            const message = $messageInput.val().trim();
            if (message) {
                addMessage(message, true);
                $messageInput.val('');
                simulateBotResponse(message);
            }
        }

        $sendButton.on('click', handleSendMessage);

        $messageInput.on('keypress', function (e) {
            if (e.key === 'Enter') {
                handleSendMessage();
            }
        });

        setTimeout(function () {
            addMessage("Hello! I'm your AI assistant. How can I help you today?");
        }, 500);

        $toggleChatbotButton.on('click', function () {
            $containerChatbot.toggleClass('shrink');
        });

        $themeToggleButton.on('click', function () {
            $containerChatbot.addClass('shrink');
        });

        /*----------------------------------------------------*/
        /*  End Chatbot
        /*----------------------------------------------------*/




        /*----------------------------------------------------*/
        /*  Map Responsive
        /*----------------------------------------------------*/
        $(document).ready(function () {
            const originalParent = $('#result-map').parent();
            const mapElement = $('#result-map');

            function handleResponsiveMap() {
                if (window.innerWidth < 992) {
                    if (!$('#map-response').find('#result-map').length) {
                        $('#map-response').append(mapElement);
                    }

                    $('#map').css({
                        height: '580px',
                        width: '100%'
                    });
                } else {
                    $('#map').css({
                        height: '61rem',
                        width: '100%'
                    });
                    if (!originalParent.find('#result-map').length) {
                        originalParent.append(mapElement);
                    }
                }
            }

            // Gọi lúc đầu
            handleResponsiveMap();

            // Gọi khi resize
            $(window).on('resize', function () {
                handleResponsiveMap();
            });
        });
        /*----------------------------------------------------*/
        /*  End Map Responsive
        /*----------------------------------------------------*/

        /*----------------------------------------------------*/
        /*  Function Check For Button Direction
        /*----------------------------------------------------*/
        function updateRouteButtons() {
            $('.requestAndDisplayRoute').each(function () {
                const $btn = $(this);

                const oriLat = $btn.data('ori-lat');
                const oriLon = $btn.data('ori-lon');
                const deLat  = $btn.data('de-lat');
                const deLon  = $btn.data('de-lon');

                if (!oriLat || !oriLon || !deLat || !deLon) {
                    $btn.removeClass('btn-primary requestAndDisplayRoute').addClass('btn-secondary');
                }
            });
        }
        /*----------------------------------------------------*/
        /*  End Function Check For Button Direction
        /*----------------------------------------------------*/



        /*----------------------------------------------------*/
        /*  Ajax Load More Place
        /*----------------------------------------------------*/
        $(document).on('click', '#load-more', function() {
            var button = $(this);
            const urlParams = new URLSearchParams(window.location.search);
            const keyword = urlParams.get('keyword');
            const province = urlParams.get('province');
            console.log(keyword)
            var pageParam = parseInt(button.attr('data-next-page'));
            if (pageParam) {
                console.log("Current Page:", pageParam);
            }
            $.ajax({
                url: $('#get-url').attr('data-url'),
                type: 'GET',
                data: {
                    'keyword': keyword,
                    'province': province,
                    'pageParam': pageParam,
                    'id': $('#get-url').attr('data-id')
                },
                success: function(data) {
                    var $data = $(data);
                    $('#loading').append($data);
                    button.attr('data-next-page', pageParam+1);
                    for (var selector in config) {
                        $(selector).chosen(config[selector]);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });


        /*----------------------------------------------------*/
        /*  Check Have More
        /*----------------------------------------------------*/
        $(document).on('click', '#load-more', function() {
            setTimeout(function() {
                var have_more = $('#have-more').attr('data-have-more');
                console.log('have more',have_more)
                if (have_more === '0'){
                    $('#load-more').remove();
                }else{
                    $('#have-more').remove();
                }
            }, 500);
        });
        /*----------------------------------------------------*/
        /*  End Ajax Load More Place
        /*----------------------------------------------------*/


        //------------------------------ Ajax show Result Search Destination ---------------------------//
        $(document).ready(function() {
            let searchTimer;
            function fetchProducts(page = 1) {
                const keyword = $('#search-input').val();
                const urlParams = new URLSearchParams(window.location.search);
                const province = urlParams.get('province');
                $.ajax({
                    url: $('#url_search').attr('data-url'),
                    type: 'GET',
                    data: {
                        'keyword': keyword,
                        'province': province,
                        'page': page,
                    },
                    success: function(data) {
                        var $data = $(data);
                        $('.tab-content').html($data);
                        var newUrl = new URL(window.location.href);
                        newUrl.searchParams.set('keyword', keyword);
                        window.history.pushState({path: newUrl.href}, '', newUrl.href);
                    },
                    error: function(xhr, status, error) {
                        console.error("Lỗi khi tìm kiếm:", xhr.responseText);
                        $('#get-result-search').html('<p class="text-danger">Đã xảy ra lỗi khi tải dữ liệu.</p>');
                    }
                });
            }

            $('#search-input').on('keyup', function() {
                clearTimeout(searchTimer);
                console.log('aaaa')
                searchTimer = setTimeout(function() {
                    fetchProducts(1);
                }, 300);
            });
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                clearTimeout(searchTimer);
                fetchProducts(1);
            });
            if (window.location.search.includes('keyword')) {
                const initialKeyword = new URLSearchParams(window.location.search).get('keyword');
                const initialPage = new URLSearchParams(window.location.search).get('page') || 1;
                $('#search-input').val(initialKeyword);
                fetchProducts(initialPage);
            } else {
            }
        });
        //------------------------ Ajax Sort Destination By Province ---------------------------------//
        $('#destination-select').on('change', function (){
            var province = $(this).val();
            const urlParams = new URLSearchParams(window.location.search);
            const keyword = urlParams.get('keyword');
            console.log(province)
            $.ajax({
                url: $('#url_sort').attr('data-url'),
                type: 'GET',
                data: {
                    'province': province,
                    'keyword': keyword,
                },
                success: function(data) {
                    var $data = $(data);
                    $('.tab-content').html($data);
                    var newUrl = new URL(window.location.href);
                    newUrl.searchParams.set('province', province);
                    window.history.pushState({path: newUrl.href}, '', newUrl.href);
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi khi tìm kiếm:", xhr.responseText);
                    $('#get-result-search').html('<p class="text-danger">Đã xảy ra lỗi khi tải dữ liệu.</p>');
                }
            });
        })
        //---------------------------------------------------------//





    });



    // ------------------ End Document ------------------ //
})(jQuery);

