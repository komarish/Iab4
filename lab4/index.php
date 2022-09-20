<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Сервис по подбору масел</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="js/main.js"></script>
	
<?php
	$BD=array(
		'host' => 'localhost',
		'name' => 'oils',
		'user' => 'root',
		'password' => ''
	);
	$mysqli=new mysqli($BD['host'], $BD['user'], $BD['password'], $BD['name']);
	
	$recipe=$mysqli->query("SELECT * FROM recipes WHERE verified=1");
	
?>
</head>
<body>
<!-- Шапка -->
<header>
	
	<div><div></div><h1>Сервис по подбору эфирных масел</h1><div></div></div>
	


<!--<p>Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney.</p>-->
</header>
<!--  -->
<div id="pnl">
<!-- Левая панель -->
<div id="lp">
<!-- Поиск и заголовок -->	
	<div>
	<form action="" method="get" onsubmit="return false;">
  	<input name="searching" placeholder="Найти рецепт..." type="search" onkeyup="searchoil()">
  	<button type="button" onclick="searchoil()">Поиск</button>
	</form>
	</div>
<!-- Список -->
	<div>
	<ul>
		
		
	<?php 
	
	while($row=mysqli_fetch_array($recipe))
	{
		echo '<li><a href="/?recipe='.$row['recipe_id'].'">'.$row['recipe_name'].'</a></li>';
	}
		
	?>
		
	</ul> 
	</div>
<!-- Кнопка Добавить -->	
	<div>
	<button onclick="opnForm()">Поделиться рецептом</button>
	</div>		
</div>	
<!-- Правая часть -->
<div id="rp">
	<h2>Найти сочетания масел или масла по желаемому свойству</h2>
		<form autocomplete="off">
			<!-- Секция переключателя -->
			<div>
				<div><label><input type="radio" name="switcher" 
								   <?php 
								   if(empty($_GET['sw']) || $_GET['sw']=='1') echo 'checked="checked"';
								   elseif(isset($_SESSION['sw']) && $_SESSION['sw']=='1') echo 'checked="checked"';
								   ?>  
								   onclick="myswitcher(1)">Сочетания</label></div>
				<div><label><input type="radio" name="switcher" onclick="myswitcher(2)" 
								   <?php 
								   if($_GET['sw']=='2')  echo 'checked="checked"';
								   elseif(isset($_SESSION['sw']) && $_SESSION['sw']=='2') echo 'checked="checked"';
								   ?>>Свойства</label></div>
			</div>
			<!-- Секция поля выпадающего списка и вывода названий масел -->
			<div>
				<!-- Выпадающий список -->
				<div>
					
						<?php
						$essense=$mysqli->query("SELECT * FROM essense");
						$effects=$mysqli->query("SELECT * FROM effects");
						//
						echo '<input type="text" name="choices" list="choicesList'.(empty($_GET['sw']) || $_GET['sw']=='1'?'1':($_GET['sw']=='2'?'2':(isset($_SESSION['sw']) && $_SESSION['sw']=='1'?'1':(isset($_SESSION['sw']) && $_SESSION['sw']=='2'?'2':'1')))).'" placeholder="Начните ввод..." value="'.(!empty($_GET['choices'])?htmlspecialchars(strip_tags($_GET['choices'])):(isset($_SESSION['choices'])?$_SESSION['choices']:'')).'">';
						//
						echo '<datalist id="choicesList1">';
						while($row=mysqli_fetch_array($essense))
						{
							echo '<option value="'.$row['oil_name'].'">'.$row['oil_name'].'</option>';
						}
						echo '</datalist>';

						echo '<datalist id="choicesList2">';
						while($row=mysqli_fetch_array($effects))
						{
							echo '<option value="'.$row['effect_name'].'">'.$row['effect_name'].'</option>';
						}
						echo '</datalist>';
					
						?>
					
					<input type="hidden" value="<?php echo (empty($_GET['sw']) || $_GET['sw']=='1'?'1':($_GET['sw']=='2'?'2':'1')); ?>" name="sw">
					<button type="submit">Обновить</button>
				</div>
				
			</div>
		</form> 	
				
<?php
	//echo '<pre>'.print_r($_SESSION,true).'</pre>';
	if(!empty($_GET['oil1']) && !empty($_GET['oilN1'])) {
		$inoils=array();
		$inoils['oil']=array();
		$inoils['drop']=array();
		//?oil1=ewr&oilN1=1&oil2=wer&oilN2=1&oil3=wer&oilN3=1
		foreach($_GET as $i => $v) {
			if($v) {
				if(preg_match("#^oil[\d]{1,}$#",$i)) $inoils['oil'][]=htmlspecialchars(strip_tags($v));
				if(preg_match("#^oilN[\d]{1,}$#",$i)) $inoils['drop'][]=htmlspecialchars(strip_tags($v));
			}
		}
		echo '<script type="text/javascript">history.pushState({},\'\',\'index.php\');</script>';
		
		$recipeid=$mysqli->query("SELECT MAX(recipe_id)+1 AS new_id FROM recipes");
		$cmpstnname=htmlspecialchars(strip_tags($_GET['compositionname']));
		
		$row=mysqli_fetch_array($recipeid);
		
		$mysqli->query("INSERT INTO recipes (recipe_id, recipe_name, verified) VALUES ('".$row['new_id']."', '".$cmpstnname."', 0)");
		

		foreach($inoils['oil'] as $i => $v) {
			$mysqli->query("INSERT INTO ingredients (recipe_id, oil, quantity) VALUES ('".$row['new_id']."', '".$v."', '".$inoils['drop'][$i]."')");
		}
		
		echo '<h3>Ваш рецепт сохранён!</h3>';
		echo '<p>По прохождении проверки он будет отображаться в списке.</p>';
		
	}
	elseif(!empty($_GET['recipe'])) {
		$rcp=htmlspecialchars(strip_tags($_GET['recipe']));
		unset($_SESSION['choices']);
		unset($_SESSION['sw']);
		$yourrecipe=$mysqli->query("SELECT * FROM recipes R
										INNER JOIN ingredients I
										ON R.recipe_id=I.recipe_id
									WHERE R.verified=1 AND R.recipe_id=".$rcp."");
		
		$row=mysqli_fetch_array($yourrecipe);
		echo '<h3>'.$row[recipe_name].'</h3>';
		echo '<p>Рецепт:</p>';
		echo '<ul>';
		
			//echo '<li></li>';
		echo '<li>'.$row[oil]." - ".$row[quantity].'</li>';
		
						while($row=mysqli_fetch_array($yourrecipe))
						{
							echo '<li>'.$row[oil]." - ".$row[quantity].'</li>';
						}
		
		echo '</ul>';
		
	}
	elseif((!empty($_GET['choices']) && !empty($_GET['sw'])) || (isset($_SESSION['choices']) && isset($_SESSION['sw']))) {
		
		if(empty($_GET['choices']) && empty($_GET['sw'])) {
			if(isset($_SESSION['choices']) && isset($_SESSION['sw'])) {
				$choice=$_SESSION['choices'];
				$sww=$_SESSION['sw'];
			}
		}
		else {
			$choice=htmlspecialchars(strip_tags($_GET['choices']));
			$sww=htmlspecialchars(strip_tags($_GET['sw']));
			$_SESSION['choices']=$choice;
			$_SESSION['sw']=$sww;
		}
		
		if ($sww=='1')
		{
			
			$volattable=$mysqli->query("SELECT E2.volatility, E2.oil_name, group_name, group_id 
										FROM essense E1
											INNER JOIN combinations ON E1.oil_id=oil_1
											INNER JOIN essense E2 ON E2.oil_id=oil_2
											INNER JOIN groups ON E2.group=groups.group_id
										WHERE oil_1=(SELECT oil_id FROM essense WHERE LOWER(oil_name)='".$choice."')
										ORDER BY E2.volatility, groups.group_id");
		}
		
		if ($sww=='2')
		{
			$volattable=$mysqli->query("SELECT E.volatility, E.oil_name, G.group_name, G.group_id 
  										FROM essense E 
  											INNER JOIN effects EF
    											ON (E.effects LIKE CONCAT('',EF.effect_id,',%')
												OR E.effects LIKE CONCAT('%,',EF.effect_id,',%')
												OR E.effects LIKE CONCAT('%,',EF.effect_id,''))
											INNER JOIN groups G ON (E.group=G.group_id)
										WHERE LOWER(EF.effect_name) LIKE '%".$choice."%'
										ORDER BY E.volatility, G.group_id");
		}
		
		
		if ($volattable->num_rows==0) 
			echo '<h3>Результат не найден</h3>';
		else {
		echo '<!-- Три колонки -->
				<table border="0" cellpadding="0" cellspacing="0" id="volattable">
					<caption>Летучесть масел по нотам</caption>
					<thead>
						  <tr>
   							<th>Нижняя</th>
							<th>Средняя</th>
							<th>Верхняя</th>
						  </tr>
					</thead>
					
					<tbody>
					
					<tr>
						<td>';
						
							
						$d="<div class=";
						
							$r1="";
							$r2="";
							$r3="";
							$r4="";
							$r5="";
							$r6="";
							$r7="";
							$r8="";
							
						$row=mysqli_fetch_array($volattable);
						while($row['volatility']==1)
						{
							//echo $row['oil_name'].'">'.$row['group_name']."<br />";
							switch ($row['group_id']) {
								case 1:
									$r1=$r1.$row['oil_name']."<br />";
									break;
								case 2:
									$r2=$r2.$row['oil_name']."<br />";
									break;
								case 3:
									$r3=$r3.$row['oil_name']."<br />";
									break;
								case 4:
									$r4=$r4.$row['oil_name']."<br />";
									break;
								case 5:
									$r5=$r5.$row['oil_name']."<br />";
									break;
								case 6:
									$r6=$r6.$row['oil_name']."<br />";
									break;
								case 7:
									$r7=$r7.$row['oil_name']."<br />";
									break;
								case 8:
									$r8=$r8.$row['oil_name']."<br />";
									break;
							}
							$row=mysqli_fetch_array($volattable);
						}
							
						$r1=$d.'"g1" title="цветочные">'.$r1."</div>";	
						echo $r1;
							
						$r2=$d.'"g2" title="травяные">'.$r2."</div>";	
						echo $r2;
							
						$r3=$d.'"g3" title="цитрусовые">'.$r3."</div>";	
						echo $r3;
							
						$r4=$d.'"g4" title="древесные">'.$r4."</div>";	
						echo $r4;	
							
						$r5=$d.'"g5" title="пряные">'.$r5."</div>";	
						echo $r5;
							
						$r6=$d.'"g6" title="смоляные">'.$r6."</div>";	
						echo $r6;	
							
						$r7=$d.'"g7" title="экзотические">'.$r7."</div>";	
						echo $r7;	
							
						$r8=$d.'"g8" title="фруктовые">'.$r8."</div>";	
						echo $r8;	
							

						echo '</td>
						
						<td>';
						
						
							$r1="";
							$r2="";
							$r3="";
							$r4="";
							$r5="";
							$r6="";
							$r7="";
							$r8="";
							
						while($row['volatility']==2)
						{
							//echo $row['oil_name'].'">'.$row['group_name']."<br />";
							switch ($row['group_id']) {
								case 1:
									$r1=$r1.$row['oil_name']."<br />";
									break;
								case 2:
									$r2=$r2.$row['oil_name']."<br />";
									break;
								case 3:
									$r3=$r3.$row['oil_name']."<br />";
									break;
								case 4:
									$r4=$r4.$row['oil_name']."<br />";
									break;
								case 5:
									$r5=$r5.$row['oil_name']."<br />";
									break;
								case 6:
									$r6=$r6.$row['oil_name']."<br />";
									break;
								case 7:
									$r7=$r7.$row['oil_name']."<br />";
									break;
								case 8:
									$r8=$r8.$row['oil_name']."<br />";
									break;
							}
							$row=mysqli_fetch_array($volattable);
						}
							
						$r1=$d.'"g1" title="цветочные">'.$r1."</div>";	
						echo $r1;
							
						$r2=$d.'"g2" title="травяные">'.$r2."</div>";	
						echo $r2;
							
						$r3=$d.'"g3" title="цитрусовые">'.$r3."</div>";	
						echo $r3;
							
						$r4=$d.'"g4" title="древесные">'.$r4."</div>";	
						echo $r4;	
							
						$r5=$d.'"g5" title="пряные">'.$r5."</div>";	
						echo $r5;
							
						$r6=$d.'"g6" title="смоляные">'.$r6."</div>";	
						echo $r6;	
							
						$r7=$d.'"g7" title="экзотические">'.$r7."</div>";	
						echo $r7;	
							
						$r8=$d.'"g8" title="фруктовые">'.$r8."</div>";	
						echo $r8;	

						echo '</td>
						
						<td>';

						
							$r1="";
							$r2="";
							$r3="";
							$r4="";
							$r5="";
							$r6="";
							$r7="";
							$r8="";
							
						while($row['volatility']==3)
						{
							//echo $row['oil_name'].'">'.$row['group_name']."<br />";
							switch ($row['group_id']) {
								case 1:
									$r1=$r1.$row['oil_name']."<br />";
									break;
								case 2:
									$r2=$r2.$row['oil_name']."<br />";
									break;
								case 3:
									$r3=$r3.$row['oil_name']."<br />";
									break;
								case 4:
									$r4=$r4.$row['oil_name']."<br />";
									break;
								case 5:
									$r5=$r5.$row['oil_name']."<br />";
									break;
								case 6:
									$r6=$r6.$row['oil_name']."<br />";
									break;
								case 7:
									$r7=$r7.$row['oil_name']."<br />";
									break;
								case 8:
									$r8=$r8.$row['oil_name']."<br />";
									break;
							}
							$row=mysqli_fetch_array($volattable);
						}
							
						$r1=$d.'"g1" title="цветочные">'.$r1."</div>";	
						echo $r1;
							
						$r2=$d.'"g2" title="травяные">'.$r2."</div>";	
						echo $r2;
							
						$r3=$d.'"g3" title="цитрусовые">'.$r3."</div>";	
						echo $r3;
							
						$r4=$d.'"g4" title="древесные">'.$r4."</div>";	
						echo $r4;	
							
						$r5=$d.'"g5" title="пряные">'.$r5."</div>";	
						echo $r5;
							
						$r6=$d.'"g6" title="смоляные">'.$r6."</div>";	
						echo $r6;	
							
						$r7=$d.'"g7" title="экзотические">'.$r7."</div>";	
						echo $r7;	
							
						$r8=$d.'"g8" title="фруктовые">'.$r8."</div>";	
						echo $r8;	
						
						echo '</td>
					</tr>
					
					</tbody>
				
			  </table>';
		}

		
	}
	else {
		//
		echo '<div class="hellodiv">';
		echo '<h3>Приветствуем!</h3>';
	
		echo '<p>Здесь Вы можете подобрать сочетание эфирных масел, найти масла по желаемому свойству или же выбрать готовые аромакомпозиции из левой боковой панели страницы.</p>';
		echo '</div>';
	}
?>
				
				
				
				
		
	
	
	
</div>	
</div>
<!-- Подвал -->
<footer>Похвалить разработчика: marina1412_11@mail.ru</footer>

	
<div id="recipeform" style="display: none;">	
<button onclick="clsForm()">Вернуться</button>
	
	<form>
		<!-- <h2>Введите название и состав</h2> -->
	  <p>Название аромакомпозиции</p>
		<input type="text" name="compositionname" value="" required="" pattern="^[^=+;\$%#@*_]{1,}$">
		
	  <table>
			<thead>
			<tr>
				<td>Наименование масла</td>
				<td>Кол-во капель</td>
			</tr>
			</thead>
			<tbody>
				<tr>
				<td><input type="text" value="" name="oil1" required=""></td> <td><input type="number" value="1" min="1" name="oilN1"></td>
				</tr>
			
				<tr>
				<td><input type="text" value="" name="oil2" required=""></td> <td><input type="number" value="1" min="1" name="oilN2"></td>
				</tr>
				
				<tr>
				<td><input type="text" value="" name="oil3" required=""></td> <td><input type="number" value="1" min="1" name="oilN3"></td>
				</tr>
			
			</tbody>
		</table>
		<div>
			<button type="button" id="plsBttn" onclick="addfield()">+</button>
			<button type="button" id="mnsBttn" onclick="delfield()">–</button>
			<button type="submit">Отправить</button>
		</div>
	</form>
</div>	
<!---->
	
</body>
</html>