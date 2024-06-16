<?php

namespace App\Http\Controllers\Api\BoardingTakeoff;

use App\Http\Requests\Operator\BoardingTakeoff\UpdateRequest;
use App\Models\BoardingTakeoff;
use Carbon\Carbon;

class BoardingTakeoffController extends BaseController
{
    public function update(UpdateRequest $request, BoardingTakeoff $boardingTakeoff): void
    {
        $this->service->update($request, $boardingTakeoff);
    }

    public function show(\Illuminate\Http\Request $request)
    {
        return response($this->service->show($request));
    }
}
