<?php
require_once "dbconnect.php";
$num = $_GET['num'];
$result = $db->query("SELECT * FROM device WHERE num = $num");
$row_data = mysqli_fetch_assoc($result);
$n = $row_data['Query_num'];
$f = $row_data['Sotr'];
$d = $row_data['Depart'];
$dev = $row_data['Device'];
$dat = $row_data['Data_vvod'];
$a = $row_data['Article'];
$k = $row_data['Kod'];
$s = $row_data['SN'];
$p = $row_data['Place'];
?>
<html>
<head>
<title>Форма запроса</title>
</head>
<body>
<center>
<h1> Запрос</h1>
    <p><label for='number'>1. Номер запроса:</label><?php print($n); ?></p>
    <p><label for='fio'>2. ФИО, сотрудника сформировавшего запрос:   </label><?php print($f); ?></p>
	<p><label for='depart'>3. Отдел, сформировавший запрос: </label><?php print($d); ?></p>
    <p><label for='name_of_device'>4. Наименование устройства: </label><?php print($dev); ?></p>
	<p><label for='date_vvod'>5. Дата ввода в эксплуатацию: </label><?php print($dat); ?></p>
    <p><label for='article'>6. Артикул: </label><?php print($a); ?></p>
	<p><label for='kod'>7. Код производителя: </label><?php print($k); ?></p>
    <p><label for='SN'>8. Серийный номер: </label><?php print($s); ?></p>
	<p><label for='Place'>9. Место установки/хранения : </label><?php print($p); ?></p>
    <p><a href = "forma.php">Назад</a></p>
</center>
</html>

