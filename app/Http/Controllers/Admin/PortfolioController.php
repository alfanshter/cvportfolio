<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('sort_order')->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.form', ['portfolio' => new Portfolio()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePortfolio($request);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');
        $validated['slug']        = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->storeImage(
                $request->file('thumbnail'), 'portfolios', 1280, 80
            );
        }

        // Handle multiple images
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $this->storeImage($image, 'portfolios/gallery', 1920, 75);
            }
        }
        $validated['images'] = count($images) ? $images : null;

        Portfolio::create($validated);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio ditambahkan!');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.form', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $this->validatePortfolio($request);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($portfolio->thumbnail) Storage::disk('public')->delete($portfolio->thumbnail);
            $validated['thumbnail'] = $this->storeImage(
                $request->file('thumbnail'), 'portfolios', 1280, 80
            );
        }

        // Handle delete existing images
        $existingImages = $portfolio->images ?? [];
        $toDelete = $request->input('delete_images', []);
        if (!empty($toDelete)) {
            foreach ($toDelete as $path) {
                Storage::disk('public')->delete($path);
            }
            $existingImages = array_values(array_diff($existingImages, $toDelete));
        }

        // Handle new images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $existingImages[] = $this->storeImage($image, 'portfolios/gallery', 1920, 75);
            }
        }
        $validated['images'] = count($existingImages) ? array_values($existingImages) : null;

        $portfolio->update($validated);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->thumbnail) Storage::disk('public')->delete($portfolio->thumbnail);
        if ($portfolio->images) {
            foreach ($portfolio->images as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $portfolio->delete();
        return back()->with('success', 'Portfolio dihapus!');
    }

    /**
     * Compress, resize (max width), dan simpan gambar ke storage.
     * Selalu output sebagai JPEG untuk ukuran lebih kecil.
     */
    private function storeImage(UploadedFile $file, string $folder, int $maxWidth = 1280, int $quality = 80): string
    {
        $manager  = new ImageManager(new Driver());
        $image    = $manager->read($file->getRealPath());

        // Resize hanya jika lebih lebar dari maxWidth (pertahankan rasio)
        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        $filename = $folder . '/' . Str::uuid() . '.jpg';
        $fullPath = Storage::disk('public')->path($filename);

        // Pastikan direktori ada
        Storage::disk('public')->makeDirectory($folder);

        // Encode ke JPEG dengan kualitas tertentu lalu simpan
        $image->toJpeg($quality)->save($fullPath);

        return $filename;
    }

    private function validatePortfolio(Request $request): array
    {
        return $request->validate([
            'title'             => 'required|string|max:150',
            'short_description' => 'required|string|max:300',
            'description'       => 'nullable|string',
            'category'          => 'required|string|max:80',
            'technologies'      => 'nullable|string|max:300',
            'demo_url'          => 'nullable|url|max:200',
            'github_url'        => 'nullable|url|max:200',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'sort_order'        => 'required|integer|min:0',
            'completed_at'      => 'nullable|date',
            'thumbnail'         => 'nullable|image|max:10240',  // 10MB — di-compress server-side
            'images.*'          => 'nullable|image|max:10240',  // 10MB per gambar
            'delete_images'     => 'nullable|array',
        ]);
    }
}
