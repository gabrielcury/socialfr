(function() {  
    tinymce.create('tinymce.plugins.quote', {  
      init : function(ed, url) {
			  
        ed.addCommand('quote', function() {
        
       
				
			});
            ed.addButton('quote', {  
                title : 'Add a 2 columns Layout',  
                image : '../wp-content/themes/mimo_grider/images/tyni/icon_2cols.png',  
                onclick : function() {  
                
                     ed.selection.setContent('[one_half]' + ed.selection.getContent() + '[/one_half][one_half_last]Another Content[/one_half_last]');  
  
                }  
            }); 
               ed.addButton('3col', {  
                title : 'Add a 3 columns Layout',  
                image : '../wp-content/themes/mimo_grider/images/tyni/icon_3cols.png',  
                onclick : function() {  
                
                     ed.selection.setContent('[one_third]' + ed.selection.getContent() + '[/one_third][one_third]Another Content[/one_third][one_third_last]Last Content[/one_third_last]');  
  
                }  
            });  
             ed.addButton('4col', {  
                title : 'Add a 4 columns Layout',  
                image : '../wp-content/themes/mimo_grider/images/tyni/icon_4cols.png',  
                onclick : function() {  
                
                     ed.selection.setContent('[one_fourth]' + ed.selection.getContent() + '[/one_fourth][one_fourth]Another Content[/one_fourth][one_fourth]Another Content[/one_fourth][one_fourth_last]Last Content[/one_fourth_last]');  
  
                }  
            });  
             ed.addButton('5col', {  
                title : 'Add a 5 columns Layout',  
                image : '../wp-content/themes/mimo_grider/images/tyni/icon_5cols.png',  
                onclick : function() {  
                
                     ed.selection.setContent('[one_fifth]' + ed.selection.getContent() + '[/one_fifth][one_fifth]Another Content[/one_fifth][one_fifth]Another Content[/one_fifth][one_fifth]Another Content[/one_fifth][one_fifth_last]Last Content[/one_fifth_last]');  
  
                }  
            });  
            ed.addButton('6col', {  
                title : 'Add a 6 columns Layout',  
                image : '../wp-content/themes/mimo_grider/images/tyni/icon_6cols.png',  
                onclick : function() {  
                
                     ed.selection.setContent('[one_sixth]' + ed.selection.getContent() + '[/one_sixth][one_sixth]Another Content[/one_sixth][one_sixth]Another Content[/one_sixth][one_sixth]Another Content[/one_sixth][one_sixth]Another Content[/one_sixth][one_sixth_last]Last Content[/one_sixth_last]');  
  
                }  
            });  
			 ed.addButton('tabs', {  
                title : 'Add Custom Tabs',  
                image : '../wp-content/themes/mimo_grider/images/tyni/icon_tabs.png',  
                onclick : function() {  
                
                     ed.selection.setContent('[tabgroup][tab title="" name=""]' + ed.selection.getContent() + '[/tab][tab title="" name=""]Another Content[/tab][tab title="" name=""]Another Content[/tab][tab title="" name=""]Another Content[/tab][tab title="" name=""]Another Content[/tab][tab title="" name=""]Last Content[/tab][/tabgroup]');  
  
                }  
            });  
			
			ed.addButton('accordion', {  
                title : 'Add Custom Accordion',  
                image :  '../wp-content/themes/mimo_grider/images/tyni/icon_accordion.png',  
                onclick : function() {  
                
                     ed.selection.setContent('[accordiongroup][accordion title="" name=""]' + ed.selection.getContent() + '[/accordion][accordion title="" name=""]Another Content[/accordion][accordion title="" name=""]Another Content[/accordion][accordion title="" name=""]Another Content[/accordion][accordion title="" name=""]Another Content[/accordion][accordion title="" name=""]Last Content[/accordion][/accordiongroup]');  
  
                }  
            }); 
			ed.addButton('soundcloud', {  
                title : 'Add Custom SoundCloud',  
                image : '../wp-content/themes/mimo_grider/images/tyni/icon_soundcloud.png',  
                onclick : function() {  
                
                     ed.selection.setContent('[soundcloud url="' + ed.selection.getContent() + '"/]');  
  
                }  
            }); 
			 
			
                   
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);  
})();


