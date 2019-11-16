<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use App\Models\MeasuringPoint;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MeasureController extends Controller
{
    public function __construct()
    {
        //
    }

    public function all(Request $request, Response $response)
    {
        $items = Measure::select();

        if ($request->has('date')) {
            $items->whereDate('created_at', $request->get('date'));
        }

        $items = $items->get();
        return $response->setContent($items);
    }

    public function getMeasures(Request $request, Response $response, $id)
    {
        $items = Measure::select()->with('measuring_point', 'measuring_point.river_section');

        $items = $items->whereHas('measuring_point', function (Builder $query) use ($id) {
            $query->where('river_section_id', $id);
        });

        if ($request->has('date')) {
            $items->whereDate('created_at', $request->get('date'));
        }

        $items = $items->get();
        return $response->setContent($items);
    }

    public function getResults(Request $request, Response $response, $id)
    {
        $measures = Measure::select()->with('measuring_point', 'measuring_point.river_section');

        $measures = $measures->whereHas('measuring_point', function (Builder $query) use ($id) {
            $query->where('river_section_id', $id);
        });

        $M = $request->get('m');
        $l = $request->get('l');
        $dh = $request->get('dh');


        $measures = $measures->get();
        return $response->setContent($measures);
    }

    public function getPollutedSection(Request $request, Response $response)
    {
        $measures = Measure::select()->with('substance', 'measuring_point', 'measuring_point.river_section');

        $measures = $measures->whereHas('substance', function (Builder $query) {
            $query->where('validValue', '>', 0);
        });

        $measures = $measures->get();
        return $response->setContent($measures);
    }

    public function get(Request $request, Response $response, $id)
    {
        $item = Measure::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        }
        return $response->setContent($item);
    }

    public function save(Request $request, Response $response, $id = null)
    {
        if ($id) {
            $item = Measure::find($id);
            if (!$item) {
                $response->setStatusCode(404);
            } else {
                $item->date = date('Y-m-d H:i:s', strtotime($request->get('date')));
                $item->update($request->all());
                $response->setContent($item);
            }
        } else {
            $response->setContent(Measure::create($request->all()));
        }
        return $response;
    }

    public function delete(Request $request, Response $response, $id)
    {
        $item = Measure::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        } else {
            $item->delete();
        }
        return $response;
    }
}
