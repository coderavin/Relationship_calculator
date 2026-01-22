@extends('layouts.app')

@section('title', 'Calculation Result')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('home') }}" class="text-white hover:text-pink-200">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    <div class="card-glass rounded-3xl shadow-2xl overflow-hidden">
        <div class="p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="text-4xl mb-4">{{ $calculation->icon }}</div>
                <h2 class="text-3xl font-bold text-gray-800">{{ $calculation->type_label }}</h2>
                <p class="text-gray-600">{{ $calculation->member1_name }} & {{ $calculation->member2_name }}</p>
            </div>

            <!-- Percentage -->
            <div class="text-center mb-10">
                <div class="text-6xl font-bold text-pink-600 mb-4">
                    {{ $calculation->percentage }}%
                </div>
                <div class="inline-block px-6 py-2 bg-{{ $calculation->level_color }}-100 text-{{ $calculation->level_color }}-800 rounded-full">
                    {{ $calculation->level }} Compatibility
                </div>
            </div>

            <!-- Description -->
            <div class="text-center mb-10">
                <div class="inline-block p-6 bg-gray-50 rounded-2xl max-w-2xl">
                    <p class="text-xl text-gray-700">{{ $calculation->description }}</p>
                </div>
            </div>

            <!-- Compatibility Points -->
            <div class="mb-10">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Compatibility Analysis</h3>
                <div class="space-y-4">
                    @if(is_array($calculation->compatibility_points))
                        @foreach($calculation->compatibility_points as $point => $score)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-700">{{ $point }}</span>
                                <span class="font-bold">{{ $score }}%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-pink-500 to-purple-500" style="width: {{ $score }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Improvement Tips -->
            @if(is_array($calculation->improvement_tips) && count($calculation->improvement_tips) > 0)
            <div class="mb-10">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">
                    @if($calculation->calculation_type == 'antagonist' && $calculation->percentage > 70)
                    Tips to Reduce Conflict
                    @else
                    Improvement Tips
                    @endif
                </h3>
                <div class="bg-gradient-to-r from-green-50 to-blue-50 p-6 rounded-2xl">
                    <div class="space-y-4">
                        @foreach($calculation->improvement_tips as $tip)
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <p class="text-gray-700">{{ $tip }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Certificate Generation -->
            <div class="text-center p-8 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Get Your Certificate</h3>
                <p class="text-gray-600 mb-6">Save this result with a beautiful certificate</p>

                <form action="{{ route('generate.certificate', $calculation->unique_id) }}" method="POST">
                    @csrf
                    <div class="max-w-md mx-auto mb-6">
                        <select name="template" class="w-full px-4 py-3 rounded-lg border">
                            <option value="elegant">Elegant Design</option>
                            <option value="modern">Modern Style</option>
                            <option value="romantic">Romantic Theme</option>
                        </select>
                    </div>
                    <button type="submit" class="px-8 py-4 bg-pink-500 text-white font-bold rounded-xl hover:bg-pink-600">
                        <i class="fas fa-certificate mr-2"></i> Generate Certificate
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
