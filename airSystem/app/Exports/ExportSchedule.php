<?php

namespace App\Exports;

use App\Http\Resources\ScheduleResource;
use App\Models\Flight;
use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportSchedule implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $query = Flight::query();
        $queryData = request()->input();
        if (isset($queryData['for_airline'])) {

            $query
                ->join('delays', 'delays.flight_number', '=', 'flights.flight_number')
                ->join('type_categories', 'delays.reason_type_id', '=', 'type_categories.id')
                ->where('delays.is_process', '=', false)
                ->select(
                    'flights.airline_code as Airline',
                    'delays.airport_code as Delay_Airport',
                    'delays.approximate_time as Delay_Time',
                    'flights.board_code as Board_Code',
                    'delays.content as Delay_Content',
                    'delays.flight_number as Delayed_Flight_Number',
                    'delays.title as Delay_Title',
                    'type_categories.title as Category_title'
                );
            if (isset($queryData['orderBy'])) {
                $query->orderBy('delays.approximate_time', $queryData['orderBy']);
                unset($queryData['orderBy']);
            }
            if (isset($queryData['airline_code'])) {
                $query->where('flights.airline_code', '=', $queryData['airline_code']);
            }
            return $query->get();
        }
        if (isset($queryData['for_flight'])) {
            $query
                ->join('delays', 'delays.flight_number', '=', 'flights.flight_number')
                ->join('type_categories', 'delays.reason_type_id', '=', 'type_categories.id')
                ->where('delays.is_process', '=', false)
                ->select(
                    'flights.airline_code as Airline',
                    'delays.airport_code as Delay_Airport',
                    'delays.approximate_time as Delay_Time',
                    'flights.board_code as Board_Code',
                    'delays.content as Delay_Content',
                    'delays.flight_number as Delayed_Flight_Number',
                    'delays.title as Delay_Title',
                    'type_categories.title as Category_title',
                    'flights.airport_code_where as Departure_Airport',
                    'flights.airport_code_whither as Destination_Airport',
                );
            if (isset($queryData['orderBy'])) {
                $query->orderBy('delays.approximate_time', $queryData['orderBy']);
                unset($queryData['orderBy']);
            }
            if (isset($queryData['flight_number'])) {
                $query->where('flights.flight_number', '=', $queryData['flight_number']);
            }
            if (isset($queryData['airport_code'])) {
                $query->where('delays.airport_code', '=', $queryData['airport_code']);
            }
        }
        if (isset($queryData['for_board'])) {
            $query
                ->join('delays', 'delays.flight_number', '=', 'flights.flight_number')
                ->join('boards', 'boards.board_code', '=', 'flights.board_code')
                ->join('aircraft_models', 'aircraft_models.id', '=', 'boards.model_id')
                ->join('manufacturers', 'manufacturers.id', '=', 'aircraft_models.manufacturer_id')
                ->join('type_categories', 'delays.reason_type_id', '=', 'type_categories.id')
                ->where('delays.is_process', '=', false)
                ->select(
                    'flights.airline_code as Airline',
                    'delays.airport_code as Delay_Airport',
                    'delays.approximate_time as Delay_Time',
                    'flights.board_code as Board_Code',
                    'delays.content as Delay_Content',
                    'aircraft_models.title as aircraft_models_title',
                    'manufacturers.title as manufacturers_title',
                    'delays.flight_number as Delayed_Flight_Number',
                    'delays.title as Delay_Title',
                    'type_categories.title as Category_title'
                );
            if (isset($queryData['orderBy'])) {
                $query->orderBy('delays.approximate_time', $queryData['orderBy']);
                unset($queryData['orderBy']);
            }
            if (isset($queryData['board_code'])) {
                $query->where('boards.board_code', '=', $queryData['board_code']);
            }
            if (isset($queryData['model_id'])) {
                $query->where('aircraft_models.id', '=', $queryData['model_id']);
            }
            return $query->get();
        }
        if (isset($queryData['for_category'])) {

            $query
                ->join('delays', 'delays.flight_number', '=', 'flights.flight_number')
                ->join('boards', 'boards.board_code', '=', 'flights.board_code')
                ->join('type_categories', 'delays.reason_type_id', '=', 'type_categories.id')
                ->join('boarding_takeoffs', 'boarding_takeoffs.id', '=', 'delays.boarding_takeoff_id')
                ->where('delays.is_process', '=', false)
                ->select(
                    'flights.airline_code as Airline',
                    'delays.airport_code as Delay_Airport',
                    'boarding_takeoffs.planed_date_time as planed_date_time',
                    'boarding_takeoffs.completed_date_time as completed_date_time',
                    'delays.approximate_time as Delay_Time',
                    'flights.board_code as Board_Code',
                    'delays.content as Delay_Content',
                    'delays.flight_number as Delayed_Flight_Number',
                    'delays.title as Delay_Title',
                    'type_categories.title as Category_title'
                );
            if (isset($queryData['orderBy'])) {
                $query->orderBy('delays.approximate_time', $queryData['orderBy']);
                unset($queryData['orderBy']);
            }
            if (isset($queryData['type_id'])) {
                $query->where('delays.reason_type_id', '=', $queryData['type_id']);
            }
        }
        return $query->get();

    }
}
