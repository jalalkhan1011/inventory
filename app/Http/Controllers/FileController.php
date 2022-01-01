<?php

namespace App\Http\Controllers;

use App\Models\file;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.image.index');
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
        $request->validate([
            'image' => 'required',
        ]);
        $input = $request->all();
        $file = $request->file('image');
        $input['image'] = $file->getClientOriginalName();
        $file->move(public_path('upload'),$file->getClientOriginalName());

        $data = [
            'name' => $request->name,
            'image' => $input['image']

        ];
        File::create($data);

        return redirect()->back()->with('success', 'success Full file upload');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\file  $file
     * @return \Illuminate\Http\Response
     */
    public function show(file $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\file  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(file $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\file  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, file $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\file  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(file $file)
    {
        //
    }
}
