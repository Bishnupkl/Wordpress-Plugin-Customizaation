jQuery(function ($) {

    var video_conferencing_zoom_api_public = {

        init: function () {
            this.cacheVariables();
            this.countDownTimerMoment();
            this.evntLoaders();
        },

        cacheVariables: function () {
            this.$timer = $('#dpn-zvc-timer');
        },

        evntLoaders: function () {
            $(window).on('load', this.setTimezone.bind(this));
        },

        countDownTimerMoment: function () {
            var clock = this.$timer;
            if (clock.length > 0) {
                var valueDate = clock.data('date');
                var mtgTimezone = clock.data('tz');

                // var dateFormat = moment(valueDate).format('MMM D, YYYY HH:mm:ss');

                var user_timezone = moment.tz.guess();
                if (user_timezone === 'Asia/Katmandu') {
                    user_timezone = 'Asia/Kathmandu';
                }

                //Converting Timezones to locals
                var source_timezone = moment.tz(valueDate, mtgTimezone).format();
                var converted_timezone = moment.tz(source_timezone, user_timezone).format('MMM D, YYYY HH:mm:ss');
                var convertedTimezonewithoutFormat = moment.tz(source_timezone, user_timezone).format();

                //Check Time Difference for Validations
                var currentTime = moment().unix();
                var eventTime = moment(convertedTimezonewithoutFormat).unix();
                var diffTime = eventTime - currentTime;

                $('.sidebar-start-time').html(moment.parseZone(convertedTimezonewithoutFormat).local().format('LLL'));

                var second = 1000,
                    minute = second * 60,
                    hour = minute * 60,
                    day = hour * 24;

                // if time to countdown
                if (diffTime > 0) {
                    var countDown = new Date(converted_timezone).getTime();
                    var x = setInterval(function () {
                        var now = new Date().getTime();
                        var distance = countDown - now;

                        document.getElementById('dpn-zvc-timer-days').innerText = Math.floor(distance / (day));
                        document.getElementById('dpn-zvc-timer-hours').innerText = Math.floor((distance % (day)) / (hour));
                        document.getElementById('dpn-zvc-timer-minutes').innerText = Math.floor((distance % (hour)) / (minute));
                        document.getElementById('dpn-zvc-timer-seconds').innerText = Math.floor((distance % (minute)) / second);

                        if (distance < 0) {
                            clearInterval(x);
                            $(clock).html("<div class='dpn-zvc-meeting-ended'><h3>" + zvc_strings.meeting_starting + "</h3></div>");
                        }
                    }, second);
                } else {
                    $(clock).html("<div class='dpn-zvc-meeting-ended'><h3>" + zvc_strings.meeting_ended + "</h3></div>");
                }
            }
        },

        /**
         * Set timezone and get links accordingly
         */
        setTimezone: function () {
            var timezone = moment.tz.guess();
            if (timezone === 'Asia/Katmandu') {
                timezone = 'Asia/Kathmandu';
            }

            if (typeof mtg_data !== undefined && mtg_data.page === "single-meeting") {
                $('.dpn-zvc-sidebar-content').after('<div class="dpn-zvc-sidebar-box remove-sidebar-loder-text"><p>Loading..Please wait..</p></div>');
                var pageData = {
                    action: 'set_timezone',
                    user_timezone: timezone,
                    post_id: mtg_data.post_id,
                    mtg_timezone: mtg_data.timezone,
                    start_date: mtg_data.start_date,
                    type: 'page'
                };

                $.post(mtg_data.ajaxurl, pageData).done(function (response) {
                    if (response.success) {
                        $('.dpn-zvc-sidebar-content').after(response.data);
                    } else {
                        $('.dpn-zvc-sidebar-content').after('<div class="dpn-zvc-sidebar-box">' + response.data + '</div>');
                    }

                    $('.remove-sidebar-loder-text').remove();
                });
            }

            //For Shortcode
            if (typeof mtg_data !== undefined && mtg_data.type === "shortcode") {
                var shortcodeData = {
                    action: 'set_timezone',
                    user_timezone: timezone,
                    mtg_timezone: mtg_data.timezone,
                    join_uri: mtg_data.join_uri,
                    browser_url: mtg_data.browser_url,
                    start_date: mtg_data.start_date,
                    type: 'shortcode'
                };

                $('.zvc-table-shortcode-duration').after('<tr class="remove-shortcode-loder-text"><td colspan="2">Loading.. Please wait..</td></tr>');
                $.post(mtg_data.ajaxurl, shortcodeData).done(function (response) {
                    if (response.success) {
                        $('.zvc-table-shortcode-duration').after(response.data);
                    } else {
                        $('.zvc-table-shortcode-duration').after('<tr><td colspan="2">' + response.data + '</td></tr>');
                    }

                    $('.remove-shortcode-loder-text').remove();
                });
            }
        }
    };

    video_conferencing_zoom_api_public.init();
});