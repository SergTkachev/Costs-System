@extends('layout')

@section('filters')
<h1 class="title">Filters</h1>
<form action="/" method="get" class="form">
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
@stop

@section('costs')
  @foreach($costs as $cost_obj)
    <div class="cost-item">
      <span>{{ $cost_obj['value'] }}&#8372</span>
      <span>{{ $cost_obj['type'] }}</span>
      <span>{{ $cost_obj['date'] }}</span>
      <span>{{ $cost_obj['description'] }}</span>
    </div>
  @endforeach
  <div class="pager">
    @foreach(range(1, $num) as $i)
      @if($page != $i)
        <a href="?page={{ $i }}&{{ $get }}">{{ $i }}</a>
      @else
        <span>{{ $page }}</span>
      @endif
    @endforeach
  </div>
@stop

@section('add')
  <h1 class="title">Add a cost</h1>
  <form action="costs" method="post" class="form">
    <ul>
      <li>
        <label for="cost-type">Type:</label>
        <input placeholder="Type…" type="text" name="type" id="cost-type"/>
      </li>
      <li>
        <label for="cost-value">Value:</label>
        <input placeholder="Value…" type="text" name="value" id="cost-value"/>
      </li>
      <li>
        <label for="cost-description">Description:</label>
        <textarea placeholder="Description…" name="description" id="cost-description"></textarea>
      </li>
    </ul>
    <input type="submit" value="Add" id="submit"/>
  </form>
@stop