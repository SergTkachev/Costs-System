<?php

class CostController extends BaseController {

  public function getCosts() {
    $costs = Cost::all()->toArray();
    $costs = array_map(function($item) {
      return array(
        'value' => $item['value'],
        'date' => date('d.m.Y', strtotime($item['date'])),
        'type' => ucfirst(Type::find($item['tid'])->toArray()['name']),
        'description' => $item['description'],
      );
    }, $costs);
    return View::make('costs')->with('costs', $costs);
  }

	public function addCost() {
    $type = strtolower(trim($_POST['type']));
    $value = strtolower(trim($_POST['value']));
    $description = ucfirst(trim($_POST['description']));
    if (!empty($value) && !empty($type)) {
      Type::firstOrNew(array('name' => $type))->save();
      $tid_arr = Type::whereName($type)->take(1)->get(array('tid'))->toArray();
      $tid = $tid_arr[0]['tid'];
      $cost = new Cost(array(
        'value' => $value,
        'description' => $description,
        'tid' => $tid,
        'uid' => 1,
        'date' => time(),
      ));
      $cost->save();
    }
    return Redirect::to('/costs');
	}
}
