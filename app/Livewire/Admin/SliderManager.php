<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class SliderManager extends Component
{
    use WithFileUploads;

    public $sliders;
    public $showModal = false;
    public $sliderId;

    // Campos del formulario
    public $title, $subtitle, $link_url, $sort_order = 0, $is_active = true;
    public $image, $newImage; // $image para url existente, $newImage para upload

    public function render()
    {
        $this->sliders = Slider::orderBy('sort_order')->get();
        return view('livewire.admin.slider-manager');
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetForm();
        $slider = Slider::findOrFail($id);
        $this->sliderId = $slider->id;
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->link_url = $slider->link_url;
        $this->sort_order = $slider->sort_order;
        $this->is_active = (bool) $slider->is_active;
        $this->image = $slider->image_path; // Ruta existente
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'title' => 'nullable|string|max:255',
            'newImage' => $this->sliderId ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'sort_order' => 'integer',
        ]);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'link_url' => $this->link_url,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
        ];

        if ($this->newImage) {
            $path = $this->newImage->store('sliders', 'public');
            $data['image_path'] = '/storage/' . $path;
        }

        if ($this->sliderId) {
            Slider::find($this->sliderId)->update($data);
            $msg = 'Slider actualizado';
        } else {
            Slider::create($data);
            $msg = 'Slider creado';
        }

        $this->showModal = false;
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => $msg]);
    }

    public function delete($id)
    {
        Slider::find($id)->delete();
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Slider eliminado']);
    }

    public function resetForm()
    {
        $this->reset(['sliderId', 'title', 'subtitle', 'link_url', 'sort_order', 'is_active', 'image', 'newImage']);
    }
}
