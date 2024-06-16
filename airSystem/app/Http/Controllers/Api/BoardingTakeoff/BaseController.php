<?php

namespace App\Http\Controllers\Api\BoardingTakeoff;

use App\Services\BoardingTakeoffService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public BoardingTakeoffService $service;
    public function __construct(BoardingTakeoffService $service)
    {
        $this->service = $service;
    }
}
