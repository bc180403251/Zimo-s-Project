<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class CompanyController extends Controller
{

    protected $firebaseStorage;

    public function __construct()
    {
        $this->firebaseStorage= (new Factory)->withServiceAccount([__DIR__.'/zimo-laravel-firebase-adminsdk-poocm-f69df360fa.json'])
            ->createStorage();


    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get the list of the Companies
        $companies = Company::all();
        return view('companies.List', compact('companies'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Companies.CompanyCreate');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        //validate the request data
        $validated=$request->validated();

        $logoUrl=null;

        if($request->hasFile('logo')){
            $file= $request->file('logo');
            $filePath='logos/'. time(). '_'.$file->getClientOriginalName();
            $bucket= $this->firebaseStorage->getBucket();
            $bucket->upload(
                file_get_contents($file)
                ,[
                    'name'=> $filePath
                ]
            );
            $logoUrl=$bucket->object($filePath)->signedUrl(new \DateTime('10 years'));
        }
        $company= new Company();
        $company->name= $validated['name'];
        $company->email= $validated['email'];
        $company->logo= $logoUrl;

        $company->save();

        return redirect()->route('dashboard');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
