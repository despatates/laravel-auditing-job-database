<?php
namespace Levell\Auditing\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Drivers\Database;

class JobDatabasePruneAudit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;

    public function __construct(Auditable $model)
    {
        $this->model = $model;
    }

    public function handle()
    {
        (new Database())->prune($this->model);
    }
}
