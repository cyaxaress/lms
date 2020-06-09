function countDownTimer() {
    var self = $('.count-down-timer');
    var countDownDate = new Date(self.data('countdown')).getTime();
    var timer = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        // distance = -1;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000)
        self.text(days + ":" + hours + ":" + minutes + ":" + seconds);

        if (distance <= 0) {
            clearInterval(timer);
            $('.campaign').css('display','none')
        }

    }, 0)

}

countDownTimer();
// countDownTimer('January 29, 2020 00:00:00');