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
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MaintainerController extends Controller
{

    /** get the list of all maintainers */
    public function getAllMaintainers(){
        $maintainers = Maintainer::all();
        $statuses = ["Interne", "Externe"];
        $expertises = ["Electronique", "Electricité industrielle", "Automatisme"];

        return view("maintainers",[
            "statuses" => $statuses,
            "expertises" => $expertises,
            "maintainers" =>  $maintainers
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


}
