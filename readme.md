- Copy database.php from any Codeigniter Project into 

    application/config/database.php

- Run migration by visiting base_url/Migrate in browser.

- Check your Database to see if update successfully installed.
	
- Keep composer installed on your system, execute following command,

for first time: 

    composer install
    
afterwards: 

    composer update

whenever you add new Eloquent, execute following command

    composer dump-autoload

To setup this project, you need to create subdomains for the different guards.

define your used subdomains in

    application/config/config.php
    
assign values of your subdomains to variables

    $api_subdomain & $admin_subdomain
    
Keep your frontend on your main domain.

URL for API collection is here:
	https://www.getpostman.com/collections/bf082c12726457c1268d
Wishlist API is latest in the collection.