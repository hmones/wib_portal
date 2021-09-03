<div class="ui container">
    @if ($message = session()->get('success'))

        <div class="ui blue message"
             style="background: #fafafa;box-shadow: 3px 1px 12px -8px #153e7a;border: solid 1px #dbdbdb;">
            <i class="close icon"></i>
            <span>{{ $message }}</span>

        </div>
        <br/>
    @endif

    @if($errors->any())
        <div class="ui error message"
             style="background: #fafafa;box-shadow: 3px 1px 12px -8px #9f3a38;border: solid 1px #dbdbdb;">
            <i class="close icon"></i>
            <div class="ui small header">Errors:</div>
            <div style="padding-left: 10px;margin-top:10px;">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                    <br>
                @endforeach
            </div>
        </div>
        <br/>
    @endif

    @if ($message = session()->get('error'))

        <div class="ui error message"
             style="background: #fafafa;box-shadow: 3px 1px 12px -8px #153e7a;border: solid 1px #dbdbdb;">
            <i class="close icon"></i>
            <span>{{ $message }}</span>

        </div>
        <br/>
    @endif


    @if ($message = session()->get('warning'))

        <div class="ui blue message"
             style="background: #fafafa;box-shadow: 3px 1px 12px -8px #153e7a;border: solid 1px #dbdbdb;">
            <i class="close icon"></i>
            <span>{{ $message }}</span>

        </div>
        <br/>
    @endif


    @if ($message = session()->get('info'))

        <div class="ui blue message"
             style="background: #fafafa;box-shadow: 3px 1px 12px -8px #153e7a;border: solid 1px #dbdbdb;">
            <i class="close icon"></i>
            <span>{{ $message }}</span>
        </div>
        <br/>
    @endif
</div>
<script>
    $('i.close.icon').click(function () {
        $(this).parent().fadeOut();
    });
</script>
