@extends("layout/template")

@section("title")
    <title>Maintenanciers</title>
@endsection


@section("contenu")

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

        <!-- Maintainers -->

        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Maintenanciers</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20 add">
                <a style="cursor: pointer; color: white" data-toggle="modal" data-target="#maintainerModal" class="btn btn-primary btn-rounded float-right add"><i class="fa fa-plus"></i> Ajouter</a>
            </div>
        </div>
        <div class="row doctor-grid">
            @foreach($maintainers as $key => $maintainer)
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget" data-id="{{$maintainer->id}}">
                    <div class="doctor-img">
                        <a class="avatar" href="#"><img alt="user" src="assets/images/user.jpg" /></a>
                    </div>
                    <div class="dropdown profile-action">
                        <a class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item edit" data-toggle="modal" data-target="#maintainerModal" style="cursor: pointer"><i class="fa fa-edit m-r-5"></i> Modifier</a>
                            <a class="dropdown-item delete" style="cursor: pointer"><i class="fa fa-trash-o m-r-5"></i> Supprimer</a>
                        </div>
                    </div>
                    <div class="doctor-name text-ellipsis" style="color: black"><a>{{$maintainer->name}}</a></div>
                    <div class="doc-prof">{{$maintainer->expertise." (".$maintainer->status.")"}}</div>
                </div>
            </div>
                @endforeach
        </div>
    </div>
    <div id="snackbar"></div>


    <!-- maintainer Modal -->
    <div class="modal fade" id="maintainerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLong" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="font-weight: bold; color: black"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="maintainerForm" method="post" action="">
                        @csrf
                        <input value="<%= token %>" name="token" type="hidden" required/>
                         <!-- Nom -->
                        <div>
                            <label for="name" style="color: black">Nom</label>
                            <input id="name" type="text" name="name" class="form-control" required/>
                        </div>

                        <!-- Statut -->
                        <div>
                            <label for="status" style="color: black">Statut</label>
                            <select id="status" name="status" class="form-control" required>
                                @foreach($statuses as $status)
                                    <option value="{{$status}}">{{$status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Domaine de compétence -->
                        <div>
                            <label for="expertise" style="color: black">Domaine de compétence</label>
                            <select id="expertise" name="expertise" class="form-control" required>
                                @foreach($expertises as $expertise)
                                <option value="{{$expertise}}">{{$expertise}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div style="display: flex; justify-content: flex-end; align-items: center" class="m-t-20">
                            <div id="loading" class="spinner-border spinner-border-sm" style="margin-right: 5px; display: none"></div>
                            <input type="submit" value="valider" class="btn btn-primary"/>
                        </div>
                    </form>
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
