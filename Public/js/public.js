/**
 * Created by anthony on 16/9/8.
 */
function dateFactory(str, time) {

    var data = new Date(time),
        Y4 = data.getFullYear(),
        Y2 = data.getFullYear().toString().slice(-2),
        MM = data.getMonth() + 1,
        DD = data.getDate(),

        hh = data.getHours(),
    mm = data.getMinutes(),
    ss = data.getSeconds();

    function addZeorn(dd) {
        dd = parseInt(dd);
        if (dd < 10) {
            dd = "0" + dd;
        }
        return dd;
    }

    MM = addZeorn(MM);
    DD = addZeorn(DD);

    hh = addZeorn(hh);
    mm = addZeorn(mm);

    ss = addZeorn(ss);

    str = str.replace("YYYY", Y4);
    str = str.replace("YY", Y2);
    str = str.replace("MM", MM);
    str = str.replace("DD", DD);

    str = str.replace("hh", hh);
    str = str.replace("mm", mm);
    str = str.replace("ss", ss);

    return str;
}
$(function () {
    $(".user").click(function () {
        $(this).children("input").attr("placeholder", "邮箱地址");
    });

    $(".pwd").click(function () {
        $(this).children("input").attr("placeholder", "8-20位字母、数字或符号两种或以上组合");
    });

    $(".pwdok").click(function () {
        $(this).children("input").attr("placeholder", "再次输入密码");
    });

    $("input").blur(function (event) {
        $(this).attr("placeholder", "");
    });

    var verifyimg = $(".passcode").attr("src");
    $(".passcode").click(function () {
        if (verifyimg.indexOf('?') > 0) {
            $(".passcode").attr("src", verifyimg + '&random=' + Math.random());
        } else {
            $(".passcode").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
        }
    });
});