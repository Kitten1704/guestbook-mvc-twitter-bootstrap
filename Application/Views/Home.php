<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link rel="shortcut icon" href="img/main_ico.png" type="image/x-icon">
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
		<title>Гостевая книга</title>
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
				<li class="active"><a href="Home">На главную</a></li>
				<li class="divider-vertical"></li>
				<?php
				if (isset($_SESSION['uID']))
				{

				print'
				<li><a href="Profile">Профиль</a></li>
				<li class="divider-vertical"></li>
				<li><a href="Logout">Выход</a></li>
				<li class="divider-vertical"></li>';
				}
				else
				{
				print'
				<li><a href="Registration">Регистрация</a></li>
				<li class="divider-vertical"></li>
				<li><a href="Login">Вход</a></li>
				<li class="divider-vertical"></li>';
				}	
				?>
				</ul>
			</div>
		</div>	
			<div class="row">
			<div class="span12">
				<hr><br>
			</div>
				
				<?php
				if(count($arr) == 0)
				{
					echo "<div class='span12'>
							<h3>В книге пока нет записей.</h3>
						 </div>";
				}
				else 
				{

					foreach((array)$arr as $item)
					{	
						echo "<div class='span1'></div>";
						echo "<div class='span3'>";
						echo "<h4>".htmlspecialchars($item['uname'])." ";	
						echo htmlspecialchars($item['usname'])."</h4>";
						echo "<img src=".$item['uavatar']." class='img-polaroid'>";		
						echo "<h4>".htmlspecialchars($item['uemail'])."</h4><br>";
						echo "<p class='muted'>".htmlspecialchars($item['pdate'])."</p><br></div>";	
						echo "<div class='span8'><p class='muted'>".htmlspecialchars($item['ptext'])."</p></div>";
						//echo "<div class='span1'></div>";
						echo "<div class='span12'><hr></div>";
					}
				}
				?>
			
			
			<div class="span12">
		<?php
			if (isset($_SESSION['uID']))
			{
				print'<form name="messform" method="post" action="Addmessage">';
				print'<div class="span3"></div>';
					echo "<div class='span2'>
						<div class='control-group'>
							<div class='controls'>
							<h4>".$arr2['uname'].":</h4>
							</div>
						 </div>";
					echo"<div class='control-group'>
						<div class='controls'>
							<img src=".$arr2['uavatar']." class='img-rounded'>
						</div>
						</div>
						</div>";
					print'<div class="span3">
						<div class="control-group">
							<div class="controls">
							<p>
								<textarea class="text_color" name="message" rows="7" placeholder="Введите текст сообщения"></textarea>
							</p>
							</div>
							</div>';
				if (isset($_SESSION['er_umessage']))echo "<p class='text-error'>".$_SESSION['er_umessage']."</p>";		
					print'<div class="control-group">
							<div class="controls">
							<button type="submit" name="message_form_button" class="btn btn-primary" >Разместить</button>
							</div>
							</div>
							</div>
							</div>';
			}
			?>
						</form>
				</div>
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
		