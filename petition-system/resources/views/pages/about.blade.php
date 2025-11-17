@extends('layouts.app')

@section('title', 'Voice for Change - About Us')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold text-dark-navy mb-6 border-b pb-4 text-center">Our Mission: Amplifying Your Voice</h1>
    
    <div class="bg-white p-8 rounded-xl shadow-lg space-y-6">
        <p class="text-gray-700 leading-relaxed">
            **Voice for Change** was founded on the principle that every citizen deserves a platform to initiate, support, and champion the causes they believe in. We provide the tools and reach necessary to transform local concerns and global issues into tangible movements for change.
        </p>
        <h2 class="text-2xl font-semibold text-primary-orange pt-4">How It Works</h2>
        <ul class="list-disc list-inside text-gray-700 ml-4 space-y-2">
            <li><b>Create:</b> Start a petition in minutes, defining your cause and target audience.</li>
            <li><b>Share:</b> Utilize our built-in sharing tools to reach your community quickly.</li>
            <li><b>Impact:</b> Collect signatures and present your cause to the relevant decision-makers.</li>
        </ul>
        <p class="text-center pt-6 text-lg font-medium">Join us in making a difference, one signature at a time.</p>
    </div>
</div>
@endsection