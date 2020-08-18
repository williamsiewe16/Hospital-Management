<?php

namespace App\Http\Controllers;

use App\Http\Requests\MachineRequest;
use App\Machine;
use App\Maintainer;
use App\Provider;
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
        $warranties = ["1 an", "2 ans", "3 ans"];


        return view("machine",[
            "services" => $services,
            "origins" => $origins,
            "warranties" => $warranties
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
            "cost" => "required", "origin" => "required",
            //"model" => 'required', "function" => 'required', "threat" => "required", "description" => 'required', "status" => 'required',

            /* Provider */
            "providerName" => ['required', 'max:255'], "providerContractNumber" => "required",
            "providerWarranty" => "required",  "providerNativeCountry" => "required"
        ];

        Validator::make($request->all(),$requirements,[])->validate();

        $provider = new Provider;
        $provider->name = $request->input("providerName");
        $provider->warranty = $request->input("providerWarranty");
        $provider->contractNumber = $request->input("providerContractNumber");
        $provider->nativeCountry = $request->input("providerNativeCountry");
        $provider->save();

        $machine = new Machine;
        $machine->name = $request->input("name");
        $machine->code = $request->input("code");
        $machine->service = $request->input("service");
        $machine->cost = $request->input("cost");
        $machine->origin = $request->input("origin");
        $machine->addDate = new \DateTime();
        $machine->expirationDate = $request->input("expirationDate");
        $machine->provider_id = Provider::all()->last()->id;
        $machine->save();

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
        $warranties = ["1 an", "2 ans", "3 ans"];

        return view("machine",[
            "machine" => $machine,
            "services" => $services,
            "origins" => $origins,
            "warranties" => $warranties
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
            "cost" => "required", "origin" => "required",
            //"model" => 'required', "function" => 'required', "threat" => "required", "description" => 'required', "status" => 'required',

            /* Provider */
            "providerName" => ['required', 'max:255'], "providerContractNumber" => "required",
            "providerWarranty" => "required",  "providerNativeCountry" => "required"
        ];

        Validator::make($request->all(),$requirements,[])->validate();

        $provider = Machine::where("id",$request->id)->first()->provider;
        $provider->name = $request->input("providerName");
        $provider->warranty = $request->input("providerWarranty");
        $provider->contractNumber = $request->input("providerContractNumber");
        $provider->nativeCountry = $request->input("providerNativeCountry");

        Provider::where('id',$provider->id)->update($provider->toArray());

        $machine = Machine::where("id",$request->id)->first();
        $machine->name = $request->input("name");
        $machine->code = $request->input("code");
        $machine->service = $request->input("service");
        $machine->cost = $request->input("cost");
        $machine->origin = $request->input("origin");
        if($request->input("expirationDate") != null) $machine->expirationDate = $request->input("expirationDate");
        $machine->provider_id = $provider->id;

        Machine::where('id',$machine->id)->update($machine->toArray());

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

    /** get a machine provider
     * @param Request $request
     * @return array provider
     */
    public function getMachineProvider(Request $request){
        $machine = Machine::where("id",$request->id)->first();
        return [
            "machine" => $machine,
            "provider" => $machine->provider
            ];
    }


}
