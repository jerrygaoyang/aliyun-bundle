<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2018/2/9
 * Time: 11:09
 */

namespace Aliyun\bundle;

use Aliyun\Core\Client;
use Aliyun\Iot\Request\V20170420\ApplyDeviceWithNamesRequest;
use Aliyun\Iot\Request\V20170420\BatchGetDeviceStateRequest;
use Aliyun\Iot\Request\V20170420\CreateProductRequest;
use Aliyun\Iot\Request\V20170420\DeleteDevicePropRequest;
use Aliyun\Iot\Request\V20170420\GetDeviceShadowRequest;
use Aliyun\Iot\Request\V20170420\PubBroadcastRequest;
use Aliyun\Iot\Request\V20170420\PubRequest;
use Aliyun\Iot\Request\V20170420\QueryApplyStatusRequest;
use Aliyun\Iot\Request\V20170420\QueryDeviceByNameRequest;
use Aliyun\Iot\Request\V20170420\QueryDevicePropRequest;
use Aliyun\Iot\Request\V20170420\QueryDeviceRequest;
use Aliyun\Iot\Request\V20170420\QueryPageByApplyIdRequest;
use Aliyun\Iot\Request\V20170420\RegistDeviceRequest;
use Aliyun\Iot\Request\V20170420\RRpcRequest;
use Aliyun\Iot\Request\V20170420\SaveDevicePropRequest;
use Aliyun\Iot\Request\V20170420\UpdateDeviceShadowRequest;
use Aliyun\Iot\Request\V20170420\UpdateProductRequest;


class Iot
{
    public $client;

    public function __construct($accessKeyId, $accessKeySecret, $region)
    {
        $this->client = Client::init($accessKeyId, $accessKeySecret, $region);
    }

    /**
     * 创建产品
     * @param $productName
     * @param $productDesc
     * @return mixed pk
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function createProduct($productName, $productDesc)
    {
        $request = new CreateProductRequest();
        $request->setName($productName);
        $request->setDesc($productDesc);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 修改产品
     * @param $productKey
     * @param $productName
     * @param $productDesc
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function updateProduct($productKey, $productName, $productDesc)
    {
        $request = new UpdateProductRequest();
        $request->setProductName($productName);
        $request->setProductDesc($productDesc);
        $request->setProductKey($productKey);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 注册设备
     * @param $productKey
     * @param $deviceName
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function registerDevice($productKey, $deviceName)
    {
        $request = new RegistDeviceRequest();
        $request->setProductKey($productKey);
        $request->setDeviceName($deviceName);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 根据devicename查询设备
     * @param $productKey
     * @param $deviceName
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function queryDeviceByName($productKey, $deviceName)
    {
        $request = new QueryDeviceByNameRequest();
        $request->setProductKey($productKey);
        $request->setDeviceName($deviceName);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 分页查询deivce
     * @param $productKey
     * @param $pageSize
     * @param $currentPage
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function queryDevice($productKey, $pageSize, $currentPage)
    {
        $request = new QueryDeviceRequest();
        $request->setProductKey($productKey);
        $request->setPageSize($pageSize);
        $request->setCurrentPage($currentPage);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 批量申请设备
     * @param $productKey
     * @param $deviceNames
     * @return mixed
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function applyDeviceWithNames($productKey, $deviceNames)
    {
        $request = new ApplyDeviceWithNamesRequest();
        $request->setProductKey($productKey);
        $request->setDeviceNames($deviceNames);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 查询申请单执行状态
     * @param $applyId
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function queryApplyStatus($applyId)
    {
        $request = new QueryApplyStatusRequest();
        $request->setApplyId($applyId);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 分页查询申请的设备
     * @param $applyId
     * @param $currentPage
     * @param $pageSize
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function queryPageByApplyId($applyId, $currentPage, $pageSize)
    {
        $request = new QueryPageByApplyIdRequest();
        $request->setApplyId($applyId);
        $request->setCurrentPage($currentPage);
        $request->setPageSize($pageSize);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 批量查询设备状态
     * @param $productKey
     * @param $deviceNames
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function batchGetDeviceStatus($productKey, $deviceNames)
    {
        $request = new BatchGetDeviceStateRequest();
        $request->setProductKey($productKey);
        $request->setDeviceNames($deviceNames);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 更新设备影子
     * @param $productKey
     * @param $deviceName
     * @param $shadowMessage
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function updateDeviceShadow($productKey, $deviceName, $shadowMessage)
    {
        $request = new UpdateDeviceShadowRequest();
        $request->setProductKey($productKey);
        $request->setDeviceName($deviceName);
        $request->setShadowMessage(json_encode($shadowMessage));
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 获取设备影子
     * @param $productKey
     * @param $deviceName
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function getDeviceShadow($productKey, $deviceName)
    {
        $request = new GetDeviceShadowRequest();
        $request->setProductKey($productKey);
        $request->setDeviceName($deviceName);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**查询设备属性  -- 目前只有华东2支持
     * @param $productKey
     * @param $deviceName
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function queryDeviceProp($productKey, $deviceName)
    {
        $request = new QueryDevicePropRequest();
        $request->setProductKey($productKey);
        $request->setDeviceName($deviceName);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**保存设备属性 -- 目前只有华东2支持
     * @param $productKey
     * @param $deviceName
     * @param $props
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function saveDeviceProp($productKey, $deviceName, $props)
    {
        $request = new SaveDevicePropRequest();
        $request->setProductKey($productKey);
        $request->setDeviceName($deviceName);
        $request->setProps(json_encode($props));
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**删除设备属性  -- 目前只有华东2支持
     * @param $productKey
     * @param $deviceName
     * @param $propKey
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function deleteDeviceProp($productKey, $deviceName, $propKey)
    {
        $request = new DeleteDevicePropRequest();
        $request->setProductKey($productKey);
        $request->setDeviceName($deviceName);
        $request->setPropKey($propKey);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 发送消息
     * @param $productKey
     * @param $deviceName
     * @param $messageContent
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function pub($productKey, $deviceName, $messageContent)
    {
        $request = new PubRequest();
        $topic = "/" . $productKey . "/" . $deviceName . "/get";
        $request->setProductKey($productKey);
        $request->setTopicFullName($topic);
        $request->setMessageContent(base64_encode($messageContent));
        $request->setQos(0);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * 发送广播消息
     * @param $productKey
     * @param $messageContent
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function pubBroadcast($productKey, $messageContent)
    {
        $request = new PubBroadcastRequest();
        $topic = "/broadcast/" . $productKey . "/";
        $request->setProductKey($productKey);
        $request->setTopicFullName($topic);
        $request->setMessageContent(base64_encode($messageContent));
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

    /**
     * rrpc请求  需要配合设备端一同使用才会成功
     * @param $productKey
     * @param $deviceName
     * @param $requestBase64Byte
     * @return mixed|\SimpleXMLElement
     * @throws \Aliyun\Core\Exception\ClientException
     */
    public function rrpc($productKey, $deviceName, $requestBase64Byte)
    {
        $request = new RRpcRequest();
        $request->setProductKey($productKey);
        $request->setDeviceName($deviceName);
        $request->setRequestBase64Byte(base64_encode($requestBase64Byte));
        $request->setTimeout(5000);
        $response = $this->client->getAcsResponse($request);
        return $response;
    }

}