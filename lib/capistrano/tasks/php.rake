namespace :php do

  #manage composer task
  task :composer do
    on roles(:web) do
      within release_path do
        execute :composer, 'self-update'
        execute :composer, :install
      end
    end
  end

  # task :fpm_restart do
  #   on roles(:web) do
  #       sudo :service, 'php-5-fpm', :restart
  #     end
  # end

end
