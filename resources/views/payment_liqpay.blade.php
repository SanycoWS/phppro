<div id="liqpay_checkout"></div>
<script>
    window.LiqPayCheckoutCallback = function () {
        const data = fetch("/api/payment/makePayment/3", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then(function (response) {
                return response.json()
            })
            .then(function (data) {
                return data.order
            })
        LiqPayCheckout.init({
            data: data.id,
            signature: data.sig,
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
