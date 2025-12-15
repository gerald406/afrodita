<?php

namespace App\Livewire\Admin;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class ReviewManager extends Component
{
    use WithPagination;

    public function toggleApproval($id)
    {
        $review = Review::find($id);
        $review->is_approved = !$review->is_approved;
        $review->save();

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Estado actualizado']);
    }

    public function delete($id)
    {
        Review::find($id)->delete();
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Reseña eliminada']);
    }

    public function render()
    {
        $reviews = Review::with(['user', 'course'])->latest()->paginate(10);
        return view('livewire.admin.review-manager', compact('reviews'));
    }
}
