<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use Auth;
use App\Invoice;

class ApiController extends Controller
{
    public function medialist()
	{
		try
        {
            
            $media = Media::where('type','3')->get();
            return response()->json(['media-list'=>$media],201);
        }
        catch(\Exception $e)
        {
            return response()->json(['message'=>'Media List Empty','error'=>$e],409);
        }
	}
    public function invoicelist()
	{
		try
        {
            
            $invoice = Invoice::where('rating','High')->get();
            return response()->json(['invoice-list'=>$invoice],201);
        }
        catch(\Exception $e)
        {
            return response()->json(['message'=>'Invoice List Empty','error'=>$e],409);
        }
	}
}
