# How to

* docker-compose up -d
* docker-compose exec web bash
  * composer install
  * mysqladmin -h mysql -u root -p create drupal_site
  * drush si standard --db-url=mysql://root:@mysql/drupal_site
* http://localhost:8080
* docker-compose exec web vendor/bin/phpcs --standard=Drupal,DrupalPractice [path to review]
