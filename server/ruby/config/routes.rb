Rails.application.routes.draw do
  get "up" => "rails/health#show", as: :rails_health_check


  post '/sessions', to: 'presentation/controllers/hosted_checkout#create_hosted_checkout_sessions'
  get '/sessions/:id', to: 'presentation/controllers/hosted_checkout#get_payment_by_hosted_checkout_id'

  get '/payments/:id', to: 'presentation/controllers/payment#get_payment_details'
  post '/payments/:id/cancels', to: 'presentation/controllers/payment#cancel_payment'
  post '/payments/:id/refunds', to: 'presentation/controllers/payment#refund_payment'
  post '/payments/:id/captures', to: 'presentation/controllers/payment#capture_payment'
  post '/payments', to: 'presentation/controllers/payment#create_payment'

  get '/tokens', to: 'presentation/controllers/hosted_tokenization#get_hosted_tokenization'

  post '/links', to: 'presentation/controllers/payment_link#create_payment_link'
end
