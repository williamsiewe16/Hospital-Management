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

class MachineController extends Controller
{
    /** get the login form */
    public function getLoginForm(){
        return view("login");
    }

    /** log into an account */
    public function login(){
        return "login";
    }

    /** logout */
    public function logout(){
        return "logout";
    }

    /** get the list of all machines */
    public function getAllMachines(){
        $machines = Machine::all();
        return view("machines", compact('machines'));
    }

    /** form for adding a machine */
    public function displayFormAddMachine(){
        $services = ["Service radiologie", "Service cardiologie", "Service ambulatoire", "Service réanimation"];
        $origins = ["Don", "Achat"];

        return view("machine",[
            "services" => $services,
            "origins" => $origins
        ]);
    }

    /** add a machine
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function addMachine(Request $request){

        $requirements = [
            "name" => ['required', 'max:255'], "code" => ['required', 'max:255'], "service" => "required",
            "cost" => "required", "origin" => "required", "expirationDate" => ["date"],
             //"model" => 'required', "function" => 'required', "threat" => "required", "description" => 'required', "status" => 'required',
        ];

        Validator::make($request->all(),$requirements,[])->validate();

        $machine = $request->toArray();
        unset($machine["_token"]);
        $machine["addDate"] = new \DateTime();

        Machine::create($machine);
        return redirect()->route('machines');
    }

    /** form for updating a machine
     * @param $id
     * @return Factory|View
     */
    public function displayFormUpdateMachine($id){
        $machine = Machine::find($id);
        $services = ["Service radiologie", "Service cardiologie", "Service ambulatoire", "Service réanimation"];
        $origins = ["Don", "Achat"];

        return view("machine",[
            "machine" => $machine,
            "services" => $services,
            "origins" => $origins
        ]);
    }

    /** update a machine
     * @param Request $request
     * @return RedirectResponse|string
     * @throws Exception
     */
    public function updateMachine(Request $request){

        $requirements = [
            "name" => ['required', 'max:255'], "code" => ['required', 'max:255'], "service" => "required",
            "cost" => "required", "origin" => "required", "expirationDate" => ["date"],
            //"model" => 'required', "function" => 'required', "threat" => "required", "description" => 'required', "status" => 'required',
        ];

        Validator::make($request->all(),$requirements,[])->validate();

        $machine = $request->toArray();
        unset($machine["_token"]);


        $machine = Machine::where('id',$request->id)
            ->update($machine);

        return redirect()->route('machines');
    }

    /** delete a machine
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteMachine(Request $request){
        Machine::destroy($request->id);
        return redirect()->route('machines');
    }


}
