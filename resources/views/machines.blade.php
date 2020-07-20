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
                            <th>Modèle</th>
                            <th>Fonction</th>
                            <th>Menace</th>
                            <th>Description</th>
                            <th>Etat</th>
                            <th>Date d'ajout</th>
                            <th>Dernière modification d'état</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($machines as $key => $machine)
                        <tr>
                            <input type="hidden" name="id" value="{{$machine->id}}"/>
                            <th >{{$key+1}}</th>
                            <td >{{$machine->name}}</td>
                            <td >{{$machine->model}}</td>
                            <td >{{$machine->function}}</td>
                            <td >{{$machine->threat}}</td>
                            <td >{{$machine->description}}</td>
                            <td >{{ $machine->status ==1 ? "En marche" : ($machine->status ==0 ? "En maintenance" : "Défectueux")}}</td>
                            <td >{{$machine->addDate}}</td>
                            <td >{{$machine->lastStatusUpdateDate}}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right menu_">
                                        <a class="dropdown-item" href="/update-machine/{{$machine->id}}"><i class="fa fa-pencil m-r-5"></i>Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target='#deleteModal'><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
