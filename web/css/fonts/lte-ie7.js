/* Use this script if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icons\'">' + entity + '</span>' + html;
	}
	var icons = {
			'iconheart' : '&#x21;',
			'iconstar' : '&#x22;',
			'iconstar-empty' : '&#x23;',
			'iconsearch' : '&#x24;',
			'iconenvelope' : '&#x25;',
			'iconok' : '&#x26;',
			'iconremove' : '&#x27;',
			'iconcog' : '&#x28;',
			'icontrash' : '&#x29;',
			'iconhome' : '&#x2a;',
			'iconcomment' : '&#x2b;',
			'iconangle-right' : '&#x2c;',
			'iconangle-left' : '&#x2d;',
			'iconhome-2' : '&#x2e;',
			'iconpencil' : '&#x2f;',
			'iconhome-3' : '&#x30;',
			'iconsupport' : '&#x31;',
			'iconclock' : '&#x32;',
			'iconcalendar' : '&#x33;',
			'iconzoom-in' : '&#x34;',
			'iconzoom-out' : '&#x35;',
			'iconcog-2' : '&#x36;',
			'iconfacebook' : '&#x37;',
			'icongoogle-plus' : '&#x38;',
			'icontwitter' : '&#x39;',
			'iconlist-ol' : '&#x3a;',
			'iconsignal' : '&#x3b;',
			'iconuser-add' : '&#x3c;',
			'icontarget' : '&#x3d;',
			'icongrid' : '&#x3e;',
			'iconlist' : '&#x3f;',
			'iconbars' : '&#x40;',
			'iconstats' : '&#x41;',
			'iconmove' : '&#x42;',
			'icontrashcan' : '&#x43;',
			'icongrid-2' : '&#x44;',
			'iconlist-2' : '&#x45;',
			'iconfloppy' : '&#x46;',
			'iconclock-2' : '&#x47;',
			'iconcamera' : '&#x48;',
			'iconadd-to-list' : '&#x49;',
			'iconwrench' : '&#x4a;',
			'iconsettings' : '&#x4b;',
			'iconstats-2' : '&#x4c;',
			'iconbars-2' : '&#x4d;',
			'iconbars-3' : '&#x4e;',
			'iconfire' : '&#x4f;',
			'iconleaf' : '&#x50;',
			'iconglass' : '&#x51;',
			'iconairplane' : '&#x52;',
			'iconshield' : '&#x53;',
			'iconlightning' : '&#x54;',
			'iconeye' : '&#x55;',
			'iconwarning' : '&#x56;',
			'iconnotification' : '&#x57;',
			'iconplus' : '&#x58;',
			'iconminus' : '&#x59;',
			'iconuser' : '&#x5a;',
			'iconusers' : '&#x5b;',
			'iconinfo' : '&#x5c;',
			'iconquestion-mark' : '&#x5d;',
			'iconimage' : '&#x5e;',
			'iconbars-4' : '&#x5f;',
			'iconbars-alt' : '&#x60;',
			'iconpencil-2' : '&#x61;',
			'iconsearch-2' : '&#x62;',
			'iconcheckmark' : '&#x63;',
			'iconclose' : '&#x64;',
			'iconpicture' : '&#x65;',
			'iconheart-2' : '&#x66;',
			'iconcircles' : '&#x67;',
			'iconlink' : '&#x68;',
			'iconclock-3' : '&#x69;',
			'iconfeather' : '&#x6a;',
			'iconeye-2' : '&#x6b;',
			'iconskull' : '&#x6c;',
			'icontrashcan-2' : '&#x6d;',
			'iconsupport-2' : '&#x6e;',
			'iconcone' : '&#x6f;',
			'iconkey' : '&#x70;',
			'iconinfo-2' : '&#x71;',
			'iconlamp' : '&#x72;',
			'iconsettings-2' : '&#x73;',
			'iconbadge' : '&#x74;',
			'iconleaf-2' : '&#x75;',
			'iconstats-3' : '&#x76;',
			'iconpicture-2' : '&#x77;',
			'iconheart-3' : '&#x78;',
			'iconkey-2' : '&#x79;',
			'iconpencil-3' : '&#x7a;',
			'iconcomment-alt' : '&#x7b;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; i < els.length; i += 1) {
		el = els[i];
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};