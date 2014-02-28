<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laravel PHP Framework</title>
  <link rel="stylesheet" href="css/style.css"/>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="js/script.js"></script>
</head>
<body>
<section class="container">
  <h1 class="page-title">Cost system</h1>
  <div class="section" id="filters">
    @yield('filters')
  </div>
  <div class="section" id="costs">
    @yield('costs')
  </div>
  <div class="section" id="add-cost">
    @yield('add')
  </div>
</section>
</body>
</html>
