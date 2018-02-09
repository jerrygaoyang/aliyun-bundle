<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2018/2/8
 * Time: 17:54
 */

namespace Aliyun\bundle;

use Aliyun\Core\Client;
use Aliyun\Push\Request\V20160801\PushRequest;


class Push
{
    public $client;

    public function __construct($accessKeyId, $accessKeySecret, $region)
    {
        $this->client = Client::init($accessKeyId, $accessKeySecret, $region);
    }

    /**
     * @param $appKey
     * @param $title
     * @param $body
     * @param $target
     * @param $targetValue
     * @param $pushType
     * @param $extParameters
     * @param string $iOSApnsEnv
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function send($appKey, $title, $body, $target, $targetValue, $pushType, $extParameters, $iOSApnsEnv = 'DEV')
    {
        $request = new PushRequest();
        // TODO 推送目标
        $request->setAppKey($appKey);
        //推送目标: DEVICE:推送给设备; ACCOUNT:推送给指定帐号,TAG:推送给自定义标签; ALL: 推送给全部
        $request->setTarget($target);
        //根据Target来设定，如Target=device, 则对应的值为 设备id1,设备id2. 多个值使用逗号分隔.(帐号与设备有一次最多100个的限制)
        $request->setTargetValue($targetValue);
        //消息类型 MESSAGE NOTICE
        $request->setPushType($pushType);
        // 消息的标题
        $request->setTitle($title);
        // 消息的内容
        $request->setBody($body);
        //设备类型 ANDROID iOS ALL.
        $request->setDeviceType("ALL");

        // TODO 推送配置: iOS
        //iOS的通知是通过APNs中心来发送的，需要填写对应的环境信息。"DEV" : 表示开发环境 "PRODUCT" : 表示生产环境
        $request->setiOSApnsEnv($iOSApnsEnv);
        //自定义的kv结构,开发者扩展用 针对iOS设备
        $request->setiOSExtParameters(json_encode($extParameters));
        // iOS应用图标右上角角标
        //$request->setiOSBadge("5");
        // iOS通知声音
        //$request->setiOSMusic("default");
        // 推送时设备不在线（既与移动推送的服务端的长连接通道不通），则这条推送会做为通知，通过苹果的APNs通道送达一次(发送通知时,Summary为通知的内容,Message不起作用)。注意：离线消息转通知仅适用于生产环境
        //$request->setiOSRemind("false");
        //iOS消息转通知时使用的iOS通知内容，仅当iOSApnsEnv=PRODUCT && iOSRemind为true时有效
        //$request->setiOSRemindBody("iOSRemindBody");


        // TODO 推送配置: Android
        $request->setAndroidExtParameters(json_encode($extParameters)); // 设定android类型设备通知的扩展属性
        //通知的提醒方式 "VIBRATE" : 震动 "SOUND" : 声音 "BOTH" : 声音和震动 NONE : 静音
        //$request->setAndroidNotifyType("NONE");
        //通知栏自定义样式0-100
        //$request->setAndroidNotificationBarType(1);
        //点击通知后动作 "APPLICATION" : 打开应用 "ACTIVITY" : 打开AndroidActivity "URL" : 打开URL "NONE" : 无跳转
        //$request->setAndroidOpenType("URL");
        //Android收到推送后打开对应的url,仅当AndroidOpenType="URL"有效
        //$request->setAndroidOpenUrl("http://www.aliyun.com");
        //设定通知打开的activity，仅当AndroidOpenType="Activity"有效
        //$request->setAndroidActivity("com.ali.demo.OpenActivity");
        //Android通知音乐
        //$request->setAndroidMusic("default");
        //设置该参数后启动辅助托管弹窗功能, 此处指定通知点击后跳转的Activity（辅助弹窗的前提条件：1. 集成第三方辅助通道；2. StoreOffline参数设为true
        //$request->setAndroidPopupActivity("com.ali.demo.PopupActivity");

        // TODO 推送控制
        //延迟0秒发送
        $pushTime = gmdate('Y-m-d\TH:i:s\Z', strtotime('+0 second'));
        $request->setPushTime($pushTime);
        //设置失效时间为1天
        $expireTime = gmdate('Y-m-d\TH:i:s\Z', strtotime('+1 day'));
        $request->setExpireTime($expireTime);
        // 离线消息是否保存,若保存, 在推送时候，用户即使不在线，下一次上线则会收到
        //$request->setStoreOffline("false");

        $response = $this->client->getAcsResponse($request);
        return $response;
    }
}