<?php

namespace Jag\Chikka\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Jag\Chikka\Events\Sending;

class SendingListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(Sending $event)
    {
        // TODO
    }
}
