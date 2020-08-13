<?php

namespace App\Http\Controllers;

use App\Http\Requests\MachineRequest;
use App\Machine;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MaintainerController extends Controller
{

    /** get the list of all machines */
    public function getAllMaintainers(){
        $machines = Machine::all();
        return view("maintainers", compact('machines'));
    }

    /** get a maintainer */
    public function getMaintainer(){
        $machines = Machine::all();
        return view("maintainer", compact('machines'));
    }


    public function addMaintainer(Request $request){

        $requirements = [
            "name" => ['required', 'max:255'], "model" => 'required', "function" => 'required',
            "threat" => "required", "description" => 'required', "status" => 'required',
        ];

        Validator::make($request->all(),$requirements,[])->validate();

        $machine = $request->toArray();
        unset($machine["_token"]);
        $machine["addDate"] = new \DateTime();
        $machine["lastStatusUpdateDate"] = new \DateTime();

        Machine::create($machine);
        return redirect()->route('machines');
    }

    public function updateMaintainer(Request $request){

        $requirements = [
            "name" => ['required', 'max:255'], "model" => 'required', "function" => 'required',
            "threat" => "required", "description" => 'required', "status" => 'required',
        ];

        Validator::make($request->all(),$requirements,[])->validate();

        $machine = $request->toArray();
        unset($machine["_token"]);
        $machine["addDate"] = new \DateTime();
        $machine["lastStatusUpdateDate"] = new \DateTime();

        Machine::create($machine);
        return redirect()->route('machines');
    }


    /** delete a machine
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteMaintainer(Request $request){
        Machine::destroy($request->id);
        return redirect()->route('machines');
    }


}
