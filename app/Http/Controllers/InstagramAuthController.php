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

    public function feed(Request $request){
        $profile = Profile::where('username', 'cpbeats')->first();
        $feed = $profile->feed();
        return view('insta-feed', ['feed' => $feed]);
    }

    public function feedRefresh(Request $request){
        $profile = Profile::where('username', 'cpbeats')->first();
        $feed = $profile->refreshFeed();
        return view('insta-feed', ['feed' => $feed]);
    }

    public function complete() {
        $was_successful = request('result') === 'success';

        return view('instagram-auth-response-page', ['was_successful' => $was_successful]);
    }
}
