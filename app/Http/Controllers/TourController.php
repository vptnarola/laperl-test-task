<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Country;
use App\Models\City;
use App\Models\User;
use App\Models\BookTour;
use App\Models\TourTicket;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filter_country_id                   = $request->filter_country_id;
            $filter_city_id                      = $request->filter_city_id;

            $data   = Tour::select('id', 'tour_id', 'country_id', 'city_id','city_tour_type_id','contract_id','name','review_count','rating','duration','image_path','tour_image_caption','city_tour_type','tour_short_description','cancellation_policy_name','is_slot','only_child','slug','id_slug');

            if(!empty($filter_country_id)){
                $data = $data->where('country_id',$filter_country_id);
            }

            if(!empty($filter_city_id)){
                $data = $data->where('city_id',$filter_city_id);
            }

            $data = $data->orderBy('created_at', 'desc')
            ->with('tourTicket','country','city')
            ->get();
            return datatables()::of($data)
                ->addColumn('select', function($row) {
                    return $row->id;
                })
                ->addColumn('encoded_id', function($row) {
                    return base64_encode($row->id);
                })
                ->addColumn('tour_id', function($row) {
                    return $row->tour_id;
                })
                ->addColumn('country_id', function($row) {
                    return $row->country_id;
                })
                ->addColumn('city_id', function($row) {
                    return $row->city_id;
                })
                ->addColumn('city_tour_type_id', function($row) {
                    return $row->city_tour_type_id;
                })
                ->addColumn('contract_id', function($row) {
                    return $row->contract_id;
                })
                ->addColumn('name', function($row) {
                    return $row->name;
                })
                ->addColumn('review_count', function($row) {
                    return $row->review_count;
                })
                ->addColumn('rating', function($row) {
                    return $row->rating;
                })
                ->addColumn('duration', function($row) {
                    return $row->duration;
                })
                ->addColumn('image_path', function($row) {
                    return $row->image_path;
                })
                ->addColumn('tour_image_caption', function($row) {
                    return $row->tour_image_caption;
                })
                ->addColumn('city_tour_type', function($row) {
                    return $row->city_tour_type;
                })
                ->addColumn('tour_short_description', function($row) {
                    return $row->tour_short_description;
                })
                ->addColumn('cancellation_policy_name', function($row) {
                    return $row->cancellation_policy_name;
                })
                ->addColumn('is_slot', function($row) {
                    return $row->is_slot;
                })
                ->addColumn('only_child', function($row) {
                    return $row->only_child;
                })
                ->addColumn('available_ticket', function($row) {
                    return isset($row->tourTicket->available_ticket) ? $row->tourTicket->available_ticket : '';
                })
                ->addColumn('country_name', function($row) {
                    return isset($row->country->name) ? $row->country->name : '';
                })
                ->addColumn('city_name', function($row) {
                    return isset($row->city->name) ? $row->city->name : '';
                })
                ->addColumn('book_action', function($row) {
                    return route('tour-book',$row->slug);
                })
                ->addColumn('action', function($row) {
                    $action['book_action'] = route('tour-book',$row->slug);
                    $action['id'] = $row->id;
                    return $action;
                })
                ->rawColumns(['select', 'name', 'action'])
                ->make(true);
        }

        return view('tours.index', []);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function tour_book ($slug = '')
    {
        $tours                          =  Tour::with('country','city')->where('slug',$slug)->first();
        if($tours){
            $tour_tickets               = TourTicket::where('tour_id', $tours->id)->first();
            $available_ticket           = isset($tour_tickets->available_ticket) ? $tour_tickets->available_ticket : 0;

            if($available_ticket <= 0){
                return get_fail_response(route('tour-listing'),'Tickets not available.',['redirect_url' => route('tour-listing')]);   
            }
            return view('tours.book',  compact('tours'));    
        }else{
            return get_fail_response(route('tour-listing'),'No data found.',['redirect_url' => route('tour-listing')],1);   
        }
        
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_of_ticket'          => 'required|numeric',
            'name'                  => 'required|string|max:60',
            'email'                 => 'required|string|email|max:80',
            'phone_no'              => 'required|numeric|digits_between:0000000000,9999999999',
        ],[
            'phone_no.digits_between'          => "Please enter valid phone number.",
        ]);

        $tour_id                    = (int) base64_decode($request->tour_id);
        $name                       = $request->name;
        $email                      = $request->email;
        $phone_no                   = $request->phone_no;
        $no_of_ticket               = $request->no_of_ticket;
        
        //check ticket available
        $tour_tickets               = TourTicket::where('tour_id', $tour_id)->first();
        $available_ticket           = isset($tour_tickets->available_ticket) ? $tour_tickets->available_ticket : 0;

        if($available_ticket <= 0){
            return get_fail_response(route('tour-listing'),'Tickets not available.',['redirect_url' => route('tour-listing')]);   
        }

        if($no_of_ticket > $available_ticket){
            return get_fail_response(route('tour-listing'),'Only '.$available_ticket.'tickets available.',['redirect_url' => route('tour-listing')]);   
        }

        $curret_available_ticket    = $available_ticket > 0 && $available_ticket >= $no_of_ticket ? $available_ticket - $no_of_ticket : 0;
        $curret_available_ticket    = $curret_available_ticket > 0 ? $curret_available_ticket : 0;


        //check and create users
        $users                      = User::where('email', $email)->where('is_admin',0)->first();
        if($users){
            $user_id                = isset($users->id) ? $users->id : 0;
        }else{
            $users = User::create([
                'name'       => $name,
                'email'      => $email,
                'phone_no'   => $phone_no,
                'password'   => Hash::make('Password123#'),
            ]);    
            $user_id         = isset($users->id) ? $users->id : 0;
        }
        
        $book_tour          = [
            'user_id'       => $user_id,
            'tour_id'       => $tour_id ,
            'name'          => $name,
            'email'         => $email,
            'phone_no'      => $phone_no,
            'no_of_ticket'  => $no_of_ticket,
            'status'        => config('global.general.status_pending'),
        ];
        $result = BookTour::create($book_tour);


        // $tour_ticket_update = TourTicket::where('tour_id', $tour_id)->update(['available_ticket' => $curret_available_ticket]);
        
        if($result)
        {
            $admin_user                      = User::where('is_admin',1)->first();
            $admin_email                     = isset($admin_user->email) ? $admin_user->email : 'admin@narola.email';

            $data               = [
                'admin_email'   => $admin_email,
                'mail_subject'  => "New booking from ".$name.".",
            ];

            //sent email to admin
            Mail::send('emails.book_tour', $book_tour, function ($message) use ($data) {
                $message->to($data['admin_email'])
                ->subject($data['mail_subject'])
                ->from($data['admin_email']);
            });
            
            return get_success_response(route('tour-listing'),'Apply for ticket succssfully, We will send approval via email.',['redirect_url' => route('tour-listing')]);
        }
        else
        {

            return get_fail_response(route('tour-listing'),'Something wrong! Please try again',['redirect_url' => route('tour-listing')]);
        }
    }
}
