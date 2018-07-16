Pravaler Validator Component
============================

Create a component using Synfony validations in the style of Laravel

Supported Symfony Versions
==========================

4.x Symfony

Installation
============

Download the package

```bash
$ composer require pravaler/validator
```

Using
=====

Example:

```php
<?php

namespace App\Controller;

use Pravaler\Component\Validator\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function savePost(Request $request)
    {
        $data = $request->request->all();
        
        $validator = new Validator([
            'name' => 'required',
            'author' => 'required',
            'email' => 'required|email',
            'description' => 'required|size:1:500'
        ]);
        $validator->validate($data);
        if (!$validator->isValid()) {
            return $this->render("post/index.html.twig", [
                'errors' => $validator->getViolations()
            ]);
        }
        
        return $this->render("post/index.html.twig", [
            'message' => 'The post is valid!'
        ]);
    }
}

```

Possible Validations
====================

* [Cpf](#cpf)
* [Email](#email)
* [Max](#max)
* [Min](#min)
* [Numeric](#numeric)
* [PasswordConfirm](#password-confirm)
* [Required](#required)
* [Size](#size)

## Cpf
```php
$validator = new Validator([
    'field' => 'cpf',
]);
```

## Email
```php
$validator = new Validator([
    'field' => 'email',
]);
```

## Max
```php
$validator = new Validator([
    'field' => 'max:10',
]);
```

## Min
```php
$validator = new Validator([
    'field' => 'min:5',
]);
```

## Numeric
```php
$validator = new Validator([
    'field' => 'numeric',
]);
```

## Password Confirm
```php
// In order for the password confirm to take effect it is necessary to have in the data the password field

$validator = new Validator([
    'field' => 'password_confirm',
]);
```

## Required
```php
$validator = new Validator([
    'field' => 'required',
]);
```

## Size
```php
$validator = new Validator([
    'field' => 'size:1:500',
]);
```

License
=======

This project is licensed under the MIT license. For more information, see the
[license](LICENSE) file included in this bundle.

Based
=====
Created based on [symfony/validator](https://github.com/symfony/validator)