<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use GPBMetadata\Google\Api\Log;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use mysql_xdevapi\Exception;
use Yajra\DataTables\DataTables;
use function Laravel\Prompts\error;

class CompanyController extends Controller
{

    private function uploadLogoToFirebase($file)
    {
        try{
            $bucket = app('firebase')->getBucket();

        ;
//            dd($file);
//            dd($file);
            $filePath = 'updatedLogos/' . $file->getClientOriginalName();


            $bucket->upload(file_get_contents($file), [
                'name' => $filePath
            ]);
//            dd($bucket);

            // Get the image URL
            $imageReference = $bucket->object($filePath);
           $url= $imageReference->signedUrl(now()->addMinutes(5));
//           dd($url);
//
           return  $url;

        }catch (\Exception $e){


            return  response()->json(['error'=> $e->getMessage()]);
        }

    }

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

public function getCompanies(Request $request)
{

    $data = Company::select('companies.*');

    if ($request->from_date) {
        $data->whereDate('created_at', '>=', $request->from_date);
    }

    if ($request->to_date) {
        $data->whereDate('created_at', '<=', $request->to_date);
    }

    return DataTables::of($data)


        ->addIndexColumn()
        ->addColumn('action', function($row){
            $editUrl=route('company.Update', $row->id);
            $viewUrl=route('company.view', $row->id);

            $btn = '<a href="'.$viewUrl.'" class="btn btn-info btn-sm">View</a> ';
            $btn .= '<a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</a> ';
            $btn .= '<button data-id="'.$row->id.'" class="btn btn-danger btn-sm delete-btn">Delete</button>';;
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

            return redirect()->route('company');
        }

        return 'request has no file';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $company=Company::find($id);
        if(!$company){
            redirect()->back()->withErrors('error', 'Company is not Found');
        }

        return view('companies.view', compact('company'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $company=Company::find($id);

        $logoUrl=$company->logo;
//        dd($logoUrl);

        return view('Companies.updateCompany', compact('company', 'logoUrl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $id)
    {

        $validated = $request->validated();
//        $logoUrl= null;
        //validate the request
        if($request->hasFile('logo')){
//            dd($request->file('logo'));
            $file=$request->file('logo');

            $logoUrl= $this->uploadLogoToFirebase($file);
//            dd($logoUrl);

            $company=Company::find($id);

            $company->update([
                'name'=>$validated['name'],
                'email'=> $validated['email'],
                'logo'=> $logoUrl
            ]);

            return redirect()->route('company');
//            return response()->json(['file' => $request->file('logo'), 'url' => $logoUrl]);

        }

        $company=Company::find($id);

        $company->update([
            'name'=>$validated['name'],
            'email'=> $validated['email'],
        ]);

        return redirect()->route('company');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // find company and deleting it
        $company=Company::find($id);

        if($company){
            $company->delete();

            return response()->json(['success'=> true]);
        }
        return response()->json(['success'=> false]);
    }



}
