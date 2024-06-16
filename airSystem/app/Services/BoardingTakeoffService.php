<?php

namespace App\Services;

use App\Http\Resources\BoardingTakeoffResource;
use App\Http\Resources\ScheduleResource;
use App\Models\BoardingTakeoff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BoardingTakeoffService
{
    public function show($request)
    {
        $query = BoardingTakeoff::query();
        $queryData = $request->input();
        if (!isset($queryData['status_completed'])) {
            $query->where('status_completed', '=', false);
        }
        if (isset($queryData['orderBy'])) {
            $query->orderBy('planed_date_time', $queryData['orderBy']);
            unset($queryData['orderBy']);
        }
        if (isset($queryData['hours'])) {
            $query = $this->sortBoardingTakeoffs($queryData['hours'], $query);
            unset($queryData['hours']);
        }
        $query->where($queryData);

        return BoardingTakeoffResource::collection($query->get());
    }

    protected function sortBoardingTakeoffs($hours, $query)
    {

        $now = Carbon::now()->addHours(7);

        $endOfHours = $now->copy()->addHours($hours);

        $nowFormatted = $now->format('Y-m-d H:i:s');
        $endOfHoursFormatted = $endOfHours->format('Y-m-d H:i:s');

        $query->where('planed_date_time', '>', $nowFormatted)
            ->where('planed_date_time', '<', $endOfHoursFormatted);

        return $query;
    }

    public function update($request, $boardingTakeoff)
    {
        $validatedData = $request->validated();

        if (isset($validatedData['date_complete']) && isset($validatedData['time_complete'])) {
            $dateTime = $validatedData['date_complete'] . ' ' . $validatedData['time_complete'] . ':00';
        } elseif (isset($validatedData['date_complete'])) {
            $dateTime = $validatedData['date_complete'] . ' ' . Carbon::now()->addHours(7)->format('H:i:s');
        } elseif (isset($validatedData['time_complete'])) {
            $dateTime = Carbon::now()->addHours(7)->format('Y-m-d') . ' ' . $validatedData['time_complete'];
        } else {
            $dateTime = Carbon::now()->addHours(7)->format('Y-m-d H:i:s');
        }

        $boardingTakeoff->status_completed = true;
        $boardingTakeoff->completed_date_time = $dateTime;
        $boardingTakeoff->save();

        if ($boardingTakeoff->planed_date_time < $dateTime) {
            $this->createDelay($boardingTakeoff, $dateTime);
        }
    }

    protected function createDelay($boardingTakeoff, $dateTime): void
    {
        $interval = Carbon::parse($boardingTakeoff->planed_date_time)->diff($dateTime);
        $daysInSeconds = $interval->days * 86400;
        $seconds = $interval->s + $interval->i * 60 + $interval->h * 3600 + $daysInSeconds;
        $boardingTakeoff->delay()->create([
            'airport_code' => $boardingTakeoff->airport_code,
            'flight_number' => $boardingTakeoff->flight_number,
            'approximate_time' => $seconds,
        ]);
    }
}

