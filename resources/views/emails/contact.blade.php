<div class="ui container">
    <img src="{{asset('images/logo.png')}}" alt="Women in Business Portal" class="ui left floated image">
    <p>Dear {{$user->title}} {{$user->name}},</p>
    <p>
        You just received a contact request from {{$auth_user->title}} {{$auth_user->name}}.
        If you would like to start a conversation, click reply to this email and write back to the user.
        Alternatively, you can email the user directly using their email address {{$auth_user->email}}
    </p>
    <p>
        Best wishes,
    </p>
    <p>
        Women in Business Portal Team
    </p>
</div>
