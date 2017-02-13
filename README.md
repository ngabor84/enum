#Enum

[ ![Codeship Status for ngabor84/enum](https://app.codeship.com/projects/d2ec3cf0-d18e-0134-3203-761d9909bfc2/status?branch=master)](https://app.codeship.com/projects/201541)

## About
Enum is a simple implementation of php's missing enumeration type.

## Requirements
- PHP 7.0 or above

## Installation
Install Enum via the composer package manager from packagist [ngabor84/enum](https://packagist.org/packages/ngabor84/enum).

## Usage
```php
// Define a new Enum type
class Status extends Enum {

    const ACTIVE = 'active';
    
    const PASSIVE = 'pasive';
    
}

// Use the new Status Enum type
$carStatus = new Status(Status::ACTIVE);
$carStatus->getValue(); // return 'active';

$carStatus2 = new Status();
$carStatus2->setValue(Status::PASSIVE);

if ($carStatus2->isEqualTo($carStatus)) { // it will be false
    echo "\$carStatus2 and \$carStatus has the same value";
} else { // this will be printed
    echo "\$carStatus2 and \$carStatus has different value"; 
    echo "\$carStatus2: $carStatus2"; // print '$carStatus2: passive'
}

Status::isValidValue('active'); // return true
Status::isValidKey('INACTIVE'); // return false
Status::getKeyByValue('passive'); // return 'PASSIVE'
Status::listOptions(); // return ['ACTIVE' => 'active', 'PASSIVE' => 'passive']
Status::listKeys(); // return ['ACTIVE', 'PASSIVE']
Status::listValues(); // return ['active', 'passive']
Status::getDefaultValue(); // return 'active' (it's the first constants value by default, but this method is also overridable)
```