<?php
namespace Sized140;

include __DIR__ . '/../Sized140.php';

$userMapping = [
// property | assertion types
    'name'  => ['string', '/^[\S]{3,}$/'],
    'email' => ['email']
];

class User
{
    public $name;
    public $email;
}

$alice =  new User();
$alice->name = 'Alice';
$alice->email = 'alice@email.com';

$is = new Is();
$is->r = [
    'string' => '/^[\S]+$/',
    'email' => '/^\S+@\S+\.\S+$/'
];

$errors = $is->ok($alice, $userMapping);

if (count($errors)==0){
    echo "\ntests pass Yes\n";
    exit(0);
}

var_dump($errors);
echo "\ntests Fail\n";
exit(1);
