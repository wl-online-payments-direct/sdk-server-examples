class ApplicationController < ActionController::API

  def creditscore
    render json: {
      creditscore: rand(500..900),
      merchantId: Rails.configuration.merchantId
    }
  end

end
