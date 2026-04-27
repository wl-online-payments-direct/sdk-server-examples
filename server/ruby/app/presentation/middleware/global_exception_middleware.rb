require 'json'

module Presentation
  module Middleware
    class GlobalExceptionMiddleware
      def initialize(app, logger = Rails.logger)
        @app = app
        @logger = logger
      end

      def call(env)
        @app.call(env)
      rescue => ex
        log_exception(ex)
        status, error_response = map_exception_to_response(ex)

        body = error_response.to_json
        headers = { 'Content-Type' => 'application/problem+json' }

        [status, headers, [body]]
      end

      private

      def map_exception_to_response(ex)
        case ex
        when Business::Exceptions::ValidationErrorResponse
          [400, { message: ex.message.to_s }]
        when Business::Exceptions::SdkException
          [ex.status_code || 400, { message: ex.message.to_s }]
        when ArgumentError
          [400, { message: ex.message.to_s }]
        else
          [500, { message: 'Internal Server Error.' }]
        end
      end

      private

      def extract_sdk_error_message(ex)
        if ex.respond_to?(:errors) && ex.errors.any?
          first_error = ex.errors.first
          first_error.message.presence ||
            first_error.id.presence ||
            first_error.to_s
        elsif ex.respond_to?(:api_message)
          ex.api_message.to_s
        else
          ex.message.to_s
        end
      rescue
        "An unexpected error occurred."
      end

      def log_exception(ex)
        @logger.error("Exception occurred while processing request: #{ex.class} - #{ex.message}")
        @logger.error(ex.backtrace.join("\n")) if ex.backtrace
      end
    end
  end
end