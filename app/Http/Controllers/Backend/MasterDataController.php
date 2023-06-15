<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class MasterDataController extends Controller
{
    public function datauser(Request $request)
    {
        $role = Role::all();
        if ($request->ajax()) {

            $users = User::latest()->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('name', function ($user) {
                    return (ucfirst($user->name));
                })
                ->addColumn('email', function ($user) {
                    return (ucfirst($user->email));
                })
                ->addColumn('phone_number', function ($user) {
                    return $user->phone_number;
                })
                ->addColumn('role', function ($user) {
                    return ucfirst($user->role);
                })
                ->addColumn('status_akun', function ($user) {
                    if ($user->status_akun == 'active') {
                        return '<div class="btn btn-success">' . ucfirst($user->status_akun) . '</div>';
                    } else {
                        return '<div class="btn btn-danger">' . ucfirst($user->status_akun) . '</div>';
                    }
                })
                ->addColumn('action', function ($user) {

                    if ($user->status_akun == 'active') {
                        $class = 'danger';
                        $title = 'Arsip';
                        $aktif = 'aktif';
                    } else {
                        $title = 'Aktifkan';
                        $class = 'warning';
                        $aktif = 'non-aktif';
                    }

                    $btn = '<button href="#" id="user-edit" data-id="' . $user->user_id . '" title="Edit" class="btn btn-secondary btn-sm edit-user"><i class="mdi mdi-pencil-box-outline"></i></button>';

                    $btn = $btn . ' <button id="user-' . $user->user_id . '" data-id="' . $user->user_id . '" class="user-delete btn btn-' . $class . ' btn-sm ' . $aktif . '" title="' . $title . '"><i class="mdi mdi-autorenew"></i></button>';

                    // $btn = $btn . ' <button id="user-show" data-id="' . $user->user_id . '" class="btn btn-primary btn-sm" title="Show"><i class="mdi mdi-eye"></i></button>';

                    return $btn;
                })
                ->rawColumns(['status_akun', 'action'])
                ->make(true);
        }

        return view('backend.data-master.data-user', compact('role'));
    }

    public function userStore(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ], [
            'name.required' => 'Name Must Be Included!',
            'email.required' => 'Email Must Be Included!',
            'phone_number.required' => 'Phone Number Must Be Included!',
            'role.required' => 'Position Must Be Included',
            'password' => 'Password Must be at least 8 Characters',
            'password_confirmation' => 'Password Confirmation Must be at least 8 Characters',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        // insert data to table user 
        $user = User::updateOrCreate([
            'user_id' => $request->user_id
        ], [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        $profile = Profile::create([
            'user_id' => $user->user_id
        ]);

        $user->syncRoles($request->role);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Your data has been saved successfully!',
        ]);
    }

    public function userDestroy(Request $request)
    {
        // find data by request id
        $user = User::find($request->user_id);

        // if condition, if aktif change user status to non-aktif and the other way around
        if ($user->status_akun == 'active') {
            $user->update([
                'status_akun' => 'inactive'
            ]);
            return response()->json(['status' => 'Archiving Data Successfully!']);
        } else {
            $user->update([
                'status_akun' => 'active'
            ]);
            return response()->json(['status' => 'Successfully Display Data!']);
        }
    }

    public function userSelected(Request $request)
    {
        $user = User::where('user_id', $request->user_id)->first();
        return response()->json($user);
    }

    public function eventAdd()
    {
        return view('backend.events.add-event');
    }

    public function dataevent()
    {
        return view('backend.events.data-event');
    }
}
