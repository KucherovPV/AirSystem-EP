<?php

namespace App\Models;

use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class BoardingTakeoff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'boarding_takeoffs';

    protected $guarded = false;
    protected $casts = [
        'completed_date_time' => 'datetime:Y-m-d H:i:s',
    ];

    public function delay(): Relation
    {
        return $this->hasMany(Delay::class,'boarding_takeoff_id','id',);
    }
    public static function getSchedule(): void
    {
        $schedules = Schedule::all();
        $period = CarbonPeriod::create(Carbon::now(), Carbon::now()->addDay(7)->format('d.m.Y'));

        $scheduleDays = [];
        $weekDayToDate = [];

        foreach ($schedules as $schedule) {
            if ($schedule->days->isNotEmpty()) {
                // Инициализируем массив для каждого schedule_id
                if (!isset($scheduleDays[$schedule->id])) {
                    $scheduleDays[$schedule->id] = [];
                }
                // Добавляем day_id в массив для соответствующего schedule_id
                foreach ($schedule->days as $day) {
                    $scheduleDays[$schedule->id][] = $day->pivot->day_id;
                }
            }
        }

        // Инициализируем массив для сопоставления номера дня недели с датой
        foreach ($period as $date) {
            // Получаем номер дня недели (1 для понедельника, 7 для воскресенья)
            $weekDay = $date->dayOfWeekIso;

            // Добавляем пару номер дня недели - дата в массив
            $weekDayToDate[$weekDay] = $date->format('Y-m-d');
        }

        foreach ($scheduleDays as $scheduleId => $days) {
            $schedule = Schedule::find($scheduleId);
            print_r('------------'."\n");
            foreach ($days as $day) {
               print_r($day."\n");
                $flight = $schedule->flight;
                $boarding = new BoardingTakeoff();
                $takeoff = new BoardingTakeoff();

                $boarding->is_boarding = true;
                $boarding->status_completed = false;
                $boarding->airport_code = $flight->airport_code_where;
                $boarding->flight_number = $flight->flight_number;
                $boarding->planed_date_time= Carbon::parse($weekDayToDate[$day] . ' ' . $schedule->boarding_time);

               print_r($weekDayToDate[$day]."\n");
                $takeoff->is_boarding = false;
                $takeoff->status_completed = false;
                $takeoff->airport_code = $flight->airport_code_whither;
                $takeoff->flight_number = $flight->flight_number;
                $takeoff->planed_date_time= Carbon::parse($weekDayToDate[$day] . ' ' . $schedule->takeoff_time);

                $boarding->save();
                $takeoff->save();
            }
        }
    }
}
