`<h3>Profile</h3>

@include('partials.messages')

<form action={{ $action }} method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field($method) }}
    <div class="form-row">
        <div class="col mb-3">
            <label for="first-name">First Name</label>
            <input id="first-name"
                   type="text"
                   class="{{ className(['form-control', 'form-control-lg'], [$errors->has('first_name') ? 'is-invalid' : null]) }}"
                   name="first_name"
                   value="{{ old('first_name', $profile->first_name ?? $user->first_name) }}">

            <div class="invalid-feedback">
                {{ $errors->first('first_name') }}
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col mb-3">
            <label for="last-name">Last Name</label>
            <input id="last-name"
                   type="text"
                   class="{{ className(['form-control', 'form-control-lg'], [$errors->has('last_name') ? 'is-invalid' : null]) }}"
                   name="last_name"
                   value="{{ old('last_name', $profile->last_name ?? $user->last_name) }}">

            <div class="invalid-feedback">
                {{ $errors->first('last_name') }}
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col mb-3">
            <input type="hidden" name="username-validation-route" value="{{ route('profile.username') }}" />
            <label for="username">Username</label>
            <input id="username"
                   type="text"
                   class="{{ className(['form-control', 'form-control-lg'], [$errors->has('username') ? 'is-invalid' : null]) }}"
                   name="username"
                   value="{{ old('username', $profile->username ?? $user->username) }}">

            <div class="invalid-feedback">
                {{ $errors->first('username') }}
                <span id="username-error"></span>
            </div>

            <div class="valid-feedback">
                <span id="username-success"></span>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col mb-3">
            <label for="gender">Gender</label>
            <select id="gender"
                    class="{{ className(['form-control', 'form-control-lg', 'selectpicker'], [$errors->has('gender') ? 'is-invalid' : null]) }}"
                    name="gender"
                    title="(select)"
                    data-style="bg-white border">
                @foreach(array_get($data, 'gender_list') as $identifier => $gender)
                    <option value="{{ $identifier }}" {{ old('gender', $profile->gender ?? null) === $identifier ? 'selected="selected"' : '' }}>{{ $gender }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('gender') }}
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col mb-3">
            <label for="country">Country</label>

            <select id="country"
                    class="{{ className(['form-control', 'form-control-lg', 'selectpicker'], [$errors->has('country') ? 'is-invalid' : null]) }}"
                    name="country"
                    title="(select)"
                    data-live-search="true"
                    data-style="bg-white border">
                @foreach(array_get($data, 'country_list') as $identifier => $country)
                    <option value="{{ $identifier }}" {{ old('country', $profile->country ?? null) === $identifier ? 'selected="selected"' : '' }}>{{ $country }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('country') }}
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col mb-3">
            <label for="genres">Genres</label>
            <select id="genres"
                    class="{{ className(['form-control', 'form-control-lg', 'selectpicker'], [$errors->has('genres') ? 'is-invalid' : null]) }}"
                    name="genres[]"
                    title="(select)"
                    multiple
                    data-live-search="true"
                    data-style="bg-white border">
                @foreach(array_get($data, 'genre_list') as $genre)
                    <option value="{{ $genre->uuid }}" {{ in_array($genre->uuid, old('genres', isset($profile->genres) ? $profile->genres->pluck('uuid')->all() : [])) ? 'selected="selected"' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('genres') }}
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col mb-3">
            <label for="date-of-birth">Date of Birth</label>
            <input id="date_of_birth"
                   class="{{ className(['form-control', 'form-control-lg'], [$errors->has('date_of_birth') ? 'is-invalid' : null]) }}"
                   name="date_of_birth"
                   value="{{ old('date_of_birth', isset($profile) ? $profile->date_of_birth->format('Y-m-d') : null) }}"
                   type="text">

            <div class="invalid-feedback">
                {{ $errors->first('date_of_birth') }}
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col mb-3">
            <label for="exampleFormControlTextarea1">About me:</label>
            <textarea class="{{ className(['form-control'], [$errors->has('about_me') ? 'is-invalid' : null]) }}" rows="5" name="about_me">{{ old('about_me', $profile->about_me ?? null) }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('about_me') }}
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col mb-3">
            <label>Profile Picture</label>
            <div class="custom-file custom-file-lg">
                <input type="file" class="{{ className(['custom-file-input'], [$errors->has('photo') ? 'is-invalid' : null]) }}" id="photo" name="photo" aria-describedby="uploadHelp">
                <label class="custom-file-label" for="photo">Choose file</label>
                <small id="uploadHelp" class="form-text text-muted">Your photo must be at least 300x300px</small>

                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>
            </div>
        </div>
    </div>

    <div class="form-row float-right">
        <a href="{{ route('welcome') }}" class="btn btn-secondary mr-1">Cancel</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
