<?php
	
	class PhoneException extends Exception {
		
		protected $vendor, $col;
		
		function __construct ($mess, $vendor = '', $col = '') {
			
			parent::__construct ($mess);
			
			$this->vendor = $vendor;
			$this->col = $col;
			
		}
		
		function getVendor (): string {
			return $this->vendor;
		}
		
		function getCol (): string {
			return $this->col;
		}
		
	}