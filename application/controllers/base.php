<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

  public function __construct(){
      //styles
      Asset::add('bootstrap-responsive', 'css/bootstrap-responsive.css');
      Asset::add('custom-styles', 'css/style.css');

      parent::__construct();
  }
}