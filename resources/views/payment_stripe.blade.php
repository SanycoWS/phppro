<!DOCTYPE html>
<html>
<head>
    <title>Оплата</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<h1>Оплата</h1>
<div id="payment-result"></div>
<form id="payment-form">
    <div id="link-authentication-element"></div>
    <div id="payment-element"></div>
    <button id="submit">Pay now</button>
    <div id="error-message"></div>
</form>

<script>


    document.addEventListener('DOMContentLoaded', async () => {
        // Load the publishable key from the server. The publishable key
        // is set in your .env file.
        const publishableKey = 'pk_test_51NZaCUEB9V1rppdNqO00a1Nn5m05rBAJCiRyUkfXwsI654b1WNBtgkYjwkq45VhZmUB1MYvZr2xPw8Hx6YjiJppF00wEbOoIzR';
        const stripe = Stripe(publishableKey, {
            apiVersion: '2020-08-27',
        });

        // On page load, we create a PaymentIntent on the server so that we have its clientSecret to
        // initialize the instance of Elements below. The PaymentIntent settings configure which payment
        // method types to display in the PaymentElement.

        const clientSecret = fetch("/api/payment/makePayment", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                paymentSystem: 2,
            }),
        })
            .then(function (response) {
                return response.json()
            })
            .then(function (order) {
                return order.id
            });

        // Initialize Stripe Elements with the PaymentIntent's clientSecret,
        // then mount the payment element.
        const elements = stripe.elements({clientSecret});
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');
        // Create and mount the linkAuthentication Element to enable autofilling customer payment details
        const linkAuthenticationElement = elements.create("linkAuthentication");
        linkAuthenticationElement.mount("#link-authentication-element");
        // If the customer's email is known when the page is loaded, you can
        // pass the email to the linkAuthenticationElement on mount:
        //
        //   linkAuthenticationElement.mount("#link-authentication-element",  {
        //     defaultValues: {
        //       email: 'jenny.rosen@example.com',
        //     }
        //   })
        // If you need access to the email address entered:
        //
        //  linkAuthenticationElement.on('change', (event) => {
        //    const email = event.value.email;
        //    console.log({ email });
        //  })

        // When the form is submitted...
        const form = document.getElementById('payment-form');
        let submitted = false;
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Disable double submission of the form
            if (submitted) {
                return;
            }
            submitted = true;
            form.querySelector('button').disabled = true;

            const nameInput = document.querySelector('#name');

            // Confirm the payment given the clientSecret
            // from the payment intent that was just created on
            // the server.
            const {error: stripeError} = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: `${window.location.origin}/return.html`,
                }
            });
            /**
             *   const url = new URL(window.location);
             const clientSecret = url.searchParams.get('payment_intent_client_secret');
             send clientSecret to confirm payment
             stripe->paymentIntents->retrieve(clientSecret);
             */

            if (stripeError) {
                alert(stripeError.message);

                // reenable the form.
                submitted = false;
                form.querySelector('button').disabled = false;
                return;
            }
        });
    });
</script>
</body>
</html>
