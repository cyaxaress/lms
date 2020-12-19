function modal(modalID, size = null, btn, func = null) {
    var modalID = $(modalID);
    var btn = $(btn);
    var modal_content = modalID.find('.modal-content').css('width', size);
    var close = modalID.find('.close');
    btn.click(function (e) {
        e.preventDefault();
        modalID.css('display', 'block');
        $('body').css('overflow','hidden');
    })
    close.click(function () {
        modalID.css('display', 'none')
        $('body').css('overflow','unset');
    })
    $(window).on('click tochstart', function (e) {
        if (modalID.is(e.target)) {
            modalID.css('display', 'none');
            $('body').css('overflow','unset');
        }
    })
}

function showImage() {
    var imgsrc = $('.tutor-avatar-img').attr('src');
    console.log(imgsrc)
    $('.modal-body img').attr('src', imgsrc);
}
showImage()

modal('#Modal1', '800px', '#tutor-image')
modal('#Modal2', '1000px', '.btn-answer')
modal('#Modal-buy', '1000px', '.btn-buy')
