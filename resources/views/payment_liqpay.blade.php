<div id="liqpay_checkout"></div>
<script>
    window.LiqPayCheckoutCallback = function () {
        fetch("/api/payment/makePayment/3", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then(function (response) {
                return response.json()
            })
            .then(function (data) {
                const paypalData = JSON.parse(data.order.id);
                console.log({
                    data: paypalData.data,
                    signature: paypalData.signature,
                    embedTo: "#liqpay_checkout",
                    language: "en",
                    mode: "embed" // embed || popup
                })
                LiqPayCheckout.init({
                    data: paypalData.data,
                    signature: paypalData.signature,
                    embedTo: "#liqpay_checkout",
                    language: "en",
                    mode: "embed" // embed || popup
                }).on("liqpay.callback", function (data) {
                    console.log(data);
                    fetch("/api/payment/confirm/3", {
                        method: "POST",
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({paymentId: data.order_id})
                    }).then(function (response) {
                        alert(response)
                    })
                        .catch(function (error) {
                            console.error('Помилка при виконанні оплати через Stripe на бекенді: ', error);
                        });
                }).on("liqpay.ready", function (data) {
                    // ready
                }).on("liqpay.close", function (data) {
                    // close
                });

            })


    };
</script>
<script src="//static.liqpay.ua/libjs/checkout.js" async></script>
