<?php

namespace App\Http\Controllers\Api\Delay;

use App\Services\DelayService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public DelayService $service;
    public function __construct(DelayService $service)
    {
        $this->service = $service;
    }
}
