<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="KLU DRIVE" />
    <title>KLU DRIVE</title>
     
   <!-- CSS START -->

   <style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button {
     -webkit-appearance: none;
    }
     </style> 
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>html/files/bower_components/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo base_url(); ?>html/files/assets/pages/waves/css/waves.min.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>html/files/assets/icon/feather/css/feather.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>html/files/assets/css/font-awesome-n.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>html/files/bower_components/chartist/css/chartist.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo base_url(); ?>html/files/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>html/files/assets/css/widget.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>html/files/assets/icon/icofont/css/icofont.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>html/files/assets/icon/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>html/files/assets/icon/themify-icons/themify-icons.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo base_url(); ?>html/files/assets/css/pages.css" rel="stylesheet" type="text/css" >

    <?php if ( isset($_SESSION['ROL']) && ($_SESSION['ROL'] != 3)){ ?>
    
    <!-- ELFINDER JS,CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/vs.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.2/require.min.js"></script>
    



    <!-- CSS END -->
     <script>
        define('elFinderConfig', {
            // elFinder options (REQUIRED)
            // Documentation for client options:
            // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
            defaultOpts : {
                url : '<?php echo $connector ?>' // connector URL (REQUIRED)
                ,cssAutoLoad : ["<?php echo base_url(); ?>html/themes/moono/css/theme.min.css"]
                ,lang : 'tr', // connector URL (REQUIRED)
                commandsOptions : {
                    edit : {
                        extraOptions : {
                            // set API key to enable Creative Cloud image editor
                            // see https://console.adobe.io/
                            creativeCloudApiKey : '',
                            // browsing manager URL for CKEditor, TinyMCE
                            // uses self location with the empty value
                            managerUrl : ''
                        }
                    }
                    ,quicklook : {
                        // to enable preview with Google Docs Viewer
                        googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
                    }
                }
                // bootCalback calls at before elFinder boot up 
                ,bootCallback : function(fm, extraObj) {

                function elfinderSetVolumeSize($limit)
                {
                    if($('.elfinder-stat-size').find('.kalan_limit').length>0) { $('.elfinder-stat-size').find('.kalan_limit').remove(); }
                    var nokta=$('.elfinder-stat-size').find('span.elfinder-stat-size').last();
                    var bilgi=nokta.html();
                    nokta.html(bilgi+'<span class="kalan_limit">, Kalan Disk Alanı: '+ $limit +' MB</span>');
                };
                    /* any bind functions etc. */
                    <?php if(($_SESSION['ROL'] == 1)){ ?>
                    fm.bind('init sync change rename upload paste duplicate extract archive rm', function() {
                        jQuery.ajax({
                            url: '<?php echo base_url();?>PersonalDrive/DriveKontrol',
                            type: 'POST',
                            dataType: 'json',
                            success:function(data){ elfinderSetVolumeSize(data['kalan_limit']); }
                        });
                    }); <?php };?>

                    var title = document.title;

                    // for example set document.title dynamically.
                    <?php if($_SESSION['ROL'] == 1){ ?>
                    fm.bind('open', function() {
                        jQuery.ajax({
                            url: '<?php echo base_url();?>PersonalDrive/DriveKontrol',
                            type: 'POST',
                            dataType: 'json',
                            success:function(data){ elfinderSetVolumeSize(data['kalan_limit']); }
                    });
                    })<?php };?><?php if($_SESSION['ROL'] == 1){ ?>.bind('sync', function() { elfinderSetVolumeSize(); })<?php };?>
                   ;
                }
            },
           
            managers : {
                 // 'DOM Element ID': { /* elFinder options of this DOM Element */ }
                'elfinder': {}
            }
        });
        define('returnVoid', void 0);
        (function(){
            var // elFinder version
            elver = '2.1.38',
             // jQuery and jQueryUI version
            jqver = '3.2.1',
            uiver = '1.12.1',
                    
            // Detect language (optional)
            lang = (function() {
                var locq = window.location.search,fullLang, locm, lang;

                if (locq && (locm = locq.match(/lang=([a-zA-Z_-]+)/))) {
                    // detection by url query (?lang=xx)
                    fullLang = locm[1];
                } else {
                    // detection by browser language
                    fullLang = (navigator.browserLanguage || navigator.language || navigator.userLanguage);
                }

                lang = fullLang.substr(0,2);
                if (lang === 'ja') lang = 'jp';
                else if (lang === 'pt') lang = 'pt_BR';
                else if (lang === 'ug') lang = 'ug_CN';
                else if (lang === 'zh') lang = (fullLang.substr(0,5).toLowerCase() === 'zh-tw')? 'zh_TW' : 'zh_CN';
                return lang;
            })(),
                    
            // Start elFinder (REQUIRED)
            start = function(elFinder, editors, config) {
                // load jQueryUI CSS
                elFinder.prototype.loadCss('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css');
                        
                $(function() {
                    var optEditors = {
                        commandsOptions: {
                            edit: {
                                editors: Array.isArray(editors)? editors : []
                            }
                        }
                    },
                    opts = {};
                    // Interpretation of "elFinderConfig"
                    if (config && config.managers) {
                        $.each(config.managers, function(id, mOpts) {
                            opts = Object.assign(opts, config.defaultOpts || {});
                            // editors marges to opts.commandOptions.edit
                            try {
                                Opts.commandsOptions.edit.editors = mOpts.commandsOptions.edit.editors.concat(editors || []);
                            } catch(e) {
                                Object.assign(mOpts, optEditors);
                            }
                            // Make elFinder
                             $('#' + id).elfinder(
                                // 1st Arg - options
                                $.extend(true, { lang: lang }, opts, mOpts || {}),
                                // 2nd Arg - before boot up function
                                function(fm, extraObj) {
                                    // `init` event callback function
                                    fm.bind('init', function() {
                                        // Optional for Japanese decoder "extras/encoding-japanese.min"
                                        delete fm.options.rawStringDecoder;
                                        if (fm.lang === 'jp') {
                                            require(
                                                [ 'encoding-japanese' ],
                                                function(Encoding) {
                                                    if (Encoding.convert) {
                                                        fm.options.rawStringDecoder = function(s) {
                                                            return Encoding.convert(s,{to:'UNICODE',type:'string'});
                                                        };
                                                    }
                                                }
                                            );
                                        }
                                    });
                                }
                            );
                        });
                    } else {
                        alert('"elFinderConfig" object is wrong.');
                    }
                });
            },
                    
            // JavaScript loader (REQUIRED)
            load = function() {
                require(
                    [
                        'elfinder'
                        ,'extras/editors.default.min'       // load text, image editors
                        , 'elFinderConfig'
                        //  , 'extras/quicklook.googledocs'  // optional preview for GoogleApps contents on the GoogleDrive volume
                    ],
                    start,
                        function(error) {
                            alert(error.message);
                        }
                );
            },
                    
            // is IE8? for determine the jQuery version to use (optional)
            ie8 = (typeof window.addEventListener === 'undefined' && typeof document.getElementsByClassName === 'undefined');
            // config of RequireJS (REQUIRED)
            require.config({
                baseUrl : 'html/js',
                paths : {
                        'jquery'   : '//cdnjs.cloudflare.com/ajax/libs/jquery/'+(ie8? '1.12.4' : jqver)+'/jquery.min',
                        'jquery-ui': '//cdnjs.cloudflare.com/ajax/libs/jqueryui/'+uiver+'/jquery-ui.min',
                        'elfinder' : 'elfinder.full',
                        'encoding-japanese': '//cdn.rawgit.com/polygonplanet/encoding.js/master/encoding.min',
                        'popper' : 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
                        'bootstrap' : 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'
                },
                waitSeconds : 10 // optional
            });

        if (! require.defined('elFinderConfig')) {
            define('elFinderConfig', {
                // elFinder options (REQUIRED)
                // Documentation for client options:
                // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
                defaultOpts : {
                    url : '<?php echo $connector ?>' // connector URL (REQUIRED) // connector URL (REQUIRED)
                    ,commandsOptions : {
                        edit : {
                            extraOptions : {
                                // set API key to enable Creative Cloud image editor
                                // see https://console.adobe.io/
                                creativeCloudApiKey : '',
                                // browsing manager URL for CKEditor, TinyMCE
                                // uses self location with the empty value
                            managerUrl : ''
                            }
                        }
                        ,quicklook : {
                            // to enable CAD-Files and 3D-Models preview with sharecad.org
                            sharecadMimes : ['image/vnd.dwg', 'image/vnd.dxf', 'model/vnd.dwf', 'application/vnd.hp-hpgl', 'application/plt', 'application/step', 'model/iges', 'application/vnd.ms-pki.stl', 'application/sat', 'image/cgm', 'application/x-msmetafile'],
                            // to enable preview with Google Docs Viewer
                            googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/postscript', 'application/rtf'],
                            // to enable preview with Microsoft Office Online Viewer
                            // these MIME types override "googleDocsMimes"
                            officeOnlineMimes : ['application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation']
                        }
                    }
                },
                managers : {
                    'elfinder': {},
                }
        });
    }

        // load JavaScripts (REQUIRED)
        load();
        })();
    </script>       
   <?php } ?>
    
  
  </head>


    
