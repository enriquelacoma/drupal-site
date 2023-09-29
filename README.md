# Installing drupal

* Create db drupal
* drush si standard --db-url=mysql://root:@mysql/drupal
* phpcs --standard=Drupal,DrupalPractice --extensions=php,module,inc,install,test,profile,theme,css,info,txt,md,yml [path]
* vendor/bin/phpstan analyse --memory-limit=1G [path]
