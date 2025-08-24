<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{


    public function register(Request $request){

        try{
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email',
                'phone' => ['required','regex:/^(\+\d{1,3}\s?\d{9}|0[67]\d{8})$/'],
                'password' => ['required','min:6','regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).+$/'],
                'passwordConfirmation' => 'required|same:password'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
            ]);

            session()->flash('success','New Account Created!');
            return back();
        }catch (\Exception $e){
            Log::info($e);
            session()->flash('error','Account not Created!Enter valid PhoneNo. and password mixed of letters numbers and symbols');
            return back();
        }

    }




    public function index(){

    $projects = Project::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();

            $pending = Project::where('user_id', Auth::user()->id)
                            ->where('status', 'Pending')
                            ->count();

            $completed = Project::where('user_id', Auth::user()->id)
                            ->where('status', 'Completed')
                            ->count();
                            
            $inProgress = Project::where('user_id', Auth::user()->id)
                            ->where('status', 'In Progress')
                            ->count();                            
        return view('userPages.userDashboard', compact('projects','completed','pending','inProgress'));
    }






    public function getProjects(Request $request){

    $searchTerm = $request->input('searchTerm');

    $projects = Project::where('user_id', Auth::id())
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('title', 'LIKE', "%{$searchTerm}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(8);
            $pending = Project::where('user_id', Auth::user()->id)
                            ->where('status', 'Pending')
                            ->latest()
                            ->get();

            $completed = Project::where('user_id', Auth::user()->id)
                            ->where('status', 'Completed')
                            ->latest()
                            ->get();
                            
            $inProgress = Project::where('user_id', Auth::user()->id)
                            ->where('status', 'In Progress')
                            ->latest()
                            ->get();   

        return view('userPages.userProjects', compact('projects','completed','pending','inProgress'));
    }





    public function save(Request $request){
        try{
            $request->validate([
                'project_title' => 'required|string|max:30',
                'project_description' => 'required'
            ]);

            Project::create([
                'user_id' => Auth::id(),
                'title' => $request->project_title,
                'description' => $request->project_description,
            ]);
            // $this->dispatch('showNewModal = false');
            session()->flash("success", "Project was created Successfully");
            return back();

        }catch(\Exception $e){
            Log::info($e);
            session()->flash("error", "Project not created!");
            return back();
        }
    }






    public function edit(Request $request){
        try{
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'project_title' => 'required|string|max:30',
                'project_description' => 'required'
            ]);

            $project = Project::findOrFail($request->project_id);

           $project->update([
                'title' => $request->project_title,
                'description' => $request->project_description,
            ]);
            session()->flash("success", "Project was Edited Successfully");
            return back();

        }catch(\Exception $e){
            Log::info($e);
            session()->flash("error", "Could not Edit Project");
            return back();
        }
    }







    public function delete(Request $request) {
        try{

            $project = Project::find($request->project_id);

            $project->delete();
            session()->flash("success", "Project Deleted!");
            return back();
        }catch(\Exception $e){
            Log::info();
            session()->flash("error", "Project not Deleted!");
            return back();
        }
    }
}
