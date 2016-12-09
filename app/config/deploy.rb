set :application, "ip-symfony-skeleton"
set :domain,      "ssh.netzone.ch"
set :deploy_to,   "/htdocs/ip-symfony-skeleton-update.interpunkt-test.ch"
set :app_path,    "app"

set :repository,  "git@github.com:interpunkt/ip-symfony-skeleton.git"
set :scm,         :git

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

# does not work on netzone servers
# set  :keep_releases,  3
# after "deploy:update", "deploy:cleanup"

# Strategy
set :deploy_via, :capifony_copy_local

# COMPOSER Settings Capifony
set :composer_options, "--no-dev --verbose --optimize-autoloader"
set :use_composer, true
set :update_vendors, true

# set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   [app_path + "/sessions"]

# ASSETS
set :dump_assetic_assets, false

set :use_sudo,      false
set :user, "interpunkt-test.ch0"

set :writable_dirs,       ["app/cache", "app/logs", "app/sessions"]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, false
set :use_sudo,            false

logger.level = Logger::MAX_LEVEL

ssh_options[:forward_agent] = true

set :copy_remote_dir, deploy_to
set :deploy_via, :copy

namespace :deploy do
  task :create_symlink, :except => { :no_release => true } do
    deploy_to_pathname = Pathname.new(deploy_to)

  if previous_release
      previous_release_pathname = Pathname.new(previous_release)
      relative_previous_release = previous_release_pathname.relative_path_from(deploy_to_pathname)
  end

    on_rollback do
      if previous_release
        run "rm -f #{current_path}; ln -s #{relative_previous_release} #{current_path}; true"
      else
        logger.important "no previous release to rollback to, rollback of symlink skipped"
      end
    end

    latest_release_pathname = Pathname.new(latest_release)
    relative_latest_release = latest_release_pathname.relative_path_from(deploy_to_pathname)
    run "rm -f #{current_path} && ln -s #{relative_latest_release} #{current_path}"

    # copy frontend assets and uploads from previous releases
    if previous_release
      run "cp -r #{deploy_to}/#{relative_previous_release}/web/assets/vendor #{current_path}/web/assets/"
            if ! Dir['#{deploy_to}/#{relative_previous_release}/web/uploads/media/*'].empty?
              run "cp -r #{deploy_to}/#{relative_previous_release}/web/uploads/documents/* #{current_path}/web/uploads/documents/"
            end
            if ! Dir['#{deploy_to}/#{relative_previous_release}/web/uploads/media/*'].empty?
              run "cp -r #{deploy_to}/#{relative_previous_release}/web/uploads/images/* #{current_path}/web/uploads/images/"
            end
            if ! Dir['#{deploy_to}/#{relative_previous_release}/web/uploads/media/*'].empty?
              run "cp -r #{deploy_to}/#{relative_previous_release}/web/uploads/media/* #{current_path}/web/uploads/media/"
            end
    else
      logger.important "No previous release, /web/assets has to be copied manually to the server"
    end

    # delete cache, to avoid error when loading for the first time
    run "rm -rf #{current_path}/app/cache/prod/"
  end
end

