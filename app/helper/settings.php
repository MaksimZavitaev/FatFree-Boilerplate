<?php

namespace Helper;

class Settings extends \Prefab
{
    protected
        $fw,
        $cache,
        $settings = array();

    function __construct()
    {
        $this->fw = \Base::instance();
        $this->cache = \Cache::instance();
        $this->getSettings();
    }

    /**
     * Получает все настройки из БД и кеширует их
     */
    function getSettings()
    {
        if (!$this->cache->exists('settings')) {
            $result = $this->fw->get('db.instance')->exec('SELECT `key`, `value` FROM settings');
            foreach ($result as $item) {
                $this->settings[$item['key']] = json_decode($item['value'], true) ?: $item['value']; // Если строка валидный JSON, то декодируем
            }
            $this->cache->set('settings', $this->settings, $this->fw->get('cache_expire.settings'));
        } else {
            $this->settings = $this->cache->get('settings');
        }

        $this->fw->mset($this->settings);

        return true;
    }

    /**
     * Возвращеает значение по ключу или FALSE
     * @param $key
     * @return mixed
     */
    function get($key)
    {
        return isset($this->settings[$key]) ? $this->settings[$key] : false;
    }

    /**
     * Добавляет настройку в БД
     * @param $key
     * @param $value
     * @return mixed
     */
    function set($key, $value)
    {
        if (isset($this->settings[$key])) {
            $sql = 'UPDATE `settings` SET `value` = :value WHERE `key` = :key';
        } else {
            $sql = 'INSERT INTO `settings` (`key`, `value`) VALUES (:key, :value)';
        }

        $result = $this->fw->get('db.instance')->exec($sql, array(':key' => $key, ':value' => $value));
        return ($this->clear() && $this->getSettings()) ? $result : false;
    }

    /**
     * Удаление настройки из БД
     * @param $key
     * @return bool
     */
    function delete($key)
    {
        if (isset($this->settings[$key])) {
            $result = $this->fw->get('db.instance')->exec('DELETE FROM settings WHERE `key` = :key', array(':key' => $key));
            return ($this->clear() && $this->getSettings()) ? $result : false;
        }

        return false;
    }

    /**
     * Очищает кеш
     * @return bool
     */
    function clear()
    {
        return $this->cache->clear('settings');
    }
}