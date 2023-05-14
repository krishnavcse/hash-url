<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * method for user index page
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $loggedInUserId = Auth::user()->id;
        $data  = User::withCount('urlDetail')
            ->get(['id', 'name', 'email', 'url_click_limit']);

        $userCount = User::count();
        
        return view('users.index',compact('data', 'loggedInUserId', 'userCount'));
    }

    /**
     * method to update user details
     * @param Request $request
     * @return redirect
     */
    public function update(Request $request)
    {
        User::where('id',$request->id)->update($request->except('_token'));

        return redirect('users')->with('insert', trans('lang.user_data_updated_successfully'));
    }

    /** 
     * method to delete user details
     * @param User $userId
     * @return response
     */
    public function delete(User $userId)
    {
        $userId->delete();

        return response()->json(['message' => trans('lang.user_data_deleted_successfully')]);
    }

}
