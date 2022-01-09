<?php

$db = new DB("localhost", "user", "pass","database");

TokenService::setAuthParams("testSecretAuthKey", "HS512");

?>
