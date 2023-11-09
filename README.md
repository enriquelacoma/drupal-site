# Installing drupal

* Create db drupal
* drush si standard --db-url=mysql://root:@mysql/drupal
* phpcs --standard=Drupal,DrupalPractice --extensions=php,module,inc,install,test,profile,theme,css,info,txt,md,yml [path]
* vendor/bin/phpstan analyse --memory-limit=1G [path]
* list test on core:
  * vendor/bin/phpunit web/core/ --list-groups
* run phpcs for your custom modules
  * vendor/bin/phpcs
* run phpstan for your custom modules
  * vendor/bin/phpstan
* run phpmd for your custom modules
  * vendor/bin/phpmd web/modules/custom/ text phpmd.xml
