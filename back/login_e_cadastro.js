//Efeito da aba---------------------------------------------------------
document.querySelector('.img-btn').addEventListener('click', function()
	{
		document.querySelector('.cont').classList.toggle('s-signup')
	}
);

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