<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

// Отправляем браузеру правильную кодировку,
// файл login.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');
session_start();
// Начинаем сессию.
if (!empty($_POST['exit'])) {
  session_destroy();
  session_write_close();
  header('Location:./');
}
// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.


// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  ?>
<head>
  <title>Autorization</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<div class="Form">
  <form action="" method="post">
    Login:<input name="login"/>
    Password:<input name="pass" type="password"/>
    <input type="submit" value="Войти" />
  </form>
</div>
<?php
}
else {
        $flag=FALSE;
        $MESSAGE='';
        $user = 'u16344';
        $pass = '4555013';
        $log=$_POST['login'];
        $db = new PDO('mysql:host=localhost;dbname=u16344', $user, $pass,
        array(PDO::ATTR_PERSISTENT => true));
        if(!empty($_POST['login']) && !empty($_POST['pass'])){
            foreach($db->query("SELECT login FROM info ") as $row) {
              if($_POST['login']==$row['login']){
                $flag=TRUE;break;
              }
            }
            if($flag==TRUE){
              $_SESSION['login']=$_POST['login'];
              $_SESSION['user_id']=rand(1,255);
              header('Location:./');
            }else{
              print("Такого пользователя в базе данных нет.");
            }
        }else{
          print("Заполните поля для логина и пароля.");
        }
    }       
?>
