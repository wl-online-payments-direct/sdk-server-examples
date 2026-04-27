require_relative "boot"

require "rails"
require "active_model/railtie"
require "active_job/railtie"
require "action_controller/railtie"
require "action_mailer/railtie"
require "action_view/railtie"
require "action_cable/engine"
require "rails/test_unit/railtie"

Bundler.require(*Rails.groups)

module ExampleAppApi
  class Application < Rails::Application
    config.load_defaults 7.2

    config.autoloader = :classic

    config.autoload_lib(ignore: %w[assets tasks])

    %w[app/configuration/**/*.rb app/infrastructure/**/*.rb app/business/**/*.rb app/presentation/**/*.rb].each do |pattern|
      Dir[Rails.root.join(pattern)].sort.each do |file|
        begin
          require file
        rescue => e
          puts "Error loading #{file}: #{e.message}"
          raise
        end
      end
    end

    config.middleware.use Presentation::Middleware::GlobalExceptionMiddleware

    config.api_only = true
  end
end