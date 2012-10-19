$(document).ready(function(){

  $("#resultado").hide();

  $('#showXml').modal('toggle')

  $('#tabs a:first').tab('show');

  //Exibi o token no Form
  $("#token").val($("#MoipWidget").attr("data-token"));

  $("#sendToMoip").click(function(){
    sendToCreditCard();
  });

  $("#sendToCofre").click(function(){
    sendToCofre();
  });

  $("#boleto").click(function(){
    sendToBoleto();
  });
  $("#debit").click(function() {
    sendToDebit();
  });



  $("#calcular-btn").click(function(){
    calcular();
  });

  $("#trocar-token").click(function(){
    $("#MoipWidget").attr("data-token", $("#token").val());
  });

});

calcular = function() {
  var settings = {
    cofre: '',
     instituicao: "Visa",
     callback: "retornoCalculoParcelamento"
  };

  MoipUtil.calcularParcela(settings);
};

retornoCalculoParcelamento = function(data) {
  alert(JSON.stringify(data));
};

sendToCreditCard = function() {
    var settings = {
        "Forma": "CartaoCredito",
        "Instituicao": $("input[name='instituicao']:checked").val(),
        "Parcelas": $("#Parcelas").val(),
        "Recebimento": "AVista",
        "CartaoCredito": {
            "Numero": $("input[name=Numero]").val(),
            "Expiracao": $("input[name=Expiracao]").val(),
            "CodigoSeguranca": $("input[name=CodigoSeguranca]").val(),
            "Portador": {
                "Nome": $("input[name=Portador]").val(),
                "DataNascimento": $("input[name=DataNascimento]").val(),
                "Telefone": $("input[name=Telefone]").val(),
                "Identidade": $("input[name=CPF]").val()
            }
        }
    }

    $("#sendToMoip").attr("disabled", "disabled");

$("#boleto").attr("disabled", "disabled");
    MoipWidget(settings);
 };


sendToCofre = function() {
  var settings = {
      "Forma": "CartaoCredito",
      "Instituicao": "Visa",
      "Parcelas": $("input[name=Parcelas]").val(),
      "Recebimento": "AVista",
      "CartaoCredito": {
          "Cofre": $("input[name=Cofre]").val(),
          "CodigoSeguranca": $("input[name=CodigoSeguranca]").val()
      }
  }

    $("#sendToCofre").attr("disabled", "disabled");
    MoipWidget(settings);
 }


sendToDebit = function() {
  var settings = {
    "Forma": "DebitoBancario",
    "Instituicao": $("#banco").val()
  };
$("#sendToMoip").attr("disabled", "disabled");

$("#boleto").attr("disabled", "disabled");
  MoipWidget(settings);
}


sendToBoleto = function() {
  var settings = {
    "Forma": "BoletoBancario"
  };
$("#sendToMoip").attr("disabled", "disabled");

$("#boleto").attr("disabled", "disabled");
  MoipWidget(settings);
};

var sucesso = function(data){
  
meio = data.TaxaMoIP;

if (meio == undefined)

{
window.open('' + data.url+ '' , '_blank' );
xx = data.url;
var n=xx.replace("https://","");
window.location.href='./retorno_o2ti.php?refazer=' + n + '&status=' + data.Status +'&codmp='+ data.CodigoMoIP +'';
}

else

{

window.location.href='./retorno_o2ti.php?refazer=&status=' + data.Status +'&codmp='+ data.CodigoMoIP +'';

}
$("#boleto").attr("disabled", "disabled");
$("#debit").attr("disabled", "disabled");
    $("#sendToMoip").removeAttr("disabled");
    $("#sendToCofre").removeAttr("disabled");

};
var erroValidacao = function(data) {
    for (i=0; i<data.length; i++) {
    Moip = data[i];
    infosMoip = '';
    for(j in Moip){
        atributo = j;
        valor = Moip[j];
        infosMoip += '<li class="erro">'+valor+'</li>';
    }
    $("#Errocartao").append(infosMoip);
}

    $("#sendToMoip").removeAttr("disabled");
    $("#sendToCofre").removeAttr("disabled");
};