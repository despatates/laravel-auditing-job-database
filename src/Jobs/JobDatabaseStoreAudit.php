<?php
namespace Levell\Auditing\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class JobDatabaseStoreAudit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        // original OwenIt\Auditing\Drivers\Database `audit()` method.
        $implementation = Config::get('audit.implementation', \OwenIt\Auditing\Models\Audit::class);
        return call_user_func([$implementation, 'create'], $this->data);
    }
}
