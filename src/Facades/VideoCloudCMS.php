<?php

namespace Jasonadriaan\VideoCloudCMS\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jasonadriaan\VideoCloudCMS\VideoCloudCMS
 */
class VideoCloudCMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'videocloudcms';
    }
}
