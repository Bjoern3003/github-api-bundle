# GithubApiBundle [![Build Status](https://travis-ci.org/maxikg/github-api-bundle.svg?branch=master)](https://travis-ci.org/maxikg/github-api-bundle)

A Kimai 2 plugin, which allows to use github-api to connecto to github or similar.

## Installation

First clone it to your Kimai installation `plugins` directory:
```
cd /kimai/var/plugins/
git clone https://github.com/Bjoern3003/github-api-bundle.git
```

And then rebuild the cache: 
```
cd /kimai/
bin/console cache:clear
bin/console cache:warmup
```

You could also [download it as zip](https://github.com/Bjoern3003/github-api-bundle/archive/master.zip) and upload the directory via FTP:

```
/kimai/var/plugins/
├── GithubApiBundle
│   ├── GithubApiBundle.php
|   └ ... more files and directories follow here ... 
```

Now register the bundle:

```php
<?php
// config/bundles.php
public function registerBundles()
{
    return = [
        // ...
        KimaiPlugin\GithubApiBundle\GithubApiBundle::class => ['all' => true],
    ];
    // ...
}
```

## Configuration

Now you are able to configure your Github Client in your Kimai Systemconfig Backend.

But you aren't required to configure this Bundle. It will also work
with the defaults (Only connect to public repositorys).

## Usage

You can use your Client for example in Controller Files.

Declare your Instance with ``GithubClient $client`` in your method.

And then you can call your repositorys for example with: ``$client->api('user')->myRepositories();``
Please refer this docummentation for for informations: [https://github.com/KnpLabs/php-github-api](https://github.com/KnpLabs/php-github-api)

## License

See [LICENSE.txt](./LICENSE.txt). Don't worry, it's the MIT license.
