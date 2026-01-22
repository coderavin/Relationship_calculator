<?php

namespace App\Services;

use Illuminate\Support\Str;

class CalculatorService
{
    public function calculate($member1, $member2, $type)
    {
        // Generate unique ID
        $uniqueId = Str::uuid()->toString();

        // Calculate percentage (30-98%)
        $percentage = $this->generatePercentage($member1, $member2, $type);

        // Get points
        $points = $this->generateCompatibilityPoints();

        // Get description
        $description = $this->getDescription($percentage, $type);

        // Get tips
        $tips = $this->getTips($percentage, $type);

        return [
            'member1_name' => $member1['name'],
            'member1_gender' => $member1['gender'],
            'member2_name' => $member2['name'],
            'member2_gender' => $member2['gender'],
            'calculation_type' => $type,
            'percentage' => $percentage,
            'description' => $description,
            'compatibility_points' => $points,
            'improvement_tips' => $tips,
            'unique_id' => $uniqueId
        ];
    }

    private function generatePercentage($member1, $member2, $type)
    {
        // Create unique seed
        $seed = strtolower($member1['name'] . $member2['name'] . $type . time());

        // Generate hash
        $hash = crc32($seed);

        // Get base percentage (30-98%)
        $base = abs($hash % 69) + 30;

        // Adjust for antagonist (reverse logic)
        if ($type === 'antagonist') {
            $percentage = 100 - $base;
            return max(30, min(98, $percentage));
        }

        return $base;
    }

    private function generateCompatibilityPoints()
    {
        $points = [];
        $categories = ['Communication', 'Trust', 'Fun', 'Support', 'Growth'];

        foreach ($categories as $category) {
            $points[$category] = rand(50, 100);
        }

        return $points;
    }

    private function getDescription($percentage, $type)
    {
        if ($percentage < 45) {
            $descriptions = [
                'love' => 'A gentle beginning. With effort and understanding, this could grow into something special.',
                'friendship' => 'Different interests but potential for mutual respect. Start with common ground.',
                'relationship' => 'Building blocks are there. Needs nurturing and patience.',
                'antagonist' => 'Minor differences. Focus on understanding rather than winning arguments.'
            ];
        } elseif ($percentage < 65) {
            $descriptions = [
                'love' => 'Good chemistry! This connection has real potential with mutual effort.',
                'friendship' => 'Solid friendship foundation. Keep nurturing this bond.',
                'relationship' => 'Healthy dynamics with room for growth. Communication is key.',
                'antagonist' => 'Healthy tension that can lead to growth if managed properly.'
            ];
        } elseif ($percentage < 85) {
            $descriptions = [
                'love' => 'Strong connection! This could be something truly special.',
                'friendship' => 'Great friends who support each other. Cherish this bond.',
                'relationship' => 'Excellent partnership with good balance.',
                'antagonist' => 'Intense dynamics that challenge both to grow.'
            ];
        } else {
            $descriptions = [
                'love' => 'Amazing connection! This is rare and beautiful.',
                'friendship' => 'Best friend material! This bond is precious.',
                'relationship' => 'Exceptional partnership. You complement each other perfectly.',
                'antagonist' => 'Perfect balance of differences creating harmony.'
            ];
        }

        return $descriptions[$type] ?? 'Good connection with potential.';
    }

    private function getTips($percentage, $type)
    {
        $tips = [];

        if ($percentage < 45) {
            // Low percentage tips
            if ($type === 'love') {
                $tips = [
                    'Plan regular date nights to build connection',
                    'Practice active listening without interruption',
                    'Share your dreams and fears openly'
                ];
            } elseif ($type === 'friendship') {
                $tips = [
                    'Find common hobbies to enjoy together',
                    'Be reliable - keep your promises',
                    'Schedule regular catch-ups'
                ];
            } elseif ($type === 'relationship') {
                $tips = [
                    'Set aside quality time each week',
                    'Learn each other\'s love languages',
                    'Practice gratitude for small things'
                ];
            } elseif ($type === 'antagonist') {
                $tips = [
                    'Focus on common goals, not differences',
                    'Take breaks when discussions get heated',
                    'Find a neutral mediator if needed'
                ];
            }
        } elseif ($percentage < 65) {
            // Medium percentage tips
            if ($type === 'love') {
                $tips = [
                    'Keep surprising each other',
                    'Create shared goals for the future',
                    'Maintain your individual identities'
                ];
            } elseif ($type === 'friendship') {
                $tips = [
                    'Be there during tough times',
                    'Celebrate each other\'s successes',
                    'Try new adventures together'
                ];
            } elseif ($type === 'relationship') {
                $tips = [
                    'Regularly check in on relationship health',
                    'Keep the romance alive with small gestures',
                    'Support each other\'s personal growth'
                ];
            } elseif ($type === 'antagonist') {
                $tips = [
                    'Channel competitive energy positively',
                    'Respect different perspectives',
                    'Find win-win solutions'
                ];
            }
        } elseif ($percentage < 85) {
            // High percentage tips
            if ($type === 'love') {
                $tips = [
                    'Cherish this special connection',
                    'Plan for long-term future together',
                    'Keep communicating openly'
                ];
            } elseif ($type === 'friendship') {
                $tips = [
                    'This friendship is precious - nurture it',
                    'Consider friendship rituals or traditions',
                    'Be honest even when it\'s difficult'
                ];
            } elseif ($type === 'relationship') {
                $tips = [
                    'You have something special - protect it',
                    'Continue growing together',
                    'Help other couples with your wisdom'
                ];
            } elseif ($type === 'antagonist') {
                $tips = [
                    'Your differences create balance',
                    'Use tension as creative fuel',
                    'Respect the yin-yang dynamic'
                ];
            }
        } else {
            // Perfect percentage tips
            if ($type === 'love') {
                $tips = [
                    'You\'ve found something rare - celebrate it',
                    'Consider mentoring other couples',
                    'Document your love story'
                ];
            } elseif ($type === 'friendship') {
                $tips = [
                    'Soul friends are rare - cherish this',
                    'Plan a special trip together',
                    'Create something lasting together'
                ];
            } elseif ($type === 'relationship') {
                $tips = [
                    'Relationship goals achieved!',
                    'Share your success story',
                    'Renew your commitment regularly'
                ];
            } elseif ($type === 'antagonist') {
                $tips = [
                    'Perfect balance achieved',
                    'Your dynamic inspires others',
                    'Teach others about harmony in differences'
                ];
            }
        }

        return $tips;
    }
}
