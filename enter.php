<?php 
require_once "dbconnect.php";
require_once "class/Engine.php";
$engine = new Engine(); 
$errmsg   = array(); //массив для хранения ошибок 
$errflag  = false; //флаг ошибки
if(isset($_POST['name']))
	{
		$user     = $_POST['name'];      //имя пользователя
		$password = $_POST['password'];  //пароль
	}
else
	{
		$user     = $_SESSION['user'];   //имя пользователя
		$password = $_SESSION['password'];//пароль
	}
if($user == '') 
{
    $errmsg[] = 'Отсутствует логин'; //ошибка
    $errflag = true; //поднимает флаг в случае ошибки
	print_r ($errmsg);
}
if($password == '') 
{
	print(1);
    $errmsg[] = 'Отсутствует пароль'; //ошибка
    $errflag = true; //поднимает флаг в случае ошибки
	print_r ($errmsg);
}

if ($user != '' && $password != '')// если поле пользователь и пароль не пусто
{
    if ($result = $db->query("SELECT password FROM users WHERE NAME ='".$user."'")) //отправляем запрос на сервер
    {
        if(mysqli_num_rows($result) > 0)  
        {  
            $dbpassword = mysqli_fetch_assoc($result);
            if ($password == $dbpassword['password']) 
            { 
				if(isset($_POST['name']))
				{
					$_SESSION['user'] = $_POST['name']; 
                	$_SESSION['password'] = $_POST['password']; 
				}
				if(isset($_GET['out'] )) 
				{
					session_start ();
					$_SESSION = array ();
					session_destroy();
					header("Location: index.php?logout=1");
				}
				if(empty($_SESSION['user']) or empty($_SESSION['password']) )
				{
					echo "<p>Вы вошли как гость. Выполните вход или зарегистрируйтесь.";  
				}
				else
				{
					echo "<p>Здравствуйте, ".$_SESSION['user']." <a id = 'out' href = 'index.php' > Выйти </a> </p>"; 
				}
				echo $engine->getContentPage();
		        $result->close();
            }
		}
        else  
        {   
            echo "Ошибка идентификации: неправильный пароль";  
            exit();  
        }  
    }  
    else  
    {  
        echo "Ошибка идентификации: посетитель не зарегистрирован";  
        exit();  
    }	
}	
if($errflag) //если данные не прошли валидацию, направляет обратно к форме регистрации
{
    $_SESSION['ERRMSG'] = $errmsg; //сообщение об ошибке
    session_write_close(); //закрытие сессии
	echo "<Br>Произошла ошибка ". "вернуться <a href = 'index.php'>назад</a>"; // сообщение об ошибке
    exit(); // Возвращаемся к форме регистрации
}
$db -> close(); // закрываем соединение с базой

?>

