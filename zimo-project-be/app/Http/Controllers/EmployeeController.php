<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeesDataTable;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Mail\ZFTRMail;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCreateMail;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function list(EmployeesDataTable $dataTable)
//    {
//
////        $employees = Employee::all();
//        return $dataTable->render('employees.List');
//
//    }

    public function index()
    {


//        if ($req->ajax()) {
//
//        }

        return view('employees.List');
    }

    public function getEmployee(Request $request)
    {

        $data=Employee::with('company')->select('employees.*');
//        dd($data);

      if($request->from_date){
          $data->whereDate('created_at','>=', $request->from_date);
      }
       if ($request->to_date) {
        $data->whereDate('created_at', '<=', $request->to_date);
    }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('company_name', function ($row){
                return $row->company ? $row->company->name :'N/A';
            })
            ->addColumn('action', function($row){
                $viewUrl=route('view', $row->id);
                $editUrl=route('update', $row->id);
//                $viewUrl=route('update', $row->id);


                $btn = '<a href="'.$viewUrl.'" class="btn btn-info btn-sm">View</a> ';
                $btn .= '<a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</a> ';
                $btn .= '<button data-id="'.$row->id.'" class="btn btn-danger btn-sm delete-btn">Delete</button>';
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

        $companies=Company::lookup();



//        dd($companies);

        return view('Employees.createEmployee' ,compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeCreateRequest $request)
    {

        $company=Company::find($request->company_id);
        //validate the request data
        $validated=$request->validated();

       $employee= Employee::create([

            'first_name'=>$validated['first_name'],
            'last_name'=> $validated['last_name'],
            'email'=> $validated['email'],
            'phone'=>$validated['phone'],
            'gender'=> $validated['gender'],
            'company_id'=>$company->id
        ]);
       Mail::to($employee->email)->send(new EmployeeCreateMail($employee, $company->email));
return redirect()->route('employeelist')->with('success','Employee created Successfully');



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $employee=Employee::find($id);
//        dd($employee);
        if(!$employee){
            return redirect()->back()->withErrors('error', 'Employee is not found');
        }

        return view('Employees.View', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $employee=Employee::find($id);
        $companies=Company::lookup();

        return view('Employees.updateEmployee', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
        // Retrieve the validated input data
        $validated = $request->validated();

        // Find the employee by ID
        $employee = Employee::find($id);
//        dd($employee);

        // Check if employee exists
        if ($employee) {
            // Update the employee with validated data
            try {
                $updated = $employee->update($validated);

                if ($updated) {
                    return redirect()->route('employeelist')->with('success', 'Employee Updated Successfully!');
                }
            } catch (\Exception $e) {
                // Handle the exception
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        // Redirect back with an error message if the employee is not found
        return redirect()->back()->with('error', 'Employee not found.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find an Employee  for deleting it

        $employee=Employee::find($id);

      if($employee){
        $employee->delete();

        return response()->json(['success'=> true]);
      }
        return response()->json(['success'=> false]);


    }

    public function showDashboard(Request $req)
    {
        $employees = Employee::join('companies', 'employees.company_id', '=', 'companies.id')
            ->select('companies.name as company', \DB::raw('count(*) as Total'))
            ->groupBy('companies.name')
            ->get();

//        dd($employees);
//
        $alldata = Employee::all();
        $totalemployee=count($alldata);
        $female = [];
        $male=[];
        $others=[];
//        echo $female;

        foreach ($alldata as $data) {
//        dd($data->gender);

            if ($data->gender === 'male') {
                $male[] = $data->gender;
            };
            if($data->gender==='female'){
                $female[]=$data->gender;
            };
            if($data->gender==='other'){
                $others[]=$data->gender;
            };


        }
//        calculate the arrays length
        $femaleCount=count($female);
        $maleCount=count($male);
        $otherCount=count($others);

//        Calculate the percentages of genders
        $femalePercentage=Employee::calculatePercentage($femaleCount, $totalemployee);
        $malePercentage=Employee::calculatePercentage($maleCount, $totalemployee);
        $othersPercentage=Employee::calculatePercentage($otherCount, $totalemployee);




       if($req->ajax()) {
            return response()->json([
                'employees' => $employees,
                'femalePercentage' => $femalePercentage,
                'malePercentage' => $malePercentage,
                'othersPercentage' => $othersPercentage,
            ]);
        }
        return view('Dashboard.welcome', compact('employees', 'femalePercentage','malePercentage','othersPercentage'));
    }


    public function testmail(Request $request)
    {


        Mail::to($request->input('email'))->send(new ZFTRMail());
    }
}
