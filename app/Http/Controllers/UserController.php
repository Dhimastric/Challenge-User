<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('id', 'desc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('user.action')->with('data', $data);
            })
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "name" => "required | min:3",
            "email" => "required | email",
            "phone" => "required | numeric",
            "address" => "required",
            "role" => "required | not_in:0",
            "password" => "required | min:8",
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => $request->password,
                'role' => $request->role,
            ];

            User::create($data);
            return response()->json(['success' => "Successfully created!"]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            "name" => "required | min:3",
            "email" => "required | email",
            "phone" => "required | numeric",
            "address" => "required",
            "role" => "required | not_in:0",
            "password" => "required | min:8",
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => $request->password,
                'role' => $request->role,
            ];

            User::where('id', $id)->update($data);
            return response()->json(['success' => "Successfully updated!"]);
        }
    }

    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
    }
}
