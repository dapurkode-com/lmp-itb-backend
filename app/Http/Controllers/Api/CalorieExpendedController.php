<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CalorieExpended;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Http\Resources\CalorieResource;
use App\Http\Resources\CalorieCollection;

class CalorieExpendedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceRequest $request): CalorieCollection
    {
        $sort = $request->input('sort', 'DESC');
        $number_item = $request->input('number_item', 5);

        $query = CalorieExpended::orderBy('id', $sort);

        if ($request->has('start_date') && $request->has('end_date')) {
            $query = $query->whereBetween(
                DB::raw('DATE(FROM_UNIXTIME(microtime / 1000))'),
                [$request->start_date, $request->end_date]
            );
        }

        return new CalorieCollection($query->paginate($number_item));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CalorieExpended  $calorieExpended
     * @return \Illuminate\Http\Response
     */
    public function show(CalorieExpended $calorieExpended): CalorieResource
    {
        return new CalorieResource($calorieExpended);
    }

    public function todayLatest()
    {
        $calorie = CalorieExpended::whereBetween(
            DB::raw('FROM_UNIXTIME(microtime / 1000)'),
            [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()]
        )->orderBy('microtime', 'DESC')->firstOrFail();

        return new CalorieResource($calorie);
    }
}
