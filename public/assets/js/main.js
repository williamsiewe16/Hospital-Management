(function($) {

    "use strict"

    /* Maintenancier */
    $('.edit').on('click',function(){
        $("#maintainerModal").find('.modal-title').text("Modifier le maintenaincier")
        $("#maintainerForm").find('input[type="text"]').val($(this).parents('.profile-widget').find('.doctor-name').text())
        $("#maintainerForm").find('input[type="email"]').val($(this).parents('.profile-widget').find('.doc-prof').text())

        let a = $('input[name="id"]')
        if(a.length != 0) a.remove()
        let id_input = $(`<input type='hidden' name='id' value='${$(this).parents('.profile-widget').data("id")}'>`)
        $("#maintainerForm").prepend(id_input)
    })

    $('.add').on('click',function(){
        $("#maintainerModal").find('.modal-title').text("Ajouter un maintenaincier")
        $('.form-control').val('')
        let a = $('input[name="id"]')
        if(a.length != 0) a.remove()
    })

    $('#maintainerForm').on('submit',function(e){
        e.preventDefault()
        let data = $(this).serialize()
        let a = $('input[name="id"]')

        let url = a.length != 0 ? `/app/admin/advertisers/${a.val()}` : `/app/admin/advertisers`
        $("#loading").show()
        Ajax(url,function(data){
            data = JSON.parse(data), $("#loading").hide(), $("#maintainerModal").find("span[aria-hidden='true']").click();

            if(a.length != 0){
                $('.profile-widget[data-id='+a.val()+']').find('.doctor-name').text(data.username)
                $('.profile-widget[data-id='+a.val()+']').find('.doc-prof').text(data.email)
            }else{
                if(data.error == undefined) $(".doctor-grid").append(generateAdvertiser(data))
            }

            if(data.error == undefined) showSnackbar("success","green","1500")
            else showSnackbar(data.error,"red","1500")

        },() => {showSnackbar("error","red","1500")},data,"POST")
    })

    $(".delete").on("click",function(e){
        swal({text: "Voulez-vous vraiment supprimer cet annonceur? ",
            buttons: { supprimer: {closeModal: false}, fermer: "cancel"}})
            .then((change) => {
                if(change == null) throw null;
                else{
                    return  $.ajax({url: `/app/admin/advertiser/${$(this).parents(".profile-widget").data("id")}?token=${$('input[name="token"]').val()}`, type: "GET", dataType:"text"})
                }})
            .then((response) => {
                if (response == "no token") window.location.href = "/app/login"
                swal({text: "Opération effectuée", icon: "success"});
                setTimeout(() => window.location.href = "/app/admin/advertisers", 1000)})
            .catch(err => {
                if(err) swal({text: "une erreur est survenue", icon: "error"});
                swal.stopLoading();
                swal.close()})
    })


    function generateMaintainer(maintainer){
        let a = "<div class=\"col-md-4 col-sm-4  col-lg-3\">\n" +
            `                   <div class=\"profile-widget\" data-id=\"${advertiser._id}\">\n` +
            "                       <div class=\"doctor-img\">\n" +
            "                           <a class=\"avatar\" href=\"#\"><img alt=\"user\" src=\"/src/assets/images/user.jpg\" /></a>\n" +
            "                       </div>\n" +
            "                       <div class=\"dropdown profile-action\">\n" +
            "                           <a href=\"#\" class=\"action-icon dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa fa-ellipsis-v\"></i></a>\n" +
            "                           <div class=\"dropdown-menu dropdown-menu-right\">\n" +
            "                               <a class=\"dropdown-item edit\" data-toggle=\"modal\" data-target=\"#advertiserModal\" style=\"cursor: pointer\"><i class=\"far fa-edit m-r-5\"></i> Modifier</a>\n" +
            "                               <a class=\"dropdown-item\" style=\"cursor: pointer\"><i class=\"fas fa-trash m-r-5\"></i> Supprimer</a>\n" +
            "                           </div>\n" +
            "                       </div>\n" +
            `                       <h4 class=\"doctor-name text-ellipsis\"><a href=\"profile.html\">${advertiser.username}</a></h4>\n` +
            `                       <div class=\"doc-prof\">${advertiser.email}</div>\n` +
            "                   </div>\n" +
            "               </div>"
        return a
    }

    function Ajax(url_,success,error,data_,type="GET"){
        $.ajax({
            url:url_, type: type,
            dataType:"text", data:data_,
            success: function(data,statut){
                success(data)
            },
            error: function(data,statut){
                error(data)
            }
        });
    }

    function showSnackbar(text,color,timeout=15000) {
        // Get the snackbar DIV
        let x = $("#snackbar")
        x.text(text)
        x.css("backgroundColor",color)
        x.addClass("show")

        // After 3 seconds, remove the show class from DIV
        setTimeout(() => { x.removeClass("show") }, timeout);
    }

    function AjaxPost(url_, data_,success,error) {
        $.ajax({
            url: url_,
            type: 'POST',
            dataType: "text",
            processData: false,
            contentType: false,
            enctype: "multipart/form-data",
            data: data_,
            error: function (resultat, statut, erreur) {
                error(erreur);
            },
            success: function (data, statut) {
                success(data);
            }
        });
    }


})(jQuery);
