<?php
/**
 * MCSae
 *
 * @package ko
 * @subpackage data
 * @author zhangchu
 */

/**
 * ��װ sina app engine memcache ��ʵ��
 */
class Ko_Data_MCSae extends Ko_Data_MemCache implements IKo_Data_MCAgent
{
	private static $s_aInstances = array();

	protected function _oCreateMemcache($sTag)
	{
		$mc = new Memcache;
		if (!$mc->init())
		{
			$mc = null;
		}
		return $mc;
	}

	public static function OInstance($sName = '', $sExinfo = '')
	{
		if (empty(self::$s_aInstances[$sName]))
		{
			self::$s_aInstances[$sName] = new self($sName);
		}
		return self::$s_aInstances[$sName];
	}
}

?>