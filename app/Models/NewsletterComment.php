<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterComment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'newsletter_id', 'comment'];
}
