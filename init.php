<?php

//use actual session logic and maybe a SessionManager class

use Couchbase\User;

$inSession = false;

$user = null;
$cart = null;

if($inSession){

}else{
    $user = new UserClass();
}