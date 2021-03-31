<?php

namespace App\Http\Livewire;

use App\Models\Release;
use Livewire\Component;
use App\Traits\SearchTrait;
use Livewire\WithPagination;

class Releases extends Component
{
    use WithPagination;
    use SearchTrait;

    public $filter = null;
    public $search = null;
    public $pagination = null;
    public $sortBy = null;
    public function render()
    {
        $query = Release::query();
        if ($this->filter) {
            if ($this->filter == "unassigned") {
                $query->whereNull('assigned_to_email');
            } elseif ($this->filter == "unresponsive") {
                $query->whereNull('root_cause')->whereNotNull('assigned_to_email');
            } elseif ($this->filter == "review") {
                $query->whereNotNull('root_cause')->where('finalized', 0);
            } elseif ($this->filter == "toMe") {
              //  $query->where('assigned_to_email', Auth::user()->email)->whereNotNull('root_cause')->where('finalized', 0);
            } else {
                $query->where('finalized', $this->filter);
            }
        }
        if ($this->sortBy) {
            $query->orderBy($this->sortBy);
        } else {
            $query->orderBy('release_date', 'DESC');
        }
        if ($this->search) {
            $query = $query->where('awb_number',"LIKE", "%$this->search%");
        }
        if ($this->pagination) {
            $releases = $query->paginate($this->pagination);;
        } else {
            $releases = $query->paginate(10);
        }
        return view('livewire.releases')->with(compact('releases'));
    }
}
