<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Commodite;
use App\Models\Souscategory;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CommoditeController extends Controller
{
    private $module;
    private ActivityService $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->middleware('auth');
        $this->middleware('status');
        $this->activityService = $activityService;
        $this->module = "Commodités";
        View::share('page_title', 'Commodités');
        View::share('title', 'Commodités');
        View::share('menu', 'commodite');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $action = 'Affichage de la liste des Commodités';
        $this->activityService->createActivity($this->module, $action);
        $data['commodites'] = Commodite::orderByDesc('created_at')->get();
        $data['sub_title'] = 'Cette page est destinée à l\'affichage de la liste des Commodités';
        return view('pages.etablissements.commodite.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|max:255',
            'icon' => 'required|max:100',
        ]);

        $data = [
            'libelle' => htmlspecialchars($request->libelle),
            'icon' => htmlspecialchars($request->icon),
            'status' => 1,
            'created_by' => Auth::user()->name.' '.Auth::user()->lastname
        ];

        if (Commodite::create($data)){
            $action = 'Enregistrement des informations de la commodité '.ucfirst($request->libelle);
            $this->activityService->createActivity($this->module, $action);
            alert('success', 'Les informations de la commodité ont bien été enregistrées avec succès.');
            return to_route('bonplan.commodite.index');

        }else{
            alert('danger', 'Oups, une erreur s\'est produite pendant l\'enregistrement.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commodite $commodite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commodite $commodite)
    {
        $action = 'Affichage de la page de modification de la commodité '.$commodite->libelle;
        $this->activityService->createActivity($this->module, $action);
        $data['commodite'] = $commodite;
        $data['sub_title'] = 'Cette page est destinée à la modification des informations de la commodité '.$commodite->libelle;
        return view('pages.bonplan.commodite.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'libelle' => 'required|max:255',
            'icon' => 'required|max:100',
            'status' => 'required|integer'
        ]);

        if (!$commodite = Commodite::find($request->id)){
            alert('danger', 'Oups, Aucune commodité trouvée.');
            return back();
        }

        $data = [
            'libelle' => htmlspecialchars($request->libelle),
            'icon' => htmlspecialchars($request->icon),
            'status' => htmlspecialchars($request->status),
        ];

        if ($commodite->update($data)){
            $action = 'Enregistrement des informations de la commodité '.ucfirst($request->libelle);
            $this->activityService->createActivity($this->module, $action);
            alert('success', 'Les informations de la commodité ont bien été enregistrées avec succès.');
            return to_route('bonplan.commodite.index');

        }else{
            alert('danger', 'Oups, une erreur s\'est produite pendant l\'enregistrement.');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commodite $commodite)
    {
        $commodite->delete();
        $action = 'Suppression de la commodité '.$commodite->libelle;
        $this->activityService->createActivity($this->module, $action);
        alert('success', 'La commodité a bien été supprimée.');
        return back();
    }

    public function editStatus(Request $request){
        if($commodite = Commodite::find($request->id)){
            $commodite->status == 1 ? $newStatus = 0 : $newStatus = 1;
            $newStatus == 1 ? $statusMsg = 'activée' : $statusMsg = 'désactivée';

            $commodite->update(['status' => $newStatus]);
            $action = 'a '.$statusMsg.' la commodité de plan '.$commodite->libelle;
            $this->activityService->createActivity($this->module, $action);
            alert('success', 'La commodité a bien été '.$statusMsg);
            return back();
        }else{
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'Oups, une erreur s\'est produite, aucune commodité n\'a pu être trouvée.');
            return back();
        }
    }
}
