
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href="{{ asset('css/get_rows.css') }}" rel="stylesheet"/>

{{--@include('head')--}}

<body>

{{--@include('header')--}}

<h1>get_rows</h1>
<div class="container">
    <h2>get_rows <small>Triggers on 767px</small></h2>
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">row_id</div>
            <div class="col col-2">Name</div>
            <div class="col col-3">Date</div>

        </li>
        @each('partials.rowblock', $RowsLinks, 'rows')

    </ul>
</div>

{{--<div id="app">--}}
{{--    <App></App>--}}
{{--</div>--}}

</body>

</html>