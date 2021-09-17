<div class="ui section inverted blue basic segment">
    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <p class="byline normal"><span class="ui white text">JOIN THE COMMUNITY AND THE DEBATE</span></p>
        <h1 class="ui page header"><span class="ui white text">Portal Services</span>
        </h1>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui stackable grid">
            <div class="ui four wide column">
                @include('partials.home.service-card', ['link' => route('profile.index'), 'icon' => 'address book outline', 'title' => 'Business Directory', 'content' => 'WiB portal enables women entrepreneurs to search for and find business partners by accessing profiles of over 400 businesswomen from the MENA Region.'])
            </div>
            <div class="ui four wide column">
                @include('partials.home.service-card', ['link' => route('entity.index'), 'icon' => 'building outline', 'title' => 'Company Directory', 'content' => 'WiB portal enables women entrepreneurs to search for and find business partners by accessing profiles of over 400 companies from the MENA Region.'])
            </div>
            <div class="ui four wide column">
                @include('partials.home.service-card', ['link' => '#', 'icon' => 'calendar alternate outline', 'title' => 'Networking Events', 'content' => 'The portal allows businesswomen to take part of the network events and stay informed about upcoming activities, in particular the regular online B2B events.'])
            </div>
            <div class="ui four wide column">
                @include('partials.home.service-card', ['link' => null, 'icon' => 'chart bar outline', 'title' => 'Data Analysis', 'content' => 'The portal is a rich and diverse platform of businesswomen in the MENA Region, this allows to have access to robust data about women entrepreneurship in the region.'])
            </div>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
    </div>
</div>
