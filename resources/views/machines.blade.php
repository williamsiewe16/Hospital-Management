@extends("layout/template")

@section("title")
<title>Machines</title>
    @endsection


@section("contenu")
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Machines</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="/add-machine" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Ajouter une machine</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-border table-striped custom-table datatable mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Code</th>
                           <!-- <th>Modèle</th> -->
                            <th>Service d'exploitation</th>
                          <!--  <th>Menace</th>
                            <th>Description</th>
                            <th>Etat</th> -->
                            <th>Prix</th>
                            <th>Provenance</th>
                            <th>Date d'ajout</th>
                            <th>Date d'expiration</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($machines as $key => $machine)
                        <tr data-id="{{$machine->id}}">
                            <input type="hidden" name="id" value="{{$machine->id}}"/>
                            <th >{{$key+1}}</th>
                            <td >{{$machine->name}}</td>
                            <td >{{$machine->code}}</td>
                            <td >{{$machine->service}}</td>
                            <td >{{$machine->cost}}</td>
                            <td >{{$machine->origin}}</td>
                            <td >{{$machine->addDate}}</td>
                            <td >{{$machine->expirationDate}}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right menu_">
                                        <a class="dropdown-item view-machine" href="#" data-toggle="modal" data-target='#viewModal'><i class="fa fa-eye m-r-5"></i>Voir la Fiche</a>
                                        <a class="dropdown-item edit-machine" href="/update-machine/{{$machine->id}}"><i class="fa fa-pencil m-r-5"></i>Modifier</a>
                                        <a class="dropdown-item delete-machine" href="#" data-toggle="modal" data-target='#deleteModal'><i class="fa fa-trash-o m-r-5"></i>Supprimer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection


@section("deleteModalContent")
    <div class="modal-header" style="text-align: center">
        <h5 class="modal-title" id="deleteModalLabel">Êtes vous sur de vouloir supprimer cette machine? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body text-center">
        <form method="post" action="/delete-machine">
            @csrf
            <a href="#" class="btn btn-white" data-dismiss="modal">Non</a>
            <button type="submit" class="btn btn-danger">Oui</button>
        </form>
    </div>
    @endsection


@section("viewModalContent")
    <div class="modal-header" style="text-align: center">
        <h5 class="modal-title" id="viewModalLabel"> Fiche de la machine </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body text-center">
        <form method="post">
                <h4 style="font-style: italic; color: black" class="text-primary">Informations générales</h4>
                <div class="row">

                <!-- Nom -->
                    <div class="form-group col-sm-6">
                        <label for="name">Nom</label>
                        <input class="form-control" type="text" name="name" id="name" disabled/>
                    </div>

                    <!-- Code -->
                    <div class="form-group col-sm-6">
                        <label for="code">Code</label>
                        <input class="form-control" type="text" name="code" id="code" disabled/>
                    </div>

                    <!-- Service d'exploitation -->
                    <div class="form-group col-sm-6">
                        <label for="status">Service d'exploitation</label>
                        <input name="service" id="service" class="form-control" disabled />
                    </div>

                    <!-- Prix -->
                    <div class="form-group col-sm-6">
                        <label for="cost">Prix <i style="font-size: 0.8em">(en FCFA)</i></label>
                        <input class="form-control" type="text" name="cost" id="cost" disabled />
                    </div>

                    <!-- Provenance -->
                    <div class="form-group col-sm-6">
                        <label for="origin">Provenance</label>
                        <input name="origin" id="origin" class="form-control" disabled />
                    </div>

                    <!-- Date d'ajout -->
                    <div class="form-group col-sm-6">
                        <label for="addDate">Date d'ajout</label>
                        <input class="form-control" type="text" name="addDate" id="addDate" disabled/>
                    </div>

                    <!-- Date d'expiration -->
                    <div class="form-group col-sm-6">
                        <label for="expirationDate">Date d'expiration</label>
                        <input class="form-control" type="text" name="expirationDate" id="expirationDate" disabled/>
                    </div>

                </div>

                <br/>

                <h4 style="font-style: italic; color: black" class="text-primary">Fournisseur</h4>
                <div class="row">

                    <!-- Nom -->
                    <div class="form-group col-sm-6">
                        <label for="providerName">Nom</label>
                        <input class="form-control" type="text" name="providerName" id="providerName" disabled />
                    </div>

                    <!-- Numero de contrat -->
                    <div class="form-group col-sm-6">
                        <label for="providerContractNumber">Numéro de contrat</label>
                        <input class="form-control" type="text" name="providerContractNumber" id="providerContractNumber" disabled />
                    </div>

                    <!-- Garantie -->
                    <div class="form-group col-sm-6">
                        <label for="providerWarranty">Garantie</label>
                        <input class="form-control" name="providerWarranty" id="providerWarranty" disabled/>
                    </div>

                    <!-- Pays d'origine -->
                    <div class="form-group col-sm-6">
                        <label for="providernativeCountry">Pays d'origine</label>
                        <input class="form-control" type="text" name="providerNativeCountry" id="providerNativeCountry" disabled />
                    </div>

                </div>
        </form>
    </div>
@endsection
