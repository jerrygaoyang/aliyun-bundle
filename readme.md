## aliyun-bundle （集合版）


### 阿里云服务SDK集合版, 并包含 api 整合


* aliyun-core   (阿里云核心包)

* aliyun-push   (阿里云移动推送)

* aliyun-iot    (阿里云IOT物联网套件)

* aliyun-sms    (阿里云短信)


### 阿里云短信 api

```
use Aliyun\bundle\Sms;

$accessKeyId = ''; 
$accessKeySecret = ''; 
$region = 'cn-hangzhou';

$sms = new Sms($accessKeyId, $accessKeySecret, $region);

$PhoneNumbers = ''; 
$SignName = ''; 
$TemplateCode = ''; 
$TemplateParam = '';

$res = sms->send($PhoneNumbers, $SignName, $TemplateCode, $TemplateParam);
print_r($res);

```


### 阿里云推送


```
use Aliyun\bundle\Push;

$accessKeyId = ''; 
$accessKeySecret = ''; 
$region = 'cn-hangzhou';

$push = new Push($accessKeyId, $accessKeySecret, $region);

$res = $push->send($appKey, $title, $body, $target, $targetValue, $pushType, $extParameters);
print_r($res);
```


### 阿里云IOT物联网套件


```
use Aliyun\bundle\Push;

$accessKeyId = ''; 
$accessKeySecret = ''; 
$region = 'cn-shanghai';

$iot = new Iot($accessKeyId, $accessKeySecret, $region);

//以下方法参数变量自己定义;这里忽略不定义了

//创建产品
$this->createProduct($productName, $productDesc);

//修改产品
$this->updateProduct($productKey, $productName, $productDesc);

//注册设备
$this->registerDevice($productKey, $deviceName);

//根据devicename查询设备
$this->queryDeviceByName($productKey, $deviceName);

//分页查询deivce
$this->queryDevice($productKey, $pageSize, $currentPage);

//批量申请设备
$this->applyDeviceWithNames($productKey, $deviceNames);

//查询申请单执行状态
$this->queryApplyStatus($applyId);

//分页查询申请的设备
$this->queryPageByApplyId($applyId, $currentPage, $pageSize);

//批量查询设备状态
$this->batchGetDeviceStatus($productKey, $deviceNames)

//更新设备影子
$this->updateDeviceShadow($productKey, $deviceName, $shadowMessage);

//获取设备影子
$this->getDeviceShadow($productKey, $deviceName);

//查询设备属性  -- 目前只有华东2支持
$this->queryDeviceProp($productKey, $deviceName);

//保存设备属性 -- 目前只有华东2支持
$this->saveDeviceProp($productKey, $deviceName, $props);

//删除设备属性  -- 目前只有华东2支持
$this->deleteDeviceProp($productKey, $deviceName, $propKey);

//发送消息
$this->pub($productKey, $deviceName, $messageContent);

//发送广播消息
$this->pubBroadcast($productKey, $messageContent);

//rrpc请求  需要配合设备端一同使用才会成功
$this->rrpc($productKey, $deviceName, $requestBase64Byte);
```

  