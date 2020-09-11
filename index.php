<?php

require 'vendor/autoload.php';
use Alipay\EasySDK\Kernel\Factory;
use Alipay\EasySDK\Kernel\Util\ResponseChecker;
use Alipay\EasySDK\Kernel\Config;

//1. 设置参数（全局只需设置一次）
Factory::setOptions(getOptions());
try {
    //2. 发起API调用（以手机APP支付生成订单串为例，再使用客户端 SDK 凭此串唤起支付宝收银台）
    $result = Factory::payment()->App()->pay("iPhone6 16G", "20200326235526002", "0.01");
    $responseChecker = new ResponseChecker();
    //3. 处理响应或异常
    if ($responseChecker->success($result)) {
        echo "调用成功,支付串为：". PHP_EOL.$result->body;
    } else {
        echo "调用失败，原因：". $result->msg."，".$result->subMsg.PHP_EOL;
    }
} catch (Exception $e) {
    echo "调用失败，". $e->getMessage(). PHP_EOL;;
}

function getOptions()
{
    $options = new Config();
    $options->protocol = 'https';
    $options->gatewayHost = 'openapi.alipaydev.com';
    $options->signType = 'RSA2';
    $options->appId = '2021000118645315';
    // 为避免私钥随源码泄露，推荐从文件中读取私钥字符串而不是写入源码中
    $options->merchantPrivateKey = 'MIIEowIBAAKCAQEAp+ntiMBS5BXpvopA2j7ZIXtL7uMMR+FOwtwUVGhrz++3Vcn7RXeQSjB5lc5KXQGwAuqjQEyGKlTCIuwVyharYlG1kjtFNwFwAhiY9sxjNz2+XF4wWzaxQpa1QNeaaNCbwrL3DiVlJi2YRczlQVt5LtdQrGlElBCvHWQQGe6+8Y3trtglBA1ocLkrGzaI6rQqTxbcsOY4BydXgceQFelHRSGD8C/oZ7Is81xvaYDsGqboZmCu6vicpphTceZ82JuXxv7gPyylHT90YSBA4eINLS7rL4xDPchwkS8x1TFGGbr22Bhty28C2A7hcdchlmWnatojKR2hSLf+lKCfoRfreQIDAQABAoIBAAUKKV30X8iGu9hDMAUc48l0eOf3mpPBuGpyzo1mAO5hxH/nqwn/t63yXIPZiDPYbB76SeIRKem1V4pSyaiiG4y85RU5gC9RdLorYNPveH7c9IyzKwJh1tonydLjZbgFotcqJe4fwzRtI+fcaXkXtMBqJ/q0wiEriwX3zd/pYYPAcUVgr15qzLeuUSFT/VRP78Oew8MzWTLxBTcy/iSo+THTgI8qbA5PgAqP3kLtJPVnj0o5s5Ir8noBCV6aYdNany5Zx61atzZh581uK3XopEmtn9JHq8Y7sTsRZ/oIc7kkoVKGESOqJS//eRslD36GPDquHj2+xTu19I7RM5rcWV0CgYEA4zN+rxaAnEVwLuX40F9crcNG+geWhPYlPR7FWIGQiXYY8IO8Jlwd3cpSki4HBjH3fEpbd2zpoExi8VHIeeOLPDxhltSQSKOiQiV3T560me9DWxz0OFqgkADp6nSuHQXpwBcC70Z5INXdMSPmgR4xg3zIqpMsY8mfUe/+xrng+3sCgYEAvTKaTpwvmC1+PXVCD3GJtqZLFdBXU4AgJY0E59gjZmAv9du7DMjfGSQazmwZNqi3JAkmbk0OQCpgrHyN4e8mJxh67JqVhRF7EtLlFbGHfJIjEho1YjqN2jev/m/xr/Z88qrHMHdCCdCm8CBd3hVTqwi0CREwwUXv5z0yQYiaeJsCgYBYdFTu/7jEnnglmh07qtTfRbadY1TjoR0wZYl5gr/t9I+THAalfJmYHsv043ySmeN7fUuM/FcctICU6T0+zysHIY7w9QLTdPmX/RQtaGFxyOgVUfl28zmttt1bDWA4JnQx+AOJeotwEDNUjWCRhlrKkUtitXfDxdyEPwaXAgkofwKBgHcFOmVxg89r7xqihWhJuKSagGm8ovL4i0CUMh3Xro1cvU8hZ85nH1IlkGeDQWlNQcj9qJuDBg//mMlpoagcVhgKImpt5NnNYWs6GLtI7z7CgCWHL0YYJ9y7Y4/gxF455eiS3rPykiyyghJVijeHmxbhZsC9e7paUM1bhh4L3YE5AoGBANuAOveiWp2nahETI3+HFKdj12JhEVBDt38EISoaF8Wj9YwxgrXxMZh+2dnU4vjrlHoArKO7RURHceIrIc6hrUPeoJaqZeEoNoVysyunwYg45+BAFKd+ckds9q1UAY6Who50U3k9Vop+F1NBLHfBxU8c1GvDXlTsbeJAUzJUFfRB';
    $options->alipayCertPath = 'D:\codes\alipay\easysdk\alipayCertPublicKey_RSA2.crt';
    $options->alipayRootCertPath = 'D:\codes\alipay\easysdk\alipayRootCert.crt';
    $options->merchantCertPath = 'D:\codes\alipay\easysdk\appCertPublicKey_2021000118645315.crt';
    //注：如果采用非证书模式，则无需赋值上面的三个证书路径，改为赋值如下的支付宝公钥字符串即可
    // $options->alipayPublicKey = '<-- 请填写您的支付宝公钥，例如：MIIBIjANBg... -->';
    //可设置异步通知接收服务地址（可选）
    // $options->notifyUrl = "";
    //可设置AES密钥，调用AES加解密相关接口时需要（可选）
    // $options->encryptKey = "";
    return $options;
}