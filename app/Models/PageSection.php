<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;
    protected $table = 'page_section';
    protected $fillable = [
          'id',
          'page_id',
          'title',
          'image',
          'image_path',
          'description',
          'section'
         ];

    // public function cms_pages()
    // {
    //     return $this->hasMany('App\Models\CmsPage');
    // }
}
