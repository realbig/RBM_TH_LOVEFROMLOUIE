"use strict";!function(l){function t(l){var t=[];for(var e in l)t.push({text:l[e],value:e});return t}l(document).ready(function(){tinymce.PluginManager.add("lfl_button_shortcode_script",function(l,e){l.addButton("lfl_button_shortcode",{text:lfl_tinymce_l10n.lfl_button_shortcode.tinymce_title,icon:!1,onclick:function(){l.windowManager.open({title:lfl_tinymce_l10n.lfl_button_shortcode.tinymce_title,body:[{type:"textbox",name:"text",label:lfl_tinymce_l10n.lfl_button_shortcode.button_text.label},{type:"textbox",name:"url",label:lfl_tinymce_l10n.lfl_button_shortcode.button_url.label},{type:"listbox",name:"color",label:lfl_tinymce_l10n.lfl_button_shortcode.colors.label,values:t(lfl_tinymce_l10n.lfl_button_shortcode.colors.choices),value:lfl_tinymce_l10n.lfl_button_shortcode.colors["default"]},{type:"listbox",name:"size",label:lfl_tinymce_l10n.lfl_button_shortcode.size.label,values:t(lfl_tinymce_l10n.lfl_button_shortcode.size.choices),value:lfl_tinymce_l10n.lfl_button_shortcode.size["default"]},{type:"checkbox",name:"hollow",label:lfl_tinymce_l10n.lfl_button_shortcode.hollow.label},{type:"checkbox",name:"expand",label:lfl_tinymce_l10n.lfl_button_shortcode.expand.label},{type:"checkbox",name:"newTab",label:lfl_tinymce_l10n.lfl_button_shortcode.new_tab.label}],onsubmit:function(t){l.insertContent("[lfl_button"+(void 0!==t.data.url&&""!==t.data.url?' url="'+t.data.url+'"':"")+(void 0!==t.data.color?' color="'+t.data.color+'"':"")+(void 0!==t.data.size?' size="'+t.data.size+'"':"")+(void 0!==t.data.hollow&&t.data.hollow!==!1?' hollow="'+t.data.hollow+'"':"")+(void 0!==t.data.expand&&t.data.expand!==!1?' expand="'+t.data.expand+'"':"")+(void 0!==t.data.newTab&&t.data.newTab!==!1?' new_tab="'+t.data.newTab+'"':"")+"]"+(void 0!==t.data.text?t.data.text:"")+"[/lfl_button]")}})}})})})}(jQuery);