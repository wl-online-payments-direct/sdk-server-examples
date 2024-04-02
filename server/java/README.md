# Online payments Java SDK Example

This example app illustrates the use of the Online Payments Java SDK and the services provided by the Online Payments platform.

## Prerequisites

- JDK 17+
- [Git](https://git-scm.com/)

## Getting started

To get started with this example application, clone or download the source from Git.

<b>IMPORTANT:</b> Before installing and running the application some basic configuration has to be set.
Set your configuration details in the [application.properties](src/main/resources/application.properties)

```
# Direct SDK Configuration
merchantId=<your-merchant-id>
merchantKey=<your-api-key>
merchantSecret=<your-api-secret>
apiEndpoint=<api-endpoint>

# Hosted checkout configuration :: testing purposes
hostedCheckout.redirectUrl=<your-hosted-checkout-redirect-url>
```

Build and run the application 

```
mvn spring-boot:run
```

Access the application: http://localhost:8999

### Available scenarios

- Create Payment - Basic: http://localhost:8999/createpayment/basic.html
- Hosted Checkout - Basic: http://localhost:8999/hostedcheckout/basic.html
- Hosted Tokenization - Basic: http://localhost:8999/hostedtokenization/basic.html

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
./ngrok http --domain=nice-small-app.ngrok-free.app 8999
```

If everything is properly set then the application should be accessed on this link: https://nice-small-app.ngrok-free.app
