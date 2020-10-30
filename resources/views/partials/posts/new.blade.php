<div class="ui raised segment">
    <form method="POST" action="{{route('post.store')}}" class="ui form">
        @csrf
        <textarea name="content" placeholder="I'm looking for ...." cols="30" rows="2" class="fluid field"></textarea>
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
        <div class="four stackable fields">
            <div class="field">
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="post_type" id="post_type" value="" />
                    <i class="dropdown icon"></i>
                    <div class="default text"><i class="tasks icon"></i>Category</div>
                    <div class="menu">
                        <div class="item" data-value="Help"><i class="life ring outline icon"></i> Help</div>
                        <div class="item" data-value="Recommendations"><i class="star outline icon"></i>Recommendations
                        </div>
                        <div class="item" data-value="Advice"><i class="compass outline icon"></i>Advice</div>
                        <div class="item" data-value="Products"><i class="dolly icon"></i>Products</div>
                        <div class="item" data-value="Services"><i class="cog icon"></i>Services</div>
                        <div class="item" data-value="Buyer"><i class="shopping cart icon"></i>Buyer</div>
                        <div class="item" data-value="Seller"><i class="money bill alternate outline icon"></i>Seller
                        </div>
                        <div class="item" data-value="Attending a fair"><i class="ticket alternate icon"></i>Attending a
                            fair</div>
                        <div class="item" data-value="Organizing a fair"><i
                                class="calendar alternate outline icon"></i>Organizing a fair</div>
                        <div class="item" data-value="Participating in an event"><i class="users icon"></i>Participating
                            in an event</div>
                        <div class="item" data-value="Announcing news"><i class="bullhorn icon"></i>Announcing news
                        </div>
                        <div class="item" data-value="Launching new product"><i class="rocket icon"></i>Launching new
                            product</div>
                    </div>
                </div>
            </div>
            <div class="field">
                <x-Countries />
            </div>
            <div class="field">
                <x-Sectors />
            </div>
            <div class="field">
                <a href="javascript:void(0);" class="ui blue fluid  button" id="create_new_post">Post &nbsp; <i
                        class="paper plane white icon"></i></a>
            </div>
        </div>
    </form>
</div>