<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use App\CustomerDB;
class DBDispatchqueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $responseData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($responseData)
    {
        $this->responseData = $responseData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $response = json_decode($this->responseData,true);
            
            // Log::info(print_r($response,true));
            /*if($response['countries']){
                $data = $response['countries'];
                // 
                foreach ($data as $value){
                    Log::info($value['id']);
                    $obj = new CustomerDB;
                    $obj->country_id =$value['id'];
                    $obj->save(); 
                }
                //Log::info(print_r($response,true));
            }*/
            return true;
        }
        catch(Exception $e){

        }
    }
}
