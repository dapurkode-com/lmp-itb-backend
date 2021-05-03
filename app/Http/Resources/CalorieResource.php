<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Calorie Resource
 * @author Satya Wibawa <i.g.b.n.satyawibawa@gmail.com>
 * @package Resource
 *
 * @OA\Schema(
 *      title="CalorieResource",
 *      description="Calorie resource",
 *      @OA\Xml(
 *          name="CalorieResource"
 *      ),
 * )
 */
class CalorieResource extends JsonResource
{
    /**
     * @OA\Property(property="id", type="integer", description="Id of collection", readOnly="true")
     *
     * @var number
     */
    /**
     * @OA\Property(property="calorie", type="integer", description="Calorie", readOnly="true")
     *
     * @var number
     */
    /**
     * @OA\Property(property="microtime", type="integer", description="Microtime format", readOnly="true")
     *
     * @var float
     */
    /**
     * @OA\Property(property="datetime", type="string", format="date-time", description="Date time format", readOnly="true")
     *
     * @var string
     */

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'calorie'       => $this->calorie,
            'microtime'     => $this->microtime,
            'datetime'      => Carbon::parse((int) ($this->microtime / 1000))->timezone(config('app.timezone'))->format('Y-m-d H:i:s')
        ];
    }
}
