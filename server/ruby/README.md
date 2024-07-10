# Online payments Ruby SDK Example

This example app illustrates the use of the Online Payments Ruby SDK and the services provided by the Online Payments platform.

## Prerequisites

- [Ruby](https://www.ruby-lang.org/en/downloads/)
- [RubyGems](https://rubygems.org/pages/download)
- [Bundler](https://bundler.io/)
- [Rails](https://rubyonrails.org/)
- [Git](https://git-scm.com/)

## Getting started

To get started with this example application, clone or download the source from Git.

<b>IMPORTANT:</b> Before installing and running the application some basic configuration has to be set.
Set your configuration details in the [config/environments/development.rb](config/environments/development.rb)

```
# Direct SDK Configuration
config.merchantId = "<your-merchant-id>"
config.apiKey = "<your-api-key>"
config.apiSecret = "<your-api-secret>"
config.host = "payment.preprod.direct.worldline-solutions.com"
config.integrator = "<your-company-name>"


# Hosted checkout configuration :: testing purposes
config.hostedCheckout.redirectUrl = "<your-hosted-checkout-redirect-url>"
```

Build and run the application 

```
rails server
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