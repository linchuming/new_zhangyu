<?php
/**
 * Created by PhpStorm.
 * User: cmlin
 * Date: 2016/9/2
 * Time: 17:12
 */

namespace App\Models;

class Join extends DBModel
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 't_join';
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'Fjoin_id';
}