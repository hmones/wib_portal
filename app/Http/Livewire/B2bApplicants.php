<?php

namespace App\Http\Livewire;

use App\Models\B2bApplication;
use App\Notifications\B2bApplicationNotification;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class B2bApplicants extends Component
{
    use WithPagination;

    public $application = null, $statuses = [], $isOpen = false;

    public function render()
    {
        $applications = B2bApplication::latest()->paginate(2);
        $this->statuses = $applications->pluck('status', 'id')->toArray();

        return view('livewire.b2b-applicants', compact('applications'));
    }

    public function hideApplication(): void
    {
        $this->isOpen = false;
        $this->application = null;
    }

    public function showApplication(B2bApplication $application): void
    {
        $this->isOpen = true;
        $this->application = $application;
    }

    public function update(B2bApplication $application): void
    {
        $this->validate([
            'statuses.' . $application->id => ['required', Rule::in(B2bApplication::STATUSES)]
        ]);

        $status = data_get($this->statuses, $application->id);

        $application->update(compact('status'));

        if (in_array($status, [B2bApplication::ACCEPTED, B2bApplication::DECLINED])) {
            auth()->user()->notify(new B2bApplicationNotification($application));
        }

        session()->flash('message', 'Application for ' . $application->user->name . ' has been set to ' . $status);
    }

    public function destroy(B2bApplication $application): void
    {
        $application->delete();

        session()->flash('message', 'Application for ' . $application->user->name . ' has been deleted');
    }
}
