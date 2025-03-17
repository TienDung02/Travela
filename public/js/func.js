
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
window.alert_after_load = function(title, icon, text, reload) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon
    }).then(() => {
        if (reload === 'true') {
            location.reload();
        }
    });
};
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
