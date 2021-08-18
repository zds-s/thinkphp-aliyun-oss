<?php
/**
 * @author    : Death-Satan
 * @date      : 2021/8/18
 * @createTime: 21:32
 * @company   : Death撒旦
 * @link      https://www.cnblogs.com/death-satan
 */


namespace think\filesystem\driver;


use League\Flysystem\AdapterInterface;
use think\filesystem\Driver;
use Xxtime\Flysystem\Aliyun\OssAdapter;

/**
 * 阿里云oss driver
 * Class Aliyun
 * @package think\filesystem\driver
 */
class Aliyun extends Driver
{
    protected function createAdapter (): AdapterInterface
    {
        return new OssAdapter($this->config);
    }
}