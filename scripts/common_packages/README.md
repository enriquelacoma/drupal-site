# How to install
1. Go to the scripts/common_packages folder
2. Run composer install

# How to use
1. In the modules.yml file, configure your project root path in root_path
2. In the modules.yml file, configure the packages to install
3. Go to you project root and run:

`
   ./scripts/common_packages/bin/console install-modules scripts/common_packages/modules.yml
`
To install

`
composer config --no-plugins allow-plugins.cweagans/composer-patches true
`
