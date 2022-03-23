<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Services\DataTable;
use DB;


class CityController extends Controller
{
    
    //get country drop down for select2
    public function city_select(Request $request)
    {
        $csrf_token             = $request->token_id;
        $search_term            = $request->search_term;
        $page                   = $request->page;
        $country_id             = $request->country_id;
        
        $get_page               = $page == 1 ? 0 : $page - 1;
        $get_page_no            = $get_page * 10;
        
        $result                 = City::select('id','name')->where('country_id',$country_id);

        if($search_term != '') {
            $result             = $result->where('name','like','%'.$search_term.'%');    
        }
        $result                 = $result->orderBy('name','asc')->get();
        
        $all_result = [];
        if($result){

            foreach ($result as $value) {
                $all_result[]   = array(
                    'id'        => $value->id,
                    'text'      => $value->name,
                );
            }
        }



        $data['items']          = $all_result;
        $data['page']           = $page;    
        $data['total_count']    = count($all_result);    

        return response()->json($data);

    }
}
