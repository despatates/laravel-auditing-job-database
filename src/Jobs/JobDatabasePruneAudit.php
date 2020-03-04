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

    private $classname, $data;

    public function __construct(Auditable $model)
    {
        // Keep serialized version od Auditable object.
        // When job will be handled object will be deleted.
        $this->data = $model->toArray();
        $this->classname = get_class($model);
    }

    public function handle()
    {
        $model = $this->classname;
        $object = new $model($this->data);

        (new Database())->prune($object);
    }
}
