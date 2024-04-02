# Online payments PHP SDK Example

This example app illustrates the use of the Online Payments PHP SDK and the services provided by the Online Payments platform.

## Prerequisites

- PHP 8.0+
- [Git](https://git-scm.com/)

## Getting started

To get started with this example application, clone or download the source from Git.

<b>IMPORTANT:</b> Before installing and running the application some basic configuration has to be set.
Set your configuration details in the [.env](.env)

```
# Direct SDK Configuration
MERCHANT_ID=<your-merchant-id>
API_KEY=<your-api-key>
API_SECRET=<your-api-secret>
API_ENDPOINT=payment.preprod.direct.worldline-solutions.com

# Hosted checkout configuration :: testing purposes
HOSTED_CHECKOUT_REDIRECT_URL=<your-hosted-checkout-redirect-url>
```

Build and run the application 

```
cd server/php
composer install && php -S localhost:8000 public/index.php
```

Access the application: http://localhost:8000

### Available scenarios

- Create Payment - Basic: http://localhost:8000/createpayment/basic.html
- Hosted Checkout - Basic: http://localhost:8000/hostedcheckout/basic.html
- Hosted Tokenization - Basic: http://localhost:8000/hostedtokenization/basic.html

## Useful information

In order to test the example application properly and see how the callbacks from the API works, 
a tunneling service like [ngrok](https://ngrok.com/) can be used in order the links for the outcomes to be reachable.

- Example of redirect url if exposed via ngrok:
```
# Hosted checkout configuration :: testing purposes
hostedCheckout.redirectUrl=https://nice-small-app.ngrok-free.app/hostedcheckout/outcome.html

# Create payment configuration :: testing purposes
createPayment.3ds.returnUrl=https://nice-small-app.ngrok-free.app/createpayment/3ds-returnUrl.html
```

- Example of running the ngrok script

```
./ngrok http --domain=nice-small-app.ngrok-free.app 8000
```

If everything is properly set then the application should be accessed on this link: https://nice-small-app.ngrok-free.app
