# thinkphp6 阿里云oss

基于 [xxtime/flysystem-aliyun-oss](https://github.com/xxtime/flysystem-aliyun-oss) 轻度封装tp

## 初始化
### 修改配置 *config/filesystem.php* 文件

---
```php
<?php

return [
    // 默认磁盘
    'default' => env('filesystem.driver', 'local'),
    // 磁盘列表
    'disks'   => [
        'local'  => [
            'type' => 'local',
            'root' => app()->getRuntimePath() . 'storage',
        ],
        'public' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . 'public/storage',
            // 磁盘路径对应的外部URL路径
            'url'        => '/storage',
            // 可见性
            'visibility' => 'public',
        ],
        //新增一个阿里云磁盘
        'aliyun'=>[
            'type'=>'Aliyun',//驱动使用阿里云
            'accessId'       => '<aliyun access id>',
            'accessSecret'   => '<aliyun access secret>',
            'bucket'         => '<bucket name>',
            'endpoint'       => '<endpoint address>',
            // 'timeout'        => 3600,
            // 'connectTimeout' => 10,
            // 'isCName'        => false,
            // 'token'          => '',
        ]
        // 更多的磁盘配置信息
    ],
];

```
---

## 使用方法
### 通过filesystem使用

---
```php 
//通过门面使用
think\facade\Filesystem::disk('aliyun')
//在控制器中通过注入使用
class TestControl{

    public function Test(\think\Filesystem $filesystem)
    {
        $aliyun = $filesystem->disk('aliyun');
    }
}
```
---

### 文件上传

```php 
<?php
namespace app\controller;

use app\BaseController;
use app\Request;
use think\facade\Filesystem;

class Index extends BaseController
{
    public function index(Request $request)
    {
        //获取上传文件
        $file = $request->file('image');
        //通过filesystem进行上传
        $url = Filesystem::disk('aliyun')->putFile('images', $file);
        if (!$url) new \exception('上传失败');

        dd('上传成功,文件位置:' . $url);
    }
}
```