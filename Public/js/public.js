/**
 * Created by anthony on 16/9/8.
 */
$(function() {
    $(".user").click(function() {
        $(this).children("input").attr("placeholder", "邮箱地址");
    });

    $(".pwd").click(function() {
        $(this).children("input").attr("placeholder", "8-20位字母、数字或符号两种或以上组合");
    });

    $(".pwdok").click(function() {
        $(this).children("input").attr("placeholder", "再次输入密码");
    });

    $("input").blur(function(event) {
        $(this).attr("placeholder", "");
    });

    var verifyimg = $(".passcode").attr("src");
    $(".passcode").click(function() {
        if (verifyimg.indexOf('?') > 0) {
            $(".passcode").attr("src", verifyimg + '&random=' + Math.random());
        } else {
            $(".passcode").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
        }
    });
})