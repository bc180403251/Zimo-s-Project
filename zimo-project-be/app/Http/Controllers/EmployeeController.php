<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeesDataTable;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\UpdateEmployeeRequest;
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

    public function getEmployee()
    {
        $employees = Employee::query();
            return DataTables::of($employees)->make(true);
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
        //

        $request=$request->all();

        $employee= Employee::find($id);

        if($employee){

            $employee->update($request);

            return redirect()->route('List')->with('success', 'Employee Updated Successfully!');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find an Employee  for deleting it

        $employee=Employee::find($id);
        if(!$employee){
            return redirect()->back()->withErrors('error', 'Employee is not found');
        }
//        dd($employee);
        $employee->delete();

        return redirect()->back()->with('success', 'Employees deleted Successfully!');

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
            if($data->gender==='others'){
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



//        dd($totalemployee,$femalePercentage, $malePercentage, $othersPercentage);
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
}
