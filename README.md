# A simple way to interact with Brightcove's VideoCloud CMS API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jasonadriaan/videocloudcms.svg?style=flat-square)](https://packagist.org/packages/jasonadriaan/videocloudcms)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/jasonadriaan/videocloudcms/run-tests?label=tests)](https://github.com/jasonadriaan/videocloudcms/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/jasonadriaan/videocloudcms/Check%20&%20fix%20styling?label=code%20style)](https://github.com/jasonadriaan/videocloudcms/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jasonadriaan/videocloudcms.svg?style=flat-square)](https://packagist.org/packages/jasonadriaan/videocloudcms)

This package makes it simple for you to retrieve and update videos on Brightcove VideoCloud's CMS API without having to deal with authentication or repetitive api calls.

## Support: Buy me a coffee

I build and maintain this project in my free time. If it makes your life simpler you can [buy me a coffee](https://buymeacoffee.com/jasonadriaan).

## Installation

You can install the package via composer:

```bash
composer require jasonadriaan/videocloudcms
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="videocloudcms-config"
```

In your .env file please add the following lines with your API details from Brightcove VideoCloud

```php
VIDEOCLOUD_ACCOUNT_ID=xxxxx
VIDEOCLOUD_API_KEY=xxxxx
VIDEOCLOUD_API_SECRET=xxxxx
```

## Usage

I would recommend you go ahead and read the [VideoCloud CMS API documentation](https://apis.support.brightcove.com/cms/index.html) to understand the underlying API.

Updating a Video:

```php
use Jasonadriaan\VideoCloudCMS\VideoCloudCMS;

class main extends Controller
{
    
    public function index(){

        $payload = array(
            'name' => 'Scooby Doo!',
          );

        $videocloud = new VideoCloudCMS();

        /*  Update requires a video id and a payload 
        *  eg. update($video_id, $payload) 
        */

        $result = $videocloud->update(1234567890, $payload);

        return $result;
    }

}
```

Get a list of videos:

```php
use Jasonadriaan\VideoCloudCMS\VideoCloudCMS;

class main extends Controller
{
    
    public function index(){

        $videocloud = new VideoCloudCMS();

        $result = $videocloud->limit(5)
                            ->offset(2)
                            ->query()
                            ->sort()
                            ->getVideos();

        return $result;
    }

}
```

Get a specific video:

```php
use Jasonadriaan\VideoCloudCMS\VideoCloudCMS;

class main extends Controller
{
    
    public function index(){

        $videocloud = new VideoCloudCMS();

        /* getVideo requires a video id
        *  eg. getVideo($video_id) 
        */

        $result = $videocloud->getVideo(1234567);

        return $result;
    }

}
```

Get a count of how many videos are on the system:

```php
use Jasonadriaan\VideoCloudCMS\VideoCloudCMS;

class main extends Controller
{
    
    public function index(){

        $videocloud = new VideoCloudCMS();
        
        $result = $videocloud->getCount();

        return $result;
    }

}
```


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jason Adriaan](https://github.com/jasonadriaan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
