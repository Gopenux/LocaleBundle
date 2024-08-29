<?php
/**
 * This file is part of the LuneticsLocaleBundle package.
 *
 * <https://github.com/lunetics/LocaleBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that is distributed with this source code.
 */
namespace Lunetics\LocaleBundle\Cookie;

use Symfony\Component\HttpFoundation\Cookie;

/**
 * @author Christophe Willemsen <willemsen.christophe@gmail.com/>
 */
class LocaleCookie
{
    private $name;
    private $ttl;
    private $path;
    private $secure;
    private $httpOnly;
    private $setOnChange;
    private $domain;

    public function __construct($name, $ttl, $path, $secure, $httpOnly, $setOnChange, $domain = null)
    {
        $this->name = $name;
        $this->ttl = $ttl;
        $this->path = $path;
        $this->secure = $secure;
        $this->httpOnly = $httpOnly;
        $this->setOnChange = $setOnChange;
        $this->domain = $domain;
    }

    public function getLocaleCookie($locale)
    {
        $value = $locale;
        $expire = $this->computeExpireTime();
        $cookie = new Cookie(
            $this->name,
            $value,
            $expire,
            $this->path,
            $this->domain,
            $this->secure,
            $this->httpOnly,
            false, /** TODO Defined From Value Default In Constructor Cookie Change By Update Symfony 5.x */
            null /** TODO Defined From Value Default In Constructor Cookie Change By Update Symfony 5.x */
        );

        return $cookie;
    }

    public function setCookieOnChange()
    {
        return $this->setOnChange;
    }

    private function computeExpireTime()
    {
        $expiretime = time() + $this->ttl;
        $date = new \DateTime();
        $date->setTimestamp($expiretime);

        return $date;
    }

    public function getName()
    {
        return $this->name;
    }
}
