allowed_origins = ENV.fetch("ALLOWED_ORIGIN", "http://localhost:3000").split(',')

Rails.application.config.middleware.insert_before 0, Rack::Cors do
  allow do
    origins(*allowed_origins)

    resource "*",
             headers: %w[Content-Type Authorization X-Requested-With],
             methods: %i[get post put patch delete options head],
             credentials: true,
             expose: ["Authorization"]
  end
end