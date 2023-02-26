<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Link;
use App\Models\Visit;

class LinkController extends Controller
{
    /**
     * Display a list of the logged-in user's links
     */
    public function index(Request $request) : View
    {
        $user = User::withCount('links')->find($request->user())->first();

        return view('link.list', [
            'links' => $user->links,
            'count' => $user->links_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shortcode' => 'required|alpha_num|max:30|min:5|unique:links',
            'url' => 'required|url',
        ]);

        $link = new Link;
        $link->url = $request->url;
        $link->shortcode = $request->shortcode;
        $link->user_id = Auth::user()->id;
        $link->save();

        return Redirect::route('link.list')->with('status', 'link-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $shortcode)
    {
        $link = Link::where('shortcode', $shortcode)->first();

        if($link == null) {
            return Redirect::route('link.missing');
        }

        $ip_validator = Validator::make(['ip' => $request->ip()], [
            'ip' => 'required|ipv4',
        ]);

        if(!$ip_validator->fails()) {
            $visit = new Visit;
            $visit->link_id = $link->id;
            $visit->ip = $request->ip();
            $visit->save();
        } else {
        }

        return Redirect::away($link->url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $shortcode)
    {
        $link = Link::where('shortcode', $shortcode)->first();

        if($link == null) {
            return Redirect::route('link.list')->with('status', 'no-such-link');
        }

        if($link->user->id != Auth::user()->id) {
            return Redirect::route('link.list')->with('status', 'not-authorized');
        }

        return view('link.edit', [
            'link' => $link,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $shortcode)
    {
        $link = Link::where('shortcode', $shortcode)->first();

        if($link == null) {
            return Redirect::route('link.list')->with('status', 'no-such-link');
        }

        if($link->user->id != Auth::user()->id) {
            return Redirect::route('link.list')->with('status', 'not-authorized');
        }

        $vaildated = $request->validate([
            'url' => 'required|url',
        ]);

        $link->url = $request->url;
        $link->save();


        return Redirect::route('link.edit', ['shortcode' => $shortcode])->with('status', 'link-updated');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function delete(string $shortcode)
    {
        $link = Link::where('shortcode', $shortcode)->first();

        if($link == null) {
            return Redirect::route('link.list')->with('status', 'no-such-link');
        }

        if($link->user->id != Auth::user()->id) {
            return Redirect::route('link.list')->with('status', 'not-authorized');
        }

        return view('link.delete', [
            'link' => $link,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $shortcode)
    {
        $link = Link::where('shortcode', $shortcode)->first();

        if($link == null) {
            return Redirect::route('link.list')->with('status', 'no-such-link');
        }

        if($link->user->id != Auth::user()->id) {
            return Redirect::route('link.list')->with('status', 'not-authorized');
        }

        $link->delete();

        return Redirect::route('link.list')->with('status', 'link-deleted');
    }
}
