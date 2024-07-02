<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\EmailLog;
use App\Models\User;
use App\Mail\NewPostMail;
use Illuminate\Support\Facades\Mail;

class SendNewPosts extends Command
{
    protected $signature = 'send:newposts';
    protected $description = 'Send new posts to subscribers';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $posts = Post::whereDoesntHave('emailLogs')->get();
        foreach ($posts as $post) {
            $subscribers = $post->website->subscribers;
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->queue(new NewPostMail($post));
                EmailLog::create(['post_id' => $post->id, 'user_id' => $subscriber->id,]);
            }
        }
    }
}

