<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // public $timestamps = false;
    // protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'status',
        'attached_images',
    ];

    protected $appends = [
        'filesCount',
    ];

    public function files() {
        return $this->hasMany(File::class);
    }

    public function getFilesCountAttribute() {
        return count($this->files);
    }
}



