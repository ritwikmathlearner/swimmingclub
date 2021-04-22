<?php

namespace App\Http\Controllers;

use App\Race;
use App\Training;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
//        $role1 = Role::create(['name' => 'Parent']);
//        $role2 = Role::create(['name' => 'Swimmer']);
//        $role3 = Role::create(['name' => 'Child']);
//        $role4 = Role::create(['name' => 'Club Administrator']);
//        $role5 = Role::create(['name' => 'Coach']);
//
//        $permission1 = Permission::create(['name' => 'add children']);
//        $permission2 = Permission::create(['name' => 'edit personal details']);
//        $permission3 = Permission::create(['name' => 'view & edit squad']);
//        $permission4 = Permission::create(['name' => 'see squad training performance data']);
//        $permission5 = Permission::create(['name' => 'see own training performance data']);
//        $permission6 = Permission::create(['name' => 'see child training performance data']);
//        $permission7 = Permission::create(['name' => 'edit race data']);
//        $permission8 = Permission::create(['name' => 'add training data']);
//        $permission9 = Permission::create(['name' => 'select a squad']);
//
//        $role1->givePermissionTo($permission1);
//        $role1->givePermissionTo($permission2);
//        $role1->givePermissionTo($permission6);
//        $role1->givePermissionTo($permission9);
//        $role2->givePermissionTo($permission5);
//        $role2->givePermissionTo($permission2);
//        $role2->givePermissionTo($permission9);
//        $role4->givePermissionTo($permission7);
//        $role5->givePermissionTo($permission3);
//        $role5->givePermissionTo($permission4);
//        $role5->givePermissionTo($permission8);
    }

    public function childrenView()
    {
        return view('child.view');
    }

    public function childrenCreate()
    {
        return view('child.create');
    }

    public function childrenStore(Request $request)
    {
        $validatedData = $request->validate([
            'given_name' => 'required|string',
            'surname' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);
        $validatedData['parent_id'] = auth()->id();
        $user = User::create($validatedData);
        $user->assignRole('Child');
        return redirect('/home');
    }

    public function editProfile()
    {
        return view('edit');
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'given_name' => 'required|string',
            'surname' => 'required|string',
            'telephone' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'date_of_birth' => 'required|date',
        ]);
        User::where('id', auth()->id())->update($validatedData);
        return redirect('/home');
    }

    public function squad()
    {
        $teamMembers = Auth::user()->squad->users;
        return view('squad.view', compact('teamMembers'));
    }

    public function addTraining()
    {
        $teamMembers = Auth::user()->squad->users;
        return view('training.create', compact('teamMembers'));
    }

    public function storeTraining(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'performance' => 'required|string',
            'training_date' => 'required|date'
        ]);
        Training::create($validatedData);
        return redirect('/squad');
    }

    public function addRaceResult()
    {
        $races = Race::all();
        $participants = User::role(['Child', 'Swimmer'])->get();
        return view('race.raceresultadd', compact(['races', 'participants']));
    }

    public function storeRaceResult(Request $request)
    {
        $validatedData = $request->validate([
            'race_id' => 'required|exists:races,id',
            'user_id' => 'required|exists:users,id|unique:race_user,user_id,NULL,race_id'.$request->race_id,
            'points' => 'required|in:0,1'
        ]);
        DB::table('race_user')->insert($validatedData);
        return redirect('/home');
    }
}
