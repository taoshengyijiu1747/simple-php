//définition des tags sous un tableau d'objets
        var tags = [
            {   
                type : 'paragraphe',
                firstTag : '[p]',
                lastTag : '[/p]',
                reGlobal : /\[p\].*?\[\/p\]/ig,
                htmlStart : '<div class="bb_text" >',
                htmlEnd : '</div>',
                reSecurity : '',
                securityResponse : ''
            },
            //Image url check
            {   
                type : 'img',
                firstTag : '[img]',
                lastTag : '[/img]',
                reGlobal : /\[img\].*?\[\/img\]/ig,
                htmlStart : '<img class="bb_img" src="',
                htmlEnd : '"/>',
                reSecurity : /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/i,
                securityResponse : 'https://nicolemichaelides.files.wordpress.com/2015/03/no-image-large.png'
            },
            //Youtube iframe
            {   
                type : 'youtube',
                firstTag : '[youtube]',
                lastTag : '[/youtube]',
                reGlobal : /\[youtube\].*?\[\/youtube\]/ig,
                htmlStart : '<iframe class="bb_iframe" width="560" height="315" src="https://www.youtube.com/embed/',
                htmlEnd : '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
                reSecurity : /^[a-zA-Z0-9_]*$/,
                securityResponse : ''
            },
            //dailymotion Iframe
            {   
                type : 'dailymotion',
                firstTag : '[dailymotion]',
                lastTag : '[/dailymotion]',
                reGlobal : /\[dailymotion\].*?\[\/dailymotion\]/ig,
                htmlStart : '<iframe class="bb_iframe" width="560" height="315" src="//www.dailymotion.com/embed/video/',
                htmlEnd : '"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
                reSecurity : /^[a-zA-Z0-9_]*$/,
                securityResponse : ''
            },
            //rutube iframe
            {   
                type : 'rutube',
                firstTag : '[rutube]',
                lastTag : '[/rutube]',
                reGlobal : /\[rutube\].*?\[\/rutube\]/ig,
                htmlStart : '<iframe class="bb_iframe" width="560" height="315" src="//rutube.ru/play/embed/',
                htmlEnd : '"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
                reSecurity : /^[a-zA-Z0-9_]*$/,
                securityResponse : ''
            },
            //vimeo Iframe
            {   
                type : 'vimeo',
                firstTag : '[vimeo]',
                lastTag : '[/vimeo]',
                reGlobal : /\[vimeo\].*?\[\/vimeo\]/ig,
                htmlStart : '<iframe class="bb_iframe" src="https://player.vimeo.com/video/',
                htmlEnd : '" width="560" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
                reSecurity : /^[a-zA-Z0-9_]*$/,
                securityResponse : ''
            },
            //soundcloud Iframe
            {   
                type : 'soundcloud',
                firstTag : '[soundcloud]',
                lastTag : '[/soundcloud]',
                reGlobal : /\[soundcloud\].*?\[\/soundcloud\]/ig,
                htmlStart : '<iframe class="bb_iframe" width="560" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/',
                htmlEnd : '&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>',
                reSecurity : /^[a-zA-Z0-9_]*$/,
                securityResponse : ''
            },
            //Vine Iframe
            //<iframe src="https://vine.co/v/ijlT6naE6lT/embed/simple" width="300" height="300" frameborder="0"></iframe>
            {   
                type : 'vine',
                firstTag : '[vine]',
                lastTag : '[/vine]',
                reGlobal : /\[vine\].*?\[\/vine\]/ig,
                htmlStart : '<iframe class="bb_iframe" src="https://vine.co/v/',
                htmlEnd : '/embed/simple" width="560" height="315" frameborder="0"></iframe>',
                reSecurity : /^[a-zA-Z0-9_]*$/,
                securityResponse : ''
            },
            /*
            * Default BBcode
            */
            {
                type : 'center',
                firstTag : '[center]',
                lastTag : '[/center]',
                reGlobal : /\[center\].*?\[\/center\]/ig,
                htmlStart : '<div class="bb_center" style="text-align:center;">',
                htmlEnd : '</div>',
                reSecurity : '',
                securityResponse : ''
            },
            {
                type : 'left',
                firstTag : '[left]',
                lastTag : '[/left]',
                reGlobal : /\[left\].*?\[\/left\]/ig,
                htmlStart : '<div class="bb_left" style="text-align:left;">',
                htmlEnd : '</div>',
                reSecurity : '',
                securityResponse : ''
            },
            {
                type : 'right',
                firstTag : '[right]',
                lastTag : '[/right]',
                reGlobal : /\[right\].*?\[\/right\]/ig,
                htmlStart : '<div class="bb_right" style="text-align:right;">',
                htmlEnd : '</div>',
                reSecurity : '',
                securityResponse : ''
            },
            {   
                type : 'gras',
                firstTag : '[b]',
                lastTag : '[/b]',
                reGlobal : /\[b\].*?\[\/b\]/ig,
                htmlStart : '<b class="bb_gras">',
                htmlEnd : '</b>',
                reSecurity : '',
                securityResponse : ''
            },
            {   
                type : 'italique',
                firstTag : '[i]',
                lastTag : '[/i]',
                reGlobal : /\[i\].*?\[\/i\]/ig,
                htmlStart : '<i class="bb_italique">',
                htmlEnd : '</i>',
                reSecurity : '',
                securityResponse : ''
            },
            {   
                type : 'souligné',
                firstTag : '[u]',
                lastTag : '[/u]',
                reGlobal : /\[u\].*?\[\/u\]/ig,
                htmlStart : '<u class="bb_souligne">',
                htmlEnd : '</u>',
                reSecurity : '',
                securityResponse : ''
            },
            {   
                type : 'barré',
                firstTag : '[s]',
                lastTag : '[/s]',
                reGlobal : /\[s\].*?\[\/s\]/ig,
                htmlStart : '<s class="bb_barre">',
                htmlEnd : '</s>',
                reSecurity : '',
                securityResponse : ''
            },
            {   
                type : 'strike',
                firstTag : '[strike]',
                lastTag : '[/strike]',
                reGlobal : /\[strike\].*?\[\/strike\]/ig,
                htmlStart : '<strike class="bb_barre">',
                htmlEnd : '</strike>',
                reSecurity : '',
                securityResponse : ''
            },
            {   
                type : 'strong',
                firstTag : '[strong]',
                lastTag : '[/strong]',
                reGlobal : /\[strong\].*?\[\/strong\]/ig,
                htmlStart : '<b class="bb_gras">',
                htmlEnd : '</b>',
                reSecurity : '',
                securityResponse : ''
            },


            {   
                type : 'em',
                firstTag : '[em]',
                lastTag : '[/em]',
                reGlobal : /\[em\].*?\[\/em\]/ig,
                htmlStart : '<em class="bb_em">',
                htmlEnd : '</em>',
                reSecurity : '',
                securityResponse : ''
            },
            {   
                type : 'h1',
                firstTag : '[h1]',
                lastTag : '[/h1]',
                reGlobal : /\[h1\].*?\[\/h1\]/ig,
                htmlStart : '<h1 class="bb_h1">',
                htmlEnd : '</h1>',
                reSecurity : '',
                securityResponse : ''
            },
            {   
                type : 'h2',
                firstTag : '[h2]',
                lastTag : '[/h2]',
                reGlobal : /\[h2\].*?\[\/h2\]/ig,
                htmlStart : '<h2 class="bb_h2">',
                htmlEnd : '</h2>',
                reSecurity : '',
                securityResponse : ''
            },
            /*
            * BBCODE avec 2 parametres
            */
            
            //Color
            {   
                type : 'color',
                //ne pas mettre le ']' dans le first tag si il y'a 2 paramettre
                firstTag : '[color=',
                lastTag : '[/color]',
                reGlobal : /\[color\=.*?\[\/color\]/ig,
                htmlStart : '<span class="bb_color" style="color:',
                htmlParams : ';">',
                htmlEnd : '</span>',
                reSecurity : '',
                securityResponse : '',
                params : 2,
                //trouve le premier params grace au ] comme séparateur
                reFirstParams : /.*?\]/,
                separationParams : ']'
            },
            //Style font
            {   
                type : 'font',
                //ne pas mettre le ] dans le first tag si il y'a 2 paramettre
                firstTag : '[font=',
                lastTag : '[/font]',
                reGlobal : /\[font\=.*?\[\/font\]/ig,
                htmlStart : '<span class="bb_font" style="font-family:',
                htmlParams : ';">',
                htmlEnd : '</span>',
                reSecurity : '',
                securityResponse : '',
                params : 2,
                //trouve le premier params grace au ] comme séparateur
                reFirstParams : /.*?\]/,
                separationParams : ']'
            },
            //saut de ligne bbcode
            {
                type :'br',
                tag : '[/br]',
                reGlobal : /\[\/br\]/ig,
                html : '</br>',
                params : 0,
            },
            //saut de ligne value
            {
                type :'n',
                tag : '',
                reGlobal : /\n/ig,
                html : '</br>',
                params : 0,
            },
        ];


var bbToHtml = function(content){
        // Remplace les balises html par des balises unicode
        var regXssLeft = /[<]/g;
        var regXssRight = /[>]/g;
        content = content.replace(regXssLeft,'&#60;');
        content = content.replace(regXssRight,'&#62;');
        var resultat = content;
        // Parcours le tableau des tags pour les remplacer par des balises html
        for(var key in tags){
            var resReg;
            // trouve les tags à changer graçe à leurs regexp notifié
            while ((resReg = tags[key].reGlobal.exec(resultat)) !== null){
                // Si présences de 2 paramètre recupère les 2 params pour les ajouter à leurs places définies
                if(tags[key].params == 2){
                    var valueInTag = resReg[0].replace(tags[key].firstTag,'');
                    valueInTag = valueInTag.replace(tags[key].lastTag,'');
                    var firtParamsMatch = valueInTag.match(tags[key].reFirstParams);
                    var secondParams = valueInTag.replace(firtParamsMatch[0],'');
                    var firstParams = firtParamsMatch[0].replace(tags[key].separationParams,'');
                    // Verification de la sécurité 
                    if(valueInTag.match(tags[key].reSecurity)){
                        resultat = resultat.replace(resReg[0],tags[key].htmlStart + firstParams + tags[key].htmlParams + secondParams + tags[key].htmlEnd);
                    }
                    // si la sécurité n'est pas validé alors renvoi une réponse dans le tag
                    else{
                        resultat = resultat.replace(resReg[0],tags[key].htmlStart + tags[key].securityResponse + tags[key].htmlParams + tags[key].htmlEnd)
                    }    
                }
                else if(tags[key].params == 0){
                    resultat = resultat.replace(resReg[0],tags[key].html)
                }
                else{
                    var valueInTag = resReg[0].replace(tags[key].firstTag,'');
                    valueInTag = valueInTag.replace(tags[key].lastTag,'');
                    if(valueInTag.match(tags[key].reSecurity)){
                        resultat = resultat.replace(resReg[0],tags[key].htmlStart + valueInTag + tags[key].htmlEnd);
                    }
                    else{
                        resultat = resultat.replace(resReg[0],tags[key].htmlStart + tags[key].securityResponse + tags[key].htmlEnd)
                    }
                }
            }
        }
        return resultat;
    }
