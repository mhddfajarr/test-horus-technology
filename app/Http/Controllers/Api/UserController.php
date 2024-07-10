<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::All();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendapatkan data user',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|max:100|min:3|unique:users,username',
            'name' => 'required|max:100|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4'
        ];

        $tanggal_daftar = now();

        $validator = Validator::make($request->all(), $rules);
        $user = new User();
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan data user',
                'data' => $validator->errors()
            ],422);
        }
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->tanggal_daftar = $tanggal_daftar;
        $user->password = $request->password;

        $store = $user->save();

        return response()->json([
            'status'=>true,
            'message'=> 'berhasil menambahkan user baru'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        if($data){
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil ditemukan',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=> 'Data user tidak ditemukan'
            ],400);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
    
        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    
        $rules = [
            'username' => 'required|max:100|min:3',
            'name' => 'required|max:100|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:4'
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan data user',
                'data' => $validator->errors()
            ], 422);
        }
    
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Jangan lupa mengenkripsi password
    
        $update = $user->save();
    
        return response()->json([
            'status' => true,
            'message' => 'Berhasil memperbarui user'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if(empty($user)){
            return response()->json([
                'status' => false,
                'message' => 'Data user tidak ditemukan'
            ],404);
        }

        $delete = $user->delete();

        return response()->json([
            'status'=>true,
            'message'=> 'Berhasil menghapus data user'
        ],200);
    }
}
