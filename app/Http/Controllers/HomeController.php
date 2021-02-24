<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use App\Jobs\UploadFile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

       /**
     * Upload files into storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function import(Request $request)
    {
        $this->validate($request, [
            'fileInput' => 'required|mimes:csv,txt',
        ]);

        if($request->has('fileInput')) {

            $fileArr = array_map('str_getcsv', file($request->fileInput));

            if(!empty($fileArr)) {
                UploadFile::dispatch($fileArr, $request->file_type);                              
            }

            return back()->with('success', 'The file import is successfully Completed!');   
        }
    }
}
