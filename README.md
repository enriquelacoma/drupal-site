# How to install
1. Run: docker-compose up -d
2. Run: docker-compose exec web bash
3. Run: drush si standard --db-url=mysql://root:@mysql/drupal
Access the site with the url: http://localhost:8080/

# How to run code analysis tools
First run "docker-compose exec web bash" to enter the web container

* list test on core:
  * vendor/bin/phpunit web/core/ --list-groups
* run phpcs for your custom modules
  * vendor/bin/phpcs
* run phpstan for your custom modules
  * vendor/bin/phpstan
* run phpmd for your custom modules
  * vendor/bin/phpmd web/modules/custom/ text phpmd.xml
