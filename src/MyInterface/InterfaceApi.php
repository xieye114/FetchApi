<?php

namespace YYY\FetchApi\Pay\MyInterface;


/**
 * 通用错误接口
 *
 */
interface InterfaceApi
{

    public function fetch();  // 抓取。
    public function is_valid():bool; // 校验抓取结果是否正确。
    public function init(); // 初始化对象

     // 实际中，为了使用方便，这个接口不确定返回值，由每个实现类自己处理。
    public function get();
}

