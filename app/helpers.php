<?php
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Tour;

if ( !function_exists( 'get_date_and_time' ) ) {
    function get_date_and_time($date) {
        return date('jS M Y h:i A', strtotime($date));
    }
}

if ( !function_exists( 'generate_random_string' ) ) {
    //generate random string
    function generate_random_string($number = 10) {
        
        $random = Str::random($number);
        return $random;
    }
}


if ( !function_exists( 'generate_unique_pin' ) ) {
    //generate random string
    function generate_unique_pin($number = 4) {
        
        return rand(pow(10, $number-1), pow(10, $number)-1);
    }
}

if ( !function_exists( 'generate_slug' ) ) {
    //generate random string
    function generate_slug($model_name, $name = '',$id = '') {
        $slug   = Str::slug($name);
        $where = array(
            'slug' => $slug
        );

        if ( $id ) {
            $where['id !='] = $id;
        }

        $result = $model_name::where($where)->first();
        if($result){
            $slug .= $slug.'-'.generate_random_string(5);
        }
        
        return $slug;

    }
}



//this function is used for convert in ymd format
function dmy_to_ymd($date = '',$is_time = 0)
{   

    
    if($is_time){
        return   \Carbon\Carbon::createFromFormat('d/m/Y', $date)
                    ->format('Y-m-d H:i:s');
    }else{
        return   \Carbon\Carbon::createFromFormat('d/m/Y', $date)
                    ->format('Y-m-d');
    }
}

function date_to_ymd($date = '',$is_time = 0){
    if($is_time){
        return   \Carbon\Carbon::parse($date)
                        ->format('Y-m-d H:i:s');
    }else{
        return   \Carbon\Carbon::parse($date)
                        ->format('Y-m-d');
    }
}

function interval_format($interval = ''){

    $year    = $interval->format('%y');
    $month   = $interval->format('%m');
    $day     = $interval->format('%d');
    $hour    = $interval->format('%h');
    $minute  = $interval->format('%i');
    $second  = $interval->format('%s');

    $format  = '';
    $format .= $year ? $year.'year ' : '';
    $format .= $month ? $month.'month ' : '';
    $format .= $day ? $day.'day ' : '';
    $format .= $hour ? $hour.'hour ' : '';
    $format .= $minute ? $minute.'minute ' : '';
    $format .= $second ? $second.'second ' : '';

    return $format;


}


//this function is used for get success response
function get_success_response($url = '',$message  = '',$extra_parameter  = array(),$set_alert = 0,$is_admin = 0){
    if(Request::ajax()){
            $response['status']    = true;
            $response['msg']       = $message;
            
            if(!empty($extra_parameter)){
                $response =     array_merge($response,$extra_parameter);
            }

            if($set_alert && $message != ''){
                Session::flash(config('global.general.msg_message'),$message);
            }
            
            return response()->json($response, 200);            
            exit;
    }else{
            return redirect($url)->with(config('global.general.msg_message'),$message);
            return true;
    }
}

//this function is used for get fail response
function get_fail_response($url = '',$message = "No record found.",$extra_parameter  = array(),$set_alert = 0,$is_admin = 0){

    if(Request::ajax()){

            $response['status']    = false;
            $response['msg']       = $message;
            
            if(!empty($extra_parameter)){
                $response =     array_merge($response,$extra_parameter);
            }

            if($set_alert && $message != ''){
                Session::flash(config('global.general.msg_error'),$message);
            }
            return response()->json($response,200);            
            exit;
    }else{
            return redirect($url)->with(config('global.general.msg_error'),$message);
            return true;
    }
}