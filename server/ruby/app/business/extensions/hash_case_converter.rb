module Business
  module Extensions
    module HashCaseConverter
      module_function

      def to_snake_case(obj)
        case obj
        when Array
          obj.map { |v| to_snake_case(v) }
        when Hash
          obj.each_with_object({}) do |(k, v), result|
            key = k.to_s.underscore.to_sym
            result[key] = to_snake_case(v)
          end
        else
          obj
        end
      end

      def to_camel_case(obj)
        case obj
        when Array
          obj.map { |v| to_camel_case(v) }
        when Hash
          obj.each_with_object({}) do |(k, v), result|
            key = k.to_s.camelize(:lower)
            result[key] = to_camel_case(v)
          end
        else
          obj
        end
      end
    end
  end
end