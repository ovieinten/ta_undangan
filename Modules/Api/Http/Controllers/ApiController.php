<?php

namespace Modules\Api\Http\Controllers;

// use App\Models\location;
use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getSelect2location(Request $request)
    {
        $table = [
            'name' => 'core_locations',
            'id' => 'location_id',
            'text' => 'location_name',
        ];

        $source = DB::table($table['name'])->select($table['id'] , $table['text'])
            ->where($table['text'] , 'LIKE' , '%' . $request->q . '%')
            ->limit(10);

        if($request->has('location_type')) {
            $source->where('location_type' , '=' , $request->location_type);
        }

        if (@$request->select2 == "yes") {
            $tmp = $source->get()->toArray();
            $data = [];
            $response['items'] = [];
            foreach ((array)$tmp as $key) {
                $keyDump = json_decode(json_encode($key), true);
                $response['items'][] = [
                    'id' => $keyDump[$table['id']],
                    'text' => $keyDump[$table['text']],
                ];
            }
            $data = $response;
        }
        return response()->json($data);
    }
}
