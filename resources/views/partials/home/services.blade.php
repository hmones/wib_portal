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
                @include('partials.home.service-card', ['link' => route('messenger'), 'icon' => 'comment outline', 'title' => 'Messaging', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non lacus auctor, vestibulum leo ac, elementum elit.'])
            </div>
            <div class="ui four wide column">
                @include('partials.home.service-card', ['link' => route('profile.index'), 'icon' => 'address book outline', 'title' => 'Business Women Directory', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non lacus auctor, vestibulum leo ac, elementum elit.'])
            </div>
            <div class="ui four wide column">
                @include('partials.home.service-card', ['link' => route('entity.index'), 'icon' => 'building outline', 'title' => 'Company Directory', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non lacus auctor, vestibulum leo ac, elementum elit.'])
            </div>
            <div class="ui four wide column">
                @include('partials.home.service-card', ['link' => route('post.index'), 'icon' => 'edit outline', 'title' => 'Posting', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non lacus auctor, vestibulum leo ac, elementum elit.'])
            </div>
            <div class="ui four wide column">
                @include('partials.home.service-card', ['link' => '#', 'icon' => 'calendar alternate outline', 'title' => 'Networking Events', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non lacus auctor, vestibulum leo ac, elementum elit.'])
            </div>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>
    </div>
</div>