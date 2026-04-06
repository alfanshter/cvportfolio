<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('sort_order')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.form', ['certificate' => new Certificate()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateCert($request);
        $validated['is_active'] = $request->boolean('is_active');
        Certificate::create($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat ditambahkan!');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.form', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $this->validateCert($request);
        $validated['is_active'] = $request->boolean('is_active');
        $certificate->update($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat diperbarui!');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return back()->with('success', 'Sertifikat dihapus!');
    }

    private function validateCert(Request $request): array
    {
        return $request->validate([
            'title'          => 'required|string|max:150',
            'issuer'         => 'required|string|max:100',
            'issued_date'    => 'required|date',
            'expiry_date'    => 'nullable|date',
            'credential_id'  => 'nullable|string|max:100',
            'credential_url' => 'nullable|url|max:200',
            'sort_order'     => 'required|integer|min:0',
            'is_active'      => 'boolean',
        ]);
    }
}
