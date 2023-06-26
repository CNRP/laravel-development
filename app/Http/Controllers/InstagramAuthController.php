<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dymantic\InstagramFeed\Profile;
use Dymantic\InstagramFeed\InstagramFeed;

class InstagramAuthController extends Controller
{
    public function show(Request $request) {
        $profile = Profile::where('username', 'cpbeats')->first();

        return view('insta-auth', ['instagram_auth_url' => $profile->getInstagramAuthUrl()]);
    }

    public function complete() {
        $was_successful = request('result') === 'success';

        return view('instagram-auth-response-page', ['was_successful' => $was_successful]);
    }
}
