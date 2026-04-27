module Presentation
  module Concerns
    module Dependencies
      extend ActiveSupport::Concern

      class_methods do
        def inject(name, key: name)
          define_method(name) do
            @__dependencies ||= {}
            @__dependencies.fetch(name) do
              @__dependencies[name] = ::Configuration::DiConfiguration::DiConfiguration.fetch(key)
            end
          end
          private name
        end
      end
    end
  end
end
