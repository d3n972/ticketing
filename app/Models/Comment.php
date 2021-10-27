<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property User $author
 * @property Issue $issue
 * @property Comment $reply_to
 * @property string $text;
 */
class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function isAnswerForComment(){
      return $this->reply_to!=null;
    }
    public function getParent(){
      return Comment::where('id','=',$this->reply_to)->first();
    }

  /**
   * @return string
   */
  public function getText(){
    return $this->deleted_at!=null?"[deleted]":$this->text;
  }

}
