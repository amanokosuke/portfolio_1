// DOMの構築が完了=$(document).ready
$(() => {
    $('.sp_menu').click(function () {
        $(this).toggleClass('clicked');

        if ($(this).hasClass('clicked')) {
            $('.header_2_sp').addClass('clicked');　 //クラスを付与
        } else {
            $('.header_2_sp').removeClass('clicked'); //クラスを外す
        }
    });

    var pagetop = $('.page_top_button');
    pagetop.click(function () {
        $('body, html').animate({scrollTop: 0}, 800);
        return false;
    });

    /**
     * iframeポップアップ
     */
    $('.header_login_button').each(function () {
        $(this).magnificPopup({
            preloader: true,
            type: 'iframe',
            closeOnBgClick: true
        });
    });

    $('.service_kiji_content').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        gallery: {enabled: true},
        callbacks: {
            elementParse: function (item) {
                item.src = item.el.attr('href');
            }
        }
    });

    console.log("kyozon page ready");

    $('.clipboard').each(function () {
        $(this).on("click", function () {
            $('body').append('<textarea id="currentURL" style="position:fixed;left:-100%;">' + location.href + '</textarea>');
            $('#currentURL').select();
            document.execCommand('copy');
            $('#currentURL').remove();
            $(this).showBalloon({contents: "クリップボードにコピーしました"});

            var that = $(this);
            setTimeout(function () {
                that.hideBalloon();
            }, 1000);
        });
    });

    //login
    if (document.location.pathname == "/") {
        var get_qs_params = this.get_qs_params();
        for (var param of get_qs_params) {
            if (param[0] == "r") {
                if (this.is_logined == 1) {
                    var action = param[1].split("%7C");
                    if (action.length == 2) {
                        if (action[0] == "m") {
                            document.location.href = "/mypage/pages/r/" + action[1];
                            return;
                        }
                    }

                } else {
                    $.magnificPopup.open({
                        preloader: false,
                        type: 'iframe',
                        closeOnBgClick: true,
                        items: {
                            src: "/login" + document.location.search
                        }
                    });
                }
            }
        }
    }

    if (navigator.userAgent.indexOf('iPhone') > 0) {
        let body = document.getElementsByTagName('body')[0];
        body.classList.add('iPhone');
    }

    if (navigator.userAgent.indexOf('iPad') > 0) {
        let body = document.getElementsByTagName('body')[0];
        body.classList.add('iPad');
    }

    if (navigator.userAgent.indexOf('Android') > 0) {
        let body = document.getElementsByTagName('body')[0];
        body.classList.add('Android');
    }
});

function get_qs_params() {
    var qs = document.location.search;
    var params = qs.replace("?", "").split("&");
    var result = [];
    if (params.length > 0) {
        for (var param of params) {
            var kv = param.split("=");
            if (kv.length == 2) {
                result.push(kv);
            }
        }
    }
    return result;
}

function login_complete() {
    $.magnificPopup.instance.close();
    document.location.reload();
}
