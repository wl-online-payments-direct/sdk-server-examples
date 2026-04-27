module Business
  module Exceptions
    class ValidationErrorResponse < StandardError
      attr_reader :errors

      def initialize(message, errors = [message])
        super(message)
        @errors = errors
      end

      def to_hash
        { message: message }
      end

      def to_json(*args)
        to_hash.to_json(*args)
      end
    end
  end
end