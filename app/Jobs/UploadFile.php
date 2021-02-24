<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Company;
use App\Employee;

class UploadFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $fileArr;
    public $file_type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fileArr, $file_type)
    {
        $this->fileArr = $fileArr;
        $this->file_type = $file_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->file_type == 'company') {

            foreach($this->fileArr as $key => $file) {
                if($key > 0) {
                    Company::create([
                        'name' => $file[1],
                        'email' => $file[2],
                        'logo' => $file[3],
                        'website' => $file[4],
                        'status' => $file[5],
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }

        } elseif($this->file_type == 'employee') {

            foreach($this->fileArr as $key => $file) {
                if($key > 0) {
                    Employee::create([
                        'first_name' => $file[1],
                        'last_name' => $file[2],
                        'company_id' => $file[3],
                        'email' => $file[4],
                        'phone' => $file[5],
                        'designation' => $file[6],
                        'status' => $file[7],
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }
        }
    }
}
