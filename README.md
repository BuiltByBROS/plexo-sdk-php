# plexo-sdk-php


```php
<?php

require_once 'vendor/autoload.php';

use Plexo\Sdk as plexo;

$client = new plexo\Client('Nombre Cliente');

var_dump($client->GetServerPublicKey('AEA4D5C586983A140F8B566EA81901E8BD8F8C9F'));

```