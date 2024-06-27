<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{

//    protected $Storage;

//    public function __construct()
//    {
//
//        $firebase= app('firebase');
//        $this->Storage= $firebase->createStorage();
//
//
//    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get the list of the Companies
//        $companies = Company::all();
        return view('companies.List');


    }

//    get all company data

public function getCompanies()
{
    $data=Company::all();
    $data = Company::all();

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="view/'.$row->id.'" class="btn btn-info btn-sm">View</a> ';
            $btn .= '<a href="edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a> ';
            $btn .= '<a href="delete/'.$row->id.'" class="btn btn-danger btn-sm">Delete</a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);

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
        // Validate the request data
        if ($request->hasFile('logo')){
            $validated = $request->validated();

//        $logoUrl= null;


            $bucket = app('firebase')->getBucket();

            $file = $request->file('logo');
//            dd($file);
//            dd($file);
            $filePath = 'companieslogo/' . $file->getClientOriginalName();

            $bucket->upload(file_get_contents($file), [
                'name' => $filePath
            ]);

            // Get the image URL
            $imageReference = $bucket->object($filePath);
            $logoUrl = $imageReference->signedUrl(now()->addMinutes(5));


            $company = new Company();
            $company->name = $validated['name'];
            $company->email = $validated['email'];
            $company->logo = $logoUrl;

            $company->save();

            return redirect()->route('dashboard');
        }

        return 'request has no file';
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
        $company=Company::find($id);

        return view('Companies.updateCompany', compact('company'));
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

//   proivde data to dashbaoard


}
