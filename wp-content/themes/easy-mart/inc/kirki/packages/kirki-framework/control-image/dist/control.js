wp.customize.controlConstructor["kirki-image"]=wp.customize.kirkiDynamicControl.extend({initKirkiControl:function(e){var i,t,n,a,l,s;i=(e=e||this).setting._value,t=_.isUndefined(e.params.choices)||_.isUndefined(e.params.choices.save_as)?"url":e.params.choices.save_as,n=e.container.find(".placeholder, .thumbnail"),a="array"===t?i.url:i,l=e.container.find(".image-upload-remove-button"),s=e.container.find(".image-default-button"),i="array"===t&&_.isString(i)?{url:i}:i,"id"!==t&&"ID"!==t||""===i||wp.media.attachment(i).fetch().then((function(){setTimeout((function(){var e=wp.media.attachment(i).get("url");n.removeClass().addClass("thumbnail thumbnail-image").html('<img src="'+e+'" alt="" />')}),700)})),("url"===t&&""!==i||"array"===t&&!_.isUndefined(i.url)&&""!==i.url)&&e.container.find("image-default-button").hide(),("url"===t&&""===i||"array"===t&&(_.isUndefined(i.url)||""===i.url))&&l.hide(),i===e.params.default&&e.container.find("image-default-button").hide(),""!==a&&n.removeClass().addClass("thumbnail thumbnail-image").html('<img src="'+a+'" alt="" />'),e.container.on("click",".image-upload-button",(function(i){var r=wp.media({multiple:!1}).open().on("select",(function(){var i=r.state().get("selection").first().toJSON();a=i.url,_.isUndefined(i.sizes)||(a=i.sizes.full.url,_.isUndefined(i.sizes.medium)?_.isUndefined(i.sizes.thumbnail)||(a=i.sizes.thumbnail.url):a=i.sizes.medium.url),"array"===t?e.setting.set({id:i.id,url:i.sizes.full.url,width:i.width,height:i.height}):"id"===t?e.setting.set(i.id):e.setting.set(_.isUndefined(i.sizes)?i.url:i.sizes.full.url),n.length&&n.removeClass().addClass("thumbnail thumbnail-image").html('<img src="'+a+'" alt="" />'),l.length&&(l.show(),s.hide())}));i.preventDefault()})),e.container.on("click",".image-upload-remove-button",(function(i){i.preventDefault(),e.setting.set(""),n=e.container.find(".placeholder, .thumbnail"),l=e.container.find(".image-upload-remove-button"),s=e.container.find(".image-default-button"),n.length&&n.removeClass().addClass("placeholder").html(wp.i18n.__("No image selected","kirki")),l.length&&(l.hide(),jQuery(s).hasClass("button")&&s.show())})),e.container.on("click",".image-default-button",(function(i){i.preventDefault(),e.setting.set(e.params.default),n=e.container.find(".placeholder, .thumbnail"),l=e.container.find(".image-upload-remove-button"),s=e.container.find(".image-default-button"),n.length&&n.removeClass().addClass("thumbnail thumbnail-image").html('<img src="'+e.params.default+'" alt="" />'),l.length&&(l.show(),s.hide())}))}});
//# sourceMappingURL=control.js.map
