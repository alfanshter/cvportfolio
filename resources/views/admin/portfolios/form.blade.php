@extends('layouts.admin')
@section('title', isset($portfolio->id) ? 'Edit Portfolio' : 'Tambah Portfolio')

@section('admin-content')
<div class="max-w-2xl">
    <form action="{{ isset($portfolio->id) ? route('admin.portfolios.update', $portfolio) : route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="portfolio-form">
        @csrf
        @if(isset($portfolio->id)) @method('PUT') @endif

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-5">
            <div>
                <label class="form-label">Judul Proyek *</label>
                <input type="text" name="title" value="{{ old('title', $portfolio->title) }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Deskripsi Singkat *</label>
                <input type="text" name="short_description" value="{{ old('short_description', $portfolio->short_description) }}" class="form-input" maxlength="300" required>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Kategori *</label>
                    <input type="text" name="category" value="{{ old('category', $portfolio->category) }}" class="form-input" placeholder="Web Application / API / Website" required>
                </div>
                <div>
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="completed_at" value="{{ old('completed_at', $portfolio->completed_at?->format('Y-m-d')) }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">URL Demo</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url', $portfolio->demo_url) }}" class="form-input" placeholder="https://...">
                </div>
                <div>
                    <label class="form-label">URL GitHub</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $portfolio->github_url) }}" class="form-input" placeholder="https://github.com/...">
                </div>
                <div>
                    <label class="form-label">Urutan Tampil *</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $portfolio->sort_order ?? 0) }}" min="0" class="form-input" required>
                </div>
            </div>

            <div>
                <label class="form-label">Teknologi (pisahkan koma)</label>
                <input type="text" name="technologies" value="{{ old('technologies', $portfolio->technologies) }}" class="form-input" placeholder="Laravel, Vue.js, MySQL, ...">
            </div>

            <div>
                <label class="form-label">Deskripsi Lengkap (HTML)</label>
                <textarea name="description" rows="8" class="form-input font-mono text-sm resize-none">{{ old('description', $portfolio->description) }}</textarea>
            </div>

            {{-- ── THUMBNAIL ── --}}
            <div>
                <label class="form-label">Thumbnail Utama (max 2MB)</label>
                @if(isset($portfolio->id) && $portfolio->thumbnail)
                <div class="mb-3">
                    <img src="{{ Storage::url($portfolio->thumbnail) }}" class="h-24 rounded-lg object-cover border border-gray-700">
                    <p class="text-xs text-gray-600 mt-1">Upload baru untuk mengganti.</p>
                </div>
                @endif
                <input type="file" name="thumbnail" accept="image/*" class="form-input text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white file:text-xs cursor-pointer">
            </div>

            {{-- ── GALLERY IMAGES ── --}}
            <div>
                <label class="form-label">Galeri Gambar (boleh banyak, maks 2MB/gambar)</label>

                {{-- Existing images --}}
                @if(isset($portfolio->id) && !empty($portfolio->images))
                <div class="mb-4">
                    <p class="text-xs text-gray-500 mb-2">Gambar yang sudah ada — centang untuk <span class="text-red-400 font-semibold">hapus</span>:</p>
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-3" id="existing-images-grid">
                        @foreach($portfolio->images as $img)
                        <div class="relative group rounded-xl overflow-hidden border border-gray-700 aspect-video bg-gray-800">
                            <img src="{{ Storage::url($img) }}" class="w-full h-full object-cover">
                            {{-- Delete checkbox overlay --}}
                            <label class="absolute inset-0 flex flex-col items-center justify-center bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer gap-1">
                                <input type="checkbox" name="delete_images[]" value="{{ $img }}"
                                    class="w-5 h-5 accent-red-500 cursor-pointer"
                                    onchange="toggleDeleteOverlay(this)">
                                <span class="text-xs text-white font-semibold">Hapus</span>
                            </label>
                            {{-- Red overlay when checked --}}
                            <div class="delete-overlay absolute inset-0 bg-red-500/30 border-2 border-red-500 rounded-xl pointer-events-none hidden"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Upload new images --}}
                <div class="border-2 border-dashed border-gray-700 hover:border-indigo-500/60 rounded-xl p-5 transition-colors" id="drop-zone">
                    <input type="file" name="images[]" id="gallery-input" accept="image/*" multiple
                        class="hidden" onchange="previewImages(this)">
                    <label for="gallery-input" class="flex flex-col items-center gap-3 cursor-pointer">
                        <div class="w-12 h-12 rounded-xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center">
                            <i class="fas fa-cloud-upload-alt text-indigo-400 text-xl"></i>
                        </div>
                        <div class="text-center">
                            <p class="text-sm font-medium text-gray-300">Klik atau drag & drop gambar di sini</p>
                            <p class="text-xs text-gray-600 mt-0.5">PNG, JPG, WEBP — boleh pilih banyak sekaligus</p>
                        </div>
                    </label>
                </div>

                {{-- Preview gambar baru yang dipilih --}}
                <div id="new-images-preview" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-3" style="display:none"></div>
            </div>

            <div class="flex flex-wrap gap-6">
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" class="w-4 h-4 accent-indigo-500"
                        {{ old('is_featured', $portfolio->is_featured ?? false) ? 'checked' : '' }}>
                    <label for="is_featured" class="text-sm text-gray-300 cursor-pointer">⭐ Featured Project</label>
                </div>
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" class="w-4 h-4 accent-indigo-500"
                        {{ old('is_active', $portfolio->is_active ?? true) ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm text-gray-300 cursor-pointer">Tampilkan di website</label>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('admin.portfolios.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>

<style>
    .img-preview-item { position: relative; aspect-ratio: 16/9; border-radius: 0.75rem; overflow: hidden; background: #1e293b; border: 1px solid #334155; }
    .img-preview-item img { width: 100%; height: 100%; object-fit: cover; }
    .img-preview-item .remove-btn { position: absolute; top: 4px; right: 4px; width: 22px; height: 22px; border-radius: 50%; background: #ef4444; color: white; border: none; font-size: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background .15s; }
    .img-preview-item .remove-btn:hover { background: #b91c1c; }
</style>

<script>
    // Preview gambar baru sebelum upload
    let selectedFiles = [];

    function previewImages(input) {
        const preview = document.getElementById('new-images-preview');
        const newFiles = Array.from(input.files);

        newFiles.forEach((file, i) => {
            selectedFiles.push(file);
            const idx = selectedFiles.length - 1;
            const reader = new FileReader();
            reader.onload = (e) => {
                const div = document.createElement('div');
                div.className = 'img-preview-item';
                div.dataset.idx = idx;
                div.innerHTML = `
                    <img src="${e.target.result}" alt="preview">
                    <button type="button" class="remove-btn" onclick="removePreview(${idx})">
                        <i class="fas fa-times"></i>
                    </button>`;
                preview.appendChild(div);
            };
            reader.readAsDataURL(file);
        });

        preview.style.display = 'grid';
        rebuildFileInput();
    }

    function removePreview(idx) {
        selectedFiles[idx] = null;
        const el = document.querySelector(`.img-preview-item[data-idx="${idx}"]`);
        if (el) el.remove();
        if (!document.querySelectorAll('.img-preview-item').length) {
            document.getElementById('new-images-preview').style.display = 'none';
        }
        rebuildFileInput();
    }

    function rebuildFileInput() {
        // Rebuild DataTransfer with remaining files
        const dt = new DataTransfer();
        selectedFiles.filter(Boolean).forEach(f => dt.items.add(f));
        document.getElementById('gallery-input').files = dt.files;
    }

    // Toggle delete overlay on existing images
    function toggleDeleteOverlay(checkbox) {
        const card = checkbox.closest('.relative.group');
        const overlay = card.querySelector('.delete-overlay');
        if (checkbox.checked) {
            overlay.classList.remove('hidden');
        } else {
            overlay.classList.add('hidden');
        }
    }

    // Drag & drop support
    const dropZone = document.getElementById('drop-zone');
    dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('border-indigo-500'); });
    dropZone.addEventListener('dragleave', () => { dropZone.classList.remove('border-indigo-500'); });
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-indigo-500');
        const input = document.getElementById('gallery-input');
        const dt = new DataTransfer();
        selectedFiles.filter(Boolean).forEach(f => dt.items.add(f));
        Array.from(e.dataTransfer.files).forEach(f => { if (f.type.startsWith('image/')) dt.items.add(f); });
        input.files = dt.files;
        previewImages(input);
    });
</script>
@endsection
