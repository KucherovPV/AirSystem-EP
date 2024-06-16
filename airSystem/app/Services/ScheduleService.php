<?php

namespace App\Services;

use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $days = $data['day_ids'];
            unset($data['day_ids']);
            $schedule = Schedule::Create($data);
            $schedule->days()->attach($days);
            DB::commit();
        } catch (\Exception $exception) {
            error_log($exception);
            DB::rollBack();
            abort(500);
        }
    }

    public function show($request)
    {
        $query = Schedule::query()
            ->join('flights', 'schedules.flight_number', '=', 'flights.flight_number');
        $queryData = $request->input();
        $scheduleWords = [
            'id',
            'flight_number',
            'start_date',
            'end_date'];

        $flightsWords = [
            'board_code',
            'airport_code_where',
            'airport_code_whither',
            'airline_code',
            'flight_type_id'];

        if ($request->has('actual')) {
            $query->where('end_date', '>=', date("Y-m-d"));
            unset($queryData['actual']);
        }
        if ($request->has('boarding_time_start')) {
            $query->where('boarding_time', '>=', $request->input('boarding_time_start'));
            unset($queryData['boarding_time_start']);
        }
        if ($request->has('boarding_time_end')) {
            $query->where('boarding_time', '<=', $request->input('boarding_time_end'));
            unset($queryData['boarding_time_end']);
        }
        if ($request->has('takeoff_time_start')) {
            $query->where('takeoff_time', '>=', $request->input('takeoff_time_start'));
            unset($queryData['takeoff_time_start']);
        }
        if ($request->has('takeoff_time_end')) {
            $query->where('takeoff_time', '<=', $request->input('takeoff_time_end'));
            unset($queryData['takeoff_time_end']);
        }

        foreach ($queryData as $key => $value) {
            if (in_array($key, $scheduleWords)) {
                $queryData['schedules.' . $key] = $value;
                unset($queryData[$key]);
            } elseif (in_array($key, $flightsWords)) {
                $queryData['flights.' . $key] = $value;
                unset($queryData[$key]);
            }
        }
        $query->where($queryData);

        return (ScheduleResource::collection($query->get()));
    }
}
