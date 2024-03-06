//Declaração de Variaveis Globais
//Elementos
var Campo_Senha = document.getElementsByTagName('input');
var Campo_Lista = document.getElementsByTagName('li');
//Array
var Caracteres = [['ABCDEFGHIJKLMNOPQRSTUVWXYZ'], ['0123456789'] , ['@#_-%¨&;?!$()*><:Ç~´^,.=\/{}`´|[]+""£0'] ];


function validaCaracteres(){
	if((Campo_Senha[0].value).length === 0){
		Campo_Lista[0].className = '';
		Campo_Lista[1].className = '';
		Campo_Lista[2].className = '';
		Campo_Lista[3].className = '';
	}else{
		if((Campo_Senha[0].value).length >= 8){
			Campo_Lista[0].className = 'text-success';
		}else{
			Campo_Lista[0].className  = '';
		}
		
		nTam = (Campo_Senha[0].value).length -1;
		for(nCont = 0; nCont <= 2; nCont++){
			for(nCont2 = 0; nCont2 <=  nTam; nCont2++){
				Letra = (Campo_Senha[0].value).charAt(nCont2);
	
				if(Caracteres[nCont][0].indexOf(Letra) >= 0){
					Campo_Lista[nCont + 1].className = 'text-success';
					break;
				}
				else if(nCont2 === nTam && Caracteres[nCont][0].indexOf(Letra) === -1){
					Campo_Lista[nCont + 1].className = '';
				}
			}
		}		
	}
}
