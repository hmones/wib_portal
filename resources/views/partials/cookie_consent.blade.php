@if (!session('consent-set'))
<div class="ui grid">
    <div class="ui container" style="z-index:200;position:fixed;bottom:0px;right:0px;">
        <div class="ui padded basic inverted grey segment">
            <div class="ui blue header">Your Privacy</div>
            <div style="color:grey;">
                We use cookies to improve your experience on our site. To find out more, read our updated <a
                    href="#">privacy policy</a> and <a href="#">cookie policy</a>.
            </div>
            <br />
            <div class="ui stackable two column grid">
                <div class="column">
                    <a class="ui blue button" href="javascript:void(0);" onclick="cookie_consent_submit('all');">
                        Accept all cookies
                    </a>
                </div>
                <div class="right aligned column">
                    <a href="javascript:void(0);" onclick="cookie_consent_submit('functional');">Accept only functional
                        cookies</a>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="/cookie/consent" method="POST" id="cookie_consent">
    @csrf
    <input type="hidden" name="status" value="" id="cookie_consent_status" />
</form>
<script>
    function cookie_consent_submit(status){
        $('#cookie_consent_status').val(status);
        $('#cookie_consent').submit();
    }
</script>
@endif