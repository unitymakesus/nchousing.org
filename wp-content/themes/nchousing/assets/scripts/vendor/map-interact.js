// Quick feature detection
function isTouchEnabled() {
	return (('ontouchstart' in window)
		|| (navigator.MaxTouchPoints > 0)
		|| (navigator.msMaxTouchPoints > 0));
}

function enqueueCounties(){
	addEvent('map_1');
	addEvent('map_2');
	addEvent('map_3');
	addEvent('map_4');
	addEvent('map_5');
	addEvent('map_6');
	addEvent('map_7');
	addEvent('map_8');
	addEvent('map_9');
	addEvent('map_10');
	addEvent('map_11');
	addEvent('map_12');
	addEvent('map_13');
	addEvent('map_14');
	addEvent('map_15');
	addEvent('map_16');
	addEvent('map_17');
	addEvent('map_18');
	addEvent('map_19');
	addEvent('map_20');
	addEvent('map_21');
	addEvent('map_22');
	addEvent('map_23');
	addEvent('map_24');
	addEvent('map_25');
	addEvent('map_26');
	addEvent('map_27');
	addEvent('map_28');
	addEvent('map_29');
	addEvent('map_30');
	addEvent('map_31');
	addEvent('map_32');
	addEvent('map_33');
	addEvent('map_34');
	addEvent('map_35');
	addEvent('map_36');
	addEvent('map_37');
	addEvent('map_38');
	addEvent('map_39');
	addEvent('map_40');
	addEvent('map_41');
	addEvent('map_42');
	addEvent('map_43');
	addEvent('map_44');
	addEvent('map_45');
	addEvent('map_46');
	addEvent('map_47');
	addEvent('map_48');
	addEvent('map_49');
	addEvent('map_50');
	addEvent('map_51');
	addEvent('map_52');
	addEvent('map_53');
	addEvent('map_54');
	addEvent('map_55');
	addEvent('map_56');
	addEvent('map_57');
	addEvent('map_58');
	addEvent('map_59');
	addEvent('map_60');
	addEvent('map_61');
	addEvent('map_62');
	addEvent('map_63');
	addEvent('map_64');
	addEvent('map_65');
	addEvent('map_66');
	addEvent('map_67');
	addEvent('map_68');
	addEvent('map_69');
	addEvent('map_70');
	addEvent('map_71');
	addEvent('map_72');
	addEvent('map_73');
	addEvent('map_74');
	addEvent('map_75');
	addEvent('map_76');
	addEvent('map_77');
	addEvent('map_78');
	addEvent('map_79');
	addEvent('map_80');
	addEvent('map_81');
	addEvent('map_82');
	addEvent('map_83');
	addEvent('map_84');
	addEvent('map_85');
	addEvent('map_86');
	addEvent('map_87');
	addEvent('map_88');
	addEvent('map_89');
	addEvent('map_90');
	addEvent('map_91');
	addEvent('map_92');
	addEvent('map_93');
	addEvent('map_94');
	addEvent('map_95');
	addEvent('map_96');
	addEvent('map_97');
	addEvent('map_98');
	addEvent('map_99');
	addEvent('map_100');
}

function addEvent(id,relationId){
	var _obj = jQuery('#'+id);
	_obj.attr({'fill':map_config[id]['upColor'],'stroke':map_config['default']['borderColor']});
	_obj.attr({'cursor':'default'});
	if(map_config[id]['enable'] == true){
		if (isTouchEnabled()) {
			_obj.on('touchstart', function(e){
				var touch = e.originalEvent.touches[0];
				var x=touch.pageX+10, y=touch.pageY+15;
				var tipw=jQuery('#map-tip').outerWidth(), tiph=jQuery('#map-tip').outerHeight(),
				x=(x+tipw>jQuery(document).scrollLeft()+jQuery(window).width())? x-tipw-(20*2) : x
				y=(y+tiph>jQuery(document).scrollTop()+jQuery(window).height())? jQuery(document).scrollTop()+jQuery(window).height()-tiph-10 : y
				jQuery('#'+id).css({'fill':map_config[id]['downColor']});
				jQuery('#map-tip').show().html(map_config[id]['hover']);
				jQuery('#map-tip').css({left:x, top:y})
			})
			_obj.on('touchend', function(){
				jQuery('#'+id).css({'fill':map_config[id]['upColor']});
				if(map_config[id]['target'] == 'new_window'){
					window.open(map_config[id]['url']);
				}else if(map_config[id]['target'] == 'same_window'){
					window.parent.location.href=map_config[id]['url'];
				}
			})
		}
		_obj.attr({'cursor':'pointer'});
		_obj.hover(function(){
			jQuery('#map-tip').show().html(map_config[id]['hover']);
			_obj.css({'fill':map_config[id]['overColor']})
		},function(){
			jQuery('#map-tip').hide();
			jQuery('#'+id).css({'fill':map_config[id]['upColor']});
		})
		_obj.mousedown(function(){
			jQuery('#'+id).css({'fill':map_config[id]['downColor']});
		})
		_obj.mouseup(function(){
			jQuery('#'+id).css({'fill':map_config[id]['overColor']});
			if(map_config[id]['target'] == 'new_window'){
				window.open(map_config[id]['url']);
			}else if(map_config[id]['target'] == 'same_window'){
				window.parent.location.href=map_config[id]['url'];
			}
		})
		_obj.mousemove(function(e){
			var x=e.pageX+10, y=e.pageY+15;
			var tipw=jQuery('#map-tip').outerWidth(), tiph=jQuery('#map-tip').outerHeight(),
			x=(x+tipw>jQuery(document).scrollLeft()+jQuery(window).width())? x-tipw-(20*2) : x
			y=(y+tiph>jQuery(document).scrollTop()+jQuery(window).height())? jQuery(document).scrollTop()+jQuery(window).height()-tiph-10 : y
			jQuery('#map-tip').css({left:x, top:y})
		})
	}
}
