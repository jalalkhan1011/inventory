<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:supplier-list|supplier-create|supplier-edit|supplier-delete', ['only' => ['index,show']]);
        $this->middleware('permission:supplier-create', ['only' => ['create,store']]);
        $this->middleware('permission:supplier-edit', ['only' => ['edit,update']]);
        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::latest()->paginate(10);
        return view('admin.suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');
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
            'name' => 'required',
            'shop_name' => 'required',
            'mobile' => 'required|min:11|max:11|unique:suppliers,mobile',
            'email' => 'nullable|email|unique:suppliers,email',
            'address' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        Suppliers::create($data);

        return redirect('admin/suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppliers $suppliers,$id)
    {
        $suppliers = Suppliers::findOrFail($id);
        return view('admin.suppliers.edit',compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suppliers $suppliers,$id)
    {
        $suppliers = Suppliers::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'shop_name' => 'required',
            'mobile' => 'required|min:11|max:11|unique:suppliers,mobile,'.$suppliers->id,
            'email' => 'nullable|email|unique:suppliers,email,'.$suppliers->id,
            'address' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $suppliers->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppliers $suppliers,$id)
    {
        $suppliers = Suppliers::findOrfail($id);
        $suppliers->delete();

        return redirect('admin/suppliers');
    }
}
