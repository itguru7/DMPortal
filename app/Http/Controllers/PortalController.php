<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Portal;
use App\Http\Requests\PortalFormRequest;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portals = Portal::all();
        return view('portals.index', compact('portals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = DB::table('portals')->select('subdomain_id')->get();
        $subdomain_ids = json_decode(json_encode($result), true);
        $result = DB::table('subdomains')->select('SubdomainID', 'Vendor')->whereNotIn('SubdomainID', $subdomain_ids)->get();
        $subdomains = json_decode(json_encode($result), true);
        return view('portals.create', compact('subdomains'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortalFormRequest $request)
    {
        try {
            $data = $request->getData();
            $portal = Portal::create($data);

            if ($request->hasFile('logo_file')) {
                $request->file('logo_file')->move(base_path() . '/public' . $portal->asset, $portal->logo);
            }
            if ($request->hasFile('background_file')) {
                $request->file('background_file')->move(base_path() . '/public' . $portal->asset, $portal->background);
            }

            return redirect()->route('portals.index')
                ->with('success_message', 'Portal was successfully added.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portal  $portal
     * @return \Illuminate\Http\Response
     */
    public function show(Portal $portal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portal  $portal
     * @return \Illuminate\Http\Response
     */
    public function edit(Portal $portal)
    {
        $result = DB::table('portals')->select('subdomain_id')->where('subdomain_id', '!=', $portal->subdomain_id)->get();
        $subdomain_ids = json_decode(json_encode($result), true);
        $result = DB::table('subdomains')->select('SubdomainID', 'Vendor')->whereNotIn('SubdomainID', $subdomain_ids)->get();
        $subdomains = json_decode(json_encode($result), true);
        return view('portals.edit', compact('portal', 'subdomains'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portal  $portal
     * @return \Illuminate\Http\Response
     */
    public function update(PortalFormRequest $request, Portal $portal)
    {
        try {
            $data = $request->getData();
            $portal->update($data);

            if ($request->hasFile('logo_file')) {
                $request->file('logo_file')->move(base_path() . '/public' . $portal->asset, $portal->logo);
            }
            if ($request->hasFile('background_file')) {
                $request->file('background_file')->move(base_path() . '/public' . $portal->asset, $portal->background);
            }

            return redirect()->route('portals.index')
                ->with('success_message', 'Portal was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portal  $portal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portal $portal)
    {
        //
    }
}
