<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function all(Request $request, Response $response)
    {
        $items = User::select();

        if ($request->has('date')) {
            $items->whereDate('created_at', $request->get('date'));
        }

        $items = $items->get();
        return $response->setContent($items);
    }

    public function get(Request $request, Response $response, $id)
    {
        $item = User::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        }
        return $response->setContent($item);
    }

    public function save(Request $request, Response $response, $id = null)
    {
        if ($id) {
            $item = User::find($id);
            if (!$item) {
                $response->setStatusCode(404);
            } else {
                $user = $request->all();
                if ($user['password'] != null) {
                    $user['password'] = app('hash')->make($user['password']);
                } else {
                    $user['password'] = $item['password'];
                }
                $item->update($user);
                $response->setContent($item);
            }
        } else {
            $user = $request->all();
            $user['password'] = app('hash')->make('admin');
            $response->setContent(User::create($user));
        }
        return $response;
    }

    public function delete(Request $request, Response $response, $id)
    {
        $item = User::find($id);
        if (!$item) {
            $response->setStatusCode(404);
        } else {
            $item->delete();
        }
        return $response;
    }
}
