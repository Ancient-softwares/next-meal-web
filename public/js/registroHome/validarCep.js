$(document).ready(function() {
    $("#validar").on("click", function(){
        var cep = $("#cep").val();
        var url = "https://viacep.com.br/ws/"+cep+"/json";

        $.ajax({
            url: url,
            type: "get",
            dataType: "json",

            success:function(dados) {
                $("#rua").val(dados.logradouro);
                $("#cidade").val(dados.localidade);
                $("#uf").val(dados.uf);
            }
        });
    })
});