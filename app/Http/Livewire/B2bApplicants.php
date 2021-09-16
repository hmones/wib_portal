<?php

namespace App\Http\Livewire;

use App\Models\B2bApplication;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class B2bApplicants extends Component
{
    use WithPagination;

    public $application = null, $status = [], $isOpen = false;

    public function render()
    {
        $applications = B2bApplication::latest()->paginate(2);
        $this->status = $applications->pluck('status', 'id')->toArray();

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
            'status.' . $application->id => ['required', Rule::in(B2bApplication::STATUSES)]
        ]);

        $application->update(['status' => data_get($this->status, $application->id)]);

        session()->flash('message', 'Application for ' . $application->user->name . ' has been set to ' . data_get($this->status, $application->id));
    }

    public function destroy(B2bApplication $application): void
    {
        $application->delete();

        session()->flash('message', 'Application for ' . $application->user->name . ' has been deleted');
    }
}
