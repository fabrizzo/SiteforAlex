<html>
<head>
<title>Форма запроса</title>
</head>
<body>
<center>
<h1> Запрос данных </h1>
<form name="formaQuery" method='post'  action='forma.php' accept-charset='utf-8'>
    <p><label for='number'>1. Номер запроса:   </label><input type='text' required name='number'></p>
    <p><label for='fio'>2. ФИО, сотрудника сформировавшего запрос:   </label><input type='text' required name='fio' id=''></p>
	<p><label for='depart'>3. Отдел, сформировавший запрос: </label><input type='text' required name='depart'></p>
    <p><label for='name_of_device'>4. Наименование устройства: </label><input type='text' name='name_of_device' id=''></p>
	<p><label for='date_vvod'>5. Дата ввода в эксплуатацию: </label><input type='date' name='date_vvod'></p>
    <p><label for='article'>6. Артикул: </label><input type='text' name='article' id=''></p>
	<p><label for='kod'>7. Код производителя: </label>	<input type='text' name='kod'></p>
    <p><label for='SN'>8. Серийный номер: </label><input type='text' name='SN' id=''></p>
	<p><label for='Place'>9. Место установки/хранения : </label><input type='text' name='Place'></p>
    <p><button type='submit'>Отправить</button></p>
</form>
</center>
</html>

