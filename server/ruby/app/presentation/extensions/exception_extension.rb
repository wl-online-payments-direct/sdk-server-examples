require 'ostruct'

module Presentation
  module Extensions
    module ExceptionExtension
      module_function

      def compose_error_message(api_error)
        return 'Internal platform error.' if api_error.nil?

        if api_error.respond_to?(:id) && !blank?(api_error.id)
          return api_error.id.to_s
        end

        if api_error.respond_to?(:message) && !blank?(api_error.message)
          return api_error.message.to_s
        end

        category = api_error.respond_to?(:category) ? api_error.category : nil
        code = if api_error.respond_to?(:error_code)
                 api_error.error_code
               else
                 api_error.respond_to?(:errorCode) ? api_error.errorCode : nil
               end
        property = api_error.respond_to?(:property_name) ? api_error.property_name : nil

        if property && category
          "Invalid value for #{property}: #{category} (#{code || 'UNKNOWN'})"
        elsif category
          "#{category} (#{code || 'UNKNOWN'})"
        else
          "UNKNOWN (#{code || 'UNKNOWN'})"
        end
      end

      def extract_first_api_error(ex)
        if exception_is_a?(ex, 'OnlinePayments::SDK::ValidationException')
          parsed_error = extract_from_validation_exception(ex)
          return parsed_error if parsed_error
        end

        begin
          if ex.respond_to?(:response)
            response = ex.response
            if response && response.respond_to?(:errors)
              errors = response.errors
              if errors.is_a?(Array) && !errors.empty?
                return errors[0]
              end
            end
          end
        rescue => _
        end

        begin
          if ex.respond_to?(:errors)
            errors = ex.errors
            if errors.is_a?(Array) && !errors.empty?
              return errors[0]
            end
          end
        rescue => _
        end

        nil
      end

      def extract_from_validation_exception(ex)
        message = ex.message.to_s

        if message =~ /response_body='(.+)'/
          json_body = $1
          begin
            parsed = JSON.parse(json_body)
            if parsed['errors'].is_a?(Array) && parsed['errors'].any?
              first_error = parsed['errors'].first
              return OpenStruct.new(
                message: first_error['message'],
                error_code: first_error['errorCode'],
                category: first_error['category'],
                property_name: first_error['propertyName'],
                http_status_code: first_error['httpStatusCode']
              )
            end
          rescue JSON::ParserError => _
          end
        end

        nil
      rescue => _
        nil
      end

      def extract_message_from_reference_exception(ex)
        begin
          if ex.respond_to?(:response)
            response = ex.response
            if response && response.respond_to?(:errors)
              errors = response.errors
              first = errors[0] if errors.is_a?(Array) && !errors.empty?
              if first
                if first.respond_to?(:message) && !blank?(first.message)
                  return first.message.to_s
                end
                if first.respond_to?(:id) && !blank?(first.id)
                  return first.id.to_s
                end
              end
            end
          end
        rescue => _
        end

        ex.respond_to?(:message) ? ex.message.to_s : nil
      end

      def blank?(v)
        v.nil? || (v.respond_to?(:empty?) && v.empty?)
      end

      def exception_is_a?(ex, class_name_string)
        ex.class.name == class_name_string || ex.class.ancestors.map(&:name).include?(class_name_string)
      rescue
        false
      end
    end
  end
end