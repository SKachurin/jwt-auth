<?php

namespace App\Observers;

use App\Models\Rows;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class RowsObserver
{
    /**
     * Handle the Rows "created" event.
     *
     * @param  \App\Models\Rows  $rows
     * @return void
     */
    public function created(Rows $rows)
    {

        cache()->set($rows->id, $rows->id .' is created');
//        $values = Cache::get($rows->id);
//        dd($values);
    }

    /**
     * Handle the Rows "updated" event.
     *
     * @param  \App\Models\Rows  $rows
     * @return void
     */
    public function updated(Rows $rows)
    {
        //
    }

    /**
     * Handle the Rows "deleted" event.
     *
     * @param  \App\Models\Rows  $rows
     * @return void
     */
    public function deleted(Rows $rows)
    {
        //
    }

    /**
     * Handle the Rows "restored" event.
     *
     * @param  \App\Models\Rows  $rows
     * @return void
     */
    public function restored(Rows $rows)
    {
        //
    }

    /**
     * Handle the Rows "force deleted" event.
     *
     * @param  \App\Models\Rows  $rows
     * @return void
     */
    public function forceDeleted(Rows $rows)
    {
        //
    }
}
