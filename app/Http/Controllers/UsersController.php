<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use Image;
use File;

class UsersController extends Controller
{
    public function index()
    {
	    $users = [
			'0' => [
			'first_name' => 'CJ',
			'last_name' => 'Sheets',
			'location' => 'La Crosse'
			],
			'1' => [
			'first_name' => 'Hannah',
			'last_name' => 'Hermes',
			'location' => 'Tomah'
			]
		];
		return view('admin.users.index', compact('users'));
    }

    public function create()
    {
    	return view('admin.users.create');
    }

    // function to create user in db
    public function store(Request $request) 
    {
    	User::create($request->all());
    	return 'success';
    	return $request->all();
    }

    // function for user profile
    public function profile()
    {
    	return view('admin.users.profile', array('user' => Auth::user() ) );
    }

    // function to upload avatar
    public function update_avatar(Request $request)
    {
    	$user = User::find(Auth::user()->id);

    	// Handle the user upload of avatar
    	if($request->hasFile('avatar'))
    	{
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();

    		// Delete current image before uploading new image
            if ($user->avatar !== 'default.jpg') 
            {
                // $file = public_path('uploads/avatars/' . $user->avatar);
                $file = 'uploads/avatars/' . $user->avatar;
                //$destinationPath = 'uploads/' . $id . '/';

                if (File::exists($file)) 
                {
                    unlink($file);
                }

            }

    		Image::make($avatar)->fit(300, 300)->save(public_path('/uploads/avatars/' . $filename) );

    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return view('admin.users.profile', array('user' => Auth::user() ) );
    }
}
