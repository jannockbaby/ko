<?php
/**
 * Parse
 *
 * @package ko
 * @subpackage html
 * @author zhangchu
 */

//include_once('../ko.class.php');

interface IKo_Html_Parse
{
	public static function sParse($sHtml, $iMaxLength = 0, $sCharset = '');
}

class Ko_Html_Parse
{
	public static function sParse($oFilter, $sHtml, $iMaxLength = 0, $sCharset = '')
	{
		assert(is_null($oFilter) || $oFilter instanceof IKo_Html_Filter);

		$htmlstr = new Ko_Html_Str($sHtml);
		$node = new Ko_Html_Node;
		$node->bParse($htmlstr);
		if (!is_null($oFilter))
		{
			$node->vAddFilter($oFilter);
		}
		$sRet = $node->sHtmlEx($iMaxLength, $sCharset);
		$node->vFreeParent();
		return $sRet;
	}
}

?>