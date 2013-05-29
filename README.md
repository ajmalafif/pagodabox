## pre-configured PagodaBox with Roots Theme for WordPress 3.5.1 setup

### First step

Added `.htaccess` into `pagoda` folder and edited `Boxfile` to include as such

```Boxfile
web1:
  name: wp-web
  shared_writable_dirs:
    - wp-content/uploads/
  after_build:
    - "mv pagoda/wp-config.php wp-config.php"
    - "mv pagoda/.htaccess .htaccess"
    - "rm -R pagoda"
db1:
  name: wp-db
  ``` 