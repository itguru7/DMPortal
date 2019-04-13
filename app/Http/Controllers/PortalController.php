<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use Illuminate\Http\Request;
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
        return view('portals.create');
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

            $logoName = 'logo.' . $request->file('logo_file')->getClientOriginalExtension();
            $portal->logo = base_path() . '/public/assets/' . $portal->vendor . '/' . $logoName;
            $request->file('logo_file')->move($portal->logo);

            $backgroundName = 'background.' . $request->file('background_file')->getClientOriginalExtension();
            $portal->background = base_path() . '/public/assets/' . $portal->vendor . '/' . $backgroundName;
            $request->file('background_file')->move($portal->background);

            $portal->save();

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
        return view('portals.edit', compact('portal'));
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
                $portal->logo = 'logo.' . $request->file('logo_file')->getClientOriginalExtension();
                $request->file('logo_file')->move(base_path() . '/public' . $portal->asset, $portal->logo);
            }

            if ($request->hasFile('background_file')) {
                $portal->background = 'background.' . $request->file('background_file')->getClientOriginalExtension();
                $request->file('background_file')->move(base_path() . '/public' . $portal->asset, $portal->background);
            }

            $portal->save();

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
