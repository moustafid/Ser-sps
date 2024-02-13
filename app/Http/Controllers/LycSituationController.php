<?php

namespace App\Http\Controllers;

use App\Etablissements;
use App\Exports\SituationLycExport;
use App\LycSituation;
use App\phases;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LycSituationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $LycSituations = LycSituation::all();
        $count_situation = LycSituation::count();
        return view('lycsituation.lycsituation', compact('LycSituations', 'count_situation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phases = phases::all()->where('id', 3);
        $etablissements = Etablissements::all()->where('phase_id', 3);
        return view('lycsituation.add_lycsituation', compact('etablissements', 'phases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return LycSituation::create([
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
        ]);exit();
        session()->flash('Add', 'تم اضافة وضعية المؤسسة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(LycSituation $lycSituation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LycSituation $lycSituation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LycSituation $lycSituation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LycSituation $lycSituation)
    {
        //
    }

    public function export()
    {

        return Excel::download(new SituationLycExport, 'الوضعية المالية الشهرية لطور الثانوي.xlsx');

    }
}
