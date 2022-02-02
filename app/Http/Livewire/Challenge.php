<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class Challenge extends Component
{
    public $text = '';

    public $names = [];

    public $alphabet;

    public $output = [];

    public $total;

    public function mount(): void
    {
        $this->alphabet = collect(range('a', 'z'));
        $this->updatingText($this->text);
    }

    public function updatingText($text): void
    {
        $this->output = collect(preg_split("/\r\n|\n|\r/", $text))
            ->map(fn($item) => trim($item))
            ->filter(fn($item) => !empty($item))
            ->sortBy(fn ($item) => strtolower($item))
            ->values()
            ->map(function ($name, $position) {
                $alphabet = $this->nameToAlphabet(strtolower($name));

                return (object) [
                    'name' => $name,
                    'alphabet' => $alphabet,
                    'total' => $alphabet->sum('value'),
                    'totalWithPosition' => $alphabet->sum('value') * ($position + 1),
                ];
            });

        $this->total = $this->output->sum('totalWithPosition');
    }

    private function nameToAlphabet($name): Collection
    {
        return collect(str_split($name))->map(fn($letter) => (object) [
            'letter' => $letter,
            'value' => $this->alphabet->search($letter) + 1
        ]);
    }

    public function render(): View
    {
        return view('livewire.challenge');
    }
}
