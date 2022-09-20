//функция, которая открывает форму по кнопке "Поделиться рецептом"
function opnForm() {
	document.getElementById('recipeform').style.display='block';
}

//функция, которая закрывает форму по кнопке "Вернуться"
function clsForm() {
	document.getElementById('recipeform').style.display='none';
}

//функция, которая добавляет пару полей для ввода масла и его количества в форму
function addfield() {
	var n=document.querySelectorAll('#recipeform > form > table > tbody > tr').length;
	var newTr=document.createElement('tr');
	newTr.innerHTML='<td><input type="text" value="" name="oil'+(n+1)+'"></td> <td><input type="number" value="1" min="1" name="oilN'+(n+1)+'" required=""></td>';
	document.getElementById('recipeform').getElementsByTagName('tbody')[0].appendChild(newTr);
}

//функция, которая удаляет последнюю добавленную пару полей из формы
function delfield() {
	if(document.querySelectorAll('#recipeform > form > table > tbody > tr').length>3) document.querySelector('#recipeform > form > table > tbody > tr:last-child').remove();
}

//функция, которая помещает в поле ввода с именем "sw" значение n
//нужно для корректной работы переключателя
function myswitcher(n) {
	document.querySelector('#rp input[name="sw"]').value=n;
	document.querySelector('#rp input[name="choices"]').setAttribute('list','choicesList'+n);
}

//функция, которая осуществляет поиск рецепта и выводит его в блок
//если не находит, ничего не отображается
function searchoil() {
	var nv=document.querySelectorAll('#lp li > a'),
		sw=document.querySelector('#lp input[name="searching"]').value.toLowerCase();
	nv.forEach(function(v,i,arr){
		if(v.innerHTML.toLowerCase().indexOf(sw)==-1) v.style.display='none';
		else v.style.display='list-item';
	});
}
