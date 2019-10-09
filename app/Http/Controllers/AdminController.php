<?php

namespace App\Http\Controllers;
use Hash;
use App\Project;
use App\Admin;
use App\Employee;
use App\Application;
use App\Job;
use App\Contact;
use Auth;
use Image;
use Excel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function employees()
    {
        $employees = Employee::where('status','!=','N/A')->orderBy('name')->paginate(10);
        return view('admin.view-employees',['employees'=>$employees]);
    }
  
    public function add_employee(Request $request)
    {
        $input = request()->validate([
     
            'pic' => 'mimes:jpeg,jpg,png,bmp,gif,tif,tiff|max:50000|nullable',
            'name' => 'required|string|max:255',
            'email' => 'string|max:255|email|nullable',
            'contact' => 'max:255|nullable',
            'address'=> 'string|max:255|nullable',
            'position'=> 'required|string',
            'date_employed'=> 'required',
            'status'=> 'required|string',
        ], [

        ]);

        if ($request->hasFile('pic')) {
            $filenameWithExt = $request->file('pic')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('pic')->getClientOriginalExtension();
            $fileNametoStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('pic')->storeAs('public/images',$fileNametoStore);
            
        }
        else{
            $fileNametoStore = 'noimage.jpg';

        }

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->contact = $request->contact;
            $employee->address = $request->address;
            $employee->position = $request->position;
            $employee->date_employed = $request->date_employed;
            $employee->status = $request->status;
            $employee->pic = $fileNametoStore;
            $employee->save();
            $request->session()->flash('alert-success', 'Employee successfully added!');
            return redirect()->back();
    }

    public function search_employee(Request $request)
    {
        $search = $request->search;
        $employees = Employee::where('name','=',$search)
        ->where('status','!=','N/A')
        ->orderBy('name')->paginate(10);

        return view('admin.view-employees',['employees'=>$employees]);
    }

    public function employee_excel(){
        $employees = Employee::where('status','!=','N/A')->orderBy('name')->get();
        $employees_array[] = array('Employee Name','Email','Contact No.','Address','Position','Date Employed','Status');
        foreach($employees as $employee){
            $employees_array[] = array(
                'Employee Name' => $employee->name,
                'Email' => $employee->email,
                'Contact No.' => $employee->contact,
                'Address' => $employee->address,
                'Position' => $employee->position,
                'Date Employed' => $employee->date_employed,
                'Status' => $employee->status,
            );
        }
 
 
        Excel::create('Employees', function($excel) use ($employees_array){
         $excel->setTitle('Employees');
         $excel->sheet('Employees', function($sheet) use ($employees_array){
         $sheet->fromArray($employees_array, null, 'A1', false, false);
         });
        })->download('xlsx');
   }


   public function edit_employee($id,Request $request)
   {
    $input = request()->validate([
     
        'pic' => 'mimes:jpeg,jpg,png,bmp,gif,tif,tiff|max:50000|nullable',
        'name' => 'required|string|max:255',
        'email' => 'string|max:255|email|nullable',
        'contact' => 'max:255|nullable',
        'address'=> 'string|max:255|nullable',
        'position'=> 'required|string',
        'date_employed'=> 'required',
        'status'=> 'required|string',
    ], [

    ]);

    if ($request->hasFile('pic')) {
        $filenameWithExt = $request->file('pic')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('pic')->getClientOriginalExtension();
        $fileNametoStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('pic')->storeAs('public/images',$fileNametoStore);
        
    }
  

        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->contact = $request->contact;
        $employee->address = $request->address;
        $employee->position = $request->position;
        $employee->date_employed = $request->date_employed;
        $employee->status = $request->status;
        if ($request->hasFile('pic')) {
        $employee->pic = $fileNametoStore;
        }
        $employee->save();
        $request->session()->flash('alert-success', 'Employee successfully updated!');
        return redirect()->back();
   }


   public function remove_employee($id,Request $request)
   {
       $employee = Employee::find($id);
       $employee->status = 'N/A';
       $employee->save();
       $request->session()->flash('alert-success', 'Employee successfully removed!');
       return redirect()->back();
   }





   public function job()
   {
       $jobs = Job::orderBy('title')->paginate(10);
       return view('admin.job',['jobs'=>$jobs]);
   }

   public function add_job(Request $request)
   {
       $input = request()->validate([
    
   
           'title' => 'required|string|max:255',
           'exp' => 'required',
           'description' => 'string|required',
           'requirement' => 'string|required',
           'qualification'=> 'string|required',
           'salary'=> 'nullable|max:255',

       ], [

       ]);



           $job = new Job();
           $job->title = $request->title;
           $job->description = $request->description;
           $job->requirement = $request->requirement;
           $job->qualification = $request->qualification;
           $job->salary = $request->salary;
           $job->exp = $request->exp;
           $job->save();
           $request->session()->flash('alert-success', 'Job successfully added!');
           return redirect()->back();
   }


   public function search_job(Request $request)
   {
       $search = $request->search;
       $jobs = Job::where('title','=',$search)->orderBy('title')->paginate(10);

       return view('admin.job',['jobs'=>$jobs]);
   }

   public function job_excel(){
    $jobs = Job::orderBy('title')->get();
    $jobs_array[] = array('Job Title','Job Description','Experience','Requirements','Qualifications','Salary','Date Created');
    foreach($jobs as $job){
        $jobs_array[] = array(
            'Job Title' => $job->title,
            'Job Description' => $job->description,
            'Experience' => $job->exp,
            'Requirements' => $job->requirement,
            'Qualifications' => $job->qualification,
            'Salary' => $job->salary,
            'Date Created' => $job->updated_at,
        );
    }


    Excel::create('Jobs', function($excel) use ($jobs_array){
     $excel->setTitle('Jobs');
     $excel->sheet('Jobs', function($sheet) use ($jobs_array){
     $sheet->fromArray($jobs_array, null, 'A1', false, false);
     });
    })->download('xlsx');
}


public function destroy_job($id, Request $request)
{
    $jobs = Job::find($id);
    if(  $jobs->delete()){
        $request->session()->flash('alert-success', 'Job successfully deleted!');
        return redirect()->back();
    }
  
   
}


    public function application($id)
    {
        $jobs = Job::where('id',$id)->get();
        $application = Application::with('jobs')->where('id',$id)->orderBy('created_at')->paginate(10);
        return view('admin.application',['application'=>$application,'jobs'=>$jobs]);
    }

    public function destroy_application($id, Request $request)
    {
        $application = Application::find($id);
        if(  $application->delete()){
            $request->session()->flash('alert-success', 'Applicant successfully deleted!');
            return redirect()->back();
        }
      
       
    }

    public function project()
    {
        $projects = Project::where('remove','=',NULL)->orderBy('name')->paginate(10);
        return view('admin.website-project',['projects'=>$projects]);
    }

    public function add_project(Request $request)
    {
        $input = request()->validate([
    
            'pic' => 'mimes:jpeg,jpg,png,bmp,gif,tif,tiff|max:50000|required',
            'name' => 'required|string|max:255',
            'description' => 'string|required',
            'budget' => 'required',
            'date_started' => 'required',
            'date_finish'=> 'required',
            'percent'=> 'required',
 
        ], [
 
        ]);
 
        if ($request->hasFile('pic')) {
            $filenameWithExt = $request->file('pic')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('pic')->getClientOriginalExtension();
            $fileNametoStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('pic')->storeAs('public/images',$fileNametoStore);
            
        }
            $projects = new Project();
            $projects->pic = $fileNametoStore;
            $projects->name = $request->name;
            $projects->description= $request->description;
            $projects->budget= $request->budget;
            $projects->date_started= $request->date_started;
            $projects->date_finish= $request->date_finish;
            $projects->percent= $request->percent;
            $projects->status= $request->status;
            $projects->save();
            $request->session()->flash('alert-success', 'Project successfully added!');
            return redirect()->back();

    }

    public function search_project(Request $request)
    {
        $search = $request->search;
        $projects = Project::where('name',$search)
        ->where('remove','=',NULL)
        ->orderBy('name')->paginate(10);
        return view('admin.website-project',['projects'=>$projects]);
    }

    public function project_excel(){
        $projects = Project::where('remove','=',NULL)->orderBy('name')->get();
        $projects_array[] = array('Project Title','Description','Date Started','Date Finish','% of completion','Status');
        foreach($projects as $project){
            $projects_array[] = array(
                'Project Title' => $project->name,
                'Description' => $project->description,
                'Date Started' => $project->date_started,
                'Date Finish' => $project->date_finish,
                '% of completion' => $project->percent,
                'Status' => $project->status,
            );
        }
    
    
        Excel::create('Projects', function($excel) use ($projects_array){
         $excel->setTitle('Projects');
         $excel->sheet('Projects', function($sheet) use ($projects_array){
         $sheet->fromArray($projects_array, null, 'A1', false, false);
         });
        })->download('xlsx');
    }

    public function edit_project($id, Request $request)
    {
        $input = request()->validate([
    
            'name' => 'required|string|max:255',
            'description' => 'string|required',
            'budget' => 'required',
            'date_started' => 'required',
            'date_finish'=> 'required',
            'percent'=> 'required',
 
        ], [
 
        ]);
 
        if ($request->hasFile('pic')) {
            $filenameWithExt = $request->file('pic')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('pic')->getClientOriginalExtension();
            $fileNametoStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('pic')->storeAs('public/images',$fileNametoStore);
            
        }

        $projects = Project::find($id);
        if ($request->hasFile('pic')) {
        $projects->pic = $fileNametoStore;
        }
        $projects->name = $request->name;
        $projects->description= $request->description;
        $projects->budget= $request->budget;
        $projects->date_started= $request->date_started;
        $projects->date_finish= $request->date_finish;
        $projects->percent= $request->percent;
        $projects->status= $request->status;
        $projects->save();
        $request->session()->flash('alert-success', 'Project successfully updated!');
        return redirect()->back();
    }

    public function remove_project($id, Request $request)
    {
        $projects = Project::find($id);
        $projects->remove = 1;
        $projects->save();
        $request->session()->flash('alert-success', 'Project successfully removed!');
        return redirect()->back();
    }


    public function contact()
    {
        $contacts = Contact::orderBy('created_at')->paginate(10);
        return view('admin.contact',['contacts'=>$contacts]);
    }

    public function destroy_contact($id, Request $request)
    {
        $contacts = Contact::find($id);
    if(  $contacts->delete()){
        $request->session()->flash('alert-success', 'Message successfully deleted!');
        return redirect()->back();
    }
    }


    public function archive_employee()
    {
        $employees = Employee::orderBy('name')->paginate(10);
        return view('admin.archive-employee',['employees'=>$employees]);
    }

    public function search_archive_employee(Request $request)
    {
        $search = $request->search;
        $employees = Employee::where('name','=',$search)
        ->orderBy('name')->paginate(10);

        return view('admin.archive-employee',['employees'=>$employees]);
    }

    public function archive_employee_excel(){
        $employees = Employee::orderBy('name')->get();
        $employees_array[] = array('Employee Name','Email','Contact No.','Address','Position','Date Employed','Status');
        foreach($employees as $employee){
            $employees_array[] = array(
                'Employee Name' => $employee->name,
                'Email' => $employee->email,
                'Contact No.' => $employee->contact,
                'Address' => $employee->address,
                'Position' => $employee->position,
                'Date Employed' => $employee->date_employed,
                'Status' => $employee->status,
            );
        }
 
 
        Excel::create('Employees', function($excel) use ($employees_array){
         $excel->setTitle('Employees');
         $excel->sheet('Employees', function($sheet) use ($employees_array){
         $sheet->fromArray($employees_array, null, 'A1', false, false);
         });
        })->download('xlsx');
   }


    public function archive_project()
    {
        $projects = Project::orderBy('name')->paginate(10);
        return view('admin.archive-project',['projects'=>$projects]);
    }

    
    public function archive_search_project(Request $request)
    {
        $search = $request->search;
        $projects = Project::where('name',$search)
        ->orderBy('name')->paginate(10);
        return view('admin.archive-project',['projects'=>$projects]);
    }

    public function archive_project_excel(){
        $projects = Project::orderBy('name')->get();
        $projects_array[] = array('Project Title','Description','Date Started','Date Finish','% of completion','Status');
        foreach($projects as $project){
            $projects_array[] = array(
                'Project Title' => $project->name,
                'Description' => $project->description,
                'Date Started' => $project->date_started,
                'Date Finish' => $project->date_finish,
                '% of completion' => $project->percent,
                'Status' => $project->status,
            );
        }
    
    
        Excel::create('Projects', function($excel) use ($projects_array){
         $excel->setTitle('Projects');
         $excel->sheet('Projects', function($sheet) use ($projects_array){
         $sheet->fromArray($projects_array, null, 'A1', false, false);
         });
        })->download('xlsx');
    }


    public function account()
    {
        $admin = Admin::where('id','=',Auth::user()->id)->get();
        return view('admin.account',['admin'=>$admin]);
    }

    public function account_update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|exists:admins,password',
            'password' => 'required|confirmed'
        ], [
  

        ]);
        $id = Auth::user()->id;
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request['password']);
        $admin->save();
        $request->session()->flash('alert-success', 'Account successfully updated!');
        return redirect()->route('add-admin-index');
    }

}