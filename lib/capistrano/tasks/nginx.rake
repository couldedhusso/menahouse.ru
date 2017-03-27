namespace :nginx do
  desc 'nginx configuration file'
  task :conf do
      on roles(:web) do
        erb = File.read "lib/capistrano/template/nginx_conf.erb"
        set :server_name, ask('votre nom de domaine ?', 'menahouse.ru')
        set :config_name, ask(' fichier de configuration  ?', 'menahouse')
        file_name = "/tmp/nginx_#{fetch(:config_name)}"
        upload! StringIO.new(ERB.new(erb).result(binding)), file_name
        sudo :mv, file_name, "/etc/nginx/sites-available/#{fetch(:config_name)}"
        sudo :ln, '-fs', "/etc/nginx/sites-available/#{fetch(:config_name)}",
                         "/etc/nginx/sites-enabled/#{fetch(:config_name)}"
        sudo :service, :nginx, :restart
      end
  end
end
