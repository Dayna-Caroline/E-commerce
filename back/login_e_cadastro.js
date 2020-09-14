//Efeito da aba---------------------------------------------------------
document.querySelector('.img-btn').addEventListener('click', function()
	{
		document.querySelector('.cont').classList.toggle('s-signup')
	}
);

//Máscara---------------------------------------------------------------

//Formatação geral
function formataCampo(campo, Mascara, evento) { 
    var boleanoMascara; 

    var Digitato = evento.keyCode;
    exp = /\-|\.|\/|\(|\)| /g
    campoSoNumeros = campo.value.toString().replace( exp, "" ); 

    var posicaoCampo = 0;    
    var NovoValorCampo="";
    var TamanhoMascara = campoSoNumeros.length;; 

    if (Digitato != 8) { // backspace 
            for(i=0; i<= TamanhoMascara; i++) { 
                    boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
                                                            || (Mascara.charAt(i) == "/")) 
                    boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") 
                                                            || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " ")) 
                    if (boleanoMascara) { 
                            NovoValorCampo += Mascara.charAt(i); 
                              TamanhoMascara++;
                    }else { 
                            NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
                            posicaoCampo++; 
                      }              
              }      
            campo.value = NovoValorCampo;
              return true; 
    }else { 
            return true; 
    }
}



//adiciona mascara de data
function MascaraData(data){
    if(mascaraInteiro(data)==false){
            event.returnValue = false;
    }       
    return formataCampo(data, '00/00/0000', event);
}

//adiciona mascara ao CPF
function MascaraCPF(cpf){
    if(mascaraInteiro(cpf)==false){
            event.returnValue = false;
    }       
    return formataCampo(cpf, '000.000.000-00', event);
}

//adiciona mascara de cep
function MascaraCep(cep){
            if(mascaraInteiro(cep)==false){
            event.returnValue = false;
    }       
    return formataCampo(cep, '00.000-000', event);
}

//adiciona mascara ao telefone
function MascaraTelefone(tel){  
    if(mascaraInteiro(tel)==false){
            event.returnValue = false;
    }       
    return formataCampo(tel, '(00) 00000-0000', event);
}

//valida numero inteiro com mascara
function mascaraInteiro(){
    if (event.keyCode < 48 || event.keyCode > 57){
            event.returnValue = false;
            return false;
    }
    return true;
}

//Força da senha--------------------------------------------------------
function validarSenhaForca(){
	var senha = document.getElementById('senhaForca').value;
	var forca = 0;

	if((senha.length >= 4) && (senha.length <= 7)){
		forca += 1;
	}else if(senha.length > 7){
		forca += 1;
	}

	if((senha.match(/[a-z]+/))){
		forca += 2;
	}

	if((senha.match(/[A-Z]+/))){
		forca +=3;
	}

	if((senha.match(/[@#$%&;*/]/))){
		forca += 4;
	}

	mostrarForca(forca);
}

function mostrarForca(forca){
	if(forca == 1 ){
		document.getElementById("erroSenhaForca").innerHTML = "<span style='color: #ff0000'>Fraca</span>";
	}else if((forca >= 2) && (forca < 5)){
		document.getElementById("erroSenhaForca").innerHTML = "<span style='color: #FFD700'>Média</span>";
	}else if((forca >= 5) && (forca < 9)){
		document.getElementById("erroSenhaForca").innerHTML = "<span style='color: #7FFF00'>Forte</span>";
	}else if(forca >= 10){
		document.getElementById("erroSenhaForca").innerHTML = "<span style='color: #008000'>Excelente</span>";
	}
}