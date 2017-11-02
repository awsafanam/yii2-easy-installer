# Yii2 Easy Installer

Easy web interface to setup Yii 2.

## Features

- Setup database
- Setup email
- Setup Admin Email

## Installation
 - Run `composer require "awsafanam/yii2-easy-installer": "0.1.1"`
 - Add this to your config file
 ```
    'bootstrap' => [
        ...
        'awsaf\installer\SiteBootstrap'
        ...
    ],
    'modules' => [
        ...
        'installer' => [
            'class' => 'awsaf\installer\InstallerModule',
            'sqlFile' => '' // Put the sql file path here (optional)
        ],
        ...
    ]
 ```
 - Visit the document root and complete the setup process
 - Go to admin section login with `user: admin pass: admin`
 
 #### How to contribute?
 
 Contributing instructions are located in [CONTRIBUTING.md](CONTRIBUTING.md) file.

 
 ## License
 
 Yii2-installer is released under the MIT License. See the bundled [LICENSE](LICENSE) for details.
