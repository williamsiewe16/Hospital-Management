@extends("layout/template")

@section("title")
    <title>Machine</title>
@endsection


@section("contenu")
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h3 class="page-title" style="color: black">{{isset($machine) ? 'Modifier la machine' : 'Ajouter une machine'}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" action="{{isset($machine) ? '/update-machine' : '/add-machine'}}">
                    @csrf
                    <h4 style="font-style: italic; color: black">* Informations générales</h4>
                    <div class="row">

                        @if(isset($machine))
                            <input type="hidden" name="id" value="{{$machine->id}}"/>
                        @endif

                            <!-- Nom -->
                        <div class="form-group col-sm-6">
                            <label for="name">Nom</label>
                            <input class="form-control" type="text" name="name" id="name" required value="{{$machine->name ?? ""}}"/>
                            <span class="error">{{$errors->first("name") ?? ""}}</span>
                        </div>

                            <!-- Code -->
                        <div class="form-group col-sm-6">
                            <label for="code">Code</label>
                            <input class="form-control" type="text" name="code" id="code" required value="{{$machine->code ?? ""}}"/>
                            <span class="error">{{$errors->first("code") ?? ""}}</span>
                        </div>

                            <!-- Service d'exploitation -->
                         <div class="form-group col-sm-6">
                            <label for="status">Service d'exploitation</label>
                            <select name="service" id="service" class="form-control" nowStatus="{{$machine->service ?? ""}}">
                                @foreach($services ?? '' as $service)
                                   <option value="{{$service}}">{{$service}}</option>
                                @endforeach
                            </select>
                        </div>

                            <!-- Prix -->
                            <div class="form-group col-sm-6">
                                <label for="cost">Prix <i style="font-size: 0.8em">(en FCFA)</i></label>
                                <input class="form-control" type="text" name="cost" id="cost" required value="{{$machine->cost ?? ""}}"/>
                                <span class="error">{{$errors->first("cost") ?? ""}}</span>
                            </div>

                            <!-- Provenance -->
                            <div class="form-group col-sm-6">
                                <label for="origin">Provenance</label>
                                <select name="origin" id="origin" class="form-control" nowStatus="{{$machine->origin ?? ""}}">
                                    @foreach($origins ?? '' as $origin)
                                        <option value="{{$origin}}">{{$origin}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date d'expiration -->
                            <div class="form-group col-sm-6">
                                <label for="expirationDate">Date d'expiration</label>
                                <input class="form-control" type="date" name="expirationDate" id="expirationDate" value="{{$machine->expirationDate ?? ""}}"/>
                                <span class="error">{{$errors->first("expirationDate") ?? ""}}</span>
                            </div>

                    </div>

                    <br/>

                    <h4 style="font-style: italic; color: black">* Fournisseur</h4>
                    <div class="row">

                        <!-- Nom -->
                        <div class="form-group col-sm-6">
                            <label for="providerName">Nom</label>
                            <input class="form-control" type="text" name="providerName" id="providerName" required value="{{$machine->provider->name ?? ""}}"/>
                            <span class="error">{{$errors->first("providerName") ?? ""}}</span>
                        </div>

                        <!-- Numero de contrat -->
                        <div class="form-group col-sm-6">
                            <label for="providerContractNumber">Numéro de contrat</label>
                            <input class="form-control" type="text" name="providerContractNumber" id="providerContractNumber" required value="{{$machine->provider->contractNumber ?? ""}}"/>
                            <span class="error">{{$errors->first("providerContractNumber") ?? ""}}</span>
                        </div>

                        <!-- Garantie -->
                        <div class="form-group col-sm-6">
                            <label for="providerWarranty">Garantie</label>
                            <select class="form-control" name="providerWarranty" id="providerWarranty" required nowStatus="{{$machine->provider->warranty ?? ""}}">
                                @foreach($warranties as $warranty)
                                    <option value="{{$warranty}}">{{$warranty}}</option>
                                @endforeach
                            </select>
                            <span class="error">{{$errors->first("providerWarranty") ?? ""}}</span>
                        </div>

                        <!-- Pays d'origine -->
                        <div class="form-group col-sm-6">
                            <label for="providernativeCountry">Pays d'origine</label>
                            <input class="form-control" type="text" name="providerNativeCountry" id="providerNativeCountry" required value="{{$machine->provider->nativeCountry ?? ""}}"/>
                                        <span class="error">{{$errors->first("providerNativeCountry") ?? ""}}</span>
                        </div>

                    </div>
                    <div class="m-t-20 text-center">
                        <a href="/machines" class="btn btn-secondary submit-btn">Annuler</a>
                        <button class="btn btn-primary submit-btn">{{isset($machine) ? 'Modifier la machine' : 'Créer la machine'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
