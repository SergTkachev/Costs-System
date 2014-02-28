<?php

define('MAX_COSTS_PER_PAGE', 50);

class CostController extends BaseController {

  public function getCosts() {
    /**
     * Filtering costs.
     */
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if (empty($_GET)) {
      $ipp = MAX_COSTS_PER_PAGE;
      $query = Cost::take($ipp)->orderBy('date', 'DESC')->get();
    }
    else {
      $type = !empty($_GET['type']) ? lcfirst($_GET['type']) : '';
      $date1 = !empty($_GET['date1']) ? date('Y-m-d', strtotime($_GET['date1'])) : 0;
      $date2 = !empty($_GET['date2']) ? date('Y-m-d H:i:s', strtotime($_GET['date2'] . ' +1 day')) : date('Y-m-d H:i:s');
      $ipp = !empty($_GET['ipp']) ? (int) $_GET['ipp'] : MAX_COSTS_PER_PAGE;
      $query = Cost::whereBetween('date', array($date1, $date2));
      if (!empty($type)) {
        $tid = Type::whereName($type)->get()->toArray()[0]['tid'];
        $query->whereTid($tid);
      }
      if (!empty($ipp)) {
        $query->take($ipp);
      }
      unset($_GET['page']);
      $query = $query->skip(($page - 1) * $ipp)->orderBy('date', 'DESC')->get();
    }

    /**
     * Prepare variables for pager.
     */
    $num_costs = Cost::all()->count();
    $num_pages = ceil($num_costs / $ipp);

    /**
     * Change costs for view.
     */
    $costs = array_map(function($item) {
      return array(
        'value' => $item['value'],
        'date' => date('d.m.Y', strtotime($item['date'])),
        'type' => ucfirst(Type::find($item['tid'])->toArray()['name']),
        'description' => $item['description'],
      );
    }, $query->toArray());
    return View::make('costs')
      ->with('costs', $costs)
      ->with('num', $num_pages)
      ->with('page', $page)
      ->with('get', http_build_query($_GET));
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
    return Redirect::to('/');
	}
}
