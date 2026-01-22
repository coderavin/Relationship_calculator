@extends('layouts.app')

@section('title', 'Recent Calculations')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('home') }}" class="text-white hover:text-pink-200">
            <i class="fas fa-arrow-left mr-2"></i> Back to Calculator
        </a>
    </div>

    <div class="card-glass rounded-3xl shadow-2xl overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Recent Calculations</h2>

            @if($calculations->count() > 0)
                <div class="space-y-4">
                    @foreach($calculations as $calculation)
                    <a href="{{ route('result', $calculation->unique_id) }}"
                       class="block p-6 bg-white rounded-xl border hover:shadow-lg transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center space-x-3">
                                    <div class="text-2xl">{{ $calculation->icon }}</div>
                                    <div>
                                        <h3 class="font-bold text-gray-800">{{ $calculation->type_label }}</h3>
                                        <p class="text-gray-600">{{ $calculation->member1_name }} & {{ $calculation->member2_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-pink-600">
                                {{ $calculation->percentage }}%
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">No calculations yet. Start by calculating your first relationship!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
