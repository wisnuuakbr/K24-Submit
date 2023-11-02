<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        $data = $user->profile;

        return view('settings.profile.index', ['data' => $data]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = User::find($id);
        return view('settings.profile.edit', ['data' => $profile]);
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
        $profile = User::find($id);

        $request->validate([
            'nama' => 'required',
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password'      => ['nullable', 'min:6', 'confirmed'],
            'foto_path'     => ['nullable','max:1024','mimes:jpg,jpeg,png'],
        ]);

        $tanggal_lahir = null;
        // Check if tanggal_lahir is provided and not null
        if ($request->has('tanggal_lahir') && $request->input('tanggal_lahir') !== null) {
            $tanggal_lahir = Carbon::createFromFormat('m/d/Y', $request['tanggal_lahir'])->format('Y-m-d');
        }

        if ($request->foto_path) {
            $destinationPath = 'storage/user_photo/';
            if ($profile->foto_path != null) {

                $oldImg = $profile->foto_path;
                unlink($destinationPath . '/' . $oldImg);

                $foto_path = $request->foto_path;
            }
            $foto_path = $request['nama'] . '_' . 'Foto' . '.' . $request->foto_path->extension();
            $request->foto_path->move($destinationPath, $foto_path);
        }else{
            $foto_path = $profile->foto_path;
        }

        // update profile profile
        $profile->update([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'no_hp'         => $request->no_hp,
            'no_ktp'        => $request->no_ktp,
            'foto_path'     => $foto_path ?? null,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password'      => Hash::make($request->password)
        ]);
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}