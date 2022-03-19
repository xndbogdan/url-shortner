<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Models\SlugUrl;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    
    public function store(StoreUrlRequest $request)
    {
        $url = Auth::user()->urls()->create([
            'destination' => $request->input('destination'),
            'slug' => Str::random(5),
        ]);
        
        return redirect()->back();
    }

    public function storeApi(StoreUrlRequest $request)
    {
        $url = Url::create([
            'destination' => $request->input('destination'),
            'slug' => Str::random(5),
        ]);
        
        return response()->json($url);
    }

    public function show(Request $request, Url $url)
    {
        // if (! Gate::allows('show-url', $url)) {
        //     abort(403);
        // }

        return view('url.show', [
            'url' => $url,
        ]);
    }

    public function edit(Request $request, Url $url) {
        if (! Gate::allows('edit-url', $url)) {
            abort(403);
        }

        return view('url.edit', [
            'url' => $url,
        ]);
    }

    public function update(StoreUrlRequest $request, Url $url) {
        if (! Gate::allows('edit-url', $url)) {
            abort(403);
        }

        $url->update([
            'destination' => $request->input('destination'),
        ]);

        return redirect()->back();
    }

    public function destroy(Url $url)
    {
        if (! Gate::allows('delete-url', $url)) {
            abort(403);
        }
        $url->delete();

        return redirect()->back();
    }
}
