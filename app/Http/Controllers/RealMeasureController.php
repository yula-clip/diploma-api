<?php

namespace App\Http\Controllers;

use App\Models\RealMeasure;
use App\Models\MeasuringPoint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RealMeasureController extends Controller
{
    public function __construct()
    {
        //
    }

    public function all(Request $request, Response $response)
    {
        $items = RealMeasure::select();

        if ($request->has('date')) {
            $items->whereDate('created_at', $request->get('date'));
        }

        $items = $items->get();
        return $response->setContent($items);
    }

    public function get(Request $request, Response $response, $id)
    {
        $item = RealMeasure::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        }
        return $response->setContent($item);
    }

    public function save(Request $request, Response $response, $id = null)
    {
        if ($request->get('substance_id')) {
            $substances = RealMeasure::where('substance_id', $request->get('substance_id'));
            if ($id) {
                $substances = $substances->where('id', '!=', $id);
            }
        }

        $model = ($id) ? RealMeasure::find($id) : new RealMeasure;

        $model->date = date("Y-m-d H:i:s", strtotime($request->get('date')));
        $model->fill($request->except('measuring_points'));
        $model->measuring_points = $request->only('measuring_points')['measuring_points'];
        $model->save();

        return $response->setContent($model);
    }

    public function delete(Request $request, Response $response, $id)
    {
        $item = RealMeasure::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        } else {
            $item->delete();
        }
        return $response;
    }
}
