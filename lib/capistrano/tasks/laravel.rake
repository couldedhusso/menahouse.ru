namespace :laravel do

  # desc "Build"
  #   after :updated, :build do
  #       on roles(:app) do
  #           within release_path  do
  #               execute :composer, "install --no-dev --quiet" # install dependencies
  #               execute :chmod, "u+x artisan" # make artisan executable
  #           end
  #       end
  #   end

  # manage migration task for laravel framework
  task :migrate do
    on roles(:web) do
      within release_path do
        # execute :composer, :install
         execute :composer, "install --no-dev --quiet" # install dependencies
         execute :chmod, "u+x artisan" # make artisan executable
         execute :php, "artisan migrate --force" # run migrations
        # execute :php, :artisan, :migrate, :force
      end
    end
  end

  #task for optimization
  task :optimize do
    on roles(:web) do
      within release_path do
        execute :php, :artisan, :optimize
      end
    end
  end

  #manage permissions task  on folder
  task :permissions do
    on roles(:web) do
      within release_path do
        execute :chmod, '777', '-R', 'bootstrap/cache'
        execute :chmod, '777', '-R', 'storage'
        
      end
    end
  end

end
