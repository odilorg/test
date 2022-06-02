<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class ScreenshotController extends Controller
{
    public function getAllScreensot() {
        return response()->view('admin/screenshot', ['data' => Storage::disk('screenshot')->files()]);
    }
}
