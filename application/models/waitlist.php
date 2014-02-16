<?php

class Waitlist extends Eloquent {

  public static $table = 'pdevent_waitlist';

  public function pdevent()
  {
    return $this->has_one('PDEvents');
  }
}