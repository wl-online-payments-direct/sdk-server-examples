class StaticFiles
  def initialize(app, static_dir)
    @app = app
    @static_dir = static_dir
  end

  def call(env)
    path = env['PATH_INFO']
    if path.nil? || path.empty? || path == '/'
      path = 'index.html'
    end

    full_path = File.join(@static_dir, path)

    if File.exist?(full_path) && !File.directory?(full_path)
      return [200, { 'Content-Type' => Rack::Mime.mime_type(File.extname(full_path)) }, [File.read(full_path)]]
    else
      return @app.call(env)
    end
  end
end
