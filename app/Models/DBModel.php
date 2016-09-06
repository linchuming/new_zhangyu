<?php
/**
 * Created by PhpStorm.
 * User: cmlin
 * Date: 2016/9/2
 * Time: 16:55
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DBModel extends Model
{
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = '';
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'Fid';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

}