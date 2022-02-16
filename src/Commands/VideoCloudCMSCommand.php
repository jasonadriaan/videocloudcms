<?php

namespace Jasonadriaan\VideoCloudCMS\Commands;

use Illuminate\Console\Command;

class VideoCloudCMSCommand extends Command
{
    public $signature = 'videocloudcms';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
