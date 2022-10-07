# How to

* docker-compose up -d
* docker-compose exec web bash
* composer install
* vendor/bin/phpcs --standard=Drupal,DrupalPractice web/update.php
* mysqladmin -h mysql -u root -p create drupal_site
* drush si standard --db-url=mysql://root:@mysql/drupal_site