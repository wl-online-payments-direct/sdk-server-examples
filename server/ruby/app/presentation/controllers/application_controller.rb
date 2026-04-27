module Presentation
  module Controllers
    class ApplicationController < ActionController::API
      include Presentation::Concerns::Dependencies
    end
  end
end