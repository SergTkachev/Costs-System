<?php

class Cost extends Eloquent {
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'costs';
  public $timestamps = false;
  protected $fillable = array('uid', 'tid', 'value', 'date', 'description');
  public function getDates() {
    return array('date');
  }
}
