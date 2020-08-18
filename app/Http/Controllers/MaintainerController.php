<?php

namespace App\Http\Controllers;

use App\Http\Requests\MachineRequest;
use App\Machine;
use App\Maintainer;
use DemeterChain\Main;
use Exception;
use http\Env\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MaintainerController extends Controller
{

    /** get the list of all maintainers */
    public function getAllMaintainers(){
        $maintainers = Maintainer::all();
        $machines = Machine::all();
        $statuses = ["Interne", "Externe"];
        $expertises = ["Electronique", "Electricité industrielle", "Automatisme"];

        return view("maintainers",[
            "statuses" => $statuses,
            "expertises" => $expertises,
            "maintainers" =>  $maintainers,
            "machines" =>  $machines
        ]);
    }

    /** get a maintainer */
    public function getMaintainer(){
        $maintainer = Maintainer::all();
        return view("maintainer", compact('machines'));
    }


    public function addMaintainer(Request $request){

        $requirements = [
            "name" => ['required', 'max:255']
        ];

        Validator::make($request->all(),$requirements,[])->validate();

        $maintainer = $request->toArray();
        unset($maintainer["_token"]); unset($maintainer["token"]);
        Maintainer::create($maintainer);

        return Maintainer::all()->last(); //$maintainerCreated->first();

    }

    public function updateMaintainer(Request $request){

        $requirements = [
            "name" => ['required', 'max:255'],
        ];

        Validator::make($request->all(),$requirements,[])->validate();

        $newMaintainer = $request->toArray();
        unset($newMaintainer["_token"]); unset($newMaintainer["token"]);

        Maintainer::where("id",$request->id)->update($newMaintainer);

        return $newMaintainer;
    }


    /** delete a maintainer
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteMaintainer(Request $request){
        Maintainer::destroy($request->id);
        return response()->json(["message" => "success"]);
    }


    /* Maintenances */


    public function getAllMaintenances(Request $request){
        return Maintainer::where("id",$request->id)->first()->maintainedMachines;
    }

    public function addMaintenance(Request $request){

        $machine = Machine::where("code",$request->code)->first();
        $maintainer = Maintainer::where("id",$request->id)->first();

        $maintainer->maintainedMachines()->attach($machine->id,[
            "date" => new \DateTime(),
        ]);
        return redirect()->route("maintainers");

    }

    public function deleteMaintenance(Request $request){
        $maintainer = Maintainer::where("id",$request->id)->first();
        /*$maintainer->maintainedMachines()->detach($request->input("machineId"),[
            "date" => $request->input("date"),
        ]);*/
        DB::delete('delete from machine_maintainer where machine_id = ? AND maintainer_id = ? AND date = ?',[
            $request->input("machineId"), $request->id, $request->input("date"),
        ]);
        return $request->all();
    }

}
