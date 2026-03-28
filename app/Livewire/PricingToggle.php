<?php

namespace App\Livewire;

use Livewire\Component;

class PricingToggle extends Component
{
    public string $period = 'monthly';

    public function toggle()
    {
        $this->period = $this->period === 'monthly' ? 'annual' : 'monthly';
    }

    public function render()
    {
        return view('livewire.pricing-toggle', [
            'prezzi' => config('corvalys.prezzi'),
        ]);
    }
}
