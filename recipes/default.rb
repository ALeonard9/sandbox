#
# Cookbook Name:: projectorion
# Recipe:: default
#
# Copyright (C) 2014 Adam Leonard
#
# All rights reserved - Do Not Redistribute
#

include_recipe 'selinux::disabled'

execute 'update yum' do
  command 'yum update -y'
  notifies :run, 'execute[add rpm]', :immediately
  not_if { ::File.exist?('/etc/yum.repos.d/webtatic.repo') }
end

execute 'add rpm' do
  command 'rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm'
  action :nothing
  notifies :run, 'execute[add rpm2]', :immediately
  not_if { ::File.exist?('/etc/yum.repos.d/webtatic.repo') }
end

execute 'add rpm2' do
  command 'rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm'
  action :nothing
  not_if { ::File.exist?('/etc/yum.repos.d/webtatic.repo') }
end

packages = ['php55w', 'php55w-mysql', 'php55w-pdo', 'php55w-mcrypt', 'mariadb', 'unzip']
# packages = ['php-mysql', 'php', 'unzip', 'mariadb']

packages.each do |pkg|
  package pkg
end

include_recipe 'apache2::default'
include_recipe 'apache2::mod_php'
include_recipe 'projectorion::reload_override'

file '/etc/httpd/conf-enabled/orion.conf' do
  content 'LimitRequestLine 10000'
  mode '0755'
  owner 'root'
  group 'root'
end

# if File.readlines('/etc/httpd/sites-available/default.conf').grep(/RewriteEngine/).size == 0
ruby_block 'insert_line' do
  block do
    file = Chef::Util::FileEdit.new('/etc/httpd/sites-available/default.conf')
    file.search_file_delete_line("<\/VirtualHost>")
    file.insert_line_if_no_match('RewriteEngine', 'RewriteEngine On')
    file.insert_line_if_no_match('RewriteCond', 'RewriteCond %{HTTP:X-Forwarded-Proto} =http')
    file.insert_line_if_no_match('RewriteRule', 'RewriteRule . https://%{HTTP:Host}%{REQUEST_URI} [L,R=permanent]')
    file.insert_line_if_no_match('</VirtualHost>', '</VirtualHost>')
    file.write_file
  end
end
# end

item_data = data_bag_item('projectorion-bag', 'projectorion')

node.default['projectorion']['tmdb_api_key'] = item_data['tmdb_api_key']
node.default['projectorion']['igdb_api_key'] = item_data['igdb_api_key']

template '/var/www/cgi-bin/connectToDB.php' do
  source 'connectToDB.php.erb'
  mode '0644'
  variables(connect: item_data['connection_string'],
            user: item_data['user'],
            userid: item_data['userid']
           )
end

remote_file "#{Chef::Config[:file_cache_path]}/projectorion-src.zip" do
  source 'https://s3.amazonaws.com/leoninestudios/projectorion/projectorion-src.zip'
  mode '0755'
  action :create
end

execute 'unzip_source' do
  command "unzip -o -u #{Chef::Config[:file_cache_path]}/projectorion-src.zip -d /var/www/"
end

execute 'download composer' do
  command 'curl -s https://getcomposer.org/installer | php && /bin/php /var/www/cgi-bin/composer/composer.phar install'
  cwd '/var/www/cgi-bin/composer/'
  not_if { ::File.directory?('/var/www/cgi-bin/composer/vendor') }
end

template '/var/www/cgi-bin/users/signin.php' do
  source 'signin.php.erb'
  mode '0644'
  variables(google_client: item_data['google_client'],
            google_secret: item_data['google_secret']
           )
end

template '/var/www/cgi-bin/movies/updateimg.php' do
  source 'updateimg.php.erb'
  mode '0644'
end

template '/var/www/cgi-bin/movies/addmovie.php' do
  source 'addmovie.php.erb'
  mode '0644'
end

service 'apache2' do
  action [:enable, :start]
end

# cron 'updatetv' do
#   hour '4'
#   minute '45'
#   command 'cd /var/www/cgi-bin/tv && /bin/php /var/www/cgi-bin/tv/updatetv.php'
# end

cron 'updateeps' do
  hour '5'
  minute '45'
  command 'cd /var/www/cgi-bin/tv && /bin/php /var/www/cgi-bin/tv/updateepisodes.php'
end

# Removed due to move to Google Cloud
# cron 'node_eraser' do
#   hour '4'
#   minute '45'
#   command 'knife node delete projectorion-wsas -y -c /etc/chef/client.rb'
# end
#
# cron 'client_eraser' do
#   hour '4'
#   minute '45'
#   command 'knife client delete projectorion-wsas -y -c /etc/chef/client.rb'
# end
