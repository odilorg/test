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
  
    public function resizeImagePost(Request $request)
    {
        $size = $request->input('pixels');

        $size_order = $size;
        $time = time();

        switch ($size) {
            case '100':
                $size = 10;
                break;
            case '400':
                $size = 20;
                break;
            case '900':
                $size = 30;
                break;
            case '1600':
                $size = 40;
                break;
            case '2500':
                $size = 50;
                break;
            case '3600':
                $size = 60;
                break;
            case '4900':
                $size = 70;
                break;
            case '6400':
                $size = 80;
                break;
            case '8100':
                $size = 90;
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
            'gif' => 'required|mimes:gif|max:1000'
        ]);

        
        $gif_name = Auth::user()->id.'_'.$time.'.gif';
        
        $gif = $request->file('gif');
        $_gif_name = $gif->getClientOriginalName();


        $gif->move(public_path('/videofile/'), $_gif_name);

            
        FFMpeg::fromDisk('videos')
            ->open($_gif_name)
            ->gif(FFMpeg\Coordinate\TimeCode::fromSeconds('0'), new FFMpeg\Coordinate\Dimension($reSize, $reSize))->save('gif/'.$gif_name);
            
        unlink(public_path('/videofile/'.$_gif_name));

        $this->checkPayPixels();

        return view('selectPixelMaps', ['size' => $size, 'size_order' => $size_order, 'url' => $request->input('url'), 'gif_name' => $gif_name, 'data' => OrderPixel::all()]);
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

        if(substr($X, -1) == '5' || substr($Y, -1) == '5' || substr($X2, -1) == '5' || substr($Y2, -1) == '5') return view('selectPixelMaps', ['size' => $size, 'size_order' => $size_order, 'url' => $request->input('url'), 'gif_name' => $gif, 'data' => OrderPixel::all()]);
        if($X < 0 || $Y < 0 || $X2 > 1000 || $Y > 1000) return view('selectPixelMaps', ['size' => $size, 'size_order' => $size_order, 'url' => $request->input('url'), 'gif_name' => $gif, 'data' => OrderPixel::all()]);
        
        $result = OrderPixel::where('X', '<', $X2)
                            ->where('X2', '>', $X)
                            ->where('Y2', '>', $Y)
                            ->where('Y', '<', $Y2)->first();

        if($result) {
            return view('selectPixelMaps', ['size' => $size, 'size_order' => $size_order, 'url' => $request->input('url'), 'gif_name' => $gif, 'data' => OrderPixel::all()]);
        }

        // END Проверка не заняты ли выбранные пиксели


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

        // Обновить пиксели
        $this->updatePixelsLeft($size_order);
        // СДелать скриншот страницы
        $this->saveScreenshot();

        // return $this->getPaymendLink($createOrder->id, $size_order);
        return redirect(route('home'));
  
    }

    public function updatePixelsLeft($size_order) {
        $getPixelsLeft = PixelsLeft::all()->first();

        $sold = $size_order + $getPixelsLeft->sold;
        $available = $getPixelsLeft->available - $size_order;
        
        PixelsLeft::where("id", 1)->update(['available' => $available, 'sold' => $sold]);
    }


    public function checkPayPixels() {
        $payment = payment::all();
        $order = OrderPixel::all();

        foreach($order as $px) {
            foreach($payment as $pay) {
                if($px->id == $pay->order_id) {
                    if(!isset($pay->status)) {
                        
                        unlink(public_path('/gif/'.$px->name_gif));
                        payment::where('id', $pay->id)->delete();
                        OrderPixel::where('id', $px->id)->delete();

                    }
                }
            }
        }
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


    // public function responsePay(Request $request) {
// 
    //     if($request->status == 'succeeded') {
    //         $checkStatus = payment::where("UUID", $request->octo_payment_UUID)->first();
    //         if($checkStatus->status == NULL) {
    //             payment::where("UUID", $request->octo_payment_UUID)->update(['status' => $request->payed_time]);
// 
    //             $getPixelsLeft = PixelsLeft::all()->first();
// 
    //             $sold = $request->total_sum + $getPixelsLeft->sold;
    //             $available = $getPixelsLeft->available - $request->total_sum;
// 
    //             PixelsLeft::where("id", 1)->update(['available' => $available, 'sold' => $sold]);
    //             $this->saveScreenshot();
    //         }
    //     }
    // }



    public function checkPixelsPlace(Request $request) {
        
        $X = $request->X;
        $Y = $request->Y;

        $size = $request->size;

        $X2 = $request->X + $size;
        $Y2 = $request->Y + $size;
        
        $result = OrderPixel::where('X', '<', $X2)
                            ->where('X2', '>', $X)
                            ->where('Y2', '>', $Y)
                            ->where('Y', '<', $Y2)->first();
        


        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function saveScreenshot() {
        $response = Http::withHeaders([
            'Accept' => 'image/png',
            'X-RapidAPI-Host' => 'url-to-screenshot.p.rapidapi.com',
            'X-RapidAPI-Key' => '14258de2acmsh825902b9f60baf4p1e8eabjsn0cbc8a3c3b9c'
        ])->get('https://url-to-screenshot.p.rapidapi.com/get', [
            'url' => 'https://milliontiktokershomepage.com/',
            'height' => '-1',
            'mobile' => '0',
            'allocated_time' => '2.0',
            'width' => '1024',
            'base64' => '0'
        ]);
    

        
 
        $body = $response->getBody();

        $name = 'screenshot_'.date('Y-m-d_H-m-s').'.png';
        Storage::disk('screenshot')->put($name, $body);

        //$file->move(public_path('/admin/'), date('Y-m-d_H-i-s').'.png');
        

    }

}