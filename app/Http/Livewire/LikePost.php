<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $fill_color;
    public $contaLikes;

    public function mount($post)
    {
        $this->post = $post;
        $this->fill_color = $this->post->checkLike(auth()->user())?'red':'white';
        $this->contaLikes = $this->post->countLike();
    }

    public function render()
    {
        return view('livewire.like-post');
    }

    public function clickLike()
    {
        if (! $this->post->checkLike(auth()->user()))
        {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            
            $this->fill_color = "red";
            $this->contaLikes++;
        } else
        {
            $like = $this->post->likes()->where('user_id',auth()->user()->id)->first();
            $like->delete();

            $this->fill_color = "white";
            $this->contaLikes--;
        }
    }
}
