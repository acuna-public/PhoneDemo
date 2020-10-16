<?php
	
	namespace PhoneDemo;
	
	require 'PhoneException.php';
	
	class Phone {
		
		public $file = 'phones.json';
		
		private $phones = [];
		
		public function __construct () {
			
			if (file_exists ($this->file))
				$this->phones = json_decode (file_get_contents ($this->file), true);
				// Если JSON с данными уже существует - делаем из него массив
			else
				$this->writePhone (); // Иначе создаем пустой
			
		}
		
		private function writePhone () {
			file_put_contents ($this->file, json_encode ($this->phones, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)); // Создаем из массива JSON c некоторыми опциями (принудительный асоциированный массив если пустой, pretty-print для чтения людьми)
		}
		
		public function getData (string $model, string $col = '') {
			
			if ($col) {
				
				if (isset ($this->phones[$model][$col]))
					return $this->phones[$model][$col];
				else
					throw new \PhoneException ('"'.$col.'" column not found', $model, $col);
				
			} elseif (isset ($this->phones[$model]))
				return $this->phones[$model];
			else
				return [];
			
		}
		
		public function addPhone (array $data) {
			
			if (!$this->getData ($data['name'])) { // Модели еще нет в БД
				
				if (!isset ($data['quantity']))
					$data['quantity'] = 1;
				
				$this->phones[$data['name']] = $data;
				$this->writePhone ();
				
			}
			
		}
		
		public function updatePhone (string $model, array $data) {
			
			if ($this->getData ($model)) {
				
				foreach ($data as $key => $value)
					$this->phones[$model][$key] = $data[$key];
				
				$this->writePhone ();
				
			} else throw new \PhoneException ('"'.$model.'" not found', $model);
			
		}
		
		public function deletePhone (string $model) {
			
			if ($this->getData ($model)) {
				
				unset ($this->phones[$model]);
				$this->writePhone ();
				
			} else throw new \PhoneException ('"'.$model.'" not found', $model);
			
		}
		
		public function buyPhone (string $model) {
			
			$num = $this->getData ($model, 'quantity');
			$num--;
			
			if ($num > 0)
				$this->updatePhone ($model, ['quantity' => $num]);
			else
				throw new \PhoneException ('"'.$model.'" model is ended', $model);
			
		}
		
	}