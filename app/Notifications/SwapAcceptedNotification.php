<?php

namespace App\Notifications;

use App\Models\Swap;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SwapAcceptedNotification extends Notification
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
            'receiver_id' => $this->swap->receiver_id,
            'receiver_name' => $this->swap->receiver->name,
            'offered_skill' => $this->swap->offeredSkill->skill_name,
            'requested_skill' => $this->swap->requestedSkill->skill_name,
            'message' => $this->swap->receiver->name . ' menerima swap request Anda',
            'action_url' => route('swaps.index'),
        ];
    }
}
