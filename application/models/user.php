<?php

class User extends Eloquent {

  public static $table = 'users';

  public function pdevents()
  {
    return $this->has_many_and_belongs_to('PDEvent');
  }
}