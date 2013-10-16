# README

The Pixel Domain ZF2 utility classes inherit from the base Zend framework
providing helper functions to cut the amount of boilerplate code required.

Classes include:

- `PixelDomain\Log\Logger` that returns a `Zend\Log\Logger` object that writes
errors to disk and also to the PHP stream in development mode
- `PixelDomain\Controller\AbstractActionController` that provides utility
functions `getEntityManager()` and `getLogger()` so the Doctrine Entity Manager
and PixelDomain Logger objects can be accessed via the Service Manager
- `PixelDomain\Entity\AbstractEntity` and
`PixelDomain\EntityRepository\AbstractEntityRepository` that extend
Doctrine, adding in magic getter and setter methods (for the Entity) as well as
other utility methods such as `getArrayCopy()` and `populate()`
- `PixelDomain\Mail\Sendgrid` that extends the Zend\Mail SMTP transport to use
Sendgrid's SMTP servers by default
- `PixelDomain\Service\AbstractService` that provides utility functions
`getEntityManager()` and `getLogger()` so the Doctrine Entity Manager and
PixelDomain Logger objects can be accessed via the Service Manager

### Usage

This library should be used with the Pixel Domain ZF2 skeleton application
which can be found [here](https://github.com/pixeldomain/zf2-skeleton-app).


### Installation

- Clone the [skeleton application](https://github.com/pixeldomain/zf2-skeleton-app)
- Install via composer `php composer.phar install`.
- Make the `data` directory recursively writable by the web server
- Copy `config/autoload/local.php.dist` to `config/autoload/local.php`

