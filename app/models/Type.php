<?php

class Type extends Eloquent {
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'types';
  protected $fillable = array('name');
  public $timestamps = false;
  protected $primaryKey = 'tid';
}
