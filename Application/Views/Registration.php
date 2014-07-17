<html>
	<head>
		<meta http-equiv="Content-Tipe" content="text/html" charset="utf-8">
		<link rel="shortcut icon" href="img/main_ico.png" type="image/x-icon"><!--Иконка для странички-->
		<title>Регистрация</title><!--заголовок страницы-->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
	</head>
	<body>
	<div class="modal-header">
			<div class="row">
			<div class="text-center">
				<h1>Гостевая книга</h1>
			</div>
			</div>	
		</div>
		<div class="container">
			<div class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
				<li><a href="Home">На главную</a></li>
				<li class="divider-vertical"></li>
				<li class="active"><a href="Registration">Регистрация</a></li>
				<li class="divider-vertical"></li>
				<li><a href="Login">Вход</a></li>
				<li class="divider-vertical"></li>
				</ul>
			</div>
			</div>
			<div class="row">
				<div class="span2"></div>
				<div class="span8">
					<form class="form-horizontal" method="post" action="Adduser">
					<div class="control-group">
						<label class="control-label" for="inputName">Имя:* </label>
						<div class="controls">
							<input class="text_color" type="text" name="name" value="<?php if (isset($_SESSION['name'])) echo $_SESSION['name'];?>">
							<p class='text-error'><?php if (isset($_SESSION['er_name'])) echo $_SESSION['er_name'];?></p>
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label" for="inputSname">Фамилия: </label>
						<div class="controls">
							<input class="text_color" type="text" name="sname" size="24" value="<?php if (isset($_SESSION['sname'])) echo $_SESSION['sname'];?>">
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label" for="inputEmail">E-mail:* </label>
						<div class="controls">	
							<input class="text_color" type="text" name="email" size="63" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email'];?>">
							<p class='text-error'><?php if (isset($_SESSION['er_email'])) echo $_SESSION['er_email'];?></p>
							<p class='text-error'><?php if (isset($_SESSION['er_emaillenght'])) echo $_SESSION['er_emaillenght'];?></p>
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label" for="inputPassword">Пароль:* </label>
						<div class="controls">					
							<input class="text_color" type="password" name="password" size="61" value="">
							<p class='text-error'><?php if (isset($_SESSION['er_password'])) echo $_SESSION['er_password'];?></p>
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label" for="inputRepassword">Повторите пароль:* </label>
						<div class="controls">
							<input class="text_color" type="password" name="re_password" size="44" value="">
							<p class='text-error'><?php if (isset($_SESSION['er_repassword'])) echo $_SESSION['er_repassword'];?></p>
						</div>
					</div>	
					<p class="text-info">*: Звездочкой помечены поля, обязательные для заполнения.</p>
					<div class="control-group">
						<div class="controls">
							<button class="btn btn-primary" name="message_form_button" type="submit">Зарегистрироваться</button>
						</div>
					</div>	
					</form>
				</div>
				<div class="span2"></div>
			</div>
		</div>	
		<div class="modal-footer">
			<div class="row">
				<div class="text-center">
				<p class='muted'>Company, 2014</p>
				<p class='muted'>Верстка:<a href="http://bootstrap-ru.com/index.php">Twitter Bootstrap</a></p>
				</div>
			</div>
		</div>
	
	</body>
	</html>