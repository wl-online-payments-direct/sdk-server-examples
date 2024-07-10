# config/initializers/content_security_policy.rb
#
## SecureHeaders::Configuration.default do |config|
#   config.csp = {
#     default_src: %w('self'),
#     script_src: %w('self' 'unsafe-inline'
#       https://payment.preprod.direct.worldline-solutions.com/
#       https://code.jquery.com https://cdnjs.cloudflare.com
#       'sha256-+o0MJW9UhlZXZnX4K8gGgXv0H4O99fl5O9w+MLxn5Dc='
#     ),
#     style_src: %w('self' 'sha256-QFHtYYZN5CH9boyJ+3sfBv0SAC6BSG/SaRLIrL0EHkw='),
#     connect_src: %w('self' https://payment.preprod.direct.worldline-solutions.com/),
#     frame_src: %w('self'
#       https://payment.preprod.direct.worldline-solutions.com/
#     ),
#   }
# end

###################################################################
### NOTE: This is not a production ready CSP configuration!
###################################################################
Rails.application.config.content_security_policy do |policy|
  # Define allowed sources for each directive
  policy.default_src :self, :https
  policy.script_src  :self, :https, "https://payment.preprod.direct.worldline-solutions.com"
  policy.style_src   :self, :https, "https://payment.preprod.direct.worldline-solutions.com"
  policy.img_src     :self, :https, :data
  policy.font_src    :self, :https, :data
  policy.object_src  :none
  policy.media_src   :self, :https
  policy.frame_src   :self, :https, "https://payment.preprod.direct.worldline-solutions.com"
  policy.frame_ancestors :self, "*"
  policy.connect_src :self, :https, "https://payment.preprod.direct.worldline-solutions.com"

  # Uncomment to enable nonce generation for inline scripts and styles
  # policy.script_src :self, :https, :unsafe_inline, :nonce => true
  # policy.style_src  :self, :https, :unsafe_inline, :nonce => true

  # Uncomment if you have a reporting endpoint
  # policy.report_uri "/csp-violation-report-endpoint"
end

# Report CSP violations to a specified URI. Only for testing and debugging purposes.
Rails.application.config.content_security_policy_report_only = true
