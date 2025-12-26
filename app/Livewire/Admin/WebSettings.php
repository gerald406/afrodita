<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\GeneralSetting;
use Livewire\WithFileUploads;

class WebSettings extends Component
{
    use WithFileUploads;

    public $site_name, $popup_active, $popup_link;
    public $site_logo, $newLogo;
    public $site_favicon, $newFavicon;
    public $popup_image, $newPopupImage;

    // Agrega estas propiedades públicas
    public $free_mode_active;
    public $free_mode_start;
    public $free_mode_end;
    public $free_mode_message;

    public $whatsapp_number;
    public $whatsapp_message;

    public function mount()
    {
        // Obtener o crear configuración por defecto
        $settings = GeneralSetting::firstOrCreate(['id' => 1]);

        $this->site_name = $settings->site_name;
        $this->popup_active = (bool) $settings->popup_active;
        $this->popup_link = $settings->popup_link;

        // Rutas existentes
        $this->site_logo = $settings->site_logo;
        $this->site_favicon = $settings->site_favicon;
        $this->popup_image = $settings->popup_image;

        $this->free_mode_active = (bool) $settings->free_mode_active;
        // Formato compatible con input datetime-local
        $this->free_mode_start = $settings->free_mode_start?->format('Y-m-d\TH:i');
        $this->free_mode_end = $settings->free_mode_end?->format('Y-m-d\TH:i');
        $this->free_mode_message = $settings->free_mode_message;

        $this->whatsapp_number = $settings->whatsapp_number;
        $this->whatsapp_message = $settings->whatsapp_message;
    }

    public function save()
    {
        $this->validate([
            'site_name' => 'required',
            'whatsapp_number' => 'nullable|numeric', // Solo números
            'whatsapp_message' => 'nullable|string|max:255',
        ]);

        $settings = GeneralSetting::find(1);
        $data = [
            'site_name' => $this->site_name,
            'popup_active' => $this->popup_active,
            'popup_link' => $this->popup_link,
            'free_mode_active' => $this->free_mode_active,
            'free_mode_start' => $this->free_mode_start,
            'free_mode_end' => $this->free_mode_end,
            'free_mode_message' => $this->free_mode_message,
            'whatsapp_number' => $this->whatsapp_number,
            'whatsapp_message' => $this->whatsapp_message,
        ];

        // Lógica de subida de imágenes
        if ($this->newLogo) {
            $data['site_logo'] = '/storage/' . $this->newLogo->store('settings', 'public');
        }
        if ($this->newFavicon) {
            $data['site_favicon'] = '/storage/' . $this->newFavicon->store('settings', 'public');
        }
        if ($this->newPopupImage) {
            $data['popup_image'] = '/storage/' . $this->newPopupImage->store('settings', 'public');
        }

        $settings->update($data);
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Configuración guardada']);
    }

    public function render()
    {
        return view('livewire.admin.web-settings');
    }
}