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
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget" data-id="">
                    <div class="doctor-img">
                        <a class="avatar" href=""><img alt="user" src="assets/images/user.jpg" /></a>
                    </div>
                    <div class="dropdown profile-action">
                        <a href="" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item edit" data-toggle="modal" data-target="#maintainerModal" style="cursor: pointer"><i class="fa fa-edit m-r-5"></i> Modifier</a>
                            <a class="dropdown-item delete" style="cursor: pointer"><i class="fa fa-trash-o m-r-5"></i> Supprimer</a>
                        </div>
                    </div>
                    <h4 class="doctor-name text-ellipsis"><a href=""></a></h4>
                    <div class="doc-prof"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="snackbar"></div>


    <!-- maintainer Modal -->
    <div class="modal fade" id="maintainerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLong" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="maintainerForm" method="post" action="">
                        <input value="<%= token %>" name="token" type="hidden" required/>
                        <div>
                            <label for="username">Username</label>
                            <input id="username" type="text" name="username" class="form-control" required/>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control" required/>
                        </div>
                        <div style="display: flex; justify-content: flex-end; align-items: center" class="m-t-20">
                            <img src="../../src/assets/images/2.gif" style="display: none" id="loading"/>
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
