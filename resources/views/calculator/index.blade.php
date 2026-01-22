@extends('layouts.app')

@section('title', 'Love Calculator - Find Your Compatibility')

@section('content')
<div class="container mx-auto max-w-4xl">
    <!-- Hero Section -->
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            Love & Relationship Calculator
        </h1>
        <p class="text-gray-600">
            Discover your compatibility with anyone in love, friendship, or relationship
        </p>
    </div>

    <!-- Calculator Form -->
    <div class="glass-card p-6 md:p-8 mb-8">
        <form id="calculator-form" action="{{ route('calculate') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Person 1 -->
                <div>
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-user-circle text-pink-500 mr-2"></i>
                            First Person
                        </h3>

                        <div class="mb-6">
                            <label class="block text-gray-700 mb-2">Name</label>
                            <input type="text" name="member1_name" required
                                class="input-field w-full"
                                placeholder="Enter name">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Gender</label>
                            <div class="grid grid-cols-3 gap-3">
                                <button type="button" onclick="selectGender(this, 'male', 'member1_gender')"
                                    class="gender-btn py-3 rounded-lg text-center">
                                    <i class="fas fa-mars text-blue-500 mb-1 block text-xl"></i>
                                    <span class="text-sm">Male</span>
                                </button>

                                <button type="button" onclick="selectGender(this, 'female', 'member1_gender')"
                                    class="gender-btn py-3 rounded-lg text-center">
                                    <i class="fas fa-venus text-pink-500 mb-1 block text-xl"></i>
                                    <span class="text-sm">Female</span>
                                </button>

                                <button type="button" onclick="selectGender(this, 'other', 'member1_gender')"
                                    class="gender-btn py-3 rounded-lg text-center">
                                    <i class="fas fa-transgender text-purple-500 mb-1 block text-xl"></i>
                                    <span class="text-sm">Other</span>
                                </button>
                            </div>
                            <input type="hidden" name="member1_gender" id="member1_gender" required>
                        </div>
                    </div>
                </div>

                <!-- Person 2 -->
                <div>
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                            Second Person
                        </h3>

                        <div class="mb-6">
                            <label class="block text-gray-700 mb-2">Name</label>
                            <input type="text" name="member2_name" required
                                class="input-field w-full"
                                placeholder="Enter name">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Gender</label>
                            <div class="grid grid-cols-3 gap-3">
                                <button type="button" onclick="selectGender(this, 'male', 'member2_gender')"
                                    class="gender-btn py-3 rounded-lg text-center">
                                    <i class="fas fa-mars text-blue-500 mb-1 block text-xl"></i>
                                    <span class="text-sm">Male</span>
                                </button>

                                <button type="button" onclick="selectGender(this, 'female', 'member2_gender')"
                                    class="gender-btn py-3 rounded-lg text-center">
                                    <i class="fas fa-venus text-pink-500 mb-1 block text-xl"></i>
                                    <span class="text-sm">Female</span>
                                </button>

                                <button type="button" onclick="selectGender(this, 'other', 'member2_gender')"
                                    class="gender-btn py-3 rounded-lg text-center">
                                    <i class="fas fa-transgender text-purple-500 mb-1 block text-xl"></i>
                                    <span class="text-sm">Other</span>
                                </button>
                            </div>
                            <input type="hidden" name="member2_gender" id="member2_gender" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connection Heart -->
            <div class="my-8 text-center">
                <div class="inline-block relative">
                    <div class="w-20 h-20 bg-gradient-to-r from-pink-400 to-purple-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-heart text-white text-3xl heart-beat"></i>
                    </div>
                </div>
            </div>

            <!-- Relationship Type -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Select Relationship Type</h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Love -->
                    <div id="type-love" onclick="selectType('love')"
                         class="type-card glass-card p-4 text-center">
                        <div class="text-3xl text-red-500 mb-2">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="font-bold text-gray-800">Love</h4>
                    </div>

                    <!-- Friendship -->
                    <div id="type-friendship" onclick="selectType('friendship')"
                         class="type-card glass-card p-4 text-center">
                        <div class="text-3xl text-blue-500 mb-2">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4 class="font-bold text-gray-800">Friendship</h4>
                    </div>

                    <!-- Relationship -->
                    <div id="type-relationship" onclick="selectType('relationship')"
                         class="type-card glass-card p-4 text-center">
                        <div class="text-3xl text-green-500 mb-2">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="font-bold text-gray-800">Relationship</h4>
                    </div>

                    <!-- Antagonist -->
                    <div id="type-antagonist" onclick="selectType('antagonist')"
                         class="type-card glass-card p-4 text-center">
                        <div class="text-3xl text-yellow-500 mb-2">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="font-bold text-gray-800">Antagonist</h4>
                    </div>
                </div>

                <input type="hidden" name="calculation_type" id="calculation_type" required>
            </div>

            <!-- Calculate Button -->
            <div class="text-center">
                <button type="submit" class="btn-primary px-12 py-3 text-lg">
                    <i class="fas fa-calculator mr-2"></i>
                    Calculate Compatibility
                </button>

                <p class="text-gray-600 mt-4 text-sm">
                    <i class="fas fa-lock text-green-500 mr-1"></i>
                    Your data is private and secure
                </p>
            </div>
        </form>
    </div>

    <!-- Features -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="glass-card p-6 text-center">
            <div class="text-3xl text-pink-500 mb-3">
                <i class="fas fa-bolt"></i>
            </div>
            <h4 class="font-bold text-gray-800 mb-2">Fast Calculation</h4>
            <p class="text-gray-600 text-sm">Get results instantly with our advanced algorithm</p>
        </div>

        <div class="glass-card p-6 text-center">
            <div class="text-3xl text-blue-500 mb-3">
                <i class="fas fa-certificate"></i>
            </div>
            <h4 class="font-bold text-gray-800 mb-2">Get Certificate</h4>
            <p class="text-gray-600 text-sm">Download beautiful certificate with results</p>
        </div>

        <div class="glass-card p-6 text-center">
            <div class="text-3xl text-green-500 mb-3">
                <i class="fas fa-chart-pie"></i>
            </div>
            <h4 class="font-bold text-gray-800 mb-2">Detailed Analysis</h4>
            <p class="text-gray-600 text-sm">See compatibility breakdown and tips</p>
        </div>
    </div>
</div>

<script>
    // Gender selection
    function selectGender(button, gender, inputId) {
        const container = button.closest('.grid.grid-cols-3');
        container.querySelectorAll('button').forEach(btn => {
            btn.classList.remove('active');
        });

        button.classList.add('active');
        document.getElementById(inputId).value = gender;
    }

    // Type selection
    function selectType(type) {
        document.querySelectorAll('.type-card').forEach(card => {
            card.classList.remove('selected');
        });

        const card = document.getElementById(`type-${type}`);
        if (card) {
            card.classList.add('selected');
        }

        document.getElementById('calculation_type').value = type;
    }

    // Set defaults
    document.addEventListener('DOMContentLoaded', function() {
        selectGender(document.querySelectorAll('.gender-btn')[0], 'male', 'member1_gender');
        selectGender(document.querySelectorAll('.gender-btn')[4], 'female', 'member2_gender');
        selectType('love');
    });
</script>
@endsection
