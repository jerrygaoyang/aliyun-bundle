<?php

namespace Aliyun\bundle;

use Aliyun\Core\Client;
use Aliyun\Sms\Request\V20170525\SendSmsRequest;

/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2018/2/8
 * Time: 16:59
 */
class Sms
{
    public $client;

    public function __construct($accessKeyId, $accessKeySecret, $region)
    {
        $this->client = Client::init($accessKeyId, $accessKeySecret, $region);
    }

    /**
     * 发送短信
     * @param $PhoneNumbers
     * @param $SignName
     * @param $TemplateCode
     * @param $TemplateParam
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function send($PhoneNumbers, $SignName, $TemplateCode, $TemplateParam)
    {
        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($PhoneNumbers);

        // 必填，设置签名名称，应严格按"签名名称"填写
        // 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName($SignName);

        // 必填，设置模板CODE，应严格按"模板CODE"填写
        // 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode($TemplateCode);

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        // 短信模板中字段的值
        $request->setTemplateParam(json_encode($TemplateParam, JSON_UNESCAPED_UNICODE));

        // 可选，设置流水号
        // $request->setOutId("yourOutId");

        // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
        // $request->setSmsUpExtendCode("1234567");

        // 发起访问请求
        $acsResponse = $this->client->getAcsResponse($request);

        return $acsResponse;
    }
}