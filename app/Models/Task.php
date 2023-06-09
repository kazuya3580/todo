<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    /**
     * 状態定義
     */
    const STATUS = [
        1 => [ 'label' => '未着手' , 'class' => 'label-danger' , 'style' => ''],
        2 => [ 'label' => '着手中' , 'class' => 'label-info' , 'style' => ''],
        3 => [ 'label' => '完了' , 'class' => '' , 'style' => 'background-color: #fff;'],
    ];

    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }
}
