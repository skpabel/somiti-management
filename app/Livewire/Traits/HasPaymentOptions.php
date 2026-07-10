<?php

namespace App\Livewire\Traits;

use App\Models\SubAccount;

trait HasPaymentOptions
{
    public array $paymentOptions = [];

    /**
     * ✅ ডাইনামিক পেমেন্ট অপশন তৈরি করা (Cash, Bkash, Bank + Dynamic Sub Accounts)
     * এই মেথডটি Deposit এবং Expense উভয় জায়গায় ব্যবহার করা হবে।
     */
    public function loadPaymentOptions(): void
    {
        $this->paymentOptions = [
            ['value' => 'Cash', 'label' => '💵 Cash'],
            ['value' => 'Bkash', 'label' => '📱 Bkash'],
            ['value' => 'Nagad', 'label' => '📱 Nagad'],
            ['value' => 'Rocket', 'label' => '📱 Rocket'],
            ['value' => 'Bank', 'label' => '🏦 Main Bank'],
        ];
    }
}