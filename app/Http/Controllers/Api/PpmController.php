<?php

namespace App\Http\Controllers\Api;

use App\Models\Ppm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Http\Resources\PpmCollection;
use App\Http\Resources\PpmResource;

class PpmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceRequest $request)
    {
        $sort = $request->input('sort', 'DESC');
        $number_item = $request->input('number_item', 5);

        $query = Ppm::orderBy('id', $sort);

        if ($request->has('start_date') && $request->has('end_date')) {
            $query = $query->whereBetween(
                DB::raw('DATE(FROM_UNIXTIME(microtime / 1000))'),
                [$request->start_date, $request->end_date]
            );
        }

        return new PpmCollection($query->paginate($number_item));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ppm  $ppm
     * @return \Illuminate\Http\Response
     */
    public function show(Ppm $ppm): PpmResource
    {
        return new PpmResource($ppm);
    }
}