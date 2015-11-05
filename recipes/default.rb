#
# Cookbook Name:: projectorion
# Recipe:: default
#
# Copyright (C) 2014 Adam Leonard
#
# All rights reserved - Do Not Redistribute
#

include_recipe 'apache2'
include_recipe 'apache2::mod_php5'
include_recipe 'projectorion::reload_override'

# Encrypted data bag option
mysql_secret = Chef::EncryptedDataBagItem.load_secret(node['projectorion']['mysql']['secretpath'])
item_data = Chef::EncryptedDataBagItem.load('projectorion-bag', 'projectorion', mysql_secret)

template '/var/www/cgi-bin/connectToDB.php' do
  source 'connectToDB.php.erb'
  mode '0644'
  variables(connect: item_data['connection_string'],
            user: item_data['user'],
            userid: item_data['userid']
           )
end

remote_directory '/var/www/cgi-bin' do
  source 'app'
end

bash 'install_mysql' do
  user 'root'
  code <<-EOH
  yum install php-mysql php php-xml php-mcrypt php-mbstring php-cli mysql httpd -y
  EOH
end

service 'apache2' do
  action :restart
end

apache_site 'default' do
  enable true
end

cron 'node_eraser' do
  hour '4'
  minute '45'
  command 'knife node delete projectorion-wsas -y -c /etc/chef/client.rb'
end

cron 'client_eraser' do
  hour '4'
  minute '45'
  command 'knife client delete projectorion-wsas -y -c /etc/chef/client.rb'
end
