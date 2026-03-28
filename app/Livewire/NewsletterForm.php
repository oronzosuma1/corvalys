<?php

namespace App\Livewire;

use App\Models\NewsletterSubscriber;
use Livewire\Component;

class NewsletterForm extends Component
{
    public string $email = '';
    public bool $success = false;
    public string $error = '';

    public function subscribe()
    {
        $this->validate([
            'email' => 'required|email|max:255',
        ]);

        try {
            NewsletterSubscriber::firstOrCreate(
                ['email' => $this->email],
                ['source' => 'website']
            );
            $this->success = true;
            $this->email = '';
            $this->error = '';
        } catch (\Exception $e) {
            $this->error = 'Si è verificato un errore. Riprova.';
        }
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
