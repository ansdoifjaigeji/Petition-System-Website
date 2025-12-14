@extends('layouts.app')

@section('title', 'Edit Petition')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-extrabold text-dark-navy mb-6">
        Edit Petition
    </h1>

    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">

        <form action="{{ route('petitions.update', $petition->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <label class="font-semibold text-dark-navy">Title</label>
            <input type="text" 
                   name="title" 
                   class="w-full p-3 border rounded-lg mt-1 mb-4"
                   value="{{ old('title', $petition->title) }}"
                   required>

            {{-- Description --}}
            <label class="font-semibold text-dark-navy">Description</label>
            <textarea name="description"
                      class="w-full p-3 border rounded-lg mt-1 mb-4"
                      rows="6"
                      required>{{ old('description', $petition->description) }}</textarea>

            {{-- Target --}}
            <label class="font-semibold text-dark-navy">Target Decision Maker</label>
            <input type="text" 
                   name="target" 
                   class="w-full p-3 border rounded-lg mt-1 mb-4"
                   value="{{ old('target', $petition->target) }}">

            <div class="flex gap-4 mt-6">
                <button type="submit" 
                        class="px-6 py-2 bg-primary-orange text-white font-semibold rounded-lg hover:bg-orange-600 transition">
                    Save Changes
                </button>

                <a href="{{ route('petitions.index') }}" 
                   class="px-6 py-2 bg-gray-200 text-dark-navy rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>
@endsection
