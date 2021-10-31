function favorite_toggle(post_id) {
    var css = $(".favorite_icon").attr("class");
    if (css.indexOf("favorite_icon_on") > 0) {
        $(".favorite_icon").removeClass("favorite_icon_on");
        var data = {
            post_id: post_id
        };
        $.ajax('/mypage/api/user/favorite/_off',
            {
                type: 'put',
                data: JSON.stringify(data),
                dataType: 'json',
                contentType: 'application/json'
            }
        );
    } else {
        $(".favorite_icon").addClass("favorite_icon_on");
        var post_title = $("h1").text();
        var post_url = document.location.href;
        var data = {
            post_id: post_id,
            post_title:post_title,
            post_url:post_url
        };
        $.ajax('/mypage/api/user/favorite/',
            {
                type: 'post',
                data: JSON.stringify(data),
                dataType: 'json',
                contentType: 'application/json'
            }
        );
    }
}
