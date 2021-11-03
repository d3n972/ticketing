<?php

namespace App\Http\Livewire;

use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AttachmentView extends Component
{

    /**
     * @var Attachment
     */
    public $attachment;

    public function mount(\App\Models\Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    public function download()
    {

        return Storage::download('public/attachments/' . '/' . $this->attachment->filename, $this->attachment->original_name);
    }

    public function render()
    {
        return view('livewire.attachment-view', ['file' => $this->attachment]);
    }
}
