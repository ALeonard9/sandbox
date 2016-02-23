default['apache']['docroot_dir'] = '/var/www/cgi-bin'
default['apache']['default_site_enabled'] = true

default['projectorion']['servername'] = 'aleonard.us'
default['projectorion']['OAuth_URL'] = "http://#{node['projectorion']['servername']}/users/signin.php"

default['projectorion']['jenkins']['plugins'] = %w( scm-api git git-client github-api github )

default['java']['jdk_version'] = '7'
