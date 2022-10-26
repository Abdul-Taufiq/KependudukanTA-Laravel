<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    function refereshCaptcha(){
    	return captcha_img('math');
    }
}
