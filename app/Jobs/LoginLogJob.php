<?php

namespace App\Jobs;

use App\Traits\SenRequestTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LoginLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use SenRequestTrait;

    public array $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->sendRequest("logservice.test/api/log", "post", [
            "type" => "login",
            "user" => $this->data["name"],
            "id" => $this->data["id"],
            "date" => $this->data["date"],
            "http_user_agent" => $this->data["http_user_agent"]
        ]);
    }
}
