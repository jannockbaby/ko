<?php
/**
 * Image
 *
 * @package ko
 * @subpackage tool
 * @author zhangchu
 */

//define('KO_IMAGE', 'Gd');
//include_once(dirname(__FILE__).'/../ko.class.php');

interface IKo_Tool_Image
{
	/**
	 * 获取文件的类型
	 *
	 * @return string|boolean 返回 false 表示不支持的文件类型
	 */
	public static function VValidImageType($sFile);
	/**
	 * 保证生成的图片宽度为 iWidth，高度为 iHeight
	 *
	 * @param array $aOption srcx srcy srcw srch 在原图的指定部分基础上进行裁剪
	 *                       sharpen.radius sharpen.sigma quality strip
	 * @return boolean|string
	 */
	public static function VCrop($sSrc, $sDst, $iWidth, $iHeight, $iFlag = 0, $aOption = array());
	/**
	 * 将源图片进行等比例的缩小，生成图片宽度不超过 iWidth 并且高度不超过 iHeight，iWidth 和 iHeight 同时有值(>0)时，需要同时满足
	 *
	 * @param array $aOption sharpen.radius sharpen.sigma quality strip
	 * @return boolean|string
	 */
	public static function VResize($sSrc, $sDst, $iWidth = 0, $iHeight = 0, $iFlag = 0, $aOption = array());
	/**
	 * 旋转图片，fAngle 通常为 90 的整数倍，顺时针方向旋转
	 *
	 * @return boolean|string
	 */
	public static function VRotate($sSrc, $sDst, $fAngle, $iBgColor = 0xffffff, $iFlag = 0);
	/**
	 * 图片水平翻转
	 *
	 * @return boolean|string
	 */
	public static function VFlipH($sSrc, $sDst, $iFlag = 0);
	/**
	 * 图片垂直翻转
	 *
	 * @return boolean|string
	 */
	public static function VFlipV($sSrc, $sDst, $iFlag = 0);
	/**
	 * 组合图片，如：加水印
	 *
	 * @param array $aOption xyflag 水印的相对位置
	 * @return boolean|string
	 */
	public static function VComposite($sSrc, $sDst, $sComposite, $iX, $iY, $iFlag = 0, $aOption = array());
}

class Ko_Tool_Image implements IKo_Tool_Image
{
	const FLAG_SRC_BLOB = 0x1;
	const FLAG_DST_BLOB = 0x2;
	const FLAG_COMPOSITE_BLOB = 0x4;
	const XYFLAG_X_CENTER = 0x1;
	const XYFLAG_X_RIGHT = 0x2;
	const XYFLAG_Y_CENTER = 0x4;
	const XYFLAG_Y_BOTTOM = 0x8;
	
	public static function VValidImageType($sFile)
	{
		return call_user_func(array('Ko_Tool_Image_'.KO_IMAGE, 'VValidImageType'), $sFile);
	}
	
	public static function VCrop($sSrc, $sDst, $iWidth, $iHeight, $iFlag = 0, $aOption = array())
	{
		return call_user_func(array('Ko_Tool_Image_'.KO_IMAGE, 'VCrop'), $sSrc, $sDst, $iWidth, $iHeight, $iFlag, $aOption);
	}
	
	public static function VResize($sSrc, $sDst, $iWidth = 0, $iHeight = 0, $iFlag = 0, $aOption = array())
	{
		return call_user_func(array('Ko_Tool_Image_'.KO_IMAGE, 'VResize'), $sSrc, $sDst, $iWidth, $iHeight, $iFlag, $aOption);
	}

	public static function VRotate($sSrc, $sDst, $fAngle, $iBgColor = 0xffffff, $iFlag = 0)
	{
		return call_user_func(array('Ko_Tool_Image_'.KO_IMAGE, 'VRotate'), $sSrc, $sDst, $fAngle, $iBgColor, $iFlag);
	}

	public static function VFlipH($sSrc, $sDst, $iFlag = 0)
	{
		return call_user_func(array('Ko_Tool_Image_'.KO_IMAGE, 'VFlipH'), $sSrc, $sDst, $iFlag);
	}
	
	public static function VFlipV($sSrc, $sDst, $iFlag = 0)
	{
		return call_user_func(array('Ko_Tool_Image_'.KO_IMAGE, 'VFlipV'), $sSrc, $sDst, $iFlag);
	}
	
	public static function VComposite($sSrc, $sDst, $sComposite, $iX, $iY, $iFlag = 0, $aOption = array())
	{
		return call_user_func(array('Ko_Tool_Image_'.KO_IMAGE, 'VComposite'), $sSrc, $sDst, $sComposite, $iX, $iY, $iFlag, $aOption);
	}
}

/*
echo KO_IMAGE."\n";
$api = new Ko_Tool_Image;
$start = microtime(true);
//$ret = $api->VCrop($argv[1], $argv[2], $argv[3], $argv[4]);
//$ret = $api->VResize($argv[1], $argv[2], $argv[3], $argv[4]);
$ret = $api->VRotate($argv[1], $argv[2], $argv[3]);
//$ret = $api->VFlipH($argv[1], $argv[2]);
//$ret = $api->VFlipV($argv[1], $argv[2]);
$end = microtime(true);
var_dump($ret);
echo "Time: ".($end - $start)."\n";
*/
