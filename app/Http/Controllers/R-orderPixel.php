<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Image;
use App\Models\OrderPixel;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\ImageInterface;
use FFMpeg;
use App\Models\PixelsLeft;
use App\Models\payment;
use Storage;
use Http;

class OrderPixelController extends Controller
{


  
  
    /**
     * Init view.
     */
    public function resizeImage()
    {
        return view('resizeImage');
    }
  
    /**
     * Image resize
     */
    // public function resizeImagePost(Request $request)
    // {
    //     $size = $request->input('width');
    //     $size_order = $request->input('width_order');
    //     $time = time();

    //     $this->validate($request, [
    //         'url' => 'required',
    //         'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif',
    //         'gif' => 'required|mimes:mp4'
    //     ]);

    //     $gif = $request->file('gif');
    //     $gif_name = $gif->getFilename();
    //     
    //     $image = $request->file('image');
    //     $input['imagename'] = Auth::user()->id.'_'.$time.'.'.$image->extension();
    //     
    //     $filePath = public_path('/thumbnails');
    //     $img = Image::make($image->path());
    //     $img->resize($size, $size, function ($const) {
    //         
    //     })->save($filePath.'/'.$input['imagename']);
    //     
    //     $filePath = public_path('/images');
    //     $videoFilePath = public_path('/videofile');
    //     $image->move($filePath, $input['imagename']);
    //     
    //     $gif->move($videoFilePath, $gif_name);
    //     // return back()
    //     //     ->with('success','Image uploaded')
    //     //     ->with('fileName',$input['imagename']);

    //     return view('selectPixelMaps', ['size' => $size, 'size_order' => $size_order, 'image_name' => $input['imagename'], 'url' => $request->input('url'), 'gif_name' => $gif_name]);
    // }


    public function resizeImagePost(Request $request)
    {
        $size = $request->input('pixels');

        // $size = $request->input('width');
        // $size_order = $request->input('width_order');
        $size_order = $size;
        $time = time();

        switch ($size) {
            case '25':
                $size = 5;
                break;
            case '100':
                $size = 10;
                break;
            case '225':
                $size = 15;
                break;
            case '400':
                $size = 20;
                break;
            case '625':
                $size = 25;
                break;
            case '900':
                $size = 30;
                break;
            case '1225':
                $size = 35;
                break;
            case '1600':
                $size = 40;
                break;
            case '2025':
                $size = 45;
                break;
            case '2500':
                $size = 50;
                break;
            case '3025':
                $size = 55;
                break;
            case '3600':
                $size = 60;
                break;
            case '4225':
                $size = 65;
                break;
            case '4900':
                $size = 70;
                break;
            case '5625':
                $size = 75;
                break;
            case '6400':
                $size = 80;
                break;
            case '7225':
                $size = 85;
                break;
            case '8100':
                $size = 90;
                break;
            case '9025':
                $size = 95;
                break;
            case '10000':
                $size = 100;
                break;
        }


        if($size < 50) {
            $reSize = 50;
        } else {
            $reSize = $size;
        }

        $this->validate($request, [
            'url' => 'required',
            'gif' => 'required|mimes:gif'
        ]);


        $getVideo = $request->file('video');
        $video_name = $getVideo->getClientOriginalName();

        $getVideo->move(public_path('/videofile/'), $video_name);


        $time = time();
        
        $gif = Auth::user()->id.'_'.time().'.gif';
        
        $clipFilter = new \FFMpeg\Filters\Video\ClipFilter(\FFMpeg\Coordinate\TimeCode::fromSeconds(0), \FFMpeg\Coordinate\TimeCode::fromSeconds(5));
        $clip_file = Auth::user()->id.'_clip_'.$time.'.wmv';

        FFMpeg::fromDisk('videos')
            ->open($video_name)
            ->export()
            ->addFilter($clipFilter)
            ->inFormat(new \FFMpeg\Format\Video\WMV)
            ->save($clip_file);


        $asd2 = FFMpeg::fromDisk('videos')
            ->open($clip_file);
            
        $asd2->filters()->resize(new FFMpeg\Coordinate\Dimension($reSize, $reSize));
        $asd2->save(new FFMpeg\Format\Video\WMV(), 'videofile/'.Auth::user()->id.'_resize_'.$time.'.wmv');
            
            

       $toGif = FFMpeg::fromDisk('videos')
        ->open(Auth::user()->id.'_resize_'.$time.'.wmv')
        ->export()
        ->toDisk('gif')
        ->inFormat(new \FFMpeg\Format\Audio\Aac)
        ->save($gif);

        // dd($toGif);




        return view('selectPixelMaps', ['size' => $size, 'size_order' => $size_order, 'url' => $request->input('url'), 'gif_name' => $gif, 'data' => OrderPixel::all()]);
    }


    public function OrderPixels(Request $request)
    {

        $X = $request->input('maps_coords_x');
        $Y = $request->input('maps_coords_y');
        $gif = $request->input('gif_name');
        $size = $request->input('size');
        $size_order = $request->input('size_order');
        $url = $request->input('url');

        $url = str_replace('@', '', $url);

        $X2 = $X + $size;
        $Y2 = $Y + $size;

        // Проверка не заняты ли выбранные пиксели
        $size = $request->size;
        
        $result = OrderPixel::where('X', '<=', $X2)
                            ->where('X2', '>=', $X)
                            ->where('Y2', '>=', $Y)
                            ->where('Y', '<=', $Y2)->first();

        if($result) {
            return view('selectPixelMaps', ['size' => $size, 'size_order' => $size_order, 'url' => $request->input('url'), 'gif_name' => $gif, 'data' => OrderPixel::all()]);
        }

        // END Проверка не заняты ли выбранные пиксели


        // $coords = $maps_coords_x.', '.$maps_coords_y.', '.$maps_coords_x_2.', '.$maps_coords_y_2;

        // $position = 'left: '.$maps_coords_x.'px; top: '.$maps_coords_y.'px;';


        $createOrder = OrderPixel::create([
            'user_id' => Auth::user()->id,
            'name_gif' => $gif,
            'X' => $X,
            'Y' => $Y,
            'X2' => $X2,
            'Y2' => $Y2,
            'size' => $size,
            'url' => $url,
        ]);

        return $this->getPaymendLink($createOrder->id, $size_order);
  
    }

    public function Test()
    {   
        $id = Auth::user()->id;
        $phone = Auth::user()->phone;
        $email = Auth::user()->email;
        
        // $getAllPixels = OrderPixel::all();
        $response = Http::post('https://secure.octo.uz/prepare_payment', [
            "octo_shop_id" => 4525,
            "octo_secret" => "e3f3e95c-f98c-4a84-8f7c-1ace1cfa1cd6",
            "shop_transaction_id" => "",
            "auto_capture" => true,
            "test" => true,
            "init_time" => date('Y-m-d H:m:s'),
            "user_data" => [
              "user_id" => $id,
              "phone" => $phone,
              "email" => $email
            ],
            "total_sum" => 103.33,
            "currency" => "UZS",
            "description" => "Название платежа, например: Авиаперелет Москва-Сингапур",
            "tsp_id" => 18,
            "return_url" => "http://merchant.site.uz/return_URL"
        ]);

        $rp = $response->json();
        dd($rp);

    }

    public function test1() {
        return view('test');
    }


    public function getPaymendLink($order_id, $sum)
    {   

        $user_id = Auth::user()->id;
        $phone = Auth::user()->phone;
        $email = Auth::user()->email;

        // $amount = $request->input('amount');
        
        
        // $getAllPixels = OrderPixel::all();
        $response = Http::post('https://secure.octo.uz/prepare_payment', [
            "octo_shop_id" => 4525,
            "octo_secret" => "e3f3e95c-f98c-4a84-8f7c-1ace1cfa1cd6",
            "shop_transaction_id" => $order_id,
            "auto_capture" => true,
            "test" => true,
            "init_time" => date('Y-m-d H:m:s'),
            "user_data" => [
              "user_id" => $user_id,
              "order_id" => $order_id,
              "phone" => $phone,
              "email" => $email
            ],
            "total_sum" => $sum,
            "currency" => "UZS",
            "description" => "Buying pixels. OrderID: $order_id",
            "return_url" => "https://milliontiktokershomepage.com/"
        ]);

        $rp = $response->json();

        payment::create([
            'order_id' => $order_id,
            'UUID' => $rp['octo_payment_UUID'],
        ]);

        return response()->view('pay', 
        [
            'link' => $rp['octo_pay_url'], 
            'sum' => $sum
        ]);

    }



    public function getPixels()
    {

        $getAllPixels = OrderPixel::all();
        return view('home', ['data' => $getAllPixels]);
    }


    public function responsePay(Request $request) {



        $request->status;
        if($request->status == 'succeeded') {
            payment::where("UUID", $request->octo_payment_UUID)->update(['status' => $request->payed_time]);

            $getPixelsLeft = PixelsLeft::all()->first();

            $sold = $request->total_sum + $getPixelsLeft->sold;
            $available = $getPixelsLeft->available - $request->total_sum;

            PixelsLeft::where("id", 1)->update(['available' => $available, 'sold' => $sold]);
        }
    }

    public function checkPixelsPlace(Request $request) {
        
        $X = $request->X;
        $Y = $request->Y;

        $size = $request->size;

        $X2 = $request->X + $size;
        $Y2 = $request->Y + $size;
        
        $result = OrderPixel::where('X', '<=', $X2)
                            ->where('X2', '>=', $X)
                            ->where('Y2', '>=', $Y)
                            ->where('Y', '<=', $Y2)->first();
        

        /*
        $result = OrderPixel::havingBetween('X', [$X, $X2])
                            ->havingBetween('Y', [$Y, $Y2])
                            ->havingBetween('X2', [$X, $X2])
                            ->havingBetween('Y2', [$Y, $Y2])->first();
        */
        if($result) {
            return true;
        } else {
            return false;
        }
    }

}
