@extends('layout')

@section('costs')
    <h2>All costs</h2>
    @foreach($costs as $cost_obj)
        <div class="cost-item">
            <span>{{ $cost_obj->value }}&#8372</span>
            <span>{{ $cost_obj->tid }}</span>
            <span>{{ $cost_obj->date }}</span>
            <span>{{ $cost_obj->description }}</span>
        </div>
    @endforeach
@stop

@section('form')
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
        <input type="submit" value="Send Message" id="submit"/>
    </form>
@stop