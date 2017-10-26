<?php
require_once "PHPExcel.php";
require_once "dbconnect.php";
$errmsg = array(); //массив для хранения ошибок 
$errflag = false; //флаг ошибки
$number = $fio = $depart = $name_of_device = $date_vvod = $article = $kod = $SN = $Place =  "";
$user = $_SESSION['user'];   //имя пользователя

if (isset($_POST['number']))
{
	$number = $_POST['number'];
	$fio = $_POST['fio'];
	$depart = $_POST['depart'];
	$name_of_device = $_POST['name_of_device'];
	$date_vvod = $_POST['date_vvod'];
	$article = $_POST['article'];
	$kod = $_POST['kod'];
	$SN = $_POST['SN'];
	$Place = $_POST['Place'];
	$result = $db->query("INSERT INTO device(num, Query_num, Sotr, Depart, Device, Data_vvod, Article, Kod, SN, Place, Executing, status)
	 	 								  VALUES('','$number','$fio' ,'$depart', '$name_of_device', '$date_vvod', $article, $kod, $SN, '$Place', '', '') ") ;
	if($result)
	{
	 		print("Данные успешно добавлены в базу");
	 		$zapros = $db->query("SELECT * FROM device WHERE status = 0");
	 		if($user == 'user1')
	 		{
				echo "<Br><a href='enter.php'>вернуться назад</a>";
				echo "<h1>Cписок запросов</h1>";
				echo '<table border="1" align="center">';
				echo '<thead>';
				echo '<tr>';
				echo '<th>№</th>';
				echo '<th>Номер запроса</th>';
				echo '<th>ФИО сотрудника</th>';
				echo '<th>Отдел</th>';
				echo '<th>Отметка об исполнении</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				while($data = mysqli_fetch_array($zapros))
				{ 
				    echo '<tr>';
				    echo '<td><a id = "out" href = "lookform.php?num=' . $data['num']. '">' . $data['num'] . '</a></td>';
				    echo '<td>' . $data['Query_num'] . '</td>';
				    echo '<td>' . $data['Sotr'] . '</td>';
				    echo '<td>' . $data['Depart'] . '</td>';
				    echo '<td><a id = "exec" href = "?num=' . $data['num']. '">Исполнено </a></td>';
				    echo '</tr>';
				}			  
				echo '</tbody>';
				echo '</table>';				
			}
	 		else
	 		{
				echo '<br><p>Благодарим Вас за информацию, ' .$user . '. </p><a href="enter.php"s>вернуться назад</a>';
	 		}
	 		$phpexcel = new PHPExcel();
			$page = $phpexcel->setActiveSheetIndex(0);
			$page->setCellValue("A1", "№ п/п");
			$page->setCellValue("B1", "Номер запроса");
			$page->setCellValue("C1", "ФИО");
			$page->setCellValue("D1", "Отдел");
			$page->setCellValue("E1", "Наименование устройства");
			$page->setCellValue("F1", "Дата ввода в эксплутацию");
			$page->setCellValue("G1", "Артикул");
			$page->setCellValue("H1", "Код производителя");
			$page->setCellValue("I1", "Серийный номер");
			$page->setCellValue("J1", "Место установки");
			$page->setCellValue("K1", "Отметка об исполнении");
			$page->setCellValue("L1", "Статус");
			$res = $db->query("SELECT * FROM device WHERE status = 0");
			$row = 2; // 1-based index
			while($row_data = mysqli_fetch_assoc($res)) 
			{
				$col = 0;
				foreach($row_data as $key=>$value) 
				{
					$page->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
					}
				$row++;
			}
			$page->setTitle("Test");
			$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
			$objWriter->save("Report.xlsx");		    
	} 
	 else 
	{ 
	 	die("<br>"."Ошибка, что то пошло не так"); 
	}
}
else if (isset($_GET['num']))
{
	$today = date("Y-m-d");
	$num = $_GET['num'];
	$SQL1qry = $db->query("UPDATE Device set status = 1 WHERE num = $num");
	$SQL2qry = $db->query("UPDATE Device set Executing = '$today' WHERE num = $num");
	
	if($SQL2qry)
	{

			print("Данные успешно обновлены в базе");
			$zapros = $db->query("SELECT * FROM device WHERE status = 0");

		echo "<Br><a href='enter.php'>вернуться назад</a>";
		echo "<h1>Cписок запросов</h1>";
		echo '<table border="1" align="center">';
		echo '<thead>';
		echo '<tr>';
		echo '<th>№</th>';
		echo '<th>Номер запроса</th>';
		echo '<th>ФИО сотрудника</th>';
		echo '<th>Отдел</th>';
		echo '<th>Отметка об исполнении</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		while($data = mysqli_fetch_array($zapros))
		{ 
		    echo '<tr>';
		    echo '<td><a id = "out" href = "lookform.php?num=' . $data['num']. '">' . $data['num'] . '</a></td>';
		    echo '<td>' . $data['Query_num'] . '</td>';
		    echo '<td>' . $data['Sotr'] . '</td>';
		    echo '<td>' . $data['Depart'] . '</td>';
		    echo '<td><a id = "exec" href = "?num=' . $data['num']. '">Исполнено </a></td>';
		    echo '</tr>';
		}
			echo '</tbody>';
			echo '</table>';
	 		$phpexcel = new PHPExcel();
			$page = $phpexcel->setActiveSheetIndex(0);
			$page->setCellValue("A1", "№ п/п");
			$page->setCellValue("B1", "Номер запроса");
			$page->setCellValue("C1", "ФИО");
			$page->setCellValue("D1", "Отдел");
			$page->setCellValue("E1", "Наименование устройства");
			$page->setCellValue("F1", "Дата ввода в эксплутацию");
			$page->setCellValue("G1", "Артикул");
			$page->setCellValue("H1", "Код производителя");
			$page->setCellValue("I1", "Серийный номер");
			$page->setCellValue("J1", "Место установки");
			$page->setCellValue("K1", "Отметка об исполнении");
			$page->setCellValue("L1", "Статус");
			$res = $db->query("SELECT * FROM device WHERE status = 0");
			$row = 2; // 1-based index
			while($row_data = mysqli_fetch_assoc($res)) 
			{
				$col = 0;
				foreach($row_data as $key=>$value) 
				{
					$page->setCellValueByColumnAndRow($col, $row, $value);
					$col++;
					}
				$row++;
			}
			$page->setTitle("Test");
			$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
			$objWriter->save("Отчёт.xlsx");
	}
}
else
{
	print("hello!");
 		print("Данные успешно добавлены в базу");
	 		$query3 = $db->query("SELECT * FROM device WHERE status = 0");
				echo "<Br><a href='enter.php'>вернуться назад</a>";
				echo "<h1>Cписок запросов</h1>";
				echo '<table border="1" align="center">';
				echo '<thead>';
				echo '<tr>';
				echo '<th>№</th>';
				echo '<th>Номер запроса</th>';
				echo '<th>ФИО сотрудника</th>';
				echo '<th>Отдел</th>';
				echo '<th>Отметка об исполнении</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				while($data = mysqli_fetch_array($query3))
				{ 
				    echo '<tr>';
				    echo '<td><a id = "out" href = "lookform.php?num=' . $data['num']. '">' . $data['num'] . '</a></td>';
				    echo '<td>' . $data['Query_num'] . '</td>';
				    echo '<td>' . $data['Sotr'] . '</td>';
				    echo '<td>' . $data['Depart'] . '</td>';
				    echo '<td><a id = "exec" href = "?num=' . $data['num']. '">Исполнено </a></td>';
				    echo '</tr>';
				}			  
				echo '</tbody>';
				echo '</table>';				
}


$db -> close(); // закрываем соединение с базой
		
?>
