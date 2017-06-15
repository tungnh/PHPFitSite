<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Account;
use App\Model\Post;

class Comment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';
    
    /**
     * The model not using timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * Mapping has one accounts table, with foreign key (account_id) references accounts(id)
     *
     * @return Manager infomation of Department
     */
    public function account()
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
    
    /**
     * Mapping has one posts table, with foreign key (post_id) references pots(id)
     *
     * @return Manager infomation of Department
     */
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }
    
    /**
     * Mapping has one comments table, with foreign key (parent_id) references comments(id)
     *
     * @return Manager infomation of Department
     */
    public function comment_root()
    {
        return $this->hasOne(Comment::class, 'id', 'parent_id');
    }
}
