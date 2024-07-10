# Online payments Python SDK Example

This example app illustrates the use of the Online Payments Python SDK and the services provided by the Online Payments platform.

## Prerequisites

- [Python 3.4+](https://www.python.org/downloads/)
- [pip](https://pip.pypa.io/en/stable/cli/pip_install/)
- [Flask](https://flask.palletsprojects.com/en/3.0.x/)
- [Git](https://git-scm.com/)

## Getting started

To get started with this example application, clone or download the source from Git.

<b>IMPORTANT:</b> Before installing and running the application some basic configuration has to be set.
Set your configuration details in the [config.local.js](configuration/config.local.json)

```
# Direct SDK Configuration
merchantId=<your-merchant-id>
apiKey=<your-api-key>
apiSecret=<your-api-secret>
host=payment.preprod.direct.worldline-solutions.com
integrator=<your-company-name>


# Hosted checkout configuration :: testing purposes
hostedCheckout.redirectUrl=<your-hosted-checkout-redirect-url>
```

Build and run the application 

```
python3 api.py
```

Access the application: http://localhost:3000

### Available scenarios

- Create Payment - Basic: http://localhost:3000/createpayment/basic.html
- Hosted Checkout - Basic: http://localhost:3000/hostedcheckout/basic.html
- Hosted Tokenization - Basic: http://localhost:3000/hostedtokenization/basic.html

## Useful information

In order to test the example application properly and see how the callbacks from the API works, 
a tunneling service like [ngrok](https://ngrok.com/) can be used in order the links for the outcomes to be reachable.

- Example of redirect url if exposed via ngrok:
```
# Hosted checkout configuration :: testing purposes
hostedCheckout.redirectUrl=https://nice-small-app.ngrok-free.app/hostedcheckout/outcome.html
```

- Example of running the ngrok script

```
./ngrok http --domain=nice-small-app.ngrok-free.app 3000
```

If everything is properly set then the application should be accessed on this link: https://nice-small-app.ngrok-free.app
