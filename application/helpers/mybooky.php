<?php

class MyBooky {

	public static function BS3Pagination($htmlCode)
	{
		return str_replace('<div class="pagination"><ul>',
			'<div><ul class="pagination">', $htmlCode);
	}

}
