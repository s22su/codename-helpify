(function () {

    var Front = {

        needHelp: function () {

            console.log('Need help');
        },

        wantHelp: function () {

            console.log('Want help');
        },

        fadeOut: function () {

            $('#body').fadeOut();
            $('#body-login')
                .removeClass('hide').fadeIn();
        },

        init: function () {

            $('#body .need-help, .want-help').click(this.fadeOut);
        }
    };

    $(document).ready(function () {

        Front.init();
    });

})();
