<?php

class PDEvent extends Eloquent {

  public static $table = 'pdevents';

  public function users()
  {
    return $this->has_many_and_belongs_to('User');
  }

  public function waitlist()
  {
    return $this->has_many('Waitlist');
  }
}