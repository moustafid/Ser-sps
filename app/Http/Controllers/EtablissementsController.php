<?php

namespace App\Http\Controllers;

use App\Etablissements;
use App\phases;
use App\products;
use App\sections;
use Illuminate\Http\Request;

class EtablissementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phases = phases::all();
        $sections = sections::all();
        $products = products::all();
        $etablissements = Etablissements::all();
        return view('etablissements.etablissements', compact( 'etablissements', 'products', 'sections', 'phases'));
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
        Etablissements::create([
            'etablissement_name' => $request->category . " " . $request->etablissement_name . " (  )",
            'section_id' => $request->Section,
            'product_id' => $request->product,
            'phase_id' => $request->phase,
        ]);
        session()->flash('Add', 'تم اضافة المؤسسة بنجاح ');
        return redirect('/etablissements');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $id_section = sections::where('section_name', $request->section_name)->first()->id;
       $id_phase = phases::where('phase_name', $request->phase_name)->first()->id;
       $id_product = products::where('Product_name', $request->product)->first()->id;
       $Products = Etablissements::findOrFail($request->pro_id);

       $Products->update([
           'etablissement_name' => $request->etablissement_name,
           'phase_id' => $id_phase,
           'product_id' => $id_product,
           'section_id' => $id_section,
       ]);

       session()->flash('Edit', 'تم تعديل المؤسسة بنجاح');
       return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $Products = Etablissements::findOrFail($request->pro_id);
         $Products->delete();
         session()->flash('delete', 'تم حذف المنتج بنجاح');
         return back();
    }
}
