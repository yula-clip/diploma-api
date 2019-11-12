<?php

namespace App\Http\Controllers;

use App\Models\River;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RiverController extends Controller
{
    public function __construct()
    {
        //
    }

    public function all(Request $request, Response $response)
    {
        $items = River::select();

        if ($request->has('date')) {
            $items->whereDate('created_at', $request->get('date'));
        }

        $items = $items->get();
        return $response->setContent($items);
    }

    public function get(Request $request, Response $response, $id)
    {
        $item = River::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        }
        return $response->setContent($item);
    }

    public function save(Request $request, Response $response, $id = null)
    {
        if ($id) {
            $item = River::find($id);
            if (!$item) {
                $response->setStatusCode(404);
            } else {
                $item->update($request->all());
                $response->setContent($item);
            }
        } else {
            $response->setContent( River::create($request->all()) );
        }
        return $response;
    }

    public function delete(Request $request, Response $response, $id)
    {
        $item = River::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        } else {
            $item->delete();
        }
        return $response;
    }
}
