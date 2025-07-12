<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    protected $hostnameRepository;
    protected $websiteRepository;

    public function __construct(HostnameRepository $hostnameRepository, WebsiteRepository $websiteRepository)
    {
        $this->hostnameRepository = $hostnameRepository;
        $this->websiteRepository = $websiteRepository;
    }

    /**
     * Display a listing of the tenants.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tenants = Website::with('hostnames')->get();
        
        return response()->json([
            'tenants' => $tenants
        ]);
    }

    /**
     * Store a newly created tenant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'subdomain' => 'required|string|unique:hostnames,fqdn|max:63',
            'name' => 'required|string|max:255',
        ]);

        $website = new Website();
        $website->uuid = (string) \Ramsey\Uuid\Uuid::uuid4();
        $website = $this->websiteRepository->create($website);

        $hostname = new Hostname();
        $hostname->fqdn = $request->subdomain . '.' . config('app.domain', 'localhost');
        $hostname = $this->hostnameRepository->create($hostname);
        
        $this->hostnameRepository->attach($hostname, $website);

        return response()->json([
            'message' => 'Tenant created successfully',
            'tenant' => $website->load('hostnames')
        ], 201);
    }

    /**
     * Display the specified tenant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tenant = Website::with('hostnames')->findOrFail($id);
        
        return response()->json([
            'tenant' => $tenant
        ]);
    }

    /**
     * Update the specified tenant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $tenant = Website::findOrFail($id);
        $tenant->update($request->only(['name']));

        return response()->json([
            'message' => 'Tenant updated successfully',
            'tenant' => $tenant->load('hostnames')
        ]);
    }

    /**
     * Remove the specified tenant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tenant = Website::findOrFail($id);
        
        // Delete associated hostnames
        foreach ($tenant->hostnames as $hostname) {
            $this->hostnameRepository->delete($hostname);
        }
        
        $this->websiteRepository->delete($tenant);

        return response()->json([
            'message' => 'Tenant deleted successfully'
        ]);
    }

    /**
     * Switch to a specific tenant context.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function switch(Request $request, $id)
    {
        $tenant = Website::findOrFail($id);
        
        // Logic to switch tenant context
        // This would typically involve setting session variables
        // or updating user's current tenant preference
        
        return response()->json([
            'message' => 'Switched to tenant successfully',
            'tenant' => $tenant->load('hostnames')
        ]);
    }
}