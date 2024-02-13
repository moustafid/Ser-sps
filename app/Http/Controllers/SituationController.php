<?php

namespace App\Http\Controllers;

use App\Etablissements;
use App\Exports\InvoicesExport;
use App\invoices;
use App\phases;
use App\Situation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SituationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $situations = Situation::all();
        $count_situation = Situation::count();
        return view('situations.situations', compact('situations', 'count_situation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phases = phases::all()->where('id', 1);
        $etablissements = Etablissements::all()->where('phase_id', 1);
        return view('situations.add_situation', compact('etablissements', 'phases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Situation::create([
            'Number_manko' => $request->Number_manko,
            'Phase_id' => $request->Phase,
            'Etablissement' => $request->Etablissement,
            'Number_hk' => $request->Number_hk,

            'Credit_OSB' => $request->Credit_OSB,
            'Revenues_OSB' => $request->Revenues_OSB,
            'Expenses_OSB' => $request->Expenses_OSB,
            'Credit_Fin_Month_OSB' => $request->Credit_Fin_Month_OSB,

            'Credit_OIEB' => $request->Credit_OIEB,
            'Revenues_OIEB' => $request->Revenues_OIEB,
            'Expenses_OIEB' => $request->Expenses_OIEB,
            'Credit_Fin_Month_OIEB' => $request->Credit_Fin_Month_OIEB,

            'Total' => $request->Total,
            'note' => $request->note,
        ]);
        session()->flash('Add', 'تم اضافة وضعية المؤسسة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Situation $situation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $situations = Situation::where('id', $id)->first();
        $phases = phases::all()->where('id', 1);
        return view('situations.edit_situation', compact('phases', 'situations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $situations = Situation::findOrFail($request->invoice_id);
        $situations->update([
            'Number_manko' => $request->Number_manko,
            'Phase_id' => $request->Phase,
            'Etablissement' => $request->Etablissement,
            'Number_hk' => $request->Number_hk,

            'Credit_OSB' => $request->Credit_OSB,
            'Revenues_OSB' => $request->Revenues_OSB,
            'Expenses_OSB' => $request->Expenses_OSB,
            'Credit_Fin_Month_OSB' => $request->Credit_Fin_Month_OSB,

            'Credit_OIEB' => $request->Credit_OIEB,
            'Revenues_OIEB' => $request->Revenues_OIEB,
            'Expenses_OIEB' => $request->Expenses_OIEB,
            'Credit_Fin_Month_OIEB' => $request->Credit_Fin_Month_OIEB,

            'Total' => $request->Total,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل وضعية المؤسسة بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = Situation::where('id', $id)->first();

        $id_page =$request->id_page;


        if (!$id_page==2) {


            $invoices->forceDelete();
            session()->flash('delete_invoice');
            return redirect('/situations');

        }

        else {

            $invoices->delete();
            session()->flash('archive_invoice');
            return redirect('/Archive');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getetablissementspre($id)
    {
        $products = DB::table("etablissements")->where("phase_id", $id)->pluck("etablissement_name", "id");
        return json_encode($products);
    }

    public function export()
    {

        return Excel::download(new InvoicesExport, 'الوضعية المالية الشهرية لطور الإبتدائي.xlsx');

    }
}
