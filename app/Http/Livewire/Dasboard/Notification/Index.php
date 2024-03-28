<?php

namespace App\Http\Livewire\Dasboard\Notification;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $notifications=[];
    public $readNotifications;
    public $unreadNotifications;
    protected $listeners = [
        'notificationMarkAsRead' => 'render',
        'notificationUnreadNotifications' => 'render',
        'notificationUnread' => 'render',
    ];
    public function render()
    {
        $this->notifications = auth()->user()->unreadNotifications;
        return view('livewire.dasboard.notification.index');
    }

    public function markNotification()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->noContent();
    }
    public function markasread($id)
    {
        if ($id) {
            auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        }
        $this->emit('notificationUnreadNotifications');
    }
    public function mount()
    {
        
        $this->readNotifications = auth()->user()->readNotifications;
        $this->unreadNotifications = auth()->user()->unreadNotifications;
        
    }
    public function pemberitahuan()
    {
        $this->readNotifications = auth()->user()->readNotifications;
        $this->unreadNotifications = auth()->user()->unreadNotifications;
    }
    public function deleteNotif($id)
    {
     
        auth()->user()->notifications()->where('id',$id)->delete();
    }
}
