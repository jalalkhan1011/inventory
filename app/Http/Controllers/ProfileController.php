<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTraits;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class ProfileController extends Controller
{
    use ImageTraits;
    const UPLOAD_DIR = '/uploads/profileImage/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::where('user_id',auth()->user()->id)->first();
//        dd($profile);
        $user = Auth::user();

        if(!empty($profile))
            return view('admin.profiles.edit',compact('user','profile'));
        else
            return view('admin.profiles.create',compact('user'));
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



    private function userInfo(Request $request){
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'sometimes|required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|sometimes'
        ]);
        $data = $request->only('name','email','password');
        if(empty($request->password)){
            $user->update($request->except('password'));
        }else{
            $data['password'] = Hash::make($request->password);
            $user->update($data);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = Profile::where('user_id',auth()->user()->id)->first();

        if($profile){
        $request->validate([
            'profile_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'mobile' => 'required|unique:profiles,mobile,'.$profile->id,
            'address' => 'nullable'
        ]);
        $data = $request->only('profile_image','mobile','address');
        $data['user_id'] = auth()->user()->id;

        if($request->has('profile_image')){
            $this->unlink($profile->profile_image);
            $data['profile_image'] = $this->upload($request->profile_image,'profile_image');
        }
        $profile->update($data);

        $this->userInfo($request);

            return redirect('admin/profiles');
        }else{
            $request->validate([
                'profile_image' => 'nullable|mimes:jpeg,jpg,png,gif',
                'mobile' => 'required|unique:profiles,mobile',
                'address' => 'nullable'
            ]);
            $data = $request->only('profile_image','mobile','address');
            $data['user_id'] = auth()->user()->id;

            if($request->has('profile_image')){
                $data['profile_image'] = $this->upload($request->profile_image,'profile_image');
            }
            Profile::create($data);
            $this->userInfo($request);

            return redirect('admin/profiles');
        }
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
        //
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
        //
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
