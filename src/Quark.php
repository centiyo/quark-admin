<?php

namespace QuarkCMS\QuarkAdmin;
use QuarkCMS\QuarkAdmin\Layout;

/**
 * Class Quark.
 */
class Quark
{
    /**
     * Get the current quark version.
     *
     * @return string
     */
    public function version()
    {
        return '1.0.0';
    }

    /**
     * Get the current quark info.
     *
     * @return string
     */
    public function info()
    {
        return [
            'version' => $this->version(),
            'name' => config('admin.name'),
            'logo' => config('admin.logo'),
            'description' => config('admin.description'),
            'captcha_driver' => config('admin.captcha_driver'),
            'tencent_captcha_appid' => config('admin.tencent_captcha.appid'),
            'iconfont_url' => config('admin.iconfont_url'),
            'copyright' => config('admin.copyright'),
            'links' => config('admin.links'),
        ];
    }

    /**
     * Get the current quark layout.
     *
     * @return string
     */
    public function layout()
    {
        $layout = new Layout;

        $layout->title(config('admin.name'));
        $layout->logo(config('admin.logo'));
        $layout->layout(config('admin.layout.layout'));
        $layout->contentWidth(config('admin.layout.content_width'));
        $layout->navTheme(config('admin.layout.nav_theme'));
        $layout->fixedHeader(config('admin.layout.fixed_header'));
        $layout->fixSiderbar(config('admin.layout.fix_siderbar'));
        $layout->iconfontUrl(config('admin.layout.iconfont_url'));
        $layout->locale(config('admin.layout.locale'));
        $layout->siderWidth(config('admin.layout.sider_width'));
        $layout->collapsed(config('admin.layout.collapsed'));

        // unset($layout->component);

        return $layout;
    }

    /**
     * Dynamically proxy method calls.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return void
     */
    public function __call($method, $parameters)
    {
        $getCalledClass = __NAMESPACE__.'\\'.ucwords($method);

        if(!class_exists($getCalledClass)) {
            throw new \Exception("Class {$method} does not exist.");
        }

        return new $getCalledClass($parameters);
    }
}
