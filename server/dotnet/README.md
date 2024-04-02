# Online payments .NET SDK Example

This example app illustrates the use of the Online Payments .NET SDK and the services provided by the Online Payments platform.

## Prerequisites

- .NET 8+
- [Git](https://git-scm.com/)

## Getting started

To get started with this example application, clone or download the source from Git.

<b>IMPORTANT:</b> Before installing and running the application some basic configuration has to be set.
Set your configuration details in the [appsettings.json](appsettings.json)

```
  "AppSettings": {
    "MerchantId": "<your-merchant-id>",
    "ApiKey": "<your-api-key>",
    "ApiSecret": "<your-api-secret>",
    "ApiEndpoint": "<api-endpoint>",
    "HostedCheckoutRedirectUrl": "<your-hosted-checkout-redirect-url>",
    "UseCommunicatorConfiguration": true
  }
```

Build and run the application 

```
dotnet run
```

Access the application 

```
http://localhost:5208
```

### Available scenarios

- Create Payment - Basic: http://localhost:5208/createpayment/basic.html
- Hosted Checkout - Basic: http://localhost:5208/hostedcheckout/basic.html
- Hosted Tokenization - Basic: http://localhost:5208/hostedtokenization/basic.html

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
./ngrok http --domain=nice-small-app.ngrok-free.app https://localhost:5208
```
