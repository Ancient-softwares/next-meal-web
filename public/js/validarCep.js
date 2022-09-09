$(document).ready(function() {
    $("#validar").on("click", function(){
        var cep = $("#cep").val();
        var url = "https://viacep.com.br/ws/"+cep+"/json";

        $.ajax({
            url: url,
            type: "get",
            dataType: "json",

            success:function(dados) {
                console.log(dados);
                $("#rua").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#estado").val(dados.uf);
            }
        });
    })
});