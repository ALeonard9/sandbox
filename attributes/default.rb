default['apache']['docroot_dir'] = '/var/www/cgi-bin'
default['apache']['default_site_enabled'] = true
default['projectorion']['mysql']['secretpath'] = '/etc/chef/encrypted_data_bag_secret'

# Encrypted data bag option
# if node.chef_environment == '_default'
#   item_data = Chef::DataBagItem.load('projectorion-bag', 'projectorion')
# else
#   mysql_secret = Chef::EncryptedDataBagItem.load_secret(node['projectorion']['mysql']['secretpath'])
#   item_data = Chef::EncryptedDataBagItem.load('projectorion-bag', 'projectorion', mysql_secret)
# end
