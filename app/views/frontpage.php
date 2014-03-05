<!doctype html>
<html ng-app='app' lang="en">
<title>Costs system</title>
<link rel="stylesheet" href="css/style.css"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/angular.js"></script>
<script src="js/script.js"></script>
<body>
<!--<div class="container">
  <ul class="main-controller">
    <li ng-repeat='cost in costs'>
      {{ cost.type }} <a href="#" ng-click='deleteUser(item, $index)'>Delete</a>
    </li>
  </ul>

  <form>
    <input type="text" ng-model='user.name'>
    <input type="text" ng-model='user.email'>
    <input type="text" ng-model='user.password'>
    <button ng-click='saveUser(user)'>Save User</button>
  </form>

</div>-->

<section class="container main-controller">
  <h1 class="page-title">Cost system</h1>
  <div class="section" id="filters">
    <h1 class="title">Filters</h1>
    <form class="form">
      <ul>
        <li>
          <label for="filter-type">Type:</label>
          <input placeholder="Type…" type="text" name="type" id="filter-type"/>
        </li>
        <li>
          <label for="filter-date-from">Date from:</label>
          <input placeholder="Date from…" type="text" name="date1" id="filter-date-from"/>
        </li>
        <li>
          <label for="filter-date-to">Date to:</label>
          <input placeholder="Date to…" type="text" name="date2" id="filter-date-to"/>
        </li>
        <li>
          <label for="filter-pager">Items per page:</label>
          <input placeholder="Items per page…" type="text" name="ipp" id="filter-pager"/>
        </li>
      </ul>
      <input type="submit" value="Filter" id="submit"/>
    </form>
  </div>
  <div class="section" id="costs">
    <div class="cost-item costs-header">
      <span class="cost-cell">Value</span>
      <span class="cost-cell">Type</span>
      <span class="cost-cell">Date</span>
      <span class="cost-cell">Description</span>
    </div>
    <div class="cost-item" ng-repeat='cost in costs'>
      <span class="cost-cell">{{ cost.value }}&#8372</span>
      <span class="cost-cell">{{ cost.type }}</span>
      <span class="cost-cell">{{ cost.date }}</span>
      <span class="cost-cell description">{{ cost.description }}</span>
    </div>
  </div>
  <div class="section" id="add-cost">
    <h1 class="title">Add a cost</h1>
    <form class="form">
      <ul>
        <li>
          <label for="cost-value">Value:</label>
          <input ng-model='cost.value' placeholder="Value…" type="text" name="value" id="cost-value"/>
        </li>
        <li>
          <label for="cost-type">Type:</label>
          <input ng-model='cost.type' placeholder="Type…" type="text" name="type" id="cost-type"/>
        </li>
        <li>
          <label for="cost-description">Description:</label>
          <textarea ng-model='cost.description' placeholder="Description…" name="description" id="cost-description"></textarea>
        </li>
      </ul>
      <input type="submit" value="Add" id="submit" ng-click='addCost(cost)'/>
    </form>
  </div>
</section>
</body>
</html>