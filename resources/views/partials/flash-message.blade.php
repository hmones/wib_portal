<div class="ui container">
    @if ($message = Session::get('success'))

    <div class="ui positive message">

        <i class="close icon"></i>

        <strong>{{ $message }}</strong>

    </div>
    <br />
    @endif

    @if($errors->any())
    <div class="ui negative message">
        <i class="close icon"></i>
        @foreach ($errors->all() as $error)
        <strong>{{ $error }}</strong>
        @endforeach
    </div>
    <br />
    @endif

    @if ($message = Session::get('error'))

    <div class="ui negative message">

        <i class="close icon"></i>

        <strong>{{ $message }}</strong>

    </div>
    <br />
    @endif


    @if ($message = Session::get('warning'))

    <div class="ui warning message">

        <i class="close icon"></i>

        <strong>{{ $message }}</strong>

    </div>
    <br />
    @endif


    @if ($message = Session::get('info'))

    <div class="ui info message">

        <i class="close icon"></i>

        <strong>{{ $message }}</strong>

    </div>
    <br />
    @endif
</div>
<script>
    $('i.close.icon').click(function () {
        $(this).parent().fadeOut();
    });
</script>