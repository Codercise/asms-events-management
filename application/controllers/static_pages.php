<?php 

class Static_Pages_Controller extends Base_Controller {
  public function get_help() {
    return View::make('static_pages.help');
  }
  public function get_contact() {
    return View::make('static_pages.contact');
  }
}