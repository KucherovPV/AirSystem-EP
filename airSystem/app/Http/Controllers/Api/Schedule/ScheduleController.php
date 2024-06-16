<?php

namespace App\Http\Controllers\Api\Schedule;


use App\Exports\ExportSchedule;
use App\Http\Requests\Operator\Schedule\StoreRequest;
use App\Http\Requests\Operator\Schedule\UpdateRequest;
use App\Models\Schedule;
use Maatwebsite\Excel\Facades\Excel;


class ScheduleController extends BaseController
{
    public function export()
    {
        // Экспортируйте данные в Excel и получите объект Response
        $response = Excel::download(new ExportSchedule(), 'data.xlsx');

        // Получите содержимое ответа
        $fileContents = $response->getFile()->getContent();

        return response()->json(['base64' => base64_encode($fileContents)]);
    }
    public function index()
    {
//        return response(ScheduleResource::collection(Schedule::all()), 200);
    }
    public function show(\Illuminate\Http\Request $request)
    {
        //return response(ScheduleResource::collection(Schedule::all()), 200);
        return response($this->service->show($request));
    }

    public function update(UpdateRequest $request, Schedule $schedule)
    {

        $data = $request->validated();
        $schedule->days()->sync($data['day_ids']);
        dd($request->validated());
        unset($data['day_ids']);
        $schedule->update($data);
        return response()->json(["message" => "Airline edited"]);
    }

    public function store(StoreRequest $request)
    {
        $this->service->store($request->validated());
        return response()->json(["message" => "Airline created"], 201);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json(["message" => "Airline removed"]);
    }


}
