<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
   <head>
        <META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta content="IE=Edge" http-equiv="X-UA-Compatible">
        <link href="http://www.ulb.be/design1/css/design-framework.css" rel="stylesheet" type="text/css">
        <link href="http://www.ulb.be/design1/css/design-page.css" rel="stylesheet" type="text/css">
        <link href="http://www.ulb.be/design1/css/design-print.css" media="print" rel="stylesheet" type="text/css">
        <link href="css/style.css?version=7" rel="stylesheet" type="text/css">
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <script src="http://www.ulb.be/design1/js/script-framework.js" type="text/javascript"></script>
      
   <title>TerminoRel</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <script language='javascript'>
    function validate() {
    if(document.getElementById('term').value.trim()=="") {
        alert("Veuillez entrer au moins un caractère !");
        return false;
    }
    return true;
    }
   </script>
   <script type="text/javascript" id="_refScript">
      var intranet_access="https://www.ulb.ac.be/commons/access?_ssl=on&";
      var intranet_status="https://www.ulb.ac.be/commons/access?_prtm=status&_ssl=on&";
      var intranet_login="connexion";
      var _siteURL="www.ulb.ac.be";
      var _previewURL="www.ulb.ac.be/preview1";

      var set = createParameterSet("page");
      set.createSet = _createParameterSetPage;
      function _createParameterSetPage()
          {
          this.addParameter("designDir", "http://www.ulb.be/design1/");
          this.addParameter("topDir", "");
          this.addParameter("genDateTime", "06/06/2018 10:01:53");
          this.addParameter("genDate", "06/06/2018");
          this.addParameter("genTime", "10:01:53");
          this.addParameter("lang", "fr");
          this.addParameter("pageId", "ulb:homepage:homepage");
          this.addParameter("pageLocalId", "homepage");
          this.addParameter("pageTarget", "index.html");
          this.addParameter("pageURL", "http://www.ulb.ac.be/index.html");
          this.addParameter("projectId", "ulb:homepage");
          this.addParameter("sourceId", "main");
          this.addParameter("sourceFile", "/usr/local/http/site/ulb-central/ulb/homepage/homepage.xml");
          this.ready();
          }

      var set = createParameterSet("navigator");
      set.createSet = _createParameterSetNavigator;
      function _createParameterSetNavigator()
          {
          this.addParameter("app-code-name", (navigator.appCodeName!=null)?navigator.appCodeName:"");
          this.addParameter("app-name", (navigator.appName!=null)?navigator.appName:"");
          this.addParameter("app-version", (navigator.appVersion!=null)?navigator.appVersion:"");
          this.addParameter("cookie-enabled", (navigator.cookieEnabled!=null)?navigator.cookieEnabled:"");
          this.addParameter("language", (navigator.language!=null)?navigator.language:"");
          this.addParameter("on-line", (navigator.appCodeName!=null)?navigator.onLine:"");
          this.addParameter("platform", (navigator.platform!=null)?navigator.platform:"");
          this.addParameter("product", (navigator.product!=null)?navigator.product:"");
          this.addParameter("user-agent", (navigator.userAgent!=null)?navigator.userAgent:"");
          this.addParameter("date", "").update = _updateDateSetNavigator;
          this.addParameter("time", "").update = _updateTimeSetNavigator;
          this.addParameter("dateTime", "").update = _updateDateTimeSetNavigator;
          this.ready();
          }
      function _updateDateSetNavigator()
          {
          var d=new Date();
          this.value=("0"+d.getDate()).slice(-2)+"/"+("0"+(d.getMonth()+1)).slice(-2)+"/"+d.getFullYear();
          }
      function _updateTimeSetNavigator()
          {
          var d=new Date();
          this.value=("0"+d.getHours()).slice(-2)+":"+("0"+d.getMinutes()).slice(-2)+":"+("0"+d.getSeconds()).slice(-2);
          }
      function _updateDateTimeSetNavigator()
          {
          var d=new Date();
          this.value=("0"+d.getDate()).slice(-2)+"/"+("0"+(d.getMonth()+1)).slice(-2)+"/"+d.getFullYear()+" "+("0"+d.getHours()).slice(-2)+":"+("0"+d.getMinutes()).slice(-2)+":"+("0"+d.getSeconds()).slice(-2);;
          }

      var set = createParameterSet("server");
      var interaction = createInteraction("_remote", "_refScript", "");
      interaction.callApplication("http://www.ulb.ac.be/sitemanagerapps/navinfo/navinfo.php", false, true, false, true);
      interaction.createSet("server");

   </script>

       
      <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-3062996-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

      </script>
   </head>
   <body onload="frameworkLoad()">
      <div id="bodyContainer">
         <div id="pageFill"></div>
         <div id="pageContainer">
           <div id="pageHeader2">
   <a href="http://www.ulb.ac.be">
      <img alt="Logo ULB" src="http://www.ulb.be/design/img/logoulb1.gif" style="float:left; margin-top:-2px;">
   </a>
   <div id="pageHeaderContainer">
      <form action="#" id="pageHeaderForm" method="get" onsubmit="return search();">
         <table id="pageHeaderSearch">
            <tr>
               <td class="headerFirst">
                  <a href="http://www.ulb.be/ulb/presentation/uk.html" style="color:#333333;">English</a>
               </td>
               <td class="headerMiddle">
                  <a href="http://www.ulb.be/china">&#20013;&#25991;</a>
               </td>
               <td class="headerMiddle">
                  <a href="http://www.ulb.be/index.html">Page d'accueil</a>
               </td>
               <td class="headerMiddle">
                  <a href="http://www.ulb.be/outils/contacts">Contacts</a>
               </td>
               <td class="headerLast">
                  <a href="http://www.ulb.be/campus/index.html">Plan des campus</a>
               </td>
               <td class="headerSearch">
                  <input class="searchRadio" name="mode" type="hidden" value="site-search">
                  
                  <input class="searchInput" name="keyword" type="text" value="">
                  <input class="searchButton" name="ok" src="http://www.ulb.be/design1/img/search.gif" type="image" value="search">

               </td>
            </tr>
            <tr>
               <td colspan="5"></td>
               <td class="searchSelect">
                  <input checked class="searchRadio" name="type" type="radio" value="pages">pages <input class="searchRadio" name="type" type="radio" value="annuaire">annuaire </td>
            </tr>
         </table>
      </form>
   </div>
</div>
      
           <div>
   <script type="text/javascript">TM=new MenuBarConstructor('TM','menuBarImg','menubar-colors.gif','menubar-colors-off.gif');</script>
   <div class="menuBar">
      <span class="menuBarLeft">
         <a href="http://www.ulb.be/index.html" onmouseout="TM.menuBarOff('home','http://www.ulb.be/design1/img/menubar-home-off.gif'); TM.mainMenuOff()" onmouseover="TM.menuBarOn('home','http://www.ulb.be/design1/img/menubar-home-on.gif','#838383'); TM.mainMenuOn('menuHome:0:1:180')">
            <img alt="" id="TM_home" src="http://www.ulb.be/design1/img/menubar-home-off.gif">
         </a>
      </span>
      <span class="menuBarLeft">
         <a href="http://www.ulb.be/sitemap/ulb/map-universite.html" onmouseout="TM.menuBarOff('universite','http://www.ulb.be/design1/img/menubar-universite-off.gif'); TM.mainMenuOff()" onmouseover="TM.menuBarOn('universite','http://www.ulb.be/design1/img/menubar-universite-on.gif','#b31a1c'); TM.mainMenuOn('menuUniversite:0:33:220')">
            <img alt="" id="TM_universite" src="http://www.ulb.be/design1/img/menubar-universite-off.gif">
         </a>
      </span>
      <span class="menuBarLeft">
         <a href="http://www.ulb.be/sitemap/ulb/map-enseignement.html" onmouseout="TM.menuBarOff('enseignement','http://www.ulb.be/design1/img/menubar-enseignement-off.gif'); TM.mainMenuOff()" onmouseover="TM.menuBarOn('enseignement','http://www.ulb.be/design1/img/menubar-enseignement-on.gif','#ca7f30'); TM.mainMenuOn('menuEnseignement:0:119:220')">
            <img alt="" id="TM_enseignement" src="http://www.ulb.be/design1/img/menubar-enseignement-off.gif">
         </a>
      </span>
      <span class="menuBarLeft">
         <a href="http://www.ulb.be/sitemap/ulb/map-recherche.html" onmouseout="TM.menuBarOff('recherche','http://www.ulb.be/design1/img/menubar-recherche-off.gif'); TM.mainMenuOff()" onmouseover="TM.menuBarOn('recherche','http://www.ulb.be/design1/img/menubar-recherche-on.gif','#b1a448'); TM.mainMenuOn('menuRecherche:0:224:192')">
            <img alt="" id="TM_recherche" src="http://www.ulb.be/design1/img/menubar-recherche-off.gif">
         </a>
      </span>
      <span class="menuBarLeft">
         <a href="http://www.ulb.be/sitemap/ulb/map-international.html" onmouseout="TM.menuBarOff('international','http://www.ulb.be/design1/img/menubar-international-off.gif'); TM.mainMenuOff()" onmouseover="TM.menuBarOn('international','http://www.ulb.be/design1/img/menubar-international-on.gif','#7ea749'); TM.mainMenuOn('menuInternational:0:312:210')">
            <img alt="" id="TM_international" src="http://www.ulb.be/design1/img/menubar-international-off.gif">
         </a>
      </span>
      <span class="menuBarLeft">
         <a href="http://www.ulb.be/sitemap/ulb/map-vivreulb.html" onmouseout="TM.menuBarOff('vivreulb','http://www.ulb.be/design1/img/menubar-vivreulb-off.gif'); TM.mainMenuOff()" onmouseover="TM.menuBarOn('vivreulb','http://www.ulb.be/design1/img/menubar-vivreulb-on.gif','#648ba8'); TM.mainMenuOn('menuVivreUlb:0:418:215')">
            <img alt="" id="TM_vivreulb" src="http://www.ulb.be/design1/img/menubar-vivreulb-off.gif">
         </a>
      </span>
      <span class="menuBarLeft">
         <img alt="" src="http://www.ulb.be/design1/img/menubar-light-left.gif">
      </span>
      <span class="menuBarRight">
         <a href="http://www.ulb.be/" onmouseout="TM.menuBarOff('reseaux','http://www.ulb.be/design1/img/menubar-reseaux-off.gif'); TM.mainMenuOff()" onmouseover="TM.menuBarOn('reseaux','http://www.ulb.be/design1/img/menubar-reseaux-on.gif','#999999'); TM.mainMenuOn('menuReseaux:0:764:238')">
            <img alt="" id="TM_reseaux" src="http://www.ulb.be/design1/img/menubar-reseaux-off.gif">
         </a>
      </span>
      <span class="menuBarRight">
         <a href="http://www.ulb.be/actulb/index.php" onmouseout="TM.menuBarOff('actualites','http://www.ulb.be/design1/img/menubar-actualites-off.gif'); TM.mainMenuOff()" onmouseover="TM.menuBarOn('actualites','http://www.ulb.be/design1/img/menubar-actualites-on.gif','#9aaec1'); TM.mainMenuOn('menuActualites:0:862:140')">
            <img alt="" id="TM_actualites" src="http://www.ulb.be/design1/img/menubar-actualites-off.gif">
         </a>
      </span>
      <span class="menuBarRight">
         <a href="http://www.ulb.be/" onmouseout="TM.menuBarOff('quickaccess','http://www.ulb.be/design1/img/menubar-quickaccess-off.gif'); TM.mainMenuOff()" onmouseover="TM.menuBarOn('quickaccess','http://www.ulb.be/design1/img/menubar-quickaccess-on.gif','#9aaec1'); TM.mainMenuOn('menuQuickAccess:0:774:220')">
            <img alt="" id="TM_quickaccess" src="http://www.ulb.be/design1/img/menubar-quickaccess-off.gif">
         </a>
      </span>
      <span class="menuBarRight" id="menu-dbg" style="display:none">
         <a href="http://www.ulb.be/javascript:debugMenu()">
            <img alt="" src="http://www.ulb.be/design1/img/menubar-debug-off.gif">
         </a>
      </span>
      <span class="menuBarRight">
         <img alt="" src="http://www.ulb.be/design1/img/menubar-dark-right.gif">
      </span>
      <div style="clear:both"></div>
   </div>
   <div id="menuBarArea">
      <div style="position:absolute; z-index: 0;">
         <img alt="" id="TM_menuBarImg" src="http://www.ulb.be/design1/img/menubar-colors.gif">
      </div>
      <div class="firstLevelMenuPane" id="TM_menuHome" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()">
         <div class="firstLevelMenu" style="border-color: #838383;">
            <a href="index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuHome')">Page d'accueil / Homepage</a>
            <a class="more" href="index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuHome.menuProfils:33:171:200')">Je suis/I am ...</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuProfils" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #838383;">
            <a href="http://www.ulb.be/futur-etudiant/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">futur &eacute;tudiant</a>
            <a href="http://www.ulb.be/ulb/bienvenue/etudiants.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">&eacute;tudiant de l'ULB</a>
            <a href="http://www.ulb.be/rech/doctorants/index-fr.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">doctorant</a>
            <a href="http://www.ulb.be/dr/chercheurs.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">chercheur</a>
            <a href="http://www.ulb.be/international/students/en/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">international student</a>
            <a href="http://www.ulb.be/rech/doctorants/index-en.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">international PhD</a>
            <a href="http://www.ulb.be/international/Mobility-IN-Researcher.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">international researcher</a>
            <a href="http://www.ulb.be/alumni/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">alumni</a>
            <a href="http://www.ulb.be/ulb/bienvenue/personnel.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">personnels ULB</a>
            <a href="http://www.ulb.be/ulb/bienvenue/enseignants.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">enseignant</a>
            <a href="http://www.ulb.ac.be/actulb/presse.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">journaliste</a>
            <a href="http://www.ulb.be/emploi/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">&agrave; la recherche d'un emploi</a>
            <a href="http://www.ulb.be/ulb/bienvenue/entreprises.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuProfils')">une entreprise</a>
         </div>
      </div>
      <div class="firstLevelMenuPane" id="TM_menuUniversite" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()">
         <div class="firstLevelMenu" style="border-color: #b31a1c;">
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-universite.html#menuUniversitePresentationFrancais" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversite.menuUniversitePresentationFrancais:14:243:180')">Pr&eacute;sentation de l'ULB - Fran&ccedil;ais</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-universite.html#menuUniversitePresentationEnglish" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversite.menuUniversitePresentationEnglish:33:243:220')">Presentation of the ULB - English</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-universite.html#menuUniversiteOrganisation" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversite.menuUniversiteOrganisation:52:243:170')">Organisation g&eacute;n&eacute;rale</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-universite.html#menuUniversitePartenaires" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversite.menuUniversitePartenaires:71:243:310')">Partenaires</a>
            <a href="http://www.ulb.be/emploi/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversite')">Offres et demandes d'emploi</a>
            <a href="http://www.ulb.be/ulb/bienvenue/soutenez-ulb.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversite')">Soutenez l'ULB</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-universite.html#menuUniversitePlus" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversite.menuUniversitePlus:128:243:280')">En savoir plus...</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuUniversitePresentationFrancais" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #b31a1c;">
            <a href="http://www.ulb.be/ulb/presentation/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePresentationFrancais')">Pr&eacute;sentation de l'universit&eacute;</a>
            <a href="http://www.ulb.be/campus/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePresentationFrancais')">Campus et moyens d'acc&egrave;s</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuUniversitePresentationEnglish" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #b31a1c;">
            <a href="http://www.ulb.be/ulb/presentation/uk.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePresentationEnglish')">Presentation of the University</a>
            <a href="http://www.ulb.be/campus/index-en.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePresentationEnglish')">Campus sites (maps and access...)</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuUniversiteOrganisation" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #b31a1c;">
            <a href="http://www.ulb.be/ulb/autorites/adresses.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteOrganisation')">Autorit&eacute;s de l'ULB</a>
            <a class="more" href="#" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversite.menuUniversiteOrganisation.menuUniversiteFacs:33:403:370')">
                  Facult&eacute;s/institut/&eacute;cole
               </a>
            <a class="more" href="#" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversite.menuUniversiteOrganisation.menuAdministration:71:403:450')">Administration g&eacute;n&eacute;rale</a>
            <a href="http://www.bib.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteOrganisation')">Biblioth&egrave;ques</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuUniversiteFacs" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 101;">
         <div class="secondLevelMenu" style="border-color: #b31a1c;">
            <a href="http://philoscsoc.ulb.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">Facult&eacute; de Philosophie et Sciences sociales </a>
            <a href="http://www.ulb.be/facs/ltc/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">Facult&eacute; de Lettres, Traduction et Communication</a>
            <a href="http://www.ulb.be/facs/droit/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">Facult&eacute; de Droit et de Criminologie</a>
            <a href="http://www.solvay.edu/index.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">Facult&eacute; Solvay Brussels School of Economics and Management</a>
            <a href="http://www.ulb.be/facs/psycho/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">Facult&eacute; des Sciences psychologiques et de l'&eacute;ducation</a>
            <a href="http://archi.ulb.ac.be/faculte/organisation-facultaire/autorite" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">Facult&eacute; d'Architecture (La Cambre-Horta)</a>
            <a href="http://www.iee-ulb.eu/fr" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">Institut d'&eacute;tudes europ&eacute;ennes</a>
            <a href="http://www.ulb.be/facs/sciences/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">Facult&eacute; des Sciences</a>
            <a href="http://www.ulb.be/facs/bioing/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">&Eacute;cole interfacultaire de bioing&eacute;nieurs</a>
            <a href="http://www.ulb.be/facs/polytech/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">&Eacute;cole polytechnique de Bruxelles</a>
            <a href="http://www.ulb.be/facs/bioing/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">&Eacute;cole interfacultaire de bioing&eacute;nieurs</a>
            <a href="http://www.ulb.be/polesante/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">P&ocirc;le Sant&eacute;</a>
            <a href="http://www.ulb.be/facs/medecine/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">Facult&eacute; de M&eacute;decine</a>
            <a href="http://www.ulb.be/facs/pharma/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">Facult&eacute; de Pharmacie</a>
            <a href="http://www.ulb.be/facs/ism/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">Facult&eacute; des Sciences de la Motricit&eacute;</a>
            <a href="http://www.ulb.be/facs/esp/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversiteFacs')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">&Eacute;cole de Sant&eacute; publique</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuAdministration" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 101;">
         <div class="secondLevelMenu" style="border-color: #b31a1c;">
            <a href="http://www.ulb.be/ulb/greffe/admin/structure.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">Organigramme g&eacute;n&eacute;ral de l'administration</a>
            <a href="http://www.ulb.be/ulb/greffe/documents/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">Documents officiels, statuts, r&egrave;glements ...</a>
            <div class="separator" style="border-color: #b31a1c;"></div>
            <a href="http://www.ulb.be/dc/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">Chancellerie</a>
            <a href="http://www.ulb.be/df/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement de l'administration financi&egrave;re</a>
            <a href="http://www.ulb.be/de/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement &eacute;tudes et &eacute;tudiants</a>
            <a href="http://www.ulb.be/dr/chercheurs.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement recherche</a>
            <a href="http://www.ulb.be/dre/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement des relations ext&eacute;rieures</a>
            <a href="http://www.ulb.be/drh/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement des ressources humaines</a>
            <a href="http://www.ulb.be/dinfo/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement informatique</a>
            <a href="http://www.ulb.be/dscu/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement des services &agrave; la communaut&eacute; universitaire</a>
            <a href="http://www.ulb.ac.be/dbis/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement des biblioth&egrave;ques et de l&rsquo;information scientifique</a>
            <a href="http://www.ulb.be/dsea/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement de support &agrave; l&rsquo;enseignement et aux apprentissages</a>
            <a href="http://www.ulb.be/dinfra/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">D&eacute;partement des infrastructures</a>
            <a href="http://www.ulb.be/scppt/introduction.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">Service Commun de Pr&eacute;vention et de Protection au Travail de l'ULB (SCPPT)</a>
            <a href="http://www.ulb.be/be/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuAdministration')">Bureau d'&eacute;tudes et de projets</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuUniversitePartenaires" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #b31a1c;">
            <a href="http://www.ulb.be/ulb/hopitaux/hopitaux.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePartenaires')">H&ocirc;pitaux li&eacute;s &agrave; l'ULB</a>
            <a href="https://www.poleacabruxelles.be" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePartenaires')">P&ocirc;le acad&eacute;mique de Bruxelles</a>
            <a href="http://www.auf.org/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePartenaires')">Agence universitaire de la francophonie</a>
            <a href="http://www.ulb.be/international/Partenariats-Reseaux.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePartenaires')">Partenaires privil&eacute;gi&eacute;s</a>
            <a href="http://www.ulb.be/international/Partenariats-Reseaux-Reseaux-Internationaux.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePartenaires')">R&eacute;seaux internationaux</a>
            <a href="http://www.ulb.be/international/Partenariats-Reseaux-G3.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePartenaires')">G3 de la francophonie</a>
            <a href="http://www.fondation-ulb.org/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePartenaires')">La Fondation ULB</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuUniversitePlus" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #b31a1c;">
            <a href="http://www.ulb.be/ulb/greffe/documents/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePlus')">Documents officiels, statuts, r&egrave;glements...</a>
            <a href="http://www.ulb.be/ulb/actualite/livres/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePlus')">Publications de l'ULB</a>
            <a href="http://www.ulb.be/ulbAZ/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePlus')">L'ULB de A &agrave; Z</a>
            <a href="http://www.ulb.be/ulb/greffe/documents/calendriers.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePlus')">Calendriers de l'ULB</a>
            <a href="http://www.ulb.be/ulb/greffe/documents/elections.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuUniversitePlus')">Les &eacute;lections &agrave; l'ULB</a>
         </div>
      </div>
      <div class="firstLevelMenuPane" id="TM_menuEnseignement" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()">
         <div class="firstLevelMenu" style="border-color: #ca7f30;">
            <a href="http://www.ulb.be/actulb/index.php?cat=2" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement')">Actualit&eacute;s Enseignement</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-enseignement.html#menuEnseignementPresentation" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement.menuEnseignementPresentation:33:329:270')">Pr&eacute;sentation des enseignements</a>
            <a href="http://www.ulb.ac.be/programme" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement')">Catalogue des programmes</a>
            <a href="http://www.ulb.be/enseignements/inscriptions/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement')">Inscriptions et admissions</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-enseignement.html#menuEnseignementFacs1" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement.menuEnseignementFacs1:71:329:370')">
               Facult&eacute;s/instituts/&eacute;coles
            </a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-enseignement.html#menuEnseignementSupports" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement.menuEnseignementSupports:109:329:280')">Supports aux enseignements</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-enseignement.html#menuEnseignementSupportsEnseignants" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement.menuEnseignementSupportsEnseignants:128:329:280')">Supports aux enseignants</a>
            <a href="http://www.bib.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement')">Biblioth&egrave;ques</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-enseignement.html#menuEnseignementEchanges" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement.menuEnseignementEchanges:166:329:160')">Programmes d'&eacute;changes</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-enseignement.html#menuEnseignementAide" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement.menuEnseignementAide:185:329:150')">Promotion de la r&eacute;ussite</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-enseignement.html#menuEnseignementOrganisation" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignement.menuEnseignementOrganisation:204:329:200')">Organisation administrative</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuEnseignementPresentation" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #ca7f30;">
            <a href="http://www.ulb.be/enseignements/presentation/fr/presentation-fr.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Nos formations</a>
            <a href="http://www.ulb.be/enseignements/presentation/fr/presentation-fr-diplomes.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Dipl&ocirc;me et suppl&eacute;ment au dipl&ocirc;me</a>
            <a href="http://www.ulb.ac.be/programme/?sort=fac&amp;source=ulb&amp;grade=MS" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Masters de sp&eacute;cialisation &agrave; l'ULB</a>
            <a href="http://www.ulb.be/facs/aess/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Agr&eacute;gation (AESS)</a>
            <a href="http://www.ulb.be/facs/capaes/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Certificat d'Aptitude (CAPAES)</a>
            <a href="http://www.ulb.be/international/students/en/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">International students (english)</a>
            <a href="http://www.ulb.be/rech/doctorants/index-fr.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Doctorats et &eacute;coles doctorales (3e cycle)</a>
            <a href="http://www.ulb.be/enseignements/planlangues/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Plan Langues</a>
            <a href="http://www.ulb.be/enseignements/reprise-etudes/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Reprendre des &eacute;tudes</a>
            <a href="http://formcont.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Formation continue</a>
            <a href="http://www.ulb.be/enseignements/prix-etudiants/accueil.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementPresentation')">Prix &eacute;tudiants</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuEnseignementFacs1" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #ca7f30;">
            <a href="http://philoscsoc.ulb.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">Facult&eacute; de Philosophie et Sciences sociales </a>
            <a href="http://www.ulb.be/facs/ltc/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">Facult&eacute; de Lettres, Traduction et Communication</a>
            <a href="http://www.ulb.be/facs/droit/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">Facult&eacute; de Droit et de Criminologie</a>
            <a href="http://www.solvay.edu/index.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">Facult&eacute; Solvay Brussels School of Economics and Management</a>
            <a href="http://www.ulb.be/facs/psycho/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">Facult&eacute; des Sciences psychologiques et de l'&eacute;ducation</a>
            <a href="http://archi.ulb.ac.be/faculte/organisation-facultaire/autorite" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">Facult&eacute; d'Architecture (La Cambre-Horta)</a>
            <a href="http://www.iee-ulb.eu/fr" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">Institut d'&eacute;tudes europ&eacute;ennes</a>
            <a href="http://www.ulb.be/facs/sciences/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">Facult&eacute; des Sciences</a>
            <a href="http://www.ulb.be/facs/bioing/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">&Eacute;cole interfacultaire de bioing&eacute;nieurs</a>
            <a href="http://www.ulb.be/facs/polytech/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">&Eacute;cole polytechnique de Bruxelles</a>
            <a href="http://www.ulb.be/facs/bioing/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">&Eacute;cole interfacultaire de bioing&eacute;nieurs</a>
            <a href="http://www.ulb.be/polesante/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">P&ocirc;le Sant&eacute;</a>
            <a href="http://www.ulb.be/facs/medecine/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">Facult&eacute; de M&eacute;decine</a>
            <a href="http://www.ulb.be/facs/pharma/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">Facult&eacute; de Pharmacie</a>
            <a href="http://www.ulb.be/facs/ism/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">Facult&eacute; des Sciences de la Motricit&eacute;</a>
            <a href="http://www.ulb.be/facs/esp/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">&Eacute;cole de Sant&eacute; publique</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuEnseignementSupports" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #ca7f30;">
            <a href="http://www.bib.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupports')">Biblioth&egrave;ques</a>
            <a href="http://www.ulb.ac.be/enseignements/uv/cours-en-ligne.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupports')">Universit&eacute; virtuelle (cours en ligne)</a>
            <a href="http://cte.ulb.ac.be/index.php/presentation/pret-de-materiel" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupports')">Pr&ecirc;t et location mat&eacute;riel audiovisuel</a>
            <a href="http://www.ulb.ac.be/pub/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupports')">Achat de livres, syllabus</a>
            <a href="http://www.editions-universite-bruxelles.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupports')">&Eacute;ditions de l'ULB</a>
            <a href="http://helpdesk.ulb.ac.be/index.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupports')">Support informatique (email, web, etc.)</a>
            <a href="http://www.ulb.be/enseignements/chartepedagogique/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupports')">Charte p&eacute;dagogique</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuEnseignementSupportsEnseignants" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #ca7f30;">
            <a href="http://www.ulb.be/enseignements/fee/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupportsEnseignants')">Fonds d'Encouragement &agrave; l'Enseignement</a>
            <a href="http://www.ulb.be/enseignements/prixsocrate/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupportsEnseignants')">Prix Socrate</a>
            <a href="http://www.ulb.be/enseignements/chartepedagogique/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupportsEnseignants')">Charte p&eacute;dagogique</a>
            <a href="http://www.ulb.be/enseignements/ficheunite/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupportsEnseignants')">Unit&eacute; d'enseignement</a>
            <a href="http://www.ulb.be/enseignements/dossiers/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementSupportsEnseignants')">Dossier d'enseignement</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuEnseignementEchanges" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #ca7f30;">
            <a href="http://www.ulb.be/enseignements/cpe/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementEchanges')">Aller &eacute;tudier &agrave; l'&eacute;tranger</a>
            <a href="http://www.ulb.be/enseignements/cpe/index2-fr.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementEchanges')">Venir &eacute;tudier &agrave; l'ULB</a>
            <a href="http://www.ulb.be/enseignements/cpe/index3.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementEchanges')">Mobilit&eacute; acad&eacute;mique</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuEnseignementAide" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #ca7f30;">
            <a href="http://www.ulb.be/enseignements/cours-preparatoires/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementAide')">Les cours pr&eacute;paratoires</a>
            <a href="http://www.ulb.be/enseignements/support-enseignements/reussir.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementAide')">Aide &agrave; la r&eacute;ussite</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuEnseignementOrganisation" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #ca7f30;">
            <a href="http://www.ulb.be/de/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuEnseignementOrganisation')">Le D&eacute;partement &eacute;tudes et &eacute;tudiants</a>
         </div>
      </div>
      <div class="firstLevelMenuPane" id="TM_menuRecherche" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()">
         <div class="firstLevelMenu" style="border-color: #b1a448;">
            <a href="http://www.ulb.be/recherche/presentation/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche')">Accueil Recherche</a>
            <a href="http://www.ulb.be/actulb/index.php?cat=3" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche')">Actualit&eacute;s recherche</a>
            <a href="http://www.ulb.be/recherche/presentation/fr-projets.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche')">Recherche fondamentale</a>
            <a href="http://www.ulb.be/recherche/presentation/fr-europe.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche')">Europe</a>
            <a href="http://www.ulb.be/rech/doctorants/index-fr.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche')">Doctorat</a>
            <a href="http://www.ulb.be/recherche/presentation/fr-developpement.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche')">D&eacute;veloppement r&eacute;gional</a>
            <a href="http://www.ulb.be/dr/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche')">Transfert de technologie</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-recherche.html#menuRecherchePresentation" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche.menuRecherchePresentation:147:406:260')">Inventaire de la recherche</a>
            <a href="http://www.ulb.be/dr/chercheurs.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche')">Information aux chercheurs</a>
            <a href="http://www.ulb.be/recherche/presentation/fr-contacts.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche')">Contacts</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-recherche.html#menuRechercheFacs1" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche.menuRechercheFacs1:185:406:370')">
               Facult&eacute;s/instituts/&eacute;coles
            </a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-recherche.html#menuRechercheSupport" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherche.menuRechercheSupport:223:406:280')">Supports &agrave; la recherche</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuRecherchePresentation" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #b1a448;">
            <a href="http://www.ulb.ac.be/rech/inventaire/facultes/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherchePresentation')">Unit&eacute;s de recherche</a>
            <a href="http://www.ulb.ac.be/rech/inventaire/index/chercheursA.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherchePresentation')">Chercheurs</a>
            <a href="http://dev.ulb.ac.be/dptrech/login.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRecherchePresentation')">Mise &agrave; jour de votre unit&eacute; de recherche</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuRechercheFacs1" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #b1a448;">
            <a href="http://philoscsoc.ulb.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">Facult&eacute; de Philosophie et Sciences sociales </a>
            <a href="http://www.ulb.be/facs/ltc/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">Facult&eacute; de Lettres, Traduction et Communication</a>
            <a href="http://www.ulb.be/facs/droit/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">Facult&eacute; de Droit et de Criminologie</a>
            <a href="http://www.solvay.edu/index.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">Facult&eacute; Solvay Brussels School of Economics and Management</a>
            <a href="http://www.ulb.be/facs/psycho/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">Facult&eacute; des Sciences psychologiques et de l'&eacute;ducation</a>
            <a href="http://archi.ulb.ac.be/faculte/organisation-facultaire/autorite" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">Facult&eacute; d'Architecture (La Cambre-Horta)</a>
            <a href="http://www.iee-ulb.eu/fr" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">Institut d'&eacute;tudes europ&eacute;ennes</a>
            <a href="http://www.ulb.be/facs/sciences/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">Facult&eacute; des Sciences</a>
            <a href="http://www.ulb.be/facs/bioing/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">&Eacute;cole interfacultaire de bioing&eacute;nieurs</a>
            <a href="http://www.ulb.be/facs/polytech/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">&Eacute;cole polytechnique de Bruxelles</a>
            <a href="http://www.ulb.be/facs/bioing/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">&Eacute;cole interfacultaire de bioing&eacute;nieurs</a>
            <a href="http://www.ulb.be/polesante/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">P&ocirc;le Sant&eacute;</a>
            <a href="http://www.ulb.be/facs/medecine/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">Facult&eacute; de M&eacute;decine</a>
            <a href="http://www.ulb.be/facs/pharma/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">Facult&eacute; de Pharmacie</a>
            <a href="http://www.ulb.be/facs/ism/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">Facult&eacute; des Sciences de la Motricit&eacute;</a>
            <a href="http://www.ulb.be/facs/esp/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheFacs1')">
               <img alt="" src="http://www.ulb.be/design1/img/main-menu-level2.gif">&Eacute;cole de Sant&eacute; publique</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuRechercheSupport" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #b1a448;">
            <a href="http://www.bib.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheSupport')">Biblioth&egrave;ques</a>
            <a href="http://difusion.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheSupport')">D&eacute;p&ocirc;t institutionnel de l'ULB</a>
            <a href="http://www.ulb.be/dre/recherche/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheSupport')">Communication Recherche</a>
            <a href="http://helpdesk.ulb.ac.be/index.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuRechercheSupport')">Support informatique (email, web...)</a>
         </div>
      </div>
      <div class="firstLevelMenuPane" id="TM_menuInternational" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()">
         <div class="firstLevelMenu" style="border-color: #7ea749;">
            <a href="http://www.ulb.be/actulb/index.php?cat=4" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuInternational')">Actualit&eacute;s de l'International</a>
            <a href="http://www.ulb.be/international/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuInternational')">Accueil</a>
            <a href="http://www.ulb.be/international/Home.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuInternational')">English version</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-international.html#menu2" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuInternational.menu2:71:512:220')">Partenariats et r&eacute;seaux</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-international.html#menu9" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuInternational.menu9:90:512:250')">Coop&eacute;ration au d&eacute;veloppement</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-international.html#menu5" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuInternational.menu5:109:512:220')">Venir &agrave; l'ULB</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-international.html#menu6" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuInternational.menu6:128:512:220')">Partir &agrave; l'&eacute;tranger</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menu2" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #7ea749;">
            <a href="http://www.ulb.be/international/Partenariats-Reseaux.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu2')">Partenaires privil&eacute;gi&eacute;s</a>
            <a href="http://www.ulb.be/international/Partenariats-Reseaux-Reseaux-Internationaux.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu2')">R&eacute;seaux internationaux</a>
            <a href="http://www.ulb.be/international/Partenariats-Reseaux-G3.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu2')">G3</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menu9" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #7ea749;">
            <a href="http://www.ulb.be/international/Cooperation-Universitaire.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu9')">Coop&eacute;ration au d&eacute;veloppement &agrave; l'ULB</a>
            <a href="http://www.ulb.be/international/Cooperation-Universitaire-Financements.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu9')">Financements</a>
            <a href="http://www.ulb.be/international/Cooperation-Universitaire-Projets-en-Cours.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu9')">Nos projets dans le monde</a>
            <a href="http://www.ulb-cooperation.org/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu9')">ULB Cooperation</a>
            <a href="http://www.stagesud.org/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu9')">Les stages au Sud</a>
            <a href="http://www.ulb.be/international/docs/Brochure_Coop_20p_2013.pdf" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu9')">Brochure</a>
            <a href="http://www.ulb.be/international/Cooperation-Universitaire-Reseau-docteur-sud.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu9')">Le R&eacute;seau des docteurs du Sud</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menu5" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #7ea749;">
            <a class="more" href="#" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuInternational.menu5.menu51:109:722:250')">En tant que chercheur</a>
            <a href="http://www.ulb.be/enseignements/cpe/index2.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu5')">En tant qu'&eacute;tudiant Incoming</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menu51" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 101;">
         <div class="secondLevelMenu" style="border-color: #7ea749;">
            <a href="http://www.ulb.be/international/international-welcome-desk-fr.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu51')">International Welcome Desk</a>
            <a href="http://www.ulb.ac.be/rech/doctorants/index-fr.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu51')">Les doctorats &agrave; l'ULB</a>
            <a href="http://www.ulb.be/international/chercheurvisiteur.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu51')">Les chercheurs visiteurs</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menu6" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #7ea749;">
            <a href="http://www.ulb.be/enseignements/cpe/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu6')">Etudiants Out-going</a>
            <a href="http://www.ulb.be/international/Financements-Bourses-Mobilites-OUT.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menu6')">Chercheurs</a>
         </div>
      </div>
      <div class="firstLevelMenuPane" id="TM_menuVivreUlb" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()">
         <div class="firstLevelMenu" style="border-color: #648ba8;">
            <a href="http://www.ulb.be/actulb/index.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Actualit&eacute;s de l'ULB</a>
            <a href="http://www.ulb.be/outils/agenda/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Agenda des activit&eacute;s</a>
            <a href="http://www.ulb.be/ulb/greffe/documents/calendriers.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Calendriers de l'ULB</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-vivreulb.html#menuVivreUlbServices" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb.menuVivreUlbServices:71:623:220')">Services offerts...</a>
            <a href="http://www.ulb.be/dscu/affairesetudiantes/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Vie &eacute;tudiante</a>
            <a href="http://www.ulb.be/logements/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Logement</a>
            <a href="http://www.ulb.be/ulb/greffe/documents/elections.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">&Eacute;lections &agrave; l'ULB</a>
            <a href="http://www.bib.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Biblioth&egrave;ques</a>
            <a href="http://www.ulb.ac.be/culture/culture.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Culture</a>
            <a href="http://www.ulb.ac.be/musees/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Mus&eacute;es de l'ULB</a>
            <a href="http://www.ulb.be/debats/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">D&eacute;bats de l'ULB</a>
            <a href="http://www.ulbsports.eu/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Sports</a>
            <a href="http://www.ulb.be/environnement/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Environnement</a>
            <a href="http://www.ulb.be/mobilite/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Mobilit&eacute; et stationnement</a>
            <a href="http://www.ulb.be/ulb/qualite/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Qualit&eacute;</a>
            <a class="more" href="http://www.ulb.be/sitemap/ulb/map-vivreulb.html#menuVivreUlbOutils" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb.menuVivreUlbOutils:261:623:220')">Outils &eacute;lectroniques...</a>
            <a href="http://www.ulb.be/campus/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Campus et sites (plans d'acc&egrave;s)</a>
            <a href="http://www.ulb.be/emploi/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlb')">Offres et demandes d'emploi</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuVivreUlbServices" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #648ba8;">
            <a href="http://www.ulb.be/services/futurs-etudiants/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbServices')">aux futurs &eacute;tudiants</a>
            <a href="http://www.ulb.be/services/etudiants/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbServices')">aux &eacute;tudiants</a>
            <a href="http://www.ulb.be/services/anciens/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbServices')">aux anciens &eacute;tudiants</a>
            <a href="http://www.ulb.be/services/personnel/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbServices')">aux membres du personnel</a>
            <a href="http://www.ulb.be/services/enseignants/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbServices')">aux enseignants du secondaire</a>
         </div>
      </div>
      <div class="secondLevelMenuPane" id="TM_menuVivreUlbOutils" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()" style="z-index: 100;">
         <div class="secondLevelMenu" style="border-color: #648ba8;">
            <a href="http://monulb.ulb.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbOutils')">Portail MonULB</a>
            <a href="http://webmail.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbOutils')">Webmail (courrier &eacute;lectronique)</a>
            <a href="http://uv.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbOutils')">Universit&eacute; virtuelle (cours en ligne)</a>
            <a href="https://support.ulb.be/web/support" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbOutils')">Support ULB </a>
            <a href="http://helpdesk.ulb.ac.be/index.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbOutils')">Support informatique</a>
            <a href="http://webnotes.ulb.ac.be" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuVivreUlbOutils')">Webnotes (fiches techniques)</a>
         </div>
      </div>
      <div class="firstLevelMenuPane" id="TM_menuReseaux" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()">
         <div class="firstLevelMenu" style="border-color: #999999;">
            <a class="icon" href="https://www.facebook.com/ulbruxelles" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuReseaux')">
               <img border="0" class="menuIcon" src="http://www.ulb.be/design1/img/link-facebook.png">L'ULB sur Facebook</a>
            <a class="icon" href="http://twitter.com/ULBruxelles" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuReseaux')">
               <img border="0" class="menuIcon" src="http://www.ulb.be/design1/img/link-twitter.png">L'ULB sur Twitter</a>
            <a class="icon" href="http://instagram.com/insta_ulb" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuReseaux')">
               <img border="0" class="menuIcon" src="http://www.ulb.be/design1/img/link-instagram.png">L'ULB sur Instagram</a>
            <a class="icon" href="http://www.youtube.com/user/ULBruxelles" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuReseaux')">
               <img border="0" class="menuIcon" src="http://www.ulb.be/design1/img/link-youtube.png">ULB TV</a>
            <a class="icon" href="http://www.scoop.it/t/ulb" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuReseaux')">
               <img border="0" class="menuIcon" src="http://www.ulb.be/design1/img/link-scoopit.png">L'ULB sur Scoop.it</a>
            <a class="icon" href="http://www.linkedin.com/company/universite-libre-de-bruxelles" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuReseaux')">
               <img border="0" class="menuIcon" src="http://www.ulb.be/design1/img/link-linkedin.png">L'ULB en tant qu'entreprise</a>
            <a class="icon" href="http://www.linkedin.com/edu/school?id=10418" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuReseaux')">
               <img border="0" class="menuIcon" src="http://www.ulb.be/design1/img/link-linkedin.png">L'ULB en tant qu'universit&eacute;</a>
            <a class="icon" href="http://www.ulb.be/outils/flux/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuReseaux')">
               <img border="0" class="menuIcon" src="http://www.ulb.be/design1/img/link-rss.png">Le flux RSS de l'ULB</a>
            <a class="icon" href="http://www.ulb.be/dre/com/reseaux-sociaux.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuReseaux')">
               <img border="0" class="menuIcon" src="http://www.ulb.be/design1/img/link-reseaux.png">Les Facult&eacute;s et Services de l'ULB</a>
         </div>
      </div>
      <div class="firstLevelMenuPane" id="TM_menuActualites" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()">
         <div class="firstLevelMenu" style="border-color: #9aaec1;">
            <a href="http://www.ulb.be/actulb/index.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuActualites')">Toutes les actualit&eacute;s</a>
            <a href="http://www.ulb.be/outils/agenda/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuActualites')">Agenda des activit&eacute;s</a>
            <a href="http://www.ulb.be/galeriephotos" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuActualites')">Galerie photos</a>
            <a href="http://www.ulb.ac.be/wserv2_oratio/oratio?f_type=view&amp;f_context=unibooks" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuActualites')">Les livres &agrave; l'ULB</a>
            <a href="http://www.ulb.ac.be/actulb/presse.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuActualites')">Infos Presse</a>
         </div>
      </div>
      <div class="firstLevelMenuPane" id="TM_menuQuickAccess" onmouseout="TM.mainMenuOff()" onmouseover="TM.mainMenuKeep()">
         <div class="firstLevelMenu" style="border-color: #9aaec1;">
            <a href="http://www.ulb.ac.be/programme" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Catalogue des programmes</a>
            <a href="http://gehol.ulb.ac.be/gehol/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Horaires des cours (GeHoL)</a>
            <a href="http://www.ulb.be/de/infor-etudes/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">InfOR-&eacute;tudes</a>
            <a href="http://www.ulb.be/enseignements/inscriptions/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Inscriptions/Admissions</a>
            <a href="http://www.ulb.ac.be/facs/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Facult&eacute;s/institut/&eacute;coles de l'ULB</a>
            <a href="http://monulb.ulb.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Portail MonULB</a>
            <a href="http://www.bib.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Biblioth&egrave;ques</a>
            <a href="http://www.ulb.be/ulbAZ/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">L'ULB de A &agrave; Z</a>
            <a href="http://www.ulb.be/outils/agenda/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Agenda des activit&eacute;s</a>
            <a href="http://webmail.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Webmail (courrier &eacute;lectronique)</a>
            <a href="http://uv.ulb.ac.be/" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Universit&eacute; virtuelle (cours en ligne)</a>
            <a href="https://support.ulb.be/web/support" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Support ULB </a>
            <a href="http://helpdesk.ulb.ac.be/index.php" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Support informatique</a>
            <a href="http://www.ulb.be/emploi/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Offres et demandes d'emploi</a>
            <a href="http://www.ulb.be/pub/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Presses Universitaires de Bruxelles</a>
            <a href="http://www.ulb.be/portailperso/index.html" onclick="return TM.mainMenuGo()" onmouseover="TM.mainMenuOn('menuQuickAccess')">Portail du personnel de l'ULB</a>
         </div>
      </div>
   </div>
</div>
                  
<div id="pageContent">           
    <div class="pageContentLayouts">             
        <table class="layoutL">
            <tr id="rowid:N115CC" class="layoutL">
                <td id="cellid:N115CC:1" class="layoutL-L"><div style="width:100%;">
                    <table border="0" style="width:100%;margin-left:auto;margin-right:auto;" cellspacing="0" cellpadding="0">
                        <tr id="rowid:N11691"><td id="cellid:N11693:1" colspan="3" style="background-color:transparent;text-align:left; vertical-align:top;">
                        <?php 
                        if(isset($_POST['term'])) {
                            include("results.php");
                        } else if(isset($_GET['glossary'])) {
                            include("glossary.php");
                        } else {
                            include("form.php");
                        }
                        ?>
                        </td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>            
</div>

<div>
   <script type="text/javascript">BM=new MenuBarConstructor('BM',null,null,null);</script>
   <div class="menuBar">
      <span class="menuBarLeft">
         <a href="http://www.ulb.be/ulbAZ/index.html" onclick="BM.menuBarOff('ulbaz','http://www.ulb.be/design1/img/menubar-ulbaz-off.gif'); return BM.mainMenuGo()" onmouseout="BM.menuBarOff('ulbaz','http://www.ulb.be/design1/img/menubar-ulbaz-off.gif'); BM.mainMenuOff()" onmouseover="BM.menuBarOn('ulbaz','http://www.ulb.be/design1/img/menubar-ulbaz-on.gif','#999999');">
            <img alt="" id="BM_ulbaz" src="http://www.ulb.be/design1/img/menubar-ulbaz-off.gif">
         </a>
      </span>
      <span class="menuBarLeft">
         <img alt="" src="http://www.ulb.be/design1/img/menubar-light-left.gif">
      </span>
      <span class="menuBarRight" id="menu-dbg" style="display:none">
         <a href="http://www.ulb.be/javascript:debugMenu()">
            <img alt="" src="http://www.ulb.be/design1/img/menubar-debug-off.gif">
         </a>
      </span>
      <span class="menuBarRight">
         <img alt="" src="http://www.ulb.be/design1/img/menubar-dark-right.gif">
      </span>
      <div style="clear:both"></div>
   </div>
</div>
      
            <div class="keywordTags">
   <div class="keywordTagsColumn">
      <a href="http://www.ulb.be/campus/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">acc&egrave;s campus</a>
      <a href="http://www.ulb.ac.be/programme">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">catalogue des programmes</a>
      <a href="http://www.ulb.be/environnement/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">environnement</a>
      <a href="http://www.ulb.be/international/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">international</a>
      <a href="http://www.ulb.ac.be/espritlibre">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">magazine de l'ULB</a>
      <a href="http://www.ulb.be/enseignements/planlangues/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">plan langues</a>
      <a href="http://www.radiocampus.be">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">radio Campus</a>
      <a href="http://www.ulb.be/dre/com/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">service communication</a>
   </div>
   <div class="keywordTagsColumn">
      <a href="http://www.ulb.ac.be/actulb/index.php">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">actualit&eacute;s de l'ULB</a>
      <a href="http://www.ulb.be/dre/com/chartes.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">charte graphique</a>
      <a href="http://formcont.ulb.ac.be/">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">formation continue</a>
      <a href="http://www.ulb.be/ulb/presentation/bienvenue.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">l'ULB en bref</a>
      <a href="http://www.ulb.ac.be/demainmaster/">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">masters (liste des formations)</a>
      <a href="https://mon-ulb.ulb.ac.be/cp/home/displaylogin">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">portail MonULB</a>
      <a href="http://www.ulb.be/recherche/presentation/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">recherche</a>
      <a href="http://www.ulb.be/ulb/bienvenue/soutenez-ulb.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">soutenez l'ULB</a>
   </div>
   <div class="keywordTagsColumn">
      <a href="http://www.ulb.be/outils/agenda/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">agenda</a>
      <a href="http://www.ulb.be/outils/contacts/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">contacts</a>
      <a href="http://www.ulb.be/ulb/hopitaux/hopitaux.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">h&ocirc;pitaux universitaires</a>
      <a href="http://www.ulb.ac.be/newsletter">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">la lettre de l'ULB</a>
      <a href="http://www.ulb.be/services/etudiants/mediatheque.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">m&eacute;diath&egrave;que</a>
      <a href="http://www.ulb.be/ulb/bienvenue/journaliste.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">presse</a>
      <a href="http://www.ulb.be/ulb/greffe/documents/reglements-general-etudes.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">r&egrave;glement des examens et des jurys</a>
      <a href="http://www.ulb.be/services/personnel/sport-personnel.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">sports</a>
   </div>
   <div class="keywordTagsColumn">
      <a href="http://www.ulb.be/outils/annuaire/1.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">annuaire</a>
      <a href="http://www.ulb.be/enseignements/presentation/fr/presentation-fr-ects.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">ects</a>
      <a href="http://gehol.ulb.ac.be/gehol/">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">horaires des cours (GeHol)</a>
      <a href="http://www.ulb.be/debats/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">les d&eacute;bats de l'ULB</a>
      <a href="http://www.ulb.be/musees/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">mus&eacute;es de l'ULB</a>
      <a href="http://www.ulb.be/pub/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">presses universitaires de bruxelles</a>
      <a href="http://www.ulb.be/ulb/greffe/documents/reglements-general-etudes.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">r&egrave;glement g&eacute;n&eacute;ral des &eacute;tudes</a>
      <a href="http://www.ulb.be/debats/index-enbref.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">tribunes de l'ULB </a>
   </div>
   <div class="keywordTagsColumn">
      <a href="http://www.ulb.ac.be/demainetudiant/">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">bacheliers (liste des formations)</a>
      <a href="http://www.ulb.be/emploi/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">emploi</a>
      <a href="http://www.ulb.be/enseignements/inscriptions/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">inscriptions/admissions</a>
      <a href="http://www.ulb.be/ulb/actualite/livres/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">livres</a>
      <a href="http://www.ulb.be/international/Partenariats-Reseaux.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">partenaires de l'ULB</a>
      <a href="http://www.ulb.be/dre/com/infopub.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">publications institutionnelles</a>
      <a href="http://www.ulb.be/enseignements/reprise-etudes/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">reprendre des &eacute;tudes</a>
      <a href="http://www.ulb.ac.be/culture/index.html">
         <img alt="" src="http://www.ulb.be/design1/img/keywords-bullet.gif" style="border-style:none;border-width:0px;">ULB Culture</a>
   </div>
   <div style="clear:both"></div>
   <div id="pageBodyFooter">
      <img alt="ULB - entreprise &eacute;codynamique" src="http://www.ulb.be/design1/img/ecodyn.png">
   </div>
</div>
      
         </div>
      </div>
   </body>
</html>