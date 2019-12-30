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

// 假表示失败。其余表示成功,这是获取最终结果的通用方法。
    // 统一使用 xxx->get() !== false 这样来判断。
    public function get();
}

