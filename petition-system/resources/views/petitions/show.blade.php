@extends('layouts.app')

@section('title', $petition->title)

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">

        {{-- Section Detail Petisi --}}
        <h1 class="text-3xl font-extrabold text-dark-navy mb-4">
            {{ $petition->title }}
        </h1>

        <p class="text-gray-800 text-lg leading-relaxed mb-6">
            {{ $petition->description }}
        </p>

        @if ($petition->target)
            <p class="text-gray-700 mb-4">
                🎯 <strong>Target Decision Maker:</strong> 
                {{ $petition->target }}
            </p>
        @endif

        {{-- Menampilkan Jumlah Tanda Tangan --}}
        <p class="text-gray-700 mb-6">
            ✍️ <strong>Signatures:</strong> {{ $petition->signatures->count() }}
        </p>

        <div class="flex flex-col gap-4 mt-6">

            <a href="{{ route('petitions.index') }}" 
               class="px-5 py-2 bg-gray-200 text-dark-navy font-semibold rounded-lg hover:bg-gray-300 transition w-max">
                ← Back to Explore
            </a>

            {{-- Tombol edit/delete hanya untuk pemilik --}}
            @auth
                @if ($petition->user_id == auth()->id())
                    <div class="flex gap-2">
                        <a href="{{ route('petitions.edit', $petition->id) }}" 
                           class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Edit
                        </a>

                        <form action="{{ route('petitions.destroy', $petition->id) }}" 
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this petition?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

        </div>

        {{-- TAMPILKAN PESAN SUKSES / ERROR (Penting) --}}
        @if (session('success'))
            <div class="mt-6 p-4 bg-green-100 text-green-700 rounded-lg border border-green-300" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mt-6 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300" role="alert">
                {{ session('error') }}
            </div>
        @endif


        {{-- BAGIAN FORM TANDA TANGAN (DAPAT DIAKSES PUBLIK) --}}
        <div class="mt-12 p-6 bg-gray-50 rounded-lg border border-gray-200">
            <h3 class="text-2xl font-bold text-dark-navy mb-4">Sign This Petition</h3>
            
            <form action="{{ route('petition.sign', $petition->id) }}" method="POST" class="flex flex-col gap-4">
                @csrf
                
                {{-- Field Name --}}
                <<div>
            <input type="text" name="name" placeholder="Your Name" required
                   class="border rounded px-4 py-3 w-full ..."
                   value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}"
                   
                   {{ Auth::check() ? 'disabled' : '' }}> 
            ...
        </div>

                {{-- Field Email --}}
                <div>
            <input type="email" name="email" placeholder="Your Email (Used only for validation)" required
                   class="border rounded px-4 py-3 w-full ..."
                   value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                   {{ Auth::check() ? 'disabled' : '' }}>
            ...
        </div>

                {{-- Field Comment (Ditambahkan) --}}
                <div>
                    <textarea name="comment" placeholder="Your comment (Optional)" rows="3"
                              class="border rounded px-4 py-3 w-full focus:ring-blue-500 focus:border-blue-500 @error('comment') border-red-500 @enderror">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                         class="mt-2 px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition w-full sm:w-max">
                    Sign the petition now!h
                </button>
            </form>
        </div>


        {{-- DAFTAR TANDA TANGAN (Opsional: untuk transparansi) --}}
        @if ($petition->signatures->count() > 0)
            <div class="mt-12">
                <h3 class="text-2xl font-bold text-dark-navy mb-4">Recent Signatures ({{ $petition->signatures->count() }})</h3>
                <ul class="space-y-3">
                    @foreach ($petition->signatures as $signature)
                        <li class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                            <p class="font-semibold text-lg">{{ $signature->name }}</p>
                            @if ($signature->comment)
                                <blockquote class="text-gray-700 italic border-l-4 border-blue-400 pl-3 mt-1">
                                    "{{ $signature->comment }}"
                                </blockquote>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Signed on {{ $signature->created_at->format('M d, Y') }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div> {{-- End bg-white --}}

</div>
@endsection