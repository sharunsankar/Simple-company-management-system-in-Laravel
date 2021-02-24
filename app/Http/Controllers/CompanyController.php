<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::withCount('employee')->paginate(10);        
        return view('company.index',[ 'companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'logo' => 'nullable|file|dimensions:min_width=100,min_height=100'            
        ]);

        $data = $request->except('logo');
        $image = $request->logo;

        if($image)
        {
          $data['logo'] = Storage::disk('local')->put('public', $image);
        }

        $data['status'] = 1;

        Company::create($data);

        return back()->with('success', 'The company '.$data['name'].' added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editData = Company::find($id);

        $image = $request->logo;

        if($image){
            Storage::delete($editData->logo);
            $editData->logo = Storage::disk('local')->put('public', $image);       
        } 

        $editData->name = $request->name;
        $editData->email = $request->email;
        $editData->website = $request->website;
        $editData->save();

        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        Storage::delete($company->logo);
        $company->delete();
        return redirect()->route('companies.index');
    }

 
}
