<?php

namespace App\Jobs;

use App\Actions\ParseFile;
use App\Imports\RowsImport;
use App\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartParsing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(File $file)
    {
        $this->file = $file;

        //dd($file);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ParseFile $action)
    {
        $file = $this->file ;
        $action->parse($file);

    }
}
