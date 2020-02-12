$(document).on("click", ".btnEditUser", function(){

    var idUser = $(this).attr("idUser");

    var data = new FormData();
    data.append("idUser", idUser);

    $.ajax({

        url: "ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        
        success: function(answer){
            
            // console.log("answer", answer);

            $("#editName").val(answer["name"]);

            $("#EditUser").val(answer["user"]);

            $("#EditProfile").val(answer["profile"]);

            $("#currentPassword").val(answer["password"]);

        }

    });

});