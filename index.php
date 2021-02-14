<?php
	
	error_reporting (E_ALL);
	
	@ini_set ('display_errors', true);
	@ini_set ('display_startup_errors', true);
	@ini_set ('error_reporting', E_ALL);
	
	require 'Phone.php';
	
	try {
		
		$phone = new \PhoneDemo\Phone ();
		
		$phone->addPhone ([ // Добавление телефона. Осуществляется проверка по модели (ту же модель нельзя добавить дважды).
			
			'name' => 'Xiaomi',
			'price' => 10000,
			'quantity' => 100,
			
		]);
		
		/*$phone->updatePhone ('Xiaomi2', [
			
			'price' => 20000,
			
		]);*/
		
		//$phone->deletePhone ('Xiaomi');
		
		$phone->buyPhone ('Xiaomi');
		
		//echo $phone->getData ('Xiaomi', 'price');
		
	} catch (\PhoneException $e) { // Перехватываем исключение (модель закончилась, не найдена, неверный ключ массива, пытаемся удалить несуществующую мобилу, и т. д.)
		echo $e->getMessage ().' ('.$e->getVendor ().')';
	}
	
	$content = '<html>
	<head>
		
		<style>
			
			body {
				margin: 0;
				padding: 20px;
			}
			
			input, select {
				padding: 10px;
				border: 1px solid #ccc;
				width: 200px;
			}
			
			.message {
				font-weight: bold;
			}
			
		</style>
		
	</head>
	
	<body>
		
		<div id="content">
			
			<form method="post" id="form" action="#">
				
				<p><input type="text" id="name" placeholder="Имя" /></p>
				<p><input type="text" id="phone" placeholder="Телефон" /></p>
				
				<p>
					<select id="city" placeholder="Город">
						<option value=""></option>
						<option value="spb">Санкт-Петербург</option>
						<option value="moscow">Москва</option>
					</select>
				</p>
				
			</form>
			
		</div>
		
		<script type="text/javascript" src="ajax.js"></script>
		
	</body>
</html>';
	
	echo $content;