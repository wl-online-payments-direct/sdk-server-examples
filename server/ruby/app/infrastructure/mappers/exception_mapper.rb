module Infrastructure
  module Mappers
    module ExceptionMapper
      module_function

      def map(exception, custom_message = nil)
        Rails.logger.info "=== ExceptionMapper#map called ==="
        Rails.logger.info "Exception class: #{exception.class.name}"
        Rails.logger.info "Exception message: #{exception.message}"
        Rails.logger.info "Custom message: #{custom_message.inspect}"

        case exception.class.name
        when 'OnlinePayments::SDK::ValidationException'
          message = extract_validation_message(exception)
          Rails.logger.info "Mapped to ValidationException with message: #{message.inspect}"
          Business::Exceptions::SdkException.new(message, 400, exception)
        when 'OnlinePayments::SDK::AuthorizationException'
          Rails.logger.info "Mapped to AuthorizationException"
          Business::Exceptions::SdkException.new('Invalid merchant data.', 403, exception)
        when 'OnlinePayments::SDK::APIError',
          'OnlinePayments::SDK::DeclinedPaymentException',
          'OnlinePayments::SDK::ReferenceException'
          message = custom_message || extract_sdk_message(exception)
          status = extract_sdk_status(exception)
          Rails.logger.info "Mapped to SDK error with message: #{message.inspect}, status: #{status}"
          Business::Exceptions::SdkException.new(message, status, exception)
        else
          Rails.logger.info "Mapped to unexpected error"
          Business::Exceptions::SdkException.new('An unexpected error occurred.', 500, exception)
        end
      end

      def extract_sdk_message(exception)
        Rails.logger.info "=== extract_sdk_message called ==="

        errors = exception.respond_to?(:errors) ? Array(exception.errors) : []
        Rails.logger.info "Errors array: #{errors.inspect}"
        Rails.logger.info "Errors count: #{errors.count}"

        first = errors.first
        Rails.logger.info "First error: #{first.inspect}"

        if first
          Rails.logger.info "First error class: #{first.class.name}"
          Rails.logger.info "First error id: #{first.id.inspect}" if first.respond_to?(:id)
          Rails.logger.info "First error message: #{first.message.inspect}" if first.respond_to?(:message)
          Rails.logger.info "First error category: #{first.category.inspect}" if first.respond_to?(:category)
          Rails.logger.info "First error errorCode: #{first.error_code.inspect}" if first.respond_to?(:errorCode)
        end

        if first&.id.to_s.strip.present?
          result = first.id.to_s
          Rails.logger.info "Returning id: #{result.inspect}"
          return result
        end

        if first&.message.to_s.strip.present?
          result = first.message.to_s
          Rails.logger.info "Returning message: #{result.inspect}"
          return result
        end

        category_code = "#{first&.category} (#{first&.error_code})".strip
        if category_code.present? && category_code != "()"
          Rails.logger.info "Returning category_code: #{category_code.inspect}"
          return category_code
        end

        fallback = exception.message.to_s.presence || 'Error could not be retrieved.'
        Rails.logger.info "Returning fallback: #{fallback.inspect}"
        fallback
      rescue => e
        Rails.logger.error "Error in extract_sdk_message: #{e.message}"
        Rails.logger.error e.backtrace.join("\n")
        'Error could not be retrieved.'
      end

      def extract_sdk_status(exception)
        Rails.logger.info "=== extract_sdk_status called ==="

        errors = exception.respond_to?(:errors) ? Array(exception.errors) : []
        status = errors.first&.http_status_code.to_i

        Rails.logger.info "Extracted status: #{status}"

        result = status.positive? ? status : 422
        Rails.logger.info "Returning status: #{result}"
        result
      rescue => e
        Rails.logger.error "Error in extract_sdk_status: #{e.message}"
        422
      end

      def extract_validation_message(exception)
        Rails.logger.info "=== extract_validation_message called ==="

        errors = exception.respond_to?(:errors) ? Array(exception.errors) : []
        Rails.logger.info "Validation errors: #{errors.inspect}"

        errors.each_with_index do |err, index|
          Rails.logger.info "Error #{index}: #{err.inspect}"
          Rails.logger.info "Error #{index} id: #{err.id.inspect}" if err.respond_to?(:id)
          Rails.logger.info "Error #{index} message: #{err.message.inspect}" if err.respond_to?(:message)

          if err&.id.to_s.strip.present?
            result = err.id.to_s
            Rails.logger.info "Returning validation id: #{result.inspect}"
            return result
          end

          if err&.message.to_s.strip.present?
            result = err.message.to_s
            Rails.logger.info "Returning validation message: #{result.inspect}"
            return result
          end
        end

        fallback = exception.message.to_s.presence || 'Validation error occurred.'
        Rails.logger.info "Returning validation fallback: #{fallback.inspect}"
        fallback
      rescue => e
        Rails.logger.error "Error in extract_validation_message: #{e.message}"
        Rails.logger.error e.backtrace.join("\n")
        'Validation error occurred.'
      end
    end
  end
end