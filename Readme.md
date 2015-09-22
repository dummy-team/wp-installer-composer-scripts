# Wordpress installer - composer scripts

[![Join the chat at https://gitter.im/dummy-team/wp-installer-composer-scripts](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/dummy-team/wp-installer-composer-scripts?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
Thoses scripts are used in [wp-installer package](git@github.com:dummy-team/wp-installer.git) and can be called after composers events (create-project, install and update)

## Installation
Install [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) and require this package

```
composer require dummy-team/wp-installer-composer-scripts
```
You have to set some parameters in the *extra* block of your composer.json to allow scripts to access your files
```
  "extra": {
    "dummyteam-parameters": {
      "parameter-file": "web/wp/wp-config-sample.php",
      "destination-folder": "web/"
    }
  }
```
- **parameter-file (required):** the path to the *wp-config-sample.php* file of the default Wordpress install
- **destination-folder (optional):** destination folder for your final *wp-config.php* and *wp-config.php.dist* files

## Scripts
### Build parameters
This script build your *wp-config.php* and *wp-config.php.dist*, find all parameters set in the dist file and ask the value required for your local version.
#### How to use it
Add those lines to your *composer.json*
```
"scripts": {
    "post-install-cmd": [
        "DummyTeam\\WpInstallerComposerScripts\\Parameters::build"
    ],
    "post-update-cmd": [
        "DummyTeam\\WpInstallerComposerScripts\\Parameters::build"
    ]
}
```
The next time, you'll execute `composer install`, `composer update` or `composer create-project ...` the script will parse your configuration

### Prepare structure
### Prepare Git