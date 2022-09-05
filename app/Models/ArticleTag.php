<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ArticleTag
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleTag query()
 * @mixin \Eloquent
 */
class ArticleTag extends Model
{
    protected $fillable = ['article_id', 'tag_id'];

    public $timestamps = false;

}
