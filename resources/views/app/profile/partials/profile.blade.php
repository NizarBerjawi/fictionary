<div class="well profile">
    <div class="col-sm-12 text-center">
        <div class="col text-center">
            @if (!is_null($profile->photo))
                <img id="image" src={{ $profile->photo_path }} class="rounded-circle mx-auto block" width="200"/>
            @endif
            <h2>{{ $profile->full_name }}</h2><small><a href="{{ route('profile.edit', $profile) }}">(Edit)</a></small>
        </div>

        <hr />

        <div class="col">
            <figure>
                <img src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png" alt="" class="img-circle img-responsive">
                <figcaption class="ratings">
                    <p>Ratings
                        <a href="#">
                            <span class="fa fa-star"></span>
                        </a>
                        <a href="#">
                            <span class="fa fa-star"></span>
                        </a>
                        <a href="#">
                            <span class="fa fa-star"></span>
                        </a>
                        <a href="#">
                            <span class="fa fa-star"></span>
                        </a>
                        <a href="#">
                            <span class="fa fa-star"></span>
                        </a>
                    </p>
                </figcaption>
            </figure>

            <p><strong>About: </strong> {{ $profile->about_me}} </p>
            <p><strong>Genres: </strong>
                @foreach($profile->genres as $genre)
                    <span class="badge badge-info">{{ $genre->name }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <div class="col-xs-12 divider text-center">
        <div class="row">

        <div class="col-xs-12 col-sm-4 emphasis">
            <h2><strong> 20,7K </strong></h2>
            <p><small>Followers</small></p>
            <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> Follow </button>
        </div>

        <div class="col-xs-12 col-sm-4 emphasis">
            <h2><strong>245</strong></h2>
            <p><small>Following</small></p>
            <button class="btn btn-info btn-block"><span class="fa fa-user"></span> View Profile </button>
        </div>

        <div class="col-xs-12 col-sm-4 emphasis">
            <h2><strong>43</strong></h2>
            <p><small>Snippets</small></p>
            <div class="btn-group dropup btn-block">
                <button type="button" class="btn btn-primary"><span class="fa fa-gear"></span> Options </button>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu text-left" role="menu">
                    <li><a href="#"><span class="fa fa-envelope pull-right"></span> Send an email </a></li>
                    <li><a href="#"><span class="fa fa-list pull-right"></span> Add or remove from a list  </a></li>
                    <li class="divider"></li>
                    <li><a href="#"><span class="fa fa-warning pull-right"></span>Report this user for spam</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="btn disabled" role="button"> Unfollow </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
