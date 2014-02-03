project_name = "coin-test"
project_dir = File.dirname(__FILE__)


task :default => ["host:init"]

desc "Configures an application host"
namespace :host do

    host_template = "nginx-vhost.template"

    nginx_root = "/etc/nginx"

    desc "Initialise the host"
    task :init => ["host:update_etc", "host:activate_vhost"]

    desc "Create nginx virtual host"
    task :create_vhost do |t, args|
        puts "! ---- Creating nginx vhost"

        vhost = "#{nginx_root}/sites-available/#{project_name}"

        vhost_template  = "#{project_dir}/#{host_template}"

        fail "!! cannot create vhost" if not system "sudo touch #{vhost}"

        fail "!! cannot update vhost - #{vhost}" if not system "sed 's|APP_PATH|#{project_dir}|g;s|APP_NAME|#{project_name}|g' #{vhost_template} | sudo tee #{vhost} > /dev/null"

        fail "!! cannot reload nginx" if not system "sudo service nginx reload"

        puts "Updated vhost  - #{vhost}"
    end

    desc "Activate nginx virtual host"
    task :activate_vhost => :create_vhost do |t, args|
        puts "! ---- Activating nginx vhost"
        vhost_inactive = "#{nginx_root}/sites-available/#{project_name}"

        vhost_active = "#{nginx_root}/sites-enabled/#{project_name}"
        ##need to come back to this
        system "sudo ln -s  #{vhost_inactive} #{vhost_active}"

    end


    desc "Update the /etc/hosts file"
    task :update_etc do |t, args|
        puts "! ---- Updating /etc/hosts file";

        localhost = "#{project_name}.local"

        found = system "cat /etc/hosts | grep \"#{localhost}\""
        if found
            puts "/etc/hosts already contains entry"
        else
            fail "!! couldnt update /etc/hosts" if not system "echo \"\n127.0.0.1\t#{localhost}\" | sudo tee -a /etc/hosts"
        end
    end
end
