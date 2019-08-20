<?php

namespace Levell\Auditing\Drivers;

use Illuminate\Support\Facades\Config;
use Levell\Auditing\Jobs\JobDatabasePruneAudit;
use Levell\Auditing\Jobs\JobDatabaseStoreAudit;
use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\AuditDriver;
use OwenIt\Auditing\Drivers\Database;

class JobDatabase extends Database implements AuditDriver
{
    /**
     * {@inheritdoc}
     */
    public function audit(Auditable $model): Audit
    {
        if (Config::get('audit.queue', false)) {
            return $this->deferAudit($model);
        } else {
            return parent::audit($model);
        }
    }

    /**
     * Create a job to generate new Audit record.
     * @param Auditable $model the auditable model to insert.
     * @return Audit
     */
    public function deferAudit(Auditable $model): Audit
    {
        $data = $model->toAudit();
        JobDatabaseStoreAudit::dispatch($data)->onQueue($this->getQueue())->onConnection($this->getConnection());

        $implementation = Config::get('audit.implementation', \OwenIt\Auditing\Models\Audit::class);
        return new $implementation($data);
    }

    /**
     * {@inheritdoc}
     */
    public function prune(Auditable $model): bool
    {
        if (Config::get('audit.queue', false)) {
            return $this->deferPrune($model);
        } else {
            return parent::prune($model);
        }
    }

    /**
     * Create a job to prune old Audit records.
     * @param Auditable $model the auditable model for which to prune audits.
     * @return bool
     */
    public function deferPrune(Auditable $model): bool
    {
        JobDatabasePruneAudit::dispatch($model)->onQueue($this->getQueue())->onConnection($this->getConnection());
        return false;
    }

    /**
     * Get the queue to use for jobs.
     * @return string
     */
    public function getQueue()
    {
        return config('audit.queue.queue');
    }

    /**
     * Get the queue connection to use for jobs.
     * @return string
     */
    public function getConnection()
    {
        return config('audit.queue.connection') ?: config('queue.default');
    }
}
