<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view( 'home' );
    }

    /**
     * @return mixed
     */
    public function shoutHome() {
        $userID = Auth::id();
        $status = Status::where( 'user_id', $userID )->orderBy( 'id', 'desc' )->get();
        $avatar = empty( Auth::user()->avatar ) ? asset( "images/avatar.jpg" ) : Auth::user()->avatar;

        return view( 'shouthome', ['status' => $status, 'avatar' => $avatar] );
    }
    /**
     * @return mixed
     */
    public function publicTimeline( $nickname ) {
        $user = User::where( 'nickname', $nickname )->first();

        if ( $user ) {
            $status        = Status::where( 'user_id', $user->id )->orderBy( 'id', 'desc' )->get();
            $avatar        = empty( $user->avatar ) ? asset( "images/avatar.jpg" ) : $user->avatar;
            $name          = $user->name;
            $displayAction = false;

            if ( Auth::check() ) {
                if ( Auth::user()->id != $user->id ) {
                    $displayAction = true;
                }
            }

            return view( 'shoutpublic', [
                'status'        => $status,
                'avatar'        => $avatar,
                'name'          => $name,
                'displayAction' => $displayAction,
                'friendID'      => $user->id,
            ] );
        } else {
            return redirect( '/' );
        }
    }

    /**
     * @param Request $request
     */
    public function saveStatus( Request $request ) {
        if ( Auth::check() ) {
            $status = $request->post( 'status' );
            $userID = Auth::id();

            $statusModel          = new Status();
            $statusModel->status  = $status;
            $statusModel->user_id = $userID;
            $statusModel->save();
            return redirect()->route( 'shout' );
        }
    }

    public function profile() {
        return view( 'profile' );
    }
    public function profileEdit() {
        return view( 'profileedit' );
    }
    public function saveProfile( Request $request ) {
        $user           = Auth::user();
        $user->name     = $request->post( 'name' );
        $user->email    = $request->post( 'email' );
        $user->nickname = $request->post( 'nickname' );

        if ( $request->hasFile( 'image' ) ) {

            $profileImage = 'user-' . $user->id . '.' . $request->image->extension();
            $request->image->move( public_path( 'images' ), $profileImage );

            $user->avatar = asset( "images/{$profileImage}" );
        }
        $user->save();

        return redirect()->route( 'shout.profile' );
    }

    public function addFriend( $friendID ) {
        $userID = Auth::user()->id;
        if ( Friend::where( 'user_id', $userID )->where( 'friend_id', $friendID )->count() == 0 ) {
            $friendship            = new Friend();
            $friendship->user_id   = $userID;
            $friendship->friend_id = $friendID;
            $friendship->save();
        }
        if ( Friend::where( 'friend_id', $userID )->where( 'user_id', $friendID )->count() == 0 ) {
            $friendship            = new Friend();
            $friendship->friend_id = $userID;
            $friendship->user_id   = $friendID;
            $friendship->save();
        }

        return redirect()->route( 'shout' );
    }
    public function unfriend( $friendID ) {
        $userID = Auth::user()->id;
        Friend::where( 'user_id', $userID )->where( 'friend_id', $friendID )->delete();
        Friend::where( 'friend_id', $userID )->where( 'user_id', $friendID )->delete();
    

        return redirect()->route( 'shout' );
    }

   
}
