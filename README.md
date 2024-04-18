# Tools library for PHP

## Installation

The recommended way to install composer packages is:

```
composer require mindfactory/tools
```

## Documentation

You can find the documentation for bake [on its own cookbook](https://book.cakephp.org/bake/3).

## Testing

After installing dependencies with composer you can run tests with `phpunit`:

```bash
vendor/bin/phpunit
```

## Packages

### File Version Trait

**Usage**
```php
class someClass
{
    use fileVersionTrait;

    public function someFunction() {
        $fileName = $this->getFileVersion('/path/to/file.php', ['version1', 'versopn2']);
    }
}
```
If you have different version of a file based on different conditions.
The file version trait returns the right name.

**Example senario**

There is tree version thats possible a, b and c.
The base file is called foo.php.
There is no changes in foo.php for version c.

You make the following files
```
foo.php
foo-a.php
foo-b.php
foo-a-b.php
```

```php
$this->getFileVersion('/path/to/foo.php', ['a']);
```
Returns 'foo-a.php'

```php
$this->getFileVersion('/path/to/foo.php', ['a', 'b', 'c']);
```
Returns 'foo-a-b.php'
