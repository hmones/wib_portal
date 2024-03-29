<br><br><br>
<div class="ui blue inverted vertical footer very padded segment">
    <div class="ui container">
        <div class="ui stackable inverted divided equal height stackable grid">
            <div class="four wide column">
                <div class="ui image">
                    <img src="{{asset('images/logo_inverted.png')}}" alt="Women in Business">
                </div>
            </div>
            <div class="four wide column">
                <h4 class="ui inverted header">Our Partners</h4>
                <div class="ui inverted link list">
                    <a href="http://BWE21.com" class="item">Business Women of Egypt 21</a>
                    <a href="http://www.cnfce.org/en/" class="item">Chambre Nationale des Femmes Chefs d'Entreprises</a>
                    <a href="https://llwb.org/" class="item"> Lebanese League for Women in Business </a>
                    <a href="https://www.sevedz.com/" class="item"> Savoir et Vouloir Entreprendre </a>
                    <a href="https://www.vdu.de/home.html" class="item">Verband deutscher Unternehmerinnen</a>
                    <a href="https://www.ebrd.com/home" class="item">The European Bank for Reconstruction and
                        Development</a>
                    <a href="http://www.global-project-partners.de/" class="item">Global Project Partners</a>
                </div>
            </div>
            <div class="four wide column">
                <h4 class="ui inverted header">Other Links</h4>
                <div class="ui inverted link list">
                    <a href="https://gpp-wib-staging.frb.io/impressium-example" class="item"> Imprint </a>
                    <a href="https://gpp-wib-staging.frb.io/data-privacy" class="item"> Data Privacy </a>
                </div>
            </div>
        </div>
        <br><br>
        <div class="ui center aligned centered blue inverted padded basic segment">
            <p>Copyrights reserved © {{now()->format('Y')}} Women in Business</p>
        </div>
    </div>
</div>
@include('partials.cookie_consent')
