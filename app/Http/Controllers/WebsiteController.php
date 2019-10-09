<?php

namespace App\Http\Controllers;

use Hash;
use App\Job;
use App\Application;
use App\Contact;
use App\Project;
use App\Admin;
use Image;
use Auth;
use Notification;
use App\Notifications\ApplicationSubmitted;
use App\Notifications\MessageSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
   
    public function about()
    {
        return view('website.about');
    }

    public function careers()
    {
        $jobs = Job::orderBy('title')->paginate(10);
        return view('website.careers',['jobs'=>$jobs]);
    }

    public function job($id)
    {
        $jobs = Job::where('id',$id)->get();
         return response($jobs);
    }

    public function application(Request $request){
        $input = request()->validate([
            'name' => 'required|max:255|string',
            'email' => 'string|max:255|email|required',
            'contact' => 'max:255|required',
            'resume' => 'required|mimes:zip,rar,tar,gzip,jpeg,jpg,png,bmp,gif,txt
            ,doc,docx,pdf|max:50000',

        ], [
            'resume.mimes' => 'Invalid Format',
           'resume.max' => 'File is too big', 
        ]);
            $id = $request->input('jid');
            if ($request->hasFile('resume')) {
                $filenameWithExt = $request->file('resume')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('resume')->getClientOriginalExtension();
                $fileNametoStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('resume')->storeAs('public/resume',$fileNametoStore);
                
            }
        $jobs = Job::where('id',$id)->get();

        $application = new Application();
        $application->job_id = $id;
        $application->name = $request->name;
        $application->email = $request->email;
        $application->contact = $request->contact;
        $application->resume = $fileNametoStore;
        $admins = Admin::get();
        foreach($admins as $admin){
            Notification::route('mail',$admin->email)->notify(new ApplicationSubmitted($application));
            }
        //$request->session()->flash('alert-success', 'Application successfully submitted!');
         if ($application->save()){
          
            return response()
                ->json([
                    'error'=> false, 
                    'message' => 'amazing',
                ], 200);
               
        }else{
            return redirect()->back()->with('error', 'An error has occured');
        }
    }

    public function project()
    {
     
        $projects = Project::orderBy('id', 'desc')->get();
      /* $imgCount = DB::table('project_gallery')->orderBy('id', 'desc')->limit(20)->get()->count();
        $imgs = DB::table('project_gallery')->orderBy('id', 'desc')->limit(20)->get();

        $out = array(
            'imgs' => []
        );
         foreach ($imgs as $img)
        {
           array_push($out['imgs'], [
                 'pic' => $img->pic,
            ]);
        }
        for ($i=0; $i < (20 - $imgCount) ; $i++) { 
            array_push($out['imgs'], [
                'pic' => '',
            ]);
        }*/
        return view('website.project',['projects'=>$projects]);
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function add_contact(Request $request)
    {
        $input = request()->validate([
     
            'name' => 'required|string|max:255',
            'email' => 'max:255|email|required',
            'contact' => 'max:255|required',
            'subject' => 'required|string|max:255',
            'message' => 'string|max:255|required',
        ], [
    
        ]);

        $contacts = new Contact();
        $contacts->name = $request->name;
        $contacts->email = $request->email;
        $contacts->contact = $request->contact;
        $contacts->subject = $request->subject;
        $contacts->message = $request->message;
       
        $contacts->save();
        $admins = Admin::get();
        foreach($admins as $admin){
            Notification::route('mail',$admin->email)->notify(new MessageSubmitted($contacts));
            }
        session()->flash('alert-success', 'Your inquiry has been successfully sent!');
        return redirect()->back();
    }

   
}