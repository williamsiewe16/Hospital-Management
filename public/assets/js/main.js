(function($) {

    "use strict"

    /* Maintenancier */
    $(".doctor-grid").on('click','.edit',function(){
        $("#maintainerModal").find('.modal-title').text("Modifier le maintenancier")
        $("#maintainerForm").find('input[type="text"]').val($(this).parents('.profile-widget').find('.doctor-name').text())
        let tab = $(this).parents('.profile-widget').find('.doc-prof').text().split("(")
        $("#status").val(tab[1].trim().substring(0,tab[1].indexOf(")")))
        $("#expertise").val(tab[0].trim())

        let a = $('input[name="id"]')
        if(a.length != 0) a.remove()
        let id_input = $(`<input type='hidden' name='id' value='${$(this).parents('.profile-widget').data("id")}'>`)
        $("#maintainerForm").prepend(id_input)
    })

    $('.add').on('click',function(){
        $("#maintainerModal").find('.modal-title').text("Ajouter un maintenancier")
        $('.form-control').val('')
        let a = $('input[name="id"]')
        if(a.length != 0) a.remove()
    })

    $('#maintainerForm').on('submit',function(e){
        e.preventDefault()
        let data = $(this).serialize()
        let a = $('input[name="id"]')

        let url = a.length != 0 ? `/update-maintainer/${a.val()}` : `/add-maintainer`
        $("#loading").show()
        $.ajax({
            url:url, type: "POST",
            dataType:"json",
            data: data,
            success: function(data,statut){
                $("#loading").hide(), $("#maintainerModal").find("span[aria-hidden='true']").click();

                if(a.length != 0) {
                    $('.profile-widget[data-id='+a.val()+']').find('.doctor-name').text(data.name)
                    $('.profile-widget[data-id='+a.val()+']').find('.doc-prof').text(data.expertise + " (" + data.status + ")")
                } else {
                    if(data.error == undefined) $(".doctor-grid").append(generateMaintainer(data))
                }

                if(data.error == undefined) showSnackbar("success","green","1500")
                else showSnackbar(data.error,"red","1500")
            },
            error: function(data,statut){
             //   console.log(data.responseJSON.errors)
                $("#loading").hide()
                showSnackbar("error","red","1500")
            }
        });
    })

    $(".doctor-grid").on("click",".delete",function(e){
        swal({text: "Voulez-vous vraiment supprimer ce maintenancier? ",
            buttons: { supprimer: {closeModal: false}, fermer: "cancel"}})
            .then((change) => {
                if(change == "fermer") throw null;
                else{
                    return  $.ajax({
                        url: `/delete-maintainer`,
                        type: "POST", headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                        data: {
                            id: $(this).parents(".profile-widget").data("id")
                        },
                        dataType:"json"
                    })
                }
            })
            .then((response) => {
                console.log(response)
                if (response.message == "no token") window.location.href = "/maintainers"
                swal({text: "Opération effectuée", icon: "success"});
                setTimeout(() => window.location.href = "/maintainers", 1000)
            })
            .catch(err => {
                console.log(err)
                if(err) swal({text: "une erreur est survenue", icon: "error"});
                swal.stopLoading();
                swal.close()
            })
    })


    /* let settings = {
      "async": true,
      "crossDomain": true,
      "url": "https://weatherbit-v1-mashape.p.rapidapi.com/current?lang=en&lon=%3Crequired%3E&lat=%3Crequired%3E",
      "method": "GET",
      "headers": {
          "x-rapidapi-host": "weatherbit-v1-mashape.p.rapidapi.com",
          "x-rapidapi-key": "e54a81af0cmshb63201ac97d9f5dp141071jsn84a38fc53e74"
      }
  }

  $.ajax(settings).done(function (response) {
      console.log(response);
  });*/

    function generateMaintainer(maintainer){
        let a = "<div class=\"col-md-4 col-sm-4  col-lg-3\">\n" +
            `                   <div class=\"profile-widget\" data-id=\"${maintainer.id}\">\n` +
            "                       <div class=\"doctor-img\">\n" +
            "                           <a class=\"avatar\" href=\"#\"><img alt=\"user\" src=\"/assets/images/user.jpg\" /></a>\n" +
            "                       </div>\n" +
            "                       <div class=\"dropdown profile-action\">\n" +
            "                           <a class=\"action-icon dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa fa-ellipsis-v\"></i></a>\n" +
            "                           <div class=\"dropdown-menu dropdown-menu-right\">\n" +
            "                               <a class=\"dropdown-item edit\" data-toggle=\"modal\" data-target=\"#maintainerModal\" style=\"cursor: pointer\"><i class=\"fa fa-edit m-r-5\"></i> Modifier</a>\n" +
            "                               <a class=\"dropdown-item delete\" style=\"cursor: pointer\"><i class=\"fa fa-trash-o m-r-5\"></i> Supprimer</a>\n" +
            "                           </div>\n" +
            "                       </div>\n" +
            `                       <div class=\"doctor-name text-ellipsis\" style=\"color: black\"><a>${maintainer.name}</a></div>\n` +
            `                       <div class=\"doc-prof\">${maintainer.expertise} (${maintainer.status})</div>\n` +
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
