<?php

namespace App\Http\Controllers;

use App\tables;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    public function index ()
    {
        return view('welcome');
    }

    public function  getContent()
    {
        $loadedCount = request()->get('loaded');
        if (!$loadedCount) {
            return null;
        }
        $loadLimit = 50;

        $responceData = \DB::table('content')
            ->where([
                ['id', '>', $loadedCount - 1],
                ['id', '<', $loadLimit + $loadedCount],
            ])
            ->get();

//        $responceData = tables::all();

        return $responceData;
    }

    public function push ()
    {
        $cells = json_decode(request()->get('cells'));
//        $answ = $cells[0]->x;

        foreach ($cells as $cell) {
            $currentSQLCell = tables::where([
                    ['x', '=', $cell->x],
                    ['y', '=', $cell->y],
                ])->get();

            if (count($currentSQLCell) == 0) {
                $tmpCell = new tables;
                $tmpCell->x = $cell->x;
                $tmpCell->y = $cell->y;
                $tmpCell->val = $cell->value;
                $tmpCell->save();

            } else {
                $currentSQLCell = $currentSQLCell[0];
                $currentSQLCell->x = $cell->x;
                $currentSQLCell->y = $cell->y;
                $currentSQLCell->val = $cell->value;
                $currentSQLCell->save();
            }
        }
//        return $answ;
//        return 'ok';
    }
}
