<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function invite() {
    	if(\Auth::user()->sharecount < 1) {
    		\Session::flash('error', 'You have to share a recipe with the community before you can invite a friend.');
    		return \Redirect::back();
    	}
   		return view('user.invite');
    }



    public function post_invite(Request $request) {
        $sender = \Auth::user()->display_name;
        $recipient = $request->get('inviteEmail');


        if($recipient === \Auth::user()->email) {
            \Session::flash('error','You cannot invite yourself.');
            return redirect('/user/invite');
        }

        // New up the invitation
        $user = \App\Invitation::firstOrcreate(
            ['email' => $recipient],
            ['token' => str_random(48)]
        );

        // Get sender data
        $data = [
            'email' => $recipient,
            'invite_token' => $user->token,
            'inviter' => $sender
        ];

        \Mail::send('emails.invite', $data, function($message) use ($data) {
            $message->to($data['email'], $data['inviter'])->subject('Welcome!');
        });


    	\Session::flash('success','Awesome! We just sent an email to '.$data['email'].' inviting them to join the site');
        return redirect('/user/invite');
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
            $data = [
                'message' => 'This invitation is invalid or has expired.'
            ];
            return view('invitations.invalid', $data);
        }
    }



    public function postReferComplete($email, $token, Request $request) {

        $user = new \App\User;
        $user->email = $request->get('username');
        $user->password = \Hash::make($request->get('password'));
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->display_name = $request->get('first_name').' '.$request->get('last_name');
        $user->role = 'user';
        $user->save();

        $invitation = \App\Invitation::where('email', $email)->delete();

        $request->session()->flash('success','Thanks for signing up '.$user->first_name.'!');

        return redirect('/login');
    }






}
