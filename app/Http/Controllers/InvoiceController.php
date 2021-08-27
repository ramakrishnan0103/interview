<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use Storage;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $filter['name'] = isset($_GET['name'])?$_GET['name']:'';
        $filter['rating'] = isset($_GET['rating'])?$_GET['rating']:'';
        $filter['invoice_no'] = isset($_GET['invoice_no'])?$_GET['invoice_no']:'';
        $invoice = Invoice::where(function($query) use ($filter){
            $query->where('name','like','%'.$filter['name'].'%');
            $query->where('rating','like','%'.$filter['rating'].'%');
            $query->where('invoice_id','like','%'.$filter['invoice_no'].'%');
        })->get();
        return view('invoice/index')->with(['invoice'=>$invoice]);
    }
    public function create()
    {
        
        return view('invoice/form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'rating' => 'required|string',
        ]);
        $invoice_id = uniqid();
            $invoice = new Invoice;
            $invoice->name = $request['name'];
            $invoice->rating = $request['rating'];
            $invoice->invoice_id = $invoice_id;
            if($request->file())
             {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $file_path = 'uploads/'.$invoice_id;
                $filePath = $request->file('file')->storeAs($file_path, $fileName, 'public');
                $invoice->file_path = '/storage/uploads/'.$invoice_id.'/'.$fileName;
            }
            $invoice->save();
            $path = Storage::disk('public')->path($file_path.$fileName);
            //print_r($path);exit;
            \Mail::send('mail',
            array(
                'name' => $request['name'],
                'rating' => $request['rating'],
                'invoice_id' => $invoice_id,
            ), function($message) use($request)
        {
            $message->from('ramakrishnan.p@synamen.com');
            $message->to('ramakrishnan0103@gmail.com', 'Ramakrishnan')
            ->subject('Interview Task');
            //->attach($request->file('files')->getRealPath());
            // $message;
        });
        return redirect()->route('invoice');
    }
}
