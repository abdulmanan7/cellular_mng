<?php 
		$this->view('template/header');
		
		$this->view('template/navbar');
		
		$this->view($page);


		$this->view('template/footer');