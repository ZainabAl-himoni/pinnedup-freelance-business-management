<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;

class CustomProfileComponent extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = 0;

    public function mount(): void
    {
        $this->form->fill(auth()->user()->only(['behance', 'dribbble', 'linkedin', 'github']));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Social Links')
                    ->aside()
                    ->description('Add or update your social links')
                    ->schema([
                        TextInput::make('behance')
                            ->label('Behance URL')
                            ->placeholder('https://www.behance.net/your-profile')
                            ->url()
                            ->nullable()
                            ->required(false),

                        TextInput::make('dribbble')
                            ->label('Dribbble URL')
                            ->placeholder('https://www.dribbble.com/your-profile')
                            ->url()
                            ->nullable()
                            ->required(false),

                        TextInput::make('linkedin')
                            ->label('LinkedIn URL')
                            ->placeholder('https://www.linkedin.com/in/your-profile')
                            ->url()
                            ->nullable()
                            ->required(false),

                        TextInput::make('github')
                            ->label('GitHub URL')
                            ->placeholder('https://www.github.com/your-profile')
                            ->url()
                            ->nullable()
                            ->required(false),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        auth()->user()->update([
            'behance' => $data['behance'] ?? null,
            'dribbble' => $data['dribbble'] ?? null,
            'linkedin' => $data['linkedin'] ?? null,
            'github' => $data['github'] ?? null,
        ]);

        session()->flash('success', 'Profile updated successfully!');
    }

    public function render(): View
    {
        return view('livewire.custom-profile-component');
    }
}
