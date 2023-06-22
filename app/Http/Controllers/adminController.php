<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Products;
use App\Models\Variations;
use App\Models\UnavailableDays;
use Validator;
use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;

class adminController extends Controller
{
    public function dashboard(){
        $bookings = Bookings::limit(5)->get();
        $products = Products::get();

        return view('admin.dashboard', compact(['bookings', 'products']));
    }
    

    public function confirmBooking(){
        $bookings = Bookings::paginate(10);
        $products = Products::get();

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

    public function showCategories(){
        $products = Products::paginate(10);


        return view('admin.products', compact(['products']));
    }

    public function showVariations(){
        $products = Products::get();

        return view('admin.variations', compact(['products']));
    }
    

    public function variationSearch(Request $request){
        $products = Products::get();
        $product_id = $request->products;
        $variations = Variations::where(['product_id' => $request->products])->get();
        session()->flashInput($request->input());
        return view('admin.variations', compact(['products', 'variations', 'product_id']));
    }

    public function updateCategory(Request $request){

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
            'product_name'=>'required|string|min:3',
            'total_slots'=>'required|numeric|gt:0',            
        ];
          
        if($request->file('prodImg')){
              $delimeters = [
                'prodImg'=>'required|mimes:jpeg,png,jpg',
                'product_name'=>'required|string|min:3',
                'total_slots'=>'required|numeric|gt:0',
              ];
        }
      
        

          $validator = Validator::make($request->all(), $delimeters, $messages);

            if ($validator->fails()) {
                return response()->json(['status'=>400, 'error'=> $validator->errors()->all()]);
            }



        $product = Products::find($request->id);
 
        $product->total_slots =  $request->total_slots;
        
        
        

        if($request->file('prodImg')){
            $path = $request->file('prodImg')->store('public');
            $imgUrl = substr($path,7);
            $product->imgUrl = $imgUrl;
        }

        $product->name = $request->product_name;
        $product->slug = strtolower(str_replace(' ', '_', $request->product_name)); 
        $product->open_saturday = ($request->open_saturday === NULL) ? 0 : 1;
        $product->open_sunday = ($request->open_sunday === NULL) ? 0 : 1;


        $product->save();

        return response()->json(['status'=>1, 'message'=>'Category updated successfully!']);
    }
    public function addCategory(Request $request){

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
                'product_image'=>'required|mimes:jpeg,png,jpg',
                'product_name'=>'required|string|min:3',
                'total_slots'=>'required|numeric|gt:0',
              ];
        
      
        

          $validator = Validator::make($request->all(), $delimeters, $messages);

            if ($validator->fails()) {
                return response()->json(['status'=>400, 'error'=> $validator->errors()->all()]);
            }



        $product = new Products;
 
        $product->total_slots =  $request->total_slots;
        
        
        

            $path = $request->file('product_image')->store('public');
            $imgUrl = substr($path,7);
            $product->imgUrl = $imgUrl;
        

        $product->name = $request->product_name;
        $product->slug = strtolower(str_replace(' ', '_', $request->product_name)); 
        $product->open_saturday = ($request->open_saturday === NULL) ? 0 : 1;
        $product->open_sunday = ($request->open_sunday === NULL) ? 0 : 1;


        $product->save();

        return response()->json(['status'=>1, 'message'=>'Category added successfully!']);
    }


    public function showUnavailable(){
       $unavailables = UnavailableDays::where('from_date_time', '>=', date('Y-m-d H:i:s', strtotime('now')))
                                        ->orwhere('to_date_time', '<=', date('Y-m-d H:i:s', strtotime('now')))
                                        ->orwhere('to_date_time', '>', date('Y-m-d H:i:s', strtotime('now')))->paginate(10);

        return view('admin.unavailable', compact(['unavailables']));
    }
    public function getCategoryDetails(Request $request){
       $variation = Variations::where(['product_id' => $request->id, 'variation_type' => $request->plan])->first();

       return response()->json(['status'=>1, 'message'=> $variation->price]);
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

     public function deleteVariation(Request $request){
        $id = $request->id; 
        $variation = Variations::find($id);
        $variation->delete();
        return response()->json(['status'=>1, 'message'=>'Your delete was successful!']);
     }
     public function deleteCategory(Request $request){
        $id = $request->id; 
        $product = Products::find($id);
        $product->delete();
        return response()->json(['status'=>1, 'message'=>'Your delete was successful!']);
     }

     public function addVariation(Request $request){

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
                'variation_type'=>'required|string',
                'price'=>'required|numeric',
            ];
      
       

          $validator = Validator::make($request->all(), $delimeters, $messages);

            if ($validator->fails()) {
                return response()->json(['status'=>400, 'error'=> $validator->errors()->all()]);
            }


            $variation_exist = Variations::where(['product_id' => $request->product_id, 'variation_type' => $request->variation_type])->get();
            if ($variation_exist->count() > 0) {
                return response()->json(['status'=>400, 'error'=> ['Variation type already exists']]);
            }

        $variation = new Variations;
        $variation->variation_type =  $request->variation_type;
        $variation->price = $request->price;
        $variation->product_id = $request->product_id;
        $variation->save();
        return response()->json(['status'=>1, 'message'=>'Variation added successfully!']);
     }
     public function updateVariation(Request $request){

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
                'variation_type'=>'required|string',
                'price'=>'required|numeric',
            ];
      
          

          $validator = Validator::make($request->all(), $delimeters, $messages);

            if ($validator->fails()) {
                return response()->json(['status'=>400, 'error'=> $validator->errors()->all()]);
            }


            $variation_exist = Variations::where(['product_id' => $request->product_id, 'variation_type' => $request->variation_type])->get();
            if ($variation_exist->count() > 0 && $variation_exist[0]->id != $request->id) {
                return response()->json(['status'=>400, 'error'=> ['Variation type already exists']]);
            }

        $id = $request->id; 
        $variation = Variations::find($id);
        $variation->variation_type =  $request->variation_type;
        $variation->price = $request->price;
        $variation->save();
        return response()->json(['status'=>1, 'message'=>'Variation updated successfully!']);
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

            $product = Products::where(['id' => $request->id])->first();

            if(!$product->open_saturday && (date('l', strtotime($request->booking_date)) == "Saturday")){
                return response()->json(['status'=>400, 'error'=> 'We do not open on Saturdays']);
            }
            if(!$product->open_sunday && (date('l', strtotime($request->booking_date)) == "Sunday")){
                return response()->json(['status'=>400, 'error'=> 'We do not open on Sundays']);
            }

            // return response()->json(['status'=>400, 'error' => $request->product]);

            switch ($request->plan) {
                case 'hourly':
                    $unavailables = UnavailableDays::where('from_date_time', '<=', date("Y-m-d", strtotime($request->booking_date) ))
                                                ->where('to_date_time', '>=', date("Y-m-d", strtotime($request->booking_date)))->get();
                    if(count($unavailables) > 0){
                        return response()->json(['status'=>400, 'error'=> 'This day is not available']); 
                    }
                                          
                    break;
                case 'daily':
                    $unavailables = UnavailableDays::where('from_date_time', '<=', date("Y-m-d", strtotime($request->booking_date) ))
                                                ->where('to_date_time', '>=', date("Y-m-d", strtotime($request->booking_date)))->get();
                    
                    if(count($unavailables) > 0){
                        return response()->json(['status'=>400, 'error'=> 'This day is not available']); 
                    }
                    break;
                case 'weekly':
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



            if(!$product->open_saturday && (date('l', strtotime($request->booking_date)) == "Saturday")){
                return response()->json(['status'=>400, 'error'=> 'We do not open on Saturdays']);
            }
            if(!$product->open_sunday && (date('l', strtotime($request->booking_date)) == "Sunday")){
                return response()->json(['status'=>400, 'error'=> 'We do not open on Sundays']);
            }

            
        $product = Products::where(['name' => $request->product])->first();
        
        $num_of_days = date("t", strtotime($request->booking_date . "- 1 month")) - 1 . " days";
        switch ($request->plan) {
            case 'hourly':
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


            case 'daily':
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
            case 'weekly':
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

        if($request->plan == "hourly"){
            return response()->json(['status'=>400, 'error'=> "The selected time slot is not available"]);
        }
        return response()->json(['status'=>400, 'error'=> "The selected day slot is not available"]);
        
     }

     public function bookCoworkspacePage(Request $request){
        $unavailables = UnavailableDays::where('from_date_time', '>', date('Y-m-d H:i:s', strtotime('now')))->paginate(10);
 
         return view('coworkspace', compact(['unavailables']));
     }

     public function welcome(){
        $products = Products::whereNot('name', 'coworkspace')->get();

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
            "Authorization: Bearer " . $_ENV['LIVE_SECRET_KEY'],
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
            // $durArr = ["Hourly" => 1, "Daily" => 2, "Weekly" => 3, "Monthly"=> 4];
            $booking->duration = $request->duration;
            $booking->quantity =  $request->no_of_seats;
            
            

            switch ($request->plan) {
                case 'hourly':
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


        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 1;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = false;
        $mail->Username = $_ENV['EMAIL_USERNAME'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
        $mail->setFrom($_ENV['EMAIL_USERNAME'],'hub.shecluded.com');
        $mail->addAddress($request->email, $request->name);
        $mail->Subject =  $request->subject;
        $mail->isHTML(true);
        $mail->Body = '  <html> 
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
        
        $mail->send();
       
           
    }
}
