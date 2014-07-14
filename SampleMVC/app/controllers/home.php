<?php

	class Home extends Controller {
		public function index($name='ganesh', $mood='happy') {
			$user = $this->model('user');
			$user->name = $name;
			
			$data2 = $user->getAllSongs();
			
			$this->view('home/index',['name'=>$user->name , 'mood'=>$mood], $data2 = $data2);
		}
	}
?>