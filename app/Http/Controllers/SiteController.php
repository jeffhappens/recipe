<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class SiteController extends Controller
{
    
    public function index() {

    	$recipes = Recipe::with('owner')
    	->with('ingredients')
    	->with('instructions')
    	->with('media')
    	->with('tags')
        ->where('active', 1)
    	->orderBy('created_at','desc')
    	->get();

    	return view('home.index', compact('recipes'));

    }



    public function refer(Request $request) {
        $sender = $request->get('sender');
        $recipient = $request->get('recipient');

        $u = \App\User::find($sender);

        // New up the invitation
        $user = new \App\Invitation;
        $user->email = $recipient;
        $user->token = str_random(48);
        $user->save();

        // Get sender data
        $data = [
            'first_name' => $u->first_name,
            'last_name' => $u->last_name,
            'email' => $recipient,
            'invite_token' => $user->token,
            'inviter' => $u->display_name
        ];


        \Mail::send('emails.invite', $data, function($message) use ($data) {
            $message->to($data['email'], $data['first_name'].' '.$data['last_name'])->subject('Welcome!');
        });




        return response()->json(['status' => 1]);


    }
    


    public function postRefer($email, $token) {
        $user = \App\Invitation::where([
            'email' => $email,
            'token' => $token
        ])->get();
        $data = [
            'user' => $user
        ];
        if(count($user)) {
            return view('invitations.setup', $data);
        }
        else {
            return view('invitations.invalid');
        }
    }
    public function postReferComplete($email, $token, Request $request) {
        $user = new \App\User;
        $user->username = $request->get('username');
        $user->password = \Hash::make($request->get('password'));
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->display_name = $request->get('first_name').' '.$request->get('last_name');
        $user->role = 'user';
        $user->save();
        $invitation = \App\Invitation::where('email', $email)->delete();
        $request->session()->flash('newuser','Thanks for signing up '.$user->first_name.'!');
        return redirect('/login');





    }





}
