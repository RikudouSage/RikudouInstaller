# Rikudou Installer

This composer plugin allows you to ship your configuration with
your package for supported project types.

As soon as this package is installed in your project, it takes care of
configuring your packages.

## Installation

`composer require rikudou/installer`

## Using

If you want to use the installer in your package, just add it as a dependency
and create the configuration directory `.installer`.

The `.installer` directory has the following structure:

`.installer/[project-type-directory]/[operation-type]`

## Project types

Currently only Symfony 4 project type is supported, but you can define
your own types in your package (more on that below).

#### Symfony 4 project type

- available directories:
    - `symfony4`
    - `symfony`
- example directories:
    - `.installer/symfony4/[operation-type]`
    - `.installer/symfony/[operation-type]`
- detected via:
    - presence of the directory `config/packages`
- machine name:
    - `symfony4`

### Overriding project type composer.json

If you want to set a project type for your project while it cannot
be detected, you can set the `extra.rikudou.installer.project-type` in
your composer.json, the value should be the machine name of desired project
type.

Example:

```json
{
  "require": {
    "php": ">=7.2"
    // your other dependencies
  },
  "extra": {
    "rikudou": {
      "installer": {
        "project-type": "symfony4"
      }
    }
  }
}
```

> Note: JSON does not support comments, if you copy the above snippet,
remove them

## Operation types

Currently only the 'copy files' operation type is supported.

### Copy files operation

Everything from the operation dir (`files`) will be copied to the root
directory of project.

On package uninstall any file that is identical in content to the
one defined in package will be removed and any empty directory
defined in directory structure will be removed.

- directory structure:
    - `.installer/[project-type-dir]/files`
- example directories:
    - `.installer/symfony4/files`
    - `.installer/symfony/files`
- example full directory structure
    - `.installer/symfony/files/config/packages/my_config_file.yaml`
    
## Disable Rikudou Installer

You can disable Rikudou Installer for your project via composer.json
configuration.

- set `extra.rikudou.installer.enabled` to `false`
- add package names to `extra.rikudou.installer.exclude` array to ignore
the installer only for specific packages

Example:

```json
{
  "require": {
    "php": ">=7.2"
    // your other dependencies
  },
  "extra": {
    "rikudou": {
      "installer": {
        "enabled": false, // disable the installer
        "exclude": [
          "vendor/package" // exclude composer package called vendor/package
        ]
      }
    }
  }
}
```

> Note: JSON does not support comments, if you copy the above snippet,
remove them

## Define custom project type

If you want to support non-default project type, in your package define
php classes in directory `.installer/project-types` that implement
`Rikudou\Installer\ProjectType\ProjectTypeInterface`

The interface methods (and what it should return) are described in PHPDoc
in the interface.

The class name or the namespace of defined types does not matter,
but you should avoid having non-namespaced classes as there could be 
a name conflict.