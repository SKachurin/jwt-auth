<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('head')

<body>

@include('header')

    <div id="app">
        <App></App>
    </div>

</body>

</html>

<script type="module">
    import App from "../js/components/App";
    export default {
        components: {App}
    }
</script>

{{--<script--}}
{{--        src="https://code.jquery.com/jquery-2.2.4.min.js"--}}
{{--        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="--}}
{{--        crossorigin="anonymous"></script>--}}

{{--<script>--}}
{{--    $(window).load(function() {--}}
{{--        $('div.va-modal__footer').prop("hidden", "true");--}}
{{--    });--}}
{{--</script>--}}