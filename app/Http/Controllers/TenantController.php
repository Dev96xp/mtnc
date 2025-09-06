<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;


class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('central.tenants.index', [
            'tenants' => Tenant::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('central.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all(); solo para pruebas

        $request->validate([
            'id' => 'required',
        ]);

        $tenant = Tenant::create($request->all());

        // PARA PRODUCCION
        $tenant->domains()->create([
            'domain' => $request->get('id') . '.' . 'nucleus-industries.com',
        ]);

        // PARA LOCAL
        /*
        $tenant->domains()->create([
            'domain' => $request->get('id') . '.' . 'mtnc.test',
        ]);
        */

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        return view('central.tenants.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        return view('central.tenants.edit', [
            'tenant' => $tenant
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'id' => 'required|unique:tenants,id,' . $tenant->id,
        ]);

        $tenant->update([
            'id' => $request->get('id'),
        ]);

        // PARA PRODUCCION
        $tenant->domains()->update([
            'domain' => $request->get('id') . '.' . 'nucleus-industries.com',
        ]);

        // PARA LOCAL
        /*
        $tenant->domains()->update([
            'domain' => $request->get('id') . '.' . 'mtnc.test',
        ]);
        */

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect()->route('tenants.index');
    }
}
