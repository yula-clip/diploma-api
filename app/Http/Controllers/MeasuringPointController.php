<?php

namespace App\Http\Controllers;

use App\Models\MeasuringPoint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MeasuringPointController extends Controller
{
    public function __construct()
    {
        //
    }

    public function all(Request $request, Response $response)
    {
        $items = MeasuringPoint::select()->with("river_section", "river_section.river");

        if ($request->has('date')) {
            $items->whereDate('created_at', $request->get('date'));
        }

        $items = $items->get();
        return $response->setContent($items);
    }

    public function get(Request $request, Response $response, $id)
    {
        $item = MeasuringPoint::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        }
        $item->river_id = MeasuringPoint::find($id)->river_section->river->id;

        return $response->setContent($item);
    }

    public function save(Request $request, Response $response, $id = null)
    {
        if ($id) {
            $item = MeasuringPoint::find($id);
            if (!$item) {
                $response->setStatusCode(404);
            } else {
                $item->update($request->all());
                $response->setContent($item);
            }
        } else {
            $response->setContent(MeasuringPoint::create($request->all()));
        }
        return $response;
    }

    public function delete(Request $request, Response $response, $id)
    {
        $item = MeasuringPoint::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        } else {
            $item->delete();
        }
        return $response;
    }

    public function importPoints(Request $request, Response $response)
    {
        $request->file('filepoints')[0]->move('/', 'import.csv');
        if (($handle = fopen('/import.csv', 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $point = ['name' => $data[0], 'x' => $data[1], 'y' => $data[2], 'river_section_id' => $data[3]];
                MeasuringPoint::create($point);
            }
        }

        return $response->setContent(1);
    }
}
