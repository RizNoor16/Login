<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;

    protected $table = 'cms_pages';
    protected $fillable = [
          'id',
          'title',
          'slug'
         ];

    public function page_section()
    {
       return $this->hasMany('App\Models\PageSection');
    }
}
