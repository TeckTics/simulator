<?php
 
namespace App\Events;
 
use App\Models\ChatMessage;
use App\Models\PrivateChatMessage;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
 
class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
 
    /**
     * Create a new event instance.
     */
    private $user;
    public function __construct(public PrivateChatMessage $message, User $user)
    {
        //
        $this->user = $user;
    }
 
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("chat.1"),
            // new Channel("chat.{$this->message->receiver_id}"),
        ];
    }

    public function broadcastwith(): array {
        return [
            'message' => $this->message, 'name' => $this->user->pseudo
        ];
    }
}