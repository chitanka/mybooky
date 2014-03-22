<?php

class Home_Controller extends Base_Controller {

	public function action_index() {
		$menu = Config::get('application.menu');

		return View::make('home.index')->with('menu', $menu);
	}

}
