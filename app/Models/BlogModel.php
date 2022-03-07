<?php

namespace App\Models;

use DateTime;

class BlogModel extends Model
{
    protected $table = "posts";

    public function getCreatedAt(): string
    {
        return $date = (new DateTime($this->created_at))->format('d/m/Y à H:m');
    }
    public function getExcerpt(): string
    {
        return substr($this->content, 0, 120) . '...';
    }
    public function getButton(): string
    {
        return <<<HTML
        <button><a href="/posts/$this->id">Lire plus</a></button>
        HTML;
    }
    public function getTags(){
        return $this->query("SELECT t.* FROM tags t
                            INNER JOIN post_tag pt                                                         
                            ON pt.tag_id = t.id
                            INNER JOIN posts p 
                            ON pt.post_id = p.id
                            WHERE p.id = ?",
                            $this->id);
    }
}
