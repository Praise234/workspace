<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Products;
use App\Models\UnavailableDays;
use Validator;

class adminController extends Controller
{
    public function dashboard(){
        $bookings = Bookings::limit(5)->get();
        $products = Products::whereNot('name', 'children_playroom')->get();

        return view('admin.dashboard', compact(['bookings', 'products']));
    }
    

    public function confirmBooking(){
        $bookings = Bookings::paginate(10);
        $products = Products::whereNot('name', 'coworkspace_weekly')
                            ->whereNot('name', 'coworkspace_monthly')
                            ->whereNot('name', 'children_playroom')->get();

        return view('admin.confirm', compact(['bookings', 'products']));
    }

    public function confirmBooking_search(Request $request){
        $old = $request;
        $bookings = Bookings::where('customer_name', 'like', "%" . $request->customer_name . "%")
                            ->where('product', 'like', "%" . $request->products . "%")
                            ->where('created_at', 'like', "%" . $request->date_paid . "%")->paginate(10);
        $products = Products::get();
        return view('admin.confirm', compact(['bookings', 'products', 'old']));
    }

    public function showProducts(Request $request){
        $prod_name = "";
        switch ($request->product_name) {
            case 'coworkspace':
                $prod_name = "COWORKSPACE";
                break;
            case 'private_offices':
                $prod_name = "PRIVATE OFFICE";
                break;
            case 'meeting_room':
                $prod_name = "MEETING ROOM";
                break;
            case 'virtual_office':
                $prod_name = "VIRTUAL OFFICE";
                break;
            case 'children_playroom':
                $prod_name = "CHILDREN PLAYROOM";
                break;
            
            default:
                $prod_name = "EVENT SPACE";
                break;
        }

        $product_name = $request->product_name;

        $products = Products::where(['name' => $product_name])->get();
        return view('admin.products', compact(['prod_name', 'products']));
    }

    public function updateProduct(Request $request){

        $messages = [
            'required' => 'The :attribute is required',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'min'      => 'The :attribute must have a minimum length of :min',
            'max'      => 'The :attribute must have a maximum length of :max',
            'numeric'      => 'The :attribute must be numeric',
            'digits_between'      => 'The :attribute must be 11 digits',
            'digits'      => 'The :attribute must be :digits digits',
            'exists'      => 'The :attribute does not exist',
            'unique'      => 'The :attribute already exist',
            'gte'      => 'The :attribute must be greater than :gte',
            'file'    => 'The :attribute must be a file',
            'gt'      => 'The :attribute must be greater than 0',
            'mimes'      => 'The image must be jpeg,png or jpg',
          ];
          

          $delimeters = [
            'total_slots'=>'required|numeric|gt:0',
            
        ];
          if($request->product_name !== 'coworkspace'){
            $delimeters = [
                'total_slots'=>'required|numeric|gt:0',
                'price'=>'required|numeric|gt:0',
            ];
        }
        if($request->file('prodImg') && $request->product_name !== 'coworkspace'){
              $delimeters = [
                'prodImg'=>'required|mimes:jpeg,png,jpg',
                'total_slots'=>'required|numeric|gt:0',
                'price'=>'required|numeric|gt:0',
              ];
        }
        if($request->file('prodImg') && $request->product_name == 'coworkspace'){
              $delimeters = [
                'prodImg'=>'required|mimes:jpeg,png,jpg',
                'total_slots'=>'required|numeric|gt:0',
               
              ];
        }

       

          $validator = Validator::make($request->all(), $delimeters, $messages);

            if ($validator->fails()) {
                return back()->withErrors($validator->errors()->all());
            }












        $prod_name = "";
        switch ($request->product_name) {
            case 'coworkspace':
                $prod_name = "COWORKSPACE";
                break;
            case 'private_offices':
                $prod_name = "PRIVATE OFFICE";
                break;
            case 'meeting_room':
                $prod_name = "MEETING ROOM";
                break;
            case 'virtual_office':
                $prod_name = "VIRTUAL OFFICE";
                break;
            case 'children_playroom':
                $prod_name = "CHILDREN PLAYROOM";
                break;
            
            default:
                $prod_name = "EVENT SPACE";
                break;
        }

        $product_name = $request->product_name;

        
        $products = Products::where(['name' => $product_name])->get();
        $product = Products::find($products[0]['id']);
 
        $product->total_slots =  $request->total_slots;
        if($request->product_name !== 'coworkspace'){
            $product->price = $request->price;
        }
        
        

        if($request->file('prodImg')){
            $path = $request->file('prodImg')->store('public');
            $imgUrl = substr($path,7);
            $product->imgUrl = $imgUrl;
        }

        $product->save();

        $products = Products::where(['name' => $product_name])->get();
        return view('admin.products', compact(['prod_name', 'products']))->withSuccess('Your update was successful');
    }


    public function showUnavailable(){
       $unavailables = UnavailableDays::where('from_date_time', '>=', date('Y-m-d H:i:s', strtotime('now')))
                                        ->orwhere('to_date_time', '<=', date('Y-m-d H:i:s', strtotime('now')))
                                        ->orwhere('to_date_time', '>', date('Y-m-d H:i:s', strtotime('now')))->paginate(10);

        return view('admin.unavailable', compact(['unavailables']));
    }

    public function updateUnavailable(Request $request){
        $id = $request->id; 
        $unavailable = UnavailableDays::find($id);
        $unavailable->from_date_time =  $request->from_date_time;
        $unavailable->to_date_time = $request->to_date_time;
        $unavailable->save();
 
         return redirect()->back()->withSuccess('Your update was successful');
     }

     public function deleteUnavailable(Request $request){
        $id = $request->id; 
        $unavailable = UnavailableDays::find($id);
        $unavailable->delete();
        return response()->json(['status'=>1, 'message'=>'Your delete was successful!']);
     }

     public function addUnavailable(Request $request){
        $unavailable = new UnavailableDays;
        $unavailable->from_date_time =  $request->from_date_time;
        $unavailable->to_date_time = $request->to_date_time;
        $unavailable->save();
        return redirect()->back()->withSuccess('Addition was successful');
     }

     public function loginUser(Request $request){
        if($request->username == "admin1" && $request->password == "sheCluded@2023"){
            \Session::put('user', 'admin');
            return redirect(Route('dashboard'));
        }
        return redirect()->back()->withErrors('Incorrect Username or Password');
     }
     public function logout(){
        if(Session()->has('user')){
            Session()->pull('user');
        }
        return redirect(Route('login'));
     }

     public function checkCoworkspaceAvailability(Request $request){

        $messages = [
            'required' => 'The :attribute is required',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'min'      => 'The :attribute must have a minimum length of :min',
            'max'      => 'The :attribute must have a maximum length of :max',
            'numeric'      => 'The :attribute must be numeric',
            'digits_between'      => 'The :attribute must be 11 digits',
            'digits'      => 'The :attribute must be :digits digits',
            'exists'      => 'The :attribute does not exist',
            'unique'      => 'The :attribute already exist',
            'gte'      => 'The :attribute must be greater than :gte',
            'file'    => 'The :attribute must be a file',
            'gt'      => 'The :attribute must be greater than 0',
            'mimes'      => 'The image must be jpeg,png or jpg',
            'after_or_equal'      => 'The :attribute must be on or after ' . date("Y-m-d", strtotime("now")),
          ];
          
          $delimeters = [
            'booking_date'=>'required|date|after_or_equal:' . date("Y-m-d", strtotime("now")),
            'plan'=>'required|string',
            'no_of_seats'=>'required|numeric|gt:0',
          ];
        
       

          $validator = Validator::make($request->all(), $delimeters, $messages);

            if ($validator->fails()) {
                return response()->json(['status'=>400, 'error'=> implode("<br />", $validator->errors()->all())]);
            }

            if($request->product !== "meeting_room" && $request->product !== "event_space" && (date('l', strtotime($request->booking_date)) == "Saturday" || date('l', strtotime($request->booking_date)) == "Sunday")){
                return response()->json(['status'=>400, 'error'=> 'We do not open on Saturdays and Sundays']);
            }

            // return response()->json(['status'=>400, 'error' => $request->product]);

            switch ($request->plan) {
                case 'Hourly':
                    $unavailables = UnavailableDays::where('from_date_time', '<=', date("Y-m-d", strtotime($request->booking_date) ))
                                                ->where('to_date_time', '>=', date("Y-m-d", strtotime($request->booking_date)))->get();
                    if(count($unavailables) > 0){
                        return response()->json(['status'=>400, 'error'=> 'This day is not available']); 
                    }
                                          
                    break;
                case 'Daily':
                    $unavailables = UnavailableDays::where('from_date_time', '<=', date("Y-m-d", strtotime($request->booking_date) ))
                                                ->where('to_date_time', '>=', date("Y-m-d", strtotime($request->booking_date)))->get();
                    
                    if(count($unavailables) > 0){
                        return response()->json(['status'=>400, 'error'=> 'This day is not available']); 
                    }
                    break;
                case 'Weekly':
                    $unavailables = UnavailableDays::where('from_date_time', '<=', date("Y-m-d 00:00:00", strtotime($request->booking_date)))
                                                ->where('to_date_time', '>=', date("Y-m-d 00:00:00", strtotime($request->booking_date)))
                                                ->orwhere(function($query) use ($request) {
                                                    $query->where('from_date_time', '<=', date("Y-m-d 00:00:00", strtotime($request->booking_date . "+ 7 days")))
                                                            ->where('to_date_time', '>=', date("Y-m-d 00:00:00", strtotime($request->booking_date . "+ 7 days")));
                                                        
                                                    })->get();
                    if(count($unavailables) > 0){
                        $days = [];
                        foreach($unavailables as $unavailable){
                            array_push($days, date("l, F d, Y", strtotime($unavailable->from_date_time)) . " - " . date("l, F d, Y", strtotime($unavailable->to_date_time)));
                        }
                        return response()->json(['status'=>404, 'error'=> 'Some of the days within your choice are not availabie: <br />' . implode("<br /> ", $days)]); 
                    }
                    break;
                default:
                    $num_of_days = date("t", strtotime($request->booking_date . "- 1 month")) - 1 . " days";
                    $unavailables = UnavailableDays::where('from_date_time', '<=', date("Y-m-d 00:00:00", strtotime($request->booking_date)))
                    ->where('to_date_time', '>=', date("Y-m-d 00:00:00", strtotime($request->booking_date)))
                    ->orwhere(function($query) use ($request, $num_of_days) {
                        $query->where('from_date_time', '<=', date("Y-m-d 00:00:00", strtotime($request->booking_date . "+ " . $num_of_days)))
                                ->where('to_date_time', '>=', date("Y-m-d 00:00:00", strtotime($request->booking_date . "+ " . $num_of_days)));
                            
                        })->get();

                    if(count($unavailables) > 0){
                        $days = [];
                        foreach($unavailables as $unavailable){
                            array_push($days, date("l, F d, Y", strtotime($unavailable->from_date_time)) . " - " . date("l, F d, Y", strtotime($unavailable->to_date_time)));
                        }
                        return response()->json(['status'=>404, 'error'=> 'Some of the days within your choice are not availabie: <br />' . implode("<br />", $days)]); 
                    }
                    break;
            }



            if($request->product !== "meeting_room" && $request->product !== "event_space" && (date('l', strtotime($request->booking_date)) == "Saturday" || date('l', strtotime($request->booking_date)) == "Sunday")){
                return response()->json(['status'=>400, 'error'=> 'We do not open on Saturdays and Sundays']);
            }

            
        $product = Products::where(['name' => $request->product])->first();
        
        $num_of_days = date("t", strtotime($request->booking_date . "- 1 month")) - 1 . " days";
        switch ($request->plan) {
            case 'Hourly':
                $check = Bookings::where(['product' => $request->product, 'booked_date_time' => date("Y-m-d H:i:s", strtotime($request->booking_date . " " . $request->booking_time))])
                                ->orwhere(function($query) use ($request, $num_of_days) {
                                    $query->where(['product' => $request->product])
                                        ->whereBetween('booked_date_time', [date("Y-m-d H:i:s", strtotime($request->booking_date . " " . $request->booking_time)), 
                                                                                date("Y-m-d H:i:s", strtotime($request->booking_date . " " . $request->booking_time . " + 1 hour"))]);
                                })
                                ->orwhere(function($query1) use ($request, $num_of_days) {
                                    $query1->where(['product' => $request->product])
                                        ->whereBetween('booked_date_time', [date("Y-m-d H:i:s", strtotime($request->booking_date . " " . $request->booking_time . " - 1 hour")), 
                                                                                date("Y-m-d H:i:s", strtotime($request->booking_date . " " . $request->booking_time))]);
                                });
                break;


            case 'Daily':
                $check = Bookings::where(['product' => $request->product])
                                ->where(function($query) use ($request, $num_of_days) {
                                    $query->where('booked_date_time', '=', date("Y-m-d", strtotime($request->booking_date)))
                                        ->orWhere('duration', '=', 3)
                                        ->where(function($query2) use ($request, $num_of_days) {
                                            $query2->whereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date . "- 7 days")), date("Y-m-d", strtotime($request->booking_date))])
                                                    ->where('booked_date_time', '<', date("Y-m-d", strtotime($request->booking_date)));
                                                 })
                                        ->orWhere('duration', '=', 4)
                                        ->where(function($query3) use ($request, $num_of_days) {
                                            $query3->whereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date . "- " . $num_of_days)), date("Y-m-d", strtotime($request->booking_date))])
                                                    ->where('booked_date_time', '<', date("Y-m-d", strtotime($request->booking_date)));
                                                });
                                    });
                break;
            case 'Weekly':
                $check = Bookings::where(['product' => $request->product])
                ->where(function($query) use ($request, $num_of_days) {
                    $query->where('booked_date_time', '=', date("Y-m-d", strtotime($request->booking_date)))
                        ->orWhere('duration', '=', 3)
                        ->where(function($query2) use ($request, $num_of_days) {
                            $query2->whereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date . "- 7 days")), date("Y-m-d", strtotime($request->booking_date))])
                                    ->orWhereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date)), date("Y-m-d", strtotime($request->booking_date . "+ 7 days"))]);
                                 })
                        ->orWhere('duration', '=', 4)
                        ->where(function($query3) use ($request, $num_of_days) {
                            $query3->whereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date . "- " . $num_of_days)), date("Y-m-d", strtotime($request->booking_date))])
                                    ->orWhereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date)), date("Y-m-d", strtotime($request->booking_date . "- " . $num_of_days))]);
                                });
                    });
                break;
            default:
                $check = Bookings::where(['product' => $request->product])
                ->where(function($query) use ($request, $num_of_days) {
                    $query->where('booked_date_time', '=', date("Y-m-d", strtotime($request->booking_date)))
                        ->orWhere('duration', '=', 3)
                        ->where(function($query2) use ($request, $num_of_days) {
                            $query2->whereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date . "- 7 days")), date("Y-m-d", strtotime($request->booking_date))])
                                    ->orWhereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date)), date("Y-m-d", strtotime($request->booking_date . "+ 7 days"))]);
                                })
                        ->orWhere('duration', '=', 4)
                        ->where(function($query3) use ($request, $num_of_days) {
                            $query3->whereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date . "- " . $num_of_days)), date("Y-m-d", strtotime($request->booking_date))])
                                    ->orWhereBetween('booked_date_time', [date("Y-m-d", strtotime($request->booking_date)), date("Y-m-d", strtotime($request->booking_date . "- " . $num_of_days))]);
                                });
                    });
                break;
        }

        if(($product->total_slots - $check->sum('quantity')) >= $request->no_of_seats){
            return response()->json(['status'=>1, 'message' => "The selected date is available"]);
        }

        if($request->plan == "Hourly"){
            return response()->json(['status'=>400, 'error'=> "The selected time slot is not available"]);
        }
        return response()->json(['status'=>400, 'error'=> "The selected day slot is not available"]);
        
     }

     public function bookCoworkspacePage(Request $request){
        $unavailables = UnavailableDays::where('from_date_time', '>', date('Y-m-d H:i:s', strtotime('now')))->paginate(10);
 
         return view('coworkspace', compact(['unavailables']));
     }

     public function welcome(){
        $products = Products::whereNot('name', 'coworkspace')
                                ->whereNot('name', 'coworkspace_weekly')
                                ->whereNot('name', 'coworkspace_monthly')
                                ->whereNot('name', 'children_playroom')->get();

        $coworkspace = Products::where(['name' => 'coworkspace'])->get();
 
         return view('welcome', compact(['products', 'coworkspace']));
     }
     public function BookNow(Request $request){
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $request->reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $result = json_decode($response, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $booking = new Bookings;
            $booking->customer_name =  $request->cus_name;
            $booking->product = $request->product;
            $booking->amount_paid =  $result['data']['amount'] / 100;
            $durArr = ["Hourly" => 1, "Daily" => 2, "Weekly" => 3, "Monthly"=> 4];
            $booking->duration = $durArr[$request->duration];
            $booking->quantity =  $request->no_of_seats;
            
            

            switch ($request->plan) {
                case 'Hourly':
                    $booking->booked_date_time = date("Y-m-d H:i:s", strtotime($request->booking_date . " " . $request->booking_time));
                    break;
                default:
                    $booking->booked_date_time = date("Y-m-d 00:00:00", strtotime($request->booking_date));
                    break;
            }
            $booking->save();

            echo $result['data']['status'];
        }
     }
     public function SendMail(Request $request){
        $to = 'pakzzy207@gmail.com'; 
        $from = 'hello@shecluded.com'; 
        $fromName = $request->name; 
        
        $subject = $request->subject; 
        
        $htmlContent = $request->email . " " . $request->comments . ' 
            <html> 
            <head> 
                <title>Welcome to CodexWorld</title> 
            </head> 
            <body> 
            <img src="images/logo.png" />
                <h1>Thanks you for joining with us!</h1> 
                <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                    <tr> 
                        <th>Name:</th><td>CodexWorld</td> 
                    </tr> 
                    <tr style="background-color: #e0e0e0;"> 
                        <th>Email:</th><td>contact@codexworld.com</td> 
                    </tr> 
                    <tr> 
                        <th>Website:</th><td><a href="http://www.codexworld.com">www.codexworld.com</a></td> 
                    </tr> 
                </table> 
            </body> 
            </html>'; 

            // Set content-type header for sending HTML email 
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        
        // Additional headers 
        $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
        
        // Send email 
        if(mail($to, $subject, $htmlContent, $headers)){ 
            echo 'Email has sent successfully.'; 
        }else{ 
            echo 'Email sending failed.'; 
        }
    }
}
