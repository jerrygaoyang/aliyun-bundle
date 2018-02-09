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

  