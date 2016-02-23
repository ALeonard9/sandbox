#
# Cookbook Name:: projectorion
# Recipe:: jenkins
#

include_recipe 'java'
include_recipe 'jenkins::master'
include_recipe 'git'

jenkins_command 'safe-restart' do
  action :nothing
end

node['projectorion']['jenkins']['plugins'].each do |p|
  jenkins_plugin p do
    action :install
    notifies :execute, 'jenkins_command[safe-restart]', :delayed
  end
end
