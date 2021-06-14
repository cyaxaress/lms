var offset = 120;


function checkCampagin() {
    if ($(window).width() <= 991) {
        setTimeout(function () {
            if ($(".campaign").css("display") == 'block') {
                $('main').removeClass('mrt-150');
                $('main').removeClass('mrt-205');
                $('main').removeClass('mrt-110');
                $('main').addClass('mrt-170');
            } else {
                $('main').removeClass('mrt-150');
                $('main').removeClass('mrt-205');
                $('main').removeClass('mrt-170');
                $('main').addClass('mrt-110');

            }
        }, 100)
    } else {
        setTimeout(function () {
            if ($(".campaign").css("display") == 'block') {
                $('main').removeClass('mrt-150');
                $('main').removeClass('mrt-170');
                $('main').removeClass('mrt-110');
                $('main').addClass('mrt-205');
                $(".sidebar-sticky").css("top", "155px");
            } else {
                $('main').removeClass('mrt-205');
                $('main').removeClass('mrt-170');
                $('main').removeClass('mrt-110');
                $('main').addClass('mrt-150');
                $(".sidebar-sticky").css("top", "104px");
            }
        }, 300)
    }
}

checkCampagin()

$(window).scroll(function () {
    $(this).scrollTop() >= offset ? ($("#navigation").addClass("sticky"), $(".scrollToTop").fadeIn()) : ($("#navigation").removeClass("sticky"),
        $(".scrollToTop").fadeOut());
}), window.addEventListener("resize", function () {
    checkCampagin();
}),
    $(".scrollToTop").on("click", function () {
        $("html,body").animate({
            scrollTop: 0
        }, 800);
    }), $(".search-icon").on("click", function () {
    $(this).toggleClass("is-active"), $(".t-header-search").toggleClass("is-active");
}), $(".menu-icon").on("click", function () {
    $(this).toggleClass("is-active"), $("#navigation").toggleClass("is-active"), $(".overlay").toggleClass("is-active"),
        $("body").toggleClass("overflow-hidden");
}), $(document).on("click", function (s) {
    $(s.target).closest("#navigation").length || $(s.target).closest(".menu-icon").length || ($(".menu-icon").removeClass("is-active"),
        $("#navigation").removeClass("is-active"), $(".overlay").removeClass("is-active"),
        $("body").removeClass("overflow-hidden"));
}), $(".episodes-list-group-head").on("click", function () {
    var s = $(this).find(".head-left");
    s.hasClass("open") ? (s.removeClass("open"), $(this).parent().find(".episodes-list-group-body").slideUp(200)) : (s.addClass("open"),
        $(this).parent().find(".episodes-list-group-body").slideDown(200));
}),


    $(".like").on("click", function () {
        $(this).toggleClass("is-active");
    }), $(".course-description-title").on("click", function () {
    $(this).parent().toggleClass("is-active");
}), $(".cancel").on("click", function () {
    $(".answer-form").removeClass("is-active");
}), $(".moon").on("click tochstart", function () {
    $("body").addClass("dark-mode"), $(this).hide(), $(".sun").show();
}), $(".sun").on("click tochstart", function () {
    $("body").removeClass("dark-mode"), $(this).hide(), $(".moon").show();
});

$(".bt-accrdion-li").on("click", function () {
    if ($(this).hasClass("open")) {
        $(this).removeClass("open");
        $(this).find(".bt-accrdion-div").slideUp(200);
    } else {
        $(this).addClass("open");
        $(this).find(".bt-accrdion-div").slideDown(200);
        $(this).siblings("li").children(".bt-accrdion-div").slideUp(200);
        $(this).siblings("li").removeClass("open");
    }
});
$('.main-menu.has-sub').hover(function (e) {
    $(this).parent().find('.main-menu.has-sub > a').removeAttr('href');
    var sh = $(this).find('.sub-menu').prop('scrollHeight');
    $(this).find('.sub-menu').css({'height': sh + 'px', 'transition': 'all 200ms ease'});
}, function () {
    sh = $(this).find('.sub-menu').prop('scrollHeight');
    $(this).find('.sub-menu').css({'height': 0, 'transition': 'all 200ms ease'});
})
var slideIndex = 1;
var pt;
var items;
slideShow(slideIndex);

function slideShow(n) {
    // console.log('n = ' + n);
    var slides = $('.slide').toArray();
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    // console.log('slideIndex  = ' + slideIndex);
    $('.slide').css('display', 'none');
    $(slides[slideIndex - 1]).css('display', 'flex');
    progressbar(slideIndex - 1);
    return slideIndex

}

function move(n) {
    clearInterval(pt);
    items[slideIndex - 1].style.width = '0%';
    slideIndex = slideIndex + n;
    slideShow(slideIndex);

}

function progressbar(slideId) {
    items = document.getElementsByClassName('item-inner');
    var width = 0;
    pt = setInterval(frame, 30);

    function frame() {
        if (width >= 100) {
            clearInterval(pt);
            items[slideId].style.width = '0%';
            slideIndex++;
            slideIndex = slideShow(slideIndex);
        } else {
            width++;
            items[slideId].style.width = width + '%';
        }
    }


}

$(document).on('click touchstart', function (e) {
    var headerSearchBox = $('.t-header-search');
    var input = $('.t-header-searchbox input');
    if ($(e.target).is(headerSearchBox) || headerSearchBox.has(e.target).length == 1) {
        input.addClass('bg-white')
        $('.t-header-search-content').show();

    } else {
        input.removeClass('bg-white');
        $('.t-header-search-content').hide();

    }
})
$('.t-header-search-filter-item').on('click', function () {
    $('.t-header-search-filter-item').removeClass('active')
    $(this).addClass('active');
})

//bg bg-toast-info | bg-toast-success | bg-toast-alert
// icon toast-info | toast-success | toast-alert
function toastNotifi(message, bg, icon, delay = 3000) {
    $('.toast__message').text(message);
    $('.toast').removeClass('bg-toast-info bg-toast-success bg-toast-alert');
    $('.toast').addClass(bg)
    $('.toast__icon').removeClass('toast-info toast-success toast-alert')
    $('.toast__icon').addClass(icon)
    $('.toast').fadeIn(200).delay(delay).fadeOut(400);
}

$(".episodes-list-item.lock").click(function (e) {
    e.preventDefault();
    toastNotifi('برای مشاهده دوره باید ابتدا آن را خریداری کنید', 'bg-toast-info', 'toast-info', 2000)
});

function toast__close() {
    $('.toast').css('display', 'none')
}

$('.short-link-a').on('click', function (e) {
    e.preventDefault();
    var url = $('.short--link');
    var copyLink = url.select();
    document.execCommand('copy');
    $('.short-link-a').removeClass('is-active');
    $(this).addClass('is-active');
    setTimeout(function () {
        $('.short-link-a').removeClass('is-active');
    }, 1000)
});

$('.rate').click(function () {
    var rate = $(this);
    var dataw = rate.data('w');
    console.log(dataw)
    var rating = $(this).parents('.rating');
    var fstar = rating.find('.fstar');
    console.log(fstar);
    fstar.css('width', dataw)

})

$('.rate').hover(function () {
    $('.fstar').addClass('is-active')
}, function () {
    $('.fstar').removeClass('is-active')

})
$('.study-mode').click(function () {
    $('.sidebar-right').toggleClass('d-none');
    $('.content-left').toggleClass('on');
})

function setCommentId(commentableId) {
    $("#comment_id").val(commentableId)
}
