<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // protected view for reusable
    protected $view_users = 'settings/users/';

    public function index()
    {
        //
        $user = User::latest()->paginate(10);
        return view($this->view_users . 'index', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'min:6', 'confirmed'],
            'foto_path'     => ['nullable','max:1024','mimes:jpg,jpeg,png'],
        ]);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tanggal_lahir = null;
        // Check if tanggal_lahir is provided and not null
        if ($request->has('tanggal_lahir') && $request->input('tanggal_lahir') !== null) {
            $tanggal_lahir = Carbon::createFromFormat('m/d/Y', $request['tanggal_lahir'])->format('Y-m-d');
        }

        if ($request->foto_path) {
            $destinationPath = 'storage/user_photo/';
            $foto_path = $request['nama'] . '_' . 'Foto' . '.' . $request->foto_path->extension();
            $request->foto_path->move($destinationPath, $foto_path);
        }

        // create post data
        $data = User::create([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'role'          => $request->role,
            'no_hp'         => $request->no_hp,
            'no_ktp'        => $request->no_ktp,
            'foto_path'     => $foto_path ?? null,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password'      => Hash::make($request->password)

        ]);

        // return response
        return response()->json([
            'success'   => true,
            'message'   => 'Data berhasil disimpan!',
            'data'      => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get detail data
        $data = User::find($id);
        return response()->json([
            'success'   => true,
            'message'   => 'Detail data',
            'data'      => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('settings.users.edit', ['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // define id
        $data = User::find($id);
        //define validasi
        $validator = Validator::make($request->all(), [
            'nama'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password'      => ['nullable', 'min:6', 'confirmed'],
            'foto_path'     => ['nullable','max:1024','mimes:jpg,jpeg,png'],
        ]);

        //check validasi fail
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tanggal_lahir = null;
        // Check if tanggal_lahir is provided and not null
        if ($request->has('tanggal_lahir') && $request->input('tanggal_lahir') !== null) {
            $tanggal_lahir = Carbon::createFromFormat('m/d/Y', $request['tanggal_lahir'])->format('Y-m-d');
        }

        if ($request->foto_path) {
            $destinationPath = 'storage/user_photo/';
            if ($data->foto_path != null) {

                $oldImg = $data->foto_path;
                unlink($destinationPath . '/' . $oldImg);

                $foto_path = $request->foto_path;
            }
            $foto_path = $request['nama'] . '_' . 'Foto' . '.' . $request->foto_path->extension();
            $request->foto_path->move($destinationPath, $foto_path);
        }else{
            $foto_path = $data->foto_path;
        }

        // update data data
        $data->update([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'role'          => $request->role,
            'no_hp'         => $request->no_hp,
            'no_ktp'        => $request->no_ktp,
            'foto_path'     => $foto_path ?? null,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password'      => Hash::make($request->password)
        ]);
        return redirect()->route('users')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Get user data by ID
        $user = User::find($id);

        // Check if the user has a photo and delete it
        if ($user->foto_path) {
            $destinationPath = 'storage/user_photo/';
            $photoPath = $destinationPath . $user->foto_path;

            if (file_exists($photoPath)) {
                unlink($photoPath); // Delete the photo file
            }
        }

        //delete Users by ID
        User::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }
}