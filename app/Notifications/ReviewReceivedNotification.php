<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReviewReceivedNotification extends Notification
{
    use Queueable;

    public function __construct(public Review $review)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'review_id' => $this->review->id,
            'swap_id' => $this->review->swap_id,
            'reviewer_id' => $this->review->reviewer_id,
            'reviewer_name' => $this->review->reviewer->name,
            'rating' => $this->review->rating,
            'message' => $this->review->reviewer->name . ' memberikan review ' . $this->review->rating . ' bintang',
            'action_url' => route('profile.show'),
        ];
    }
}
