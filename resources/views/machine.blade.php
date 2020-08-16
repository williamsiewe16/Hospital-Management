@extends("layout/template")

@section("title")
    <title>Machine</title>
@endsection


@section("contenu")
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">{{isset($machine) ? 'Modifier la machine' : 'Ajouter une machine'}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" action="{{isset($machine) ? '/update-machine' : '/add-machine'}}">
                    @csrf
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
                    <div class="m-t-20 text-center">
                        <a href="/machines" class="btn btn-secondary submit-btn">Annuler</a>
                        <button class="btn btn-primary submit-btn">{{isset($machine) ? 'Modifier la machine' : 'Créer la machine'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
