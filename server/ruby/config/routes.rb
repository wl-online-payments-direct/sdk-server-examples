Rails.application.routes.draw do
  # For details on the DSL available within this file, see https://guides.rubyonrails.org/routing.html

  get 'api/getcreditscore', to: 'application#creditscore'

  get 'api/createpayment', to: 'create_payment#initialize_payment'
  post 'api/createpayment/basic', to: 'create_payment#create_payment'
  get 'api/createpayment/outcome', to: 'create_payment#outcome'

  get 'api/hostedcheckout', to: 'hosted_checkout#initialize_hosted_checkout'
  post 'api/hostedcheckout/basic', to: 'hosted_checkout#create_hosted_checkout'
  get 'api/hostedcheckout/outcome', to: 'hosted_checkout#outcome'

  get 'api/hostedtokenization', to: 'hosted_tokenization#initialize_hosted_tokenization'
  post 'api/hostedtokenization/basic', to: 'hosted_tokenization#create_hosted_tokenization'
  get 'api/hostedtokenization/outcome', to: 'hosted_tokenization#outcome'

end
