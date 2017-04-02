# config valid only for current version of Capistrano
lock '3.5.0'

set :application, 'menahouse'
#set :repo_url, 'git@github.com:couldedhusso/menahouse.git'
set :repo_url, 'https://github.com/couldedhusso/menahouse.ru.git'
set :default_stage, 'production'
set :user, 'ec2-user'


set :branch, 'master'
# Default branch is :dev
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Which roles to consider as laravel roles

# Default deploy_to directory is /var/www/my_app_name
set :deploy_to, '/home/ec2-user/menahouse'
#set :deploy_to, '/home/ubuntu/menahouse'

# role :web, '35.161.27.29' # Your HTTP server, Apache/etc
# role :app, '35.161.27.29' # This may be the same as your `Web` server

role :web, '35.161.27.29' # Your HTTP server, Apache/etc
role :app, '35.161.27.29' # This may be the same as your `Web` server

# role :web, '35.161.27.29' # Your HTTP server, Apache/etc
# role :app, '35.161.27.29' # This may be the same as your `Web` server

set :ssh_options, { :forward_agent => true }
#ssh_options[:forward_agent] = true

# Default value for :scm is :git
# set :scm, :git

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: 'log/capistrano.log', color: :auto, truncate: :auto

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
set :linked_files, fetch(:linked_files, []).push('.env')

# Default value for linked_dirs is []
set :linked_dirs, fetch(:linked_dirs, []).push('storage/framework/sessions')

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
set :keep_releases, 2

namespace :deploy do

  # after :clear_cache do
  #   on roles(:web)  do
  #     # Here we can do anything such as:
  #     within release_path do
  #       execute :rake, 'cache:clear'
  #     end
  #   end
  #
  # end

  after :updated,  :menahouse do
    # on roles(:web)  do
    #   within release_path do
    #     execute :composer, :install
    #   end
    # end
    invoke "laravel:migrate"
    invoke "laravel:optimize"
    invoke "laravel:permissions"
  end


  # after :finished do
  #   invoke "php:fpm_restart"
  # end

end
