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

                        @if(isset($id))
                            <input type="hidden" name="id" value="{{$id}}"/>
                        @endif

                        <!-- Nom -->
                        <div class="form-group col-sm-6">
                            <label for="name">Nom</label>
                            <input class="form-control" type="text" name="name" id="name" required value="{{$machine->name ?? ""}}"/>
                            <span class="error">{{$errors->first("name") ?? ""}}</span>
                        </div>

                        <!-- Modèle -->
                        <div class="form-group col-sm-6">
                            <label for="model">Modèle</label>
                            <input class="form-control" type="text" name="model" id="model" required value="{{$machine->model ?? ""}}"/>
                            <span class="error">{{$errors->first("model") ?? ""}}</span>
                        </div>

                        <!-- Fonction -->
                        <div class="form-group col-sm-6">
                            <label for="function">Fonction</label>
                            <input class="form-control" type="text" name="function" id="function" required value="{{$machine->function ?? ""}}"/>
                            <span class="error">{{$errors->first("function") ?? ""}}</span>
                        </div>

                        <!-- Menace -->
                        <div class="form-group col-sm-6">
                            <label for="threat">Menace</label>
                            <input class="form-control" type="text" name="threat" id="threat" required value="{{$machine->threat ?? ""}}"/>
                            <span class="error">{{$errors->first("threat") ?? ""}}</span>
                        </div>

                        <!-- Etat -->
                        <div class="form-group col-sm-6">
                            <label for="status">Etat</label>
                            <select name="status" id="status" class="form-control" nowStatus="{{$machine->status ?? ""}}">
                                <option value="1">En marche</option>
                                <option value="-1">Défectueux</option>
                                <option value="0">En maintenance</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="form-group col-sm-6">
                            <label for="description">Description</label>
                            <textarea rows="5" class="form-control" type="text" name="description" id="description" required>{{$machine->description ?? ""}}</textarea>
                            <span class="error">{{$errors->first("description") ?? ""}}</span>
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
