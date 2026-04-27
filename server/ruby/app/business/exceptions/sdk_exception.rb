module Business
  module Exceptions
    class SdkException < StandardError
      attr_reader :status_code, :cause_exception

      def initialize(message = nil, status_code = 400, cause = nil)
        super(message)
        @status_code = status_code
        @cause_exception = cause
      end
    end
  end
end
