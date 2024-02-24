//Declaração de Variaveis Globais
//Elementos
var Chamados = OBJtoArray(document.getElementsByClassName('chamado'));
var Data = OBJtoArray(document.getElementsByTagName('time'));
var Sessao = OBJtoArray(document.getElementsByTagName('section'));
var Titulo = OBJtoArray(document.getElementsByTagName('h3'));
var Modalidades = OBJtoArray(document.getElementsByClassName('Modalidades'));
//Constante
const qtd_milissegundos = 86400000;
//Funções Anonimas
var Cabecalho = function() {
	cRet = '<div class="p-2 text-left border-bottom">'
	cRet += '<h5 class="text-secondary">Chamados</h5></div>'
	cRet += '<div class="p-2 text-info">'
	cRet += '<h6 class="d-inline">Filtros:</h6>' 
	cRet += '<button class="btn btn-info" onclick="Filtrar(1)">Data Mais Atual</button>'
	cRet += '<button class="btn btn-info" onclick="Filtrar(2)">Data Mais Antiga</button>'
	cRet += '<button class="btn btn-info" onclick="Filtrar(3)">Alfabeto (A-Z)</button>'
	cRet += '<button class="btn btn-info" onclick="Filtrar(4)">Alfabeto (Z-A)</button>'
	cRet += '<button class="btn btn-info" onclick="Filtrar(5)">Modalidade</button>'
	cRet += '</div>'
	return cRet;
}
//==========================Funções===========================
/*

*/
function Filtrar(opc){
	//Direciona a Opção escolhida pelo Usuario
	switch(opc){
		case 1:
			dataCrescente();
			break;
		case 2:
			dataDecrecente();
			break;
		case 3:
			alfabetoCrescente();
			break;
		case 4:
			alfabetoDecrescente();			
			break;
		case 5:
			modalidade();
			break;
	}
	//Responsavel por Organizar as Divs da Página
	organiza();
}
/*

*/
function organiza(){
	//Declaração de Variaveis
	//String
	var cSessao = '';
	//Numerico
	var nCont = 0;

	cSessao = Cabecalho();//Monta o Cabeçalho da Sessão

	for(nCont = 0; nCont <= Chamados.length -1; nCont++){
		cSessao += Chamados[nCont].outerHTML;//Reconstroi as Divs, agora desta vez, Ordenadas
	}

	cSessao += '<h6 class="text-center">Fim dos Chamados</h6>';

	Sessao[0].innerHTML = cSessao;//Insere na Tag Section
}
/*

*/
function dataCrescente(){
	//Declaração de Variaveis
	//Numerico
	var nCont = 0;
	var nCont2 = 0;
	//Array
	var Datas_Str = ['', ''];

	for(nCont = 0; nCont <= (Data.length - 1); nCont++){
		Datas_Str[0] = Data[nCont].innerText;

		for(nCont2 = nCont +1; nCont2 <= Data.length -1; nCont2++){
			Datas_Str[1] = Data[nCont2].innerText;
			
			if(calcularDias(Datas_Str[0], Datas_Str[1]) > 0){
				//Troca de lugar as datas para a maior
				troca(nCont, nCont2, Chamados);
				troca(nCont, nCont2, Data);
			}
		}
	}
}
/*

*/
function dataDecrecente(){
	//Declaração de Variaveis
	//Numerico
	var nCont = 0;
	var nCont2 = 0;
	//Array
	var Datas_Str = ['', ''];
	
	for(nCont = 0; nCont <= (Data.length - 1); nCont++){
		Datas_Str[0] = Data[nCont].innerText;

		for(nCont2 = nCont +1; nCont2 <= Data.length -1; nCont2++){
			Datas_Str[1] = Data[nCont2].innerText;
			
			if(calcularDias(Datas_Str[0], Datas_Str[1]) < 0){
				//Troca de lugar as datas para a maior
				troca(nCont, nCont2, Chamados);
				troca(nCont, nCont2, Data);
			}
		}
	}
}
/*

*/
function alfabetoCrescente(){
	//Declaração de Variaveis
	//String
	var Titulo1 = ''
	var Titulo2 = ''
	//Numerico
	var nCont = 0;
	var nCont2 = 0;
	var nCont3 = 0;

	for(nCont = 0; nCont <= (Titulo.length -1); nCont++){
		Titulo1 = Titulo[nCont].innerText;

		for(nCont2 = nCont +1; nCont2 <= (Titulo.length -1); nCont2++){
			Titulo2 = Titulo[nCont2].innerText;

			if(Chr(Titulo1.charAt(0)) > Chr(Titulo2.charAt(0))){
				troca(nCont, nCont2, Chamados);//Troca de lugar os titulos maiores
				troca(nCont, nCont2, Titulo);//Troca de lugar os titulos maiores
			}else if(Chr(Titulo1.charAt(0)) === Chr(Titulo2.charAt(0))){

			}
		}
	}
}
/*

*/
function alfabetoDecrescente(){
	//Declaração de Variaveis
	//String
	var Titulo1 = ''
	var Titulo2 = ''
	//Numerico
	var nCont = 0;
	var nCont2 = 0;
	var nCont3 = 0;

	for(nCont = 0; nCont <= (Titulo.length -1); nCont++){
		Titulo1 = Titulo[nCont].innerText;

		for(nCont2 = nCont +1; nCont2 <= (Titulo.length -1); nCont2++){
			Titulo2 = Titulo[nCont2].innerText;

			if(Chr(Titulo1.charAt(0)) < Chr(Titulo2.charAt(0))){
				troca(nCont, nCont2, Chamados);//Troca de lugar os titulos maiores
				troca(nCont, nCont2, Titulo);//Troca de lugar os titulos maiores
			}else if(Chr(Titulo1.charAt(0)) === Chr(Titulo2.charAt(0))){

			}
		}
	}
}
/*

*/
function modalidade(){
	//Declaração de Variaveis
	//String
	var Titulo1 = ''
	var Titulo2 = ''
	VAR
	//Array
	var Modalidades_Aux = []
	//Numerico
	var nCont = 0;
	var nCont2 = 0;
	var nCont3 = 0;

	for(nCont = 1; nCont <= 3; nCont++){

		for(nCont2 = 0; nCont2 <= Modalidades_Aux.length -1; nCont2++){

		}
	}
}
/*

*/
function OBJtoArray(Elemento){
	//Declaração de Variaveis
	//Numerico
	var nCont = 0;
	//Array
	var aRet = []

	for(nCont = 0; nCont <= Elemento.length -1; nCont++){
		aRet[nCont] = Elemento[nCont];
	}

	return aRet;
}
/*

*/
function troca(nCont, nCont2, Array){
	//Declaração de Variaveis
	//Elemento
	Aux = null;

	Aux = Array[nCont];
	Array[nCont] = Array[nCont2];
	Array[nCont2] = Aux;

	return Array;
}
/*

*/
function calcularDias(Data1, Data2){
	//Declaração de Variaveis
	//Datas
	var Data_Primaria = new Date(Number(Data1.substr(6,4)), (Number(Data1.substr(3,2))-1), Number(Data1.substr(0,2)));
	var Data_Secundaria = new Date(Number(Data2.substr(6,4)), (Number(Data2.substr(3,2))-1), Number(Data2.substr(0,2)));
	//Numerico
	var Total = 0;

	//Calula a Diferença das Datas pelo método de Milissegundos
	Total = Data_Secundaria.getTime() - Data_Primaria.getTime();

	//Se Retornar negativo é porque a data 2 não é maior que a data 1
	if(Total > 0){
		Total = (Total / qtd_milissegundos);
	}

	return Total;
}
/*

*/
function Chr(letra){
	//Declaração de Variaveis
	//String	
	var Alfabeto = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	return (Alfabeto.search(letra.toUpperCase())) +1;
}