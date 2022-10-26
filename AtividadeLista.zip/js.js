   
    var dataatual = new Date();
    var anoatual = dataatual.getFullYear();
    var mesatual = dataatual.getMonth();
    var mesatual = mesatual + 1;
    var diaatual = dataatual.getDay();
    var diaatual = diaatual + 4;
    //console.log(diaatual);
    //var mesniver = getMonth(document.getElementById("in_nome").value);

function validafuncao(){
    var nome = document.getElementById("in_nome").value;
    var sobrenome = document.getElementById("in_sobrenome").value;
    var data = document.getElementById("in_datanasc").value;
    var email = document.getElementById("in_email").value;
    var [ano, mes, dia] = data.split('-').map(Number);
    console.log(idade)
    console.log(ano)
    idade = anoatual - ano;

    if(document.getElementById("in_nome").value == "" || document.getElementById("in_nome").value.length < 3){
        alert("Campo nome, nulo e/ou inválido");
        document.getElementById("nomeinvalido").innerHTML = "Campo iválido!";
        return false;
    }
    else{
        document.getElementById("nomeinvalido").innerHTML = "";
        if(document.getElementById("in_sobrenome").value == "" || document.getElementById("in_sobrenome").value.length < 3){
            alert("Campo sobrenome nulo e/ou inválido");
            document.getElementById("sobrenomeinvalido").innerHTML = "Campo iválido!";
            return false;
        }
        else{
            document.getElementById("sobrenomeinvalido").innerHTML = "";
            if(document.getElementById("in_email").value == ""){
                alert("Campo email nulo!");
                document.getElementById("emailinvalido").innerHTML = "Campo iválido!";
                return false;
            }
            else{
                document.getElementById("emailinvalido").innerHTML = "";
                if(document.getElementById("in_senha").value == ""){
                    alert("Campo senha nulo!!");
                    document.getElementById("senhainvalida").innerHTML = "Campo iválido!";
                    return false;
                }
                else{
                    document.getElementById("senhainvalida").innerHTML = "";
                    if(document.getElementById("in_datanasc").value == ""){
                        alert("Campo data nascimento nula");
                        document.getElementById("datanascinvalida").innerHTML = "Campo iválido!";
                        return false;
                    }
                    else{
                        document.getElementById("datanascinvalida").innerHTML = "";
                        if((mesatual < mes) && (mesatual != mes)){
                            
                            idade = idade - 1;
                            console.log(mes);
                            console.log(idade);
                        }
                        else{
                            if((mesatual == mes) && (diaatual < dia)){
                                idade = idade - 1;
                                
                            }
                            else{
                                
                            }
                        }
                        
                        document.getElementById("in_idade").value = idade;

                        var dados = {
                            "nome": nome,
                            "sobrenome": sobrenome,
                            "idade": idade,
                            "email": email

                        } 

                        let resultado = JSON.stringify(dados);
                        alert(resultado);
                        //document.getElementById("area").innerHTML = resultado;
                        

                        /*
                        let resultadoJSON = 'Usuario cadastrado":['+
                        'Nome do cadastrado: '+nome+
                        'Sobrenome do cadastrado: '+sobrenome+
                        'Idade do sujeito: '+idade+']';
                        */

                    }
                }
            }
        }
    }
}
