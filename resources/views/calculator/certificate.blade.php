@extends('layouts.app')

@section('title', 'Certificate - ' . $calculation->member1_name . ' & ' . $calculation->member2_name)

@section('styles')
<style>
    .certificate-container {
        max-width: 180mm;
        min-height: 250mm;
        margin: 10px auto;
        background: white;
    }

    .certificate-paper {
        width: 100%;
        height: 100%;
        background: white;
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 10mm;
        position: relative;
        overflow: hidden;
        box-sizing: border-box;
    }

    .watermark {
        position: absolute;
        font-size: 5rem;
        opacity: 0.03;
        color: #ff4081;
        transform: rotate(-30deg);
        top: 35%;
        left: -40px;
    }

    .border-decoration {
        position: absolute;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        border: 1px solid #ff4081;
        border-radius: 2px;
        pointer-events: none;
    }

    .single-signature {
        font-family: 'Dancing Script', cursive;
        font-size: 1.5rem;
        color: #1e40af;
        display: inline-block;
        margin-top: 3px;
    }

    .small-barcode {
        max-width: 120px;
        margin: 0 auto;
    }

    @media print {
        @page { margin: 10mm; }
        body {
            background: white !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .certificate-container {
            max-width: 180mm !important;
            min-height: 250mm !important;
            margin: 0 auto !important;
        }
        .certificate-paper {
            border: none !important;
            padding: 10mm !important;
        }
        .no-print { display: none !important; }
        * { -webkit-print-color-adjust: exact !important; }
    }

    @media screen and (max-width: 768px) {
        .certificate-container {
            max-width: 95%;
            min-height: auto;
            margin: 15px auto;
        }
        .certificate-paper { padding: 15px; }
        .watermark { font-size: 3rem; }
    }

    .a4-content {
        position: relative;
        z-index: 1;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .header-section { margin-bottom: 10px; }
    .main-section { flex: 1; margin-bottom: 10px; }
    .footer-section { margin-top: auto; }

    .print-btn {
        background: linear-gradient(45deg, #ff4081, #ff6b9d);
        color: white;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-size: 13px;
        margin: 2px;
    }

    .back-btn {
        background: linear-gradient(45deg, #536dfe, #7986cb);
        color: white;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        font-size: 13px;
        margin: 2px;
    }
</style>
@endsection

@section('content')
<div class="certificate-container my-3">
    <div class="certificate-paper">
        <div class="border-decoration"></div>
        <div class="watermark">LOVE</div>

        <div class="a4-content">
            <!-- Header -->
            <div class="header-section text-center">
                <div class="mb-2">
                    <div class="inline-block w-12 h-12 rounded-full bg-gradient-to-r from-pink-400 to-purple-500 flex items-center justify-center">
                        <i class="fas fa-heart text-white text-xl"></i>
                    </div>
                </div>
                <h1 class="text-xl font-bold text-gray-800 mb-1">Compatibility Certificate</h1>
                <div class="w-32 h-0.5 bg-gradient-to-r from-pink-400 to-purple-500 mx-auto mb-1"></div>
                <p class="text-gray-600 text-xs">Relationship Analysis</p>
            </div>

            <!-- Main Content -->
            <div class="main-section">
                <!-- Participants -->
                <div class="text-center mb-6">
                    <p class="text-gray-700 mb-3">This certifies the relationship between</p>
                    <div class="flex flex-col md:flex-row justify-center items-center space-y-3 md:space-y-0 md:space-x-6 mb-4">
                        <div class="text-center">
                            <div class="text-lg font-bold text-gray-800">{{ $calculation->member1_name }}</div>
                            <div class="text-gray-600 text-xs">{{ $calculation->member1_gender }}</div>
                        </div>
                        <div class="text-2xl text-pink-500"><i class="fas fa-heart"></i></div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-gray-800">{{ $calculation->member2_name }}</div>
                            <div class="text-gray-600 text-xs">{{ $calculation->member2_gender }}</div>
                        </div>
                    </div>
                </div>

                <!-- Score Section -->
                <div class="text-center mb-6">
                    <div class="relative w-32 h-32 mx-auto mb-3">
                        <svg class="w-full h-full" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="45" fill="none" stroke="#f3f4f6" stroke-width="8"/>
                            <circle cx="50" cy="50" r="40" fill="none" stroke="url(#gradient)" stroke-width="10"
                                stroke-linecap="round" stroke-dasharray="251.2"
                                stroke-dashoffset="{{ 251.2 * (1 - $calculation->percentage / 100) }}"
                                transform="rotate(-90 50 50)"/>
                            <defs>
                                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#ff4081"/><stop offset="100%" stop-color="#8b5cf6"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <div class="text-3xl font-bold text-pink-600">{{ $calculation->percentage }}%</div>
                            <div class="text-xs text-gray-700">Score</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-lg font-bold text-gray-800 mb-1">{{ $calculation->type_label }}</div>
                        <div class="inline-block px-2 py-1 bg-{{ $calculation->level_color }}-100 text-{{ $calculation->level_color }}-800 rounded-full text-xs">
                            {{ $calculation->level }} Compatibility
                        </div>
                    </div>

                    <div class="max-w-md mx-auto">
                        <p class="text-gray-700 italic text-sm">"{{ $calculation->description }}"</p>
                    </div>
                </div>

                <!-- Tips -->
                @if(is_array($calculation->improvement_tips) && count($calculation->improvement_tips) > 0)
                <div class="mb-4">
                    <h3 class="text-sm font-bold text-gray-800 mb-2 text-center">Suggestions:-How to improve..</h3>
                    <div class="space-y-1 text-xs">
                        @foreach($calculation->improvement_tips as $tip)
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-0.5 mr-2 text-xs"></i>
                            <span class="text-gray-700">{{ $tip }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="footer-section border-t border-gray-300 pt-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="text-center">
                        <div class="font-bold text-gray-800 text-xs mb-1">Certificate No.</div>
                        <div class="text-gray-700 text-xs">{{ $certificate->certificate_number }}</div>
                    </div>
                    <div class="text-center">
                        <div class="font-bold text-gray-800 text-xs mb-1">Signature</div>
                        <div class="single-signature">Love-Guru</div>
                        <div class="w-24 h-0.5 bg-gray-800 mx-auto mt-1"></div>
                        <div class="text-gray-600 text-xs mt-1">Analyst</div>
                    </div>
                    <div class="text-center">
                        <div class="font-bold text-gray-800 text-xs mb-1">Date</div>
                        <div class="text-gray-700 text-xs">{{ date('M d, Y', strtotime($certificate->issue_date)) }}</div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="small-barcode mb-2">
                        <div class="flex justify-center space-x-0.5 mb-1">
                            @for($i = 0; $i < 10; $i++)
                            <div class="w-{{ rand(1, 2) }} h-4 bg-black"></div>
                            @endfor
                        </div>
                        <div class="text-xs text-gray-600 font-mono">
                            ID: {{ substr(md5($certificate->certificate_number), 0, 6) }}
                        </div>
                    </div>
                    <div class="text-center pt-3">
                        <p class="text-xs text-gray-500">
                            Generated by Love Meter • For entertainment purposes
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-2 justify-center mt-4 no-print">
        <button onclick="printCertificate()" class="print-btn">
            <i class="fas fa-print mr-1"></i> Print
        </button>
        <a href="{{ route('result', $calculation->unique_id) }}" class="back-btn">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
        <a href="{{ route('home') }}" class="print-btn" style="background:linear-gradient(45deg,#4CAF50,#66BB6A);">
            <i class="fas fa-redo mr-1"></i> New
        </a>
    </div>
</div>

<script>
    function printCertificate() {
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>';
        button.disabled = true;

        setTimeout(() => {
            window.print();
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 500);
        }, 100);
    }
</script>

<style>
    @media print {
        @page { margin: 5mm; }
        body { width: 210mm; height: 297mm; }
        .certificate-container {
            width: 200mm !important;
            height: 287mm !important;
        }
        .no-print, button, a, nav, footer { display: none !important; }
    }
</style>
@endsection
