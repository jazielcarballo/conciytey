<?php
class liveSearch{
	/**
	 * Live search cargado de un modelo
	 */
	public static function typeSelect($field, $data, $show, $attrs = NULL, $value = NULL){
		return self::base($field, $data, $show, $attrs, $value, 'true');
	}
	public static function typeText($field, $data, $show, $attrs = NULL, $value = NULL){
		return self::base($field, $data, $show, $attrs, $value, 'false');
	}
	private static function base($field, $data, $show, $attrs, $value, $bool){
		static $i = false;
		static $cont=0;
		$cont++;		
		if($i == false){
			$i = true;
			$code	=	Tag::css("jquery.autocomplete");
			$code	.=	Tag::js('jquery/jquery.autocomplete');
		}
		if(is_array($attrs)) {
		    $attrs = Tag::getAttrs($attrs);
		}
		// si no se especificó el valor explicitamente
 
		$name =	self::getName($field);
		$field = self::getId($field);
 
		$code	.=	"<input id=\"$field\" name=\"$name\" type=\"text\" value=\"$value\" $attrs/>";
		$datos  = '';
		foreach($data as $p) {
		    $datos 	.=	'"' . $p->$show . '", ';
		}
		$datos	= substr ($datos, 0, -2);
		$code .= "<script type=\"text/javascript\">
			var array_data_" . $cont . "= [ " .  $datos . " ]
			$().ready(function() {
				$(\"#" . $field .  "\").autocomplete(array_data_" . $cont . ", {
					minChars: 0,
					max: 12,
					autoFill: true,
					mustMatch: $bool,
					matchContains: true,
					scrollHeight: 220,
					formatItem: function(data, i, total) {
						return data[0];
					}
				});
 
			});
		</script>";
		return $code;
	}
	private static function getName($field){
		$array_data	=	explode('.', $field);
		if(count($array_data[1])==1){
			return $array_data[0] . '[' . $array_data[1] . ']';
		}
		return $field;
	}
	private static function getId($field){
		$array_data	=	explode('.', $field);
		if(count($array_data[1])==1){
			return $array_data[0] . '_' . $array_data[1];
		}
		return $field;
	}	
}
?>