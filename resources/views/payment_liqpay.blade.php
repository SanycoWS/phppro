<div id="liqpay_checkout"></div>
<script>
    window.LiqPayCheckoutCallback = function () {
        LiqPayCheckout.init({
            data: "eyAidmVyc2lvbiIgOiAzLCAicHVibGljX2tleSIgOiAieW91cl9wdWJsaWNfa2V5IiwgImFjdGlv" +
                "biIgOiAicGF5IiwgImFtb3VudCIgOiAxLCAiY3VycmVuY3kiIDogIlVTRCIsICJkZXNjcmlwdGlv" +
                "biIgOiAiZGVzY3JpcHRpb24gdGV4dCIsICJvcmRlcl9pZCIgOiAib3JkZXJfaWRfMSIgfQ==",
            signature: "QvJD5u9Fg55PCx/Hdz6lzWtYwcI=",
            embedTo: "#liqpay_checkout",
            language: "en",
            mode: "embed" // embed || popup
        }).on("liqpay.callback", function (data) {
            console.log(data.status);
            console.log(data);
        }).on("liqpay.ready", function (data) {
            // ready
        }).on("liqpay.close", function (data) {
            // close
        });
    };
</script>
<script src="//static.liqpay.ua/libjs/checkout.js" async></script>
