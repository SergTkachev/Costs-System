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
    Filters
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
    Add form
  </div>
</section>
</body>
</html>