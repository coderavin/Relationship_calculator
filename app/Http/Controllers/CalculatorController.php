<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calculation;
use App\Models\Certificate;
use App\Services\CalculatorService;

class CalculatorController extends Controller
{
    protected $calculatorService;

    public function __construct()
    {
        $this->calculatorService = new CalculatorService();
    }

    public function index()
    {
        return view('calculator.index');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'member1_name' => 'required|string|max:50',
            'member1_gender' => 'required|in:male,female,other',
            'member2_name' => 'required|string|max:50',
            'member2_gender' => 'required|in:male,female,other',
            'calculation_type' => 'required|in:love,friendship,relationship,antagonist'
        ]);

        $data = $this->calculatorService->calculate(
            ['name' => $validated['member1_name'], 'gender' => $validated['member1_gender']],
            ['name' => $validated['member2_name'], 'gender' => $validated['member2_gender']],
            $validated['calculation_type']
        );

        $calculation = Calculation::create($data);

        return redirect()->route('result', $calculation->unique_id);
    }

    public function result($uniqueId)
    {
        $calculation = Calculation::where('unique_id', $uniqueId)->firstOrFail();
        return view('calculator.result', compact('calculation'));
    }

    public function generateCertificate(Request $request, $uniqueId)
    {
        $calculation = Calculation::where('unique_id', $uniqueId)->firstOrFail();

        $certificateNumber = 'CERT-' . strtoupper(\Illuminate\Support\Str::random(6)) . '-' . date('Ymd');

        $certificate = Certificate::create([
            'calculation_id' => $calculation->id,
            'certificate_number' => $certificateNumber,
            'issue_date' => now(),
            'valid_until' => now()->addYear(),
            'template' => $request->template ?? 'elegant'
        ]);

        return redirect()->route('certificate', $certificate->certificate_number);
    }

    public function certificate($certificateNumber)
    {
        $certificate = Certificate::where('certificate_number', $certificateNumber)->firstOrFail();
        $calculation = $certificate->calculation;

        return view('calculator.certificate', compact('certificate', 'calculation'));
    }

    public function recent()
    {
        $calculations = Calculation::latest()->take(10)->get();
        return view('calculator.recent', compact('calculations'));
    }
}
