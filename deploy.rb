# deploy.rb
set :symfony_directory_structure, 2
set :sensio_distribution_version, 4

set :permission_method, :acl
set :file_permissions_users, ["nginx"]
set :file_permissions_paths, ["app/cache", "app/logs", "app/sessions"]

# Give our application a name
set :application, 'app'

# The repository path, must be accessible from the remote server
set :repo_url, 'ssh://domain.tld/repositories/project.git'

# The path where to deploy things
set :deploy_to, '/htdocs/toggenburger-update.interpunkt-test.ch'

# The default tasks shipped by the install task
namespace :deploy do
  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :touch, release_path.join('tmp/restart.txt')
    end
  end
  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
    end
  end
  after :finishing, 'deploy:cleanup'
end