<?php

namespace App\Notifications;

use App\Models\Swap;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SwapRequestNotification extends Notification
{
    use Queueable;

    public function __construct(public Swap $swap)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'swap_id' => $this->swap->id,
            'sender_id' => $this->swap->sender_id,
            'sender_name' => $this->swap->sender->name,
            'offered_skill' => $this->swap->offeredSkill->skill_name,
            'requested_skill' => $this->swap->requestedSkill->skill_name,
            'message' => $this->swap->sender->name . ' mengajukan swap request',
            'action_url' => route('swaps.index'),
        ];
    }
}
