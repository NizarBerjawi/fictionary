<?php

namespace App\Http\Controllers;

use App\Fictionary\Auth\User;
use App\Fictionary\Profiles\Profile;
use App\Fictionary\Profiles\Requests\CreateProfile;
use App\Fictionary\Support\Forms\AggregatorInterface;
use App\Fictionary\Auth\Profiles\Policies\ProfilePolicy;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RedirectsUsers;

class ProfileController extends Controller
{
    /**
     * Storage driver
     *
     * @var Storage  $storage
     */
    protected $storage;

    /**
     * Data required to render form
     *
     * @var DataAggregator
     */
    protected $data;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AggregatorInterface $data)
    {
        $this->data = $data;
        $this->storage = Storage::disk('profile.photos');
    }

    /**
     * Show the profile create page.
     *
     * @param Request
     * @return Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Profile::class);

        return view('app.profile.create')
                ->withUser($request->user())
                ->withData($this->data);
    }

    /**
     * Store the user's profile details
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateProfile $request)
    {
        $this->authorize('create', Profile::class);

        $profile = new Profile(['user_uuid' => $request->user()->uuid]);

        $profile->fill(
            $request->only([
                'first_name',
                'last_name',
                'username',
                'date_of_birth',
                'gender',
                'country',
                'about_me',
            ])
        );

        if ($request->has('photo')) {
            $profile->photo = $this->handlePhotoUpload($request, $profile);
        }
        $profile->save();
        $profile->genres()->attach($request->input('genres'));

        return redirect()->route('profile.show', $profile)
                         ->withSuccess('Profile created successfully.');
    }

    /**
     * Display a user's profile
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request, Profile $profile)
    {
        $this->authorize('show', $profile);
        
        return view('app.profile.show')
                 ->withProfile($profile);
    }

    /**
     * Edit a specific user's profile
     *
     * @param Request $request
     * @param Profile $profile
     * @return Response
     */
    public function edit(Request $request, Profile $profile)
    {
        $this->authorize('update', $profile);

        $profile->load('genres');
        $user = $profile->user()->firstOrFail();

        return view('app.profile.edit')
                ->withUser($user)
                ->withProfile($profile)
                ->withData($this->data);
    }

    /**
     * Update a specified user profile
     *
     * @param Request $request
     * @param Profile $profile
     * @return Response
     */
    public function update(Request $request, Profile $profile)
    {
        $this->authorize('update', $profile);

        $profile->fill(
            $request->only([
                'first_name',
                'last_name',
                'username',
                'date_of_birth',
                'gender',
                'country',
                'about_me',
            ])
        );

        if ($request->has('photo')) {
            $profile->photo = $this->handlePhotoUpload($request, $profile);
        }

        $profile->save();

        return redirect()->route('profile.show', $profile)
                ->withSuccess('Profile updated successfully.');
    }

    /**
     * Check that the user's selected username is unique.
     *
     * @param Request $request
     * @return Response
     */
    public function validateUsername(Request $request)
    {
        if (!$request->isJson()) {
            abort(404);
        }

        $validator = Validator::make($request->only('username'), [
            'username' => 'required|string|max:255|unique:profiles,username',
        ], [
            'username.unique' => 'This username has already been taken.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('username')
            ], 422);
        }

        return response()->json([
            'message' => 'Username available'
        ], 200);
    }

    /**
     * Handle profile photo upload
     *
     * @param Request $request
     * @return string|null
     */
    private function handlePhotoUpload(Request $request, Profile $profile)
    {
        // If the user already has a profile photo, delete it
        if (($filename = $profile->photo) && $this->storage->exists($filename)) {
            $this->storage->delete($filename);
        }

        // Get the data of the image
        $data = json_decode($request->input('photo'));
        $extension = pathinfo($data->name, PATHINFO_EXTENSION);
        $hashName = Str::random(40);
        $filename = "{$hashName}.{$extension}";
        $valid = $this->storage->put($filename, base64_decode($data->data));

        return $valid ? $filename : null;
    }
}
