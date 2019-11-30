<?php

namespace App\Http\Controllers;

use App\Models\RiverSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RiverSectionController extends Controller
{
    public function __construct()
    {
        //
    }

    public function all(Request $request, Response $response)
    {
        $items = RiverSection::select()->with('river');

        if ($request->has('date')) {
            $items->whereDate('created_at', $request->get('date'));
        }

        $items = $items->get();
        return $response->setContent($items);
    }

    public function get(Request $request, Response $response, $id)
    {
        $item = RiverSection::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        }
        return $response->setContent($item);
    }

    public function save(Request $request, Response $response, $id = null)
    {
        if ($id) {
            $item = RiverSection::find($id);
            if (!$item) {
                $response->setStatusCode(404);
            } else {
                $item->update($request->all());
                $response->setContent($item);
            }
        } else {
            $response->setContent( RiverSection::create($request->all()) );
        }
        return $response;
    }

    public function delete(Request $request, Response $response, $id)
    {
        $item = RiverSection::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        } else {
            $item->delete();
        }
        return $response;
    }
}
