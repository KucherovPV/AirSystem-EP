<?php

namespace App\Http\Controllers\Api\Schedule;

use App\Services\ScheduleService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public ScheduleService $service;
    public function __construct(ScheduleService $service)
    {
        $this->service = $service;
    }
}
