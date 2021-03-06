<?php

define('MAX_COSTS_PER_PAGE', 10);

class CostController extends BaseController {

  public function getPagerCount($ipp = MAX_COSTS_PER_PAGE) {
    return ceil(Cost::all()->count() / $ipp);
  }

  public function getApiCosts() {
    /**
     * Filtering costs.
     */
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $type = !empty($_GET['type']) ? lcfirst($_GET['type']) : '';
    $date1 = !empty($_GET['date1']) ? date('Y-m-d', strtotime($_GET['date1'])) : 0;
    $date2 = !empty($_GET['date2']) ? date('Y-m-d H:i:s', strtotime($_GET['date2'] . ' +1 day')) : date('Y-m-d H:i:s');
    $ipp = (int) $_GET['ipp'];
    $query = Cost::whereBetween('date', array($date1, $date2));
    if (!empty($type)) {
      $tid = Type::whereName($type)->get()->toArray()[0]['tid'];
      $query->whereTid($tid);
    }
    $query = $query->orderBy('date', 'DESC')->get();

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
    $result['numItems'] = count($costs);
    $result['costs'] = array_slice($costs, ($page - 1) * $ipp, $ipp);
    $result['page'] = $page;
    return $result;
  }

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
      ->with('num', $this->getPagerCount())
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
    return Redirect::to('/costs');
	}

  public function addApiCost() {
    global $HTTP_RAW_POST_DATA;
    $costPost = json_decode($HTTP_RAW_POST_DATA);
    $type = strtolower(trim($costPost->type));
    $value = strtolower(trim($costPost->value));
    $description = ucfirst(trim($costPost->description));
    $result = NULL;
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
      $result = $cost->getAttributes();
      $result['type'] = ucfirst($type);
      $result['date'] = date('d.m.Y', strtotime($result['date']));
    }
    return $result;
  }
}
