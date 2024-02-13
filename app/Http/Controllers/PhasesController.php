<?php

namespace App\Http\Controllers;

use App\phases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PhasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phases = phases::all();
        return view('phases.phases',compact('phases'));
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

        $validatedData = $request->validate([
            'phase_name' => 'required|unique:phases|max:255',
        ],[

            'phase_name.required' =>'يرجي ادخال اسم الطور',
            'phase_name.unique' =>'اسم الطور مسجل مسبقا',


        ]);

            phases::create([
                'phase_name' => $request->phase_name,
                'Created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'تم اضافة الطور بنجاح ');
            return redirect('/phases');

        }



    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'phase_name' => 'required|max:255|unique:phases,phase_name,'.$id,
        ],[

            'phase_name.required' =>'يرجي ادخال اسم الطور',
            'phase_name.unique' =>'اسم الطور مسجل مسبقا',
        ]);

        $sections = phases::find($id);
        $sections->update([
            'phase_name' => $request->phase_name,
        ]);

        session()->flash('edit','تم تعديل الطور بنجاج');
        return redirect('/phases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        phases::find($id)->delete();
        session()->flash('delete','تم حذف الطور بنجاح');
        return redirect('/phases');
    }
}
