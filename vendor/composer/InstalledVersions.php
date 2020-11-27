<?php

namespace MolliePrefix\Composer;

use MolliePrefix\Composer\Semver\VersionParser;
class InstalledVersions
{
    private static $installed = array('root' => array('pretty_version' => '4.1.1.x-dev', 'version' => '4.1.1.9999999-dev', 'aliases' => array(), 'reference' => '3a567ac8d9a9aca33e9a0099fd21d1a39cc5378b', 'name' => 'mollie/prestashop'), 'versions' => array('composer/ca-bundle' => array('pretty_version' => '1.2.8', 'version' => '1.2.8.0', 'aliases' => array(), 'reference' => '8a7ecad675253e4654ea05505233285377405215'), 'guzzlehttp/guzzle' => array('pretty_version' => '6.5.5', 'version' => '6.5.5.0', 'aliases' => array(), 'reference' => '9d4290de1cfd701f38099ef7e183b64b4b7b0c5e'), 'guzzlehttp/promises' => array('pretty_version' => '1.4.0', 'version' => '1.4.0.0', 'aliases' => array(), 'reference' => '60d379c243457e073cff02bc323a2a86cb355631'), 'guzzlehttp/psr7' => array('pretty_version' => '1.7.0', 'version' => '1.7.0.0', 'aliases' => array(), 'reference' => '53330f47520498c0ae1f61f7e2c90f55690c06a3'), 'mollie/mollie-api-php' => array('pretty_version' => 'v2.24.0', 'version' => '2.24.0.0', 'aliases' => array(), 'reference' => '52bd606724109906d61226698c8b031ccae9e637'), 'mollie/prestashop' => array('pretty_version' => '4.1.1.x-dev', 'version' => '4.1.1.9999999-dev', 'aliases' => array(), 'reference' => '3a567ac8d9a9aca33e9a0099fd21d1a39cc5378b'), 'paragonie/random_compat' => array('pretty_version' => 'v2.0.19', 'version' => '2.0.19.0', 'aliases' => array(), 'reference' => '446fc9faa5c2a9ddf65eb7121c0af7e857295241'), 'prestashop/decimal' => array('pretty_version' => '1.4.0', 'version' => '1.4.0.0', 'aliases' => array(), 'reference' => '188028580f4b551c126d1d723578f3ee88008e95'), 'psr/cache' => array('pretty_version' => '1.0.1', 'version' => '1.0.1.0', 'aliases' => array(), 'reference' => 'd11b50ad223250cf17b86e38383413f5a6764bf8'), 'psr/cache-implementation' => array('provided' => array(0 => '1.0')), 'psr/container' => array('pretty_version' => '1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => 'b7ce3b176482dbbc1245ebf52b181af44c2cf55f'), 'psr/container-implementation' => array('provided' => array(0 => '1.0')), 'psr/http-message' => array('pretty_version' => '1.0.1', 'version' => '1.0.1.0', 'aliases' => array(), 'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363'), 'psr/http-message-implementation' => array('provided' => array(0 => '1.0')), 'psr/log' => array('pretty_version' => '1.1.3', 'version' => '1.1.3.0', 'aliases' => array(), 'reference' => '0f73288fd15629204f9d42b7055f72dacbe811fc'), 'psr/simple-cache' => array('pretty_version' => '1.0.1', 'version' => '1.0.1.0', 'aliases' => array(), 'reference' => '408d5eafb83c57f6365a3ca330ff23aa4a5fa39b'), 'psr/simple-cache-implementation' => array('provided' => array(0 => '1.0')), 'ralouphie/getallheaders' => array('pretty_version' => '3.0.3', 'version' => '3.0.3.0', 'aliases' => array(), 'reference' => '120b605dfeb996808c31b6477290a714d356e822'), 'symfony/cache' => array('pretty_version' => 'v3.4.46', 'version' => '3.4.46.0', 'aliases' => array(), 'reference' => 'a7a14c4832760bd1fbd31be2859ffedc9b6ff813'), 'symfony/config' => array('pretty_version' => 'v3.4.46', 'version' => '3.4.46.0', 'aliases' => array(), 'reference' => 'bc6b3fd3930d4b53a60b42fe2ed6fc466b75f03f'), 'symfony/dependency-injection' => array('pretty_version' => 'v3.4.46', 'version' => '3.4.46.0', 'aliases' => array(), 'reference' => '51d2a2708c6ceadad84393f8581df1dcf9e5e84b'), 'symfony/expression-language' => array('pretty_version' => 'v3.4.46', 'version' => '3.4.46.0', 'aliases' => array(), 'reference' => 'de38e66398fca1fcb9c48e80279910e6889cb28f'), 'symfony/filesystem' => array('pretty_version' => 'v3.4.46', 'version' => '3.4.46.0', 'aliases' => array(), 'reference' => 'e58d7841cddfed6e846829040dca2cca0ebbbbb3'), 'symfony/polyfill-apcu' => array('pretty_version' => 'v1.19.0', 'version' => '1.19.0.0', 'aliases' => array(), 'reference' => 'b44b51e7814c23bfbd793a16ead5d7ce43ed23c5'), 'symfony/polyfill-ctype' => array('pretty_version' => 'v1.19.0', 'version' => '1.19.0.0', 'aliases' => array(), 'reference' => 'aed596913b70fae57be53d86faa2e9ef85a2297b'), 'symfony/polyfill-intl-idn' => array('pretty_version' => 'v1.19.0', 'version' => '1.19.0.0', 'aliases' => array(), 'reference' => '4ad5115c0f5d5172a9fe8147675ec6de266d8826'), 'symfony/polyfill-intl-normalizer' => array('pretty_version' => 'v1.19.0', 'version' => '1.19.0.0', 'aliases' => array(), 'reference' => '8db0ae7936b42feb370840cf24de1a144fb0ef27'), 'symfony/polyfill-mbstring' => array('pretty_version' => 'v1.19.0', 'version' => '1.19.0.0', 'aliases' => array(), 'reference' => 'b5f7b932ee6fa802fc792eabd77c4c88084517ce'), 'symfony/polyfill-php70' => array('pretty_version' => 'v1.19.0', 'version' => '1.19.0.0', 'aliases' => array(), 'reference' => '3fe414077251a81a1b15b1c709faf5c2fbae3d4e'), 'symfony/polyfill-php72' => array('pretty_version' => 'v1.19.0', 'version' => '1.19.0.0', 'aliases' => array(), 'reference' => 'beecef6b463b06954638f02378f52496cb84bacc'), 'symfony/yaml' => array('pretty_version' => 'v3.4.46', 'version' => '3.4.46.0', 'aliases' => array(), 'reference' => '88289caa3c166321883f67fe5130188ebbb47094')));
    public static function getInstalledPackages()
    {
        return \array_keys(self::$installed['versions']);
    }
    public static function isInstalled($packageName)
    {
        return isset(self::$installed['versions'][$packageName]);
    }
    public static function satisfies(\MolliePrefix\Composer\Semver\VersionParser $parser, $packageName, $constraint)
    {
        $constraint = $parser->parseConstraints($constraint);
        $provided = $parser->parseConstraints(self::getVersionRanges($packageName));
        return $provided->matches($constraint);
    }
    public static function getVersionRanges($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        $ranges = array();
        if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            $ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
        }
        if (\array_key_exists('aliases', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
        }
        if (\array_key_exists('replaced', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
        }
        if (\array_key_exists('provided', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
        }
        return \implode(' || ', $ranges);
    }
    public static function getVersion($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['version'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['version'];
    }
    public static function getPrettyVersion($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['pretty_version'];
    }
    public static function getReference($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['reference'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['reference'];
    }
    public static function getRootPackage()
    {
        return self::$installed['root'];
    }
    public static function getRawData()
    {
        return self::$installed;
    }
    public static function reload($data)
    {
        self::$installed = $data;
    }
}
