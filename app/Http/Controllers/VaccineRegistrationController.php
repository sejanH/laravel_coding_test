<?php

namespace App\Http\Controllers;

use App\Jobs\NotifiyUser;
use App\Models\User;
use App\Models\UserVaccineCenterPivot;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VaccineRegistrationController extends Controller
{
    public function index()
    {
        return view('home', ['user' => null,'status'=>null]);
    }
    public function register()
    {
        $centers = VaccineCenter::all();
        return view('register', compact('centers'));
    }
    public function center_register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nid' => 'required|unique:users,nid',
            'email' => 'sometimes|unique:users,email',
            'center' => 'required',
            'time' => 'required',
        ], [
            'nid.required' => 'Your NID is required',
            'nid.unique' => 'This NID is already registered',
            'center.required' => 'Please choose a vaccine center',
        ]);
        try {
            DB::beginTransaction();
            if(Carbon::parse($request->time)->lessThan(Carbon::now())){
                return redirect()->back()->withErrors('Older timestamps are not allowed');
            }
            if(Carbon::parse($request->time)->isSaturday() || Carbon::parse($request->time)->isSunday()){
                return redirect()->back()->withErrors('Sorry Weekends are not allowed');
            }
            $center = VaccineCenter::find($request->center);
            $registered_users = UserVaccineCenterPivot::where('center_id',$request->center)->where('registered_at','<',now())->count();
            if($center->center_limit <= $registered_users){
                return redirect()->back()->withErrors('Vaccine Center No Space Left');
            }
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->nid = $request->nid;
            $user->status = 'Scheduled';
            $user->save();
            UserVaccineCenterPivot::create(['user_id' => $user->id, 'center_id' => $request->center, 'registered_at' => $request->time]);
            DB::commit();
            if(!empty($request->email)){
                NotifiyUser::dispatch(['email'=>$request->email])->delay(Carbon::parse($request->time)->timestamp);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return view('home',['user'=>null]);
    }

    public function checkRegistration(Request $request)
    {
        $user = User::where('nid', $request->nid)->first();
        $status = 'Not registered';
        if($user){
            $status = $user->status;
            $user->center = UserVaccineCenterPivot::where('user_id',$user->id)->first();
            if(strtotime($user->center->registered_at) >= now()->timestamp){
                $status = 'Vaccinated';
            }
        }
        return view('home', ['user' => $user, 'status' => $status]);
    }
}
