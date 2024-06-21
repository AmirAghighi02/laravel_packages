<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public array $user, public string $message) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        info('on :: user.'.$this->user['id']);

        return [
            new PrivateChannel('user.'.$this->user['id']),
            new PrivateChannel('admin'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'users.test';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'user' => ['id' => $this->user['id'], 'email' => $this->user['email']],
        ];
    }
}
