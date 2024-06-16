<?php

namespace App\Http\Controllers\Api\Delay;

use App\Http\Requests\Operator\Delay\UpdateRequest;
use App\Models\Delay;
use \Illuminate\Http\Response;

class DelayController extends BaseController
{
    public function update(UpdateRequest $request, Delay $delay): void
    {
        $delay->is_process = false;
        $delay->update($request->validated());
        $delay->save();
    }

    public function show(\Illuminate\Http\Request $request)
    {
        return response($this->service->show($request));
    }

    public function getInfoForAnalyst(\Illuminate\Http\Request $request): Response
    {
        return response($this->service->getInfoForAnalyst($request));
    }
}
