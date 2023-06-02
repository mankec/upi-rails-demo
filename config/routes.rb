Rails.application.routes.draw do
  post 'create_payment', to: 'main#create_payment'

  root "main#index"
end
