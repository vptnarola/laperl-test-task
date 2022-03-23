<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class AdminBookTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data   = BookTour::select('id', 'user_id', 'tour_id', 'no_of_ticket','status','name','email','phone_no','slug','id_slug')
                                ->orderBy('created_at', 'desc')
                                ->with('tour','user')
                                ->get();
            return datatables()::of($data)
                ->addColumn('select', function($row) {
                    return $row->id;
                })
                ->addColumn('encoded_id', function($row) {
                    return base64_encode($row->id);
                })
                ->addColumn('encoded_tour_id', function($row) {
                    return base64_encode($row->tour_id);
                })
                ->addColumn('tour_id', function($row) {
                    return $row->tour_id;
                })
                ->addColumn('user_id', function($row) {
                    return $row->user_id;
                })
                ->addColumn('name', function($row) {
                    return ucfirst($row->name);
                })
                ->addColumn('email', function($row) {
                    return $row->email;
                })
                ->addColumn('phone_no', function($row) {
                    return $row->phone_no;
                })
                ->addColumn('available_ticket', function($row) {
                    return isset($row->tour->tourTicket->available_ticket) ? $row->tour->tourTicket->available_ticket : '';
                })
                ->addColumn('status_text', function($row) {
                    return ucfirst(strtolower($row->status));
                })
                ->addColumn('tour_name', function($row) {
                    return isset($row->tour->name) ? $row->tour->name : '';
                })
                ->addColumn('user_name', function($row) {
                    return isset($row->user->name) ? $row->user->name : '';
                })
                ->addColumn('confirm_book_action', function($row) {
                    return route('admin/confirm-tour-book',$row->slug);
                })
                ->addColumn('action', function($row) {
                    $action['confirm_book_action'] = route('admin/confirm-tour-book',$row->slug);
                    $action['id'] = $row->id;
                    return $action;
                })
                ->rawColumns(['select', 'name', 'action'])
                ->make(true);
        }

        return view('admin.tours.index', []);
    }

    public function confirm_tour_book(Request $request)
    {
        $book_tour_id               = (int) base64_decode($request->book_tour_id);
        $tour_id                    = (int) base64_decode($request->tour_id);
        
        //get book tour detail
        $book_tour_detail           = BookTour::where('id', $book_tour_id)->first();

        if(!$book_tour_detail){
            return get_fail_response(route('admin/tour-listing'),'No data found.',['redirect_url' => route('admin/tour-listing')]); 
        }

        $tour_id                    = isset($book_tour_detail->tour_id) ? $book_tour_detail->tour_id : 0;
        $status                     = isset($book_tour_detail->status) ? $book_tour_detail->status : 0;
        $no_of_ticket               = isset($book_tour_detail->no_of_ticket) ? $book_tour_detail->no_of_ticket : 0;
        $tour_name                  = isset($book_tour_detail->tour->name) ? $book_tour_detail->tour->name : '';
        $user_name                  = isset($book_tour_detail->name) ? $book_tour_detail->name : '';
        $user_email                 = isset($book_tour_detail->email) ? $book_tour_detail->email : '';
        $user_phone_no              = isset($book_tour_detail->phone_no) ? $book_tour_detail->phone_no : '';

        //check book tour status
        if($status == config('global.general.status_confirm')){
            return get_fail_response(route('admin/tour-listing'),'Ticket already confirm.',['redirect_url' => route('admin/tour-listing')]);
        }
        if($status == config('global.general.status_cancel')){
            return get_fail_response(route('admin/tour-listing'),'Ticket already cancel.',['redirect_url' => route('admin/tour-listing')]);
        }

        //check ticket available
        $tour_tickets               = TourTicket::where('tour_id', $tour_id)->first();
        $available_ticket           = isset($tour_tickets->available_ticket) ? $tour_tickets->available_ticket : 0;

        if($available_ticket <= 0){
            return get_fail_response(route('tour-listing'),'Tickets not available.',['redirect_url' => route('admin/tour-listing')]);   
        }

        if($no_of_ticket > $available_ticket){
            return get_fail_response(route('tour-listing'),'Only '.$available_ticket.'tickets available.',['redirect_url' => route('admin/tour-listing')]);   
        }

        $curret_available_ticket    = $available_ticket > 0 && $available_ticket >= $no_of_ticket ? $available_ticket - $no_of_ticket : 0;
        $curret_available_ticket    = $curret_available_ticket > 0 ? $curret_available_ticket : 0;


        $result                     = BookTour::where('id', $book_tour_id)->update(['status' => config('global.general.status_confirm')]);
        
        if($result)
        {
            $tour_ticket_update         = TourTicket::where('tour_id', $tour_id)->update(['available_ticket' => $curret_available_ticket]);

            $data               = [
                'user_email'    => $user_email,
                'mail_subject'  => "Your ".$tour_name." ticket is confirm.",
            ];

            $book_tour          = [
                'name'          => $user_name,
                'email'         => $user_email,
                'phone_no'      => $user_phone_no,
                'tour_name'     => $tour_name,
                'no_of_ticket'  => $no_of_ticket,
                'status'        => ucfirst(strtolower(config('global.general.status_confirm'))),
            ];
            //sent email to admin
            Mail::send('emails.user_book_tour', $book_tour, function ($message) use ($data) {
                $message->to($data['user_email'])
                ->subject($data['mail_subject'])
                ->from($data['user_email']);
            });
            
            return get_success_response(route('admin/tour-listing'),'Ticket confirm succssfully.',['redirect_url' => route('admin/tour-listing')]);
        }
        else
        {

            return get_fail_response(route('admin/tour-listing'),'Something wrong! Please try again',['redirect_url' => route('admin/tour-listing')]);
        }
    }

    public function cancel_tour_book(Request $request)
    {
        $book_tour_id               = (int) base64_decode($request->book_tour_id);
        $tour_id                    = (int) base64_decode($request->tour_id);
        
        //get book tour detail
        $book_tour_detail           = BookTour::where('id', $book_tour_id)->first();

        if(!$book_tour_detail){
            return get_fail_response(route('admin/tour-listing'),'No data found.',['redirect_url' => route('admin/tour-listing')]); 
        }

        $tour_id                    = isset($book_tour_detail->tour_id) ? $book_tour_detail->tour_id : 0;
        $status                     = isset($book_tour_detail->status) ? $book_tour_detail->status : 0;
        $no_of_ticket               = isset($book_tour_detail->no_of_ticket) ? $book_tour_detail->no_of_ticket : 0;
        $tour_name                  = isset($book_tour_detail->tour->name) ? $book_tour_detail->tour->name : '';
        $user_name                  = isset($book_tour_detail->name) ? $book_tour_detail->name : '';
        $user_email                 = isset($book_tour_detail->email) ? $book_tour_detail->email : '';
        $user_phone_no              = isset($book_tour_detail->phone_no) ? $book_tour_detail->phone_no : '';

        //check book tour status
        if($status == config('global.general.status_confirm')){
            return get_fail_response(route('admin/tour-listing'),'Ticket already confirm.',['redirect_url' => route('admin/tour-listing')]);
        }
        if($status == config('global.general.status_cancel')){
            return get_fail_response(route('admin/tour-listing'),'Ticket already cancel.',['redirect_url' => route('admin/tour-listing')]);
        }


        $result                     = BookTour::where('id', $book_tour_id)->update(['status' => config('global.general.status_cancel')]);
        
        if($result)
        {
            $data               = [
                'user_email'    => $user_email,
                'mail_subject'  => "Your ".$tour_name." ticket is cancel.",
            ];

            $book_tour          = [
                'name'          => $user_name,
                'email'         => $user_email,
                'phone_no'      => $user_phone_no,
                'tour_name'     => $tour_name,
                'no_of_ticket'  => $no_of_ticket,
                'status'        => ucfirst(strtolower(config('global.general.status_cancel'))),
            ];
            //sent email to admin
            Mail::send('emails.user_book_tour', $book_tour, function ($message) use ($data) {
                $message->to($data['user_email'])
                ->subject($data['mail_subject'])
                ->from($data['user_email']);
            });
            
            return get_success_response(route('admin/tour-listing'),'Ticket cancel succssfully.',['redirect_url' => route('admin/tour-listing')]);
        }
        else
        {
            return get_fail_response(route('admin/tour-listing'),'Something wrong! Please try again',['redirect_url' => route('admin/tour-listing')]);
        }
    }

}
