<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UrlDetail;
use Illuminate\Http\Request;

class HashedUrlController extends Controller
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
     * method for url index page
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $loggedInUser = Auth::user();
        $data = UrlDetail::get(['id', 'url', 'hashed_url', 'is_active', 'url_click_count'])->transform(function($item) {
            $item->tiny_url = url('url' . DIRECTORY_SEPARATOR . $item->hashed_url);

            return $item;
        });
        
        return view('hashed-url.index',compact('data'));
    }

    /**
     * method to create or update url entry
     * @param Request $request
     * @return redirect
     */
    public function createOrUpdateUrl(Request $request)
    {
        $data = $request->except('_token');
        $data['hashed_url'] = sha1($request->url);
        $data['user_id']   = Auth::user()->id;
        $request->validate([
            'url'       => 'required|url|unique:url_details,url',
            'is_active' => 'required|in:1,0'
        ]);

        UrlDetail::updateOrCreate(['id' => $request->id], $data);

        return redirect('hashed-urls')->with('insert', trans('lang.url_data_saved_successfully'));
    }

    /**
     * method to delete url
     * @param UrlDetail $urlId
     * @return response
     */
    public function delete(UrlDetail $urlId)
    {
        $urlId->delete();

        return response()->json(['message' => trans('lang.url_data_deleted_successfully')]);
    }

    /**
     * method for url create page
     * @return view
     */
    public function create()
    {
        return view('hashed-url.create');
    }

    /**
     * method for redirect url based on hash url, it can redirect only active url
     * @param string $hashedUrl
     * @return redirect
     */
    public function redirectUrl(string $hashedUrl)
    {
        $urlData = UrlDetail::where([['is_active', true], ['hashed_url', $hashedUrl]])->first();
        if ($urlData) {
            $updateArray['url_click_count'] = ++$urlData->url_click_count;

            if($updateArray['url_click_count'] == Auth::user()->url_click_limit) {
                $updateArray['is_active'] = false;
            }

            if($updateArray['url_click_count'] > Auth::user()->url_click_limit) {
                $updateArray['is_active'] = false;

                return redirect('page-not-found');
            }

            UrlDetail::whereId($urlData->id)
                ->update($updateArray);

            return redirect($urlData->url);
        } else {
            return redirect('page-not-found');
        }
    }
}
