### Concept and Challenges:

A Template Framework, Both user and developer friendly, To enhance and empower a Joomla template. To maintain the balance between framework and template, Template should inherit all features from framework and it may also have his own features. So, user can use all available features of template and the framework, Both at the same time.



### Old vs New template structure.

astroid-template-zero  
┣ astroid `Optional`  
┃ ┣ elements `Optional - To add new elements or override existing`  
┃ ┣ options `Optional - To add new options or override existing`  
┃ ┣ presets `Optional - Template Presets`  
┃ ┗ default.json `Optional - Default Template Settings`  
┣ css  
┃ ┣ isis  
┃ ┃ ┣ index.html  
┃ ┃ ┗ isis.css  
┃ ┗ index.html  
┣ ~~frontend~~ `Deleted - Site frontend blocks layouts. In New version, Enharits from framework and can override through html folder`  
┣ html `Site overrides`  
┣ images `Template Images`  
┃ ┣ default `Default folder content will auto move into media folder`  
┣ js  
┃ ┣ ~~jui~~  `Deleted - Joomla Bootstrap overrides`  
┃ ┣ ~~vendor~~  `Deleted - JS plugins and functions. In New version, Manage by framework and can never be overridden.`  
┃ ┣ system  
┃ ┃ ┣ frontediting-uncompressed.js  
┃ ┃ ┗ frontediting.js  
┃ ┣ index.html  
┃ ┗ isis.js  
┃ ┗ ~~script.js~~ `Deleted - In new version, Manage by framework`
┣ language  
┣ scss `Templates SCSS Styling`  
┃ ┣ ~~astroid~~ `Deleted - Astroid style dependencies. In New version, Manage by framework`  
┃ ┣ ~~boostrap~~ `Bootstrap style dependencies. In New version, Manage by framework`  
┃ ┣ zero `Optional - Template styles. Folder name and structure can be anything.`  
┃ ┃ ┣ ~~_variables.scss~~ `Deleted - No More use`  
┃ ┃ ┣ ~~style.scss~~ `Deleted - No More use`  
┃ ┃ ┗ ~~variables_override.scss~~ `Deleted - No More use`  
┃ ┗ style.scss `Main - Old way is deprecated, Auto include if exist, This will have all styles and includes. Template developer can override Astroid and Bootstrap anywhere in their scss.`  
┃ ┣ custom `Optional - To add custom styles`  
┃ ┃ ┣ custom.scss `Auto include if exists. In New version, User can Access or override varibales, mixins and styles of Astroid, Bootstrap and Template's scss.`  
┣ README.md  
┣ component.php  
┣ error.php `Updated - With Framework's new library.`  
┣ helper.php `Optional - Template Helper`  
┣ index.php `Updated, Removed dependencies and updated with Framework's new library.`  
┣ offline.php  
┣ templateDetails.xml  
┣ template_preview.png  
┗ template_thumbnail.png  
  
### HTML Structure  

```php+HTML
<html>
	<head>
	</head>
	<body>
		<div class="astroid-container">
			<div class="astroid-content">
				<div class="astroid-layout">
					<div class="astroid-wrapper">
					</div>
        			</div>
			</div>
		</div>
	</body>
</html>
```

Template developers can add additional code at `bodyStart`, `bodyEnd`, `containerStart`, `containerEnd`, `contentStart`, `contentEnd`, `layoutStart`, `layoutEnd`, `wrapperStart` and `wrapperEnd` by simply adding file with the same name in `html/frontend/*.php` for example if want to add any code just after `astroid-container` starts then add your code in `html/frontend/containerStart.php` file.

**Note:** There are some more enhancements has been done, Will update document once will finish our work.



### Old vs New Framework Structure

astroid-framework  
┣ assets  
┃ ┣ css `For Admin use only`  
┃ ┣ images `For Admin use only`  
┃ ┣ js `For Admin use only`  
┃ ┣ json `For Admin use only`  
┃ ┣ menu_scss `For Admin use only`  
┃ ┣ scss `For Admin use only`  
┃ ┣ vendor `Third party assets both for site and admin`  
┃ ┃ ┣ ace `For Admin use only`  
┃ ┃ ┣ angular `For Admin use only`  
┃ ┃ ┣ api-check `For Admin use only`  
┃ ┃ ┣ astroid `Site template Astroid defaults`  
┃ ┃ ┃ ┣ css `Astroid default css for site, Moved from template`  
┃ ┃ ┃ ┃ ┗ debug.css  
┃ ┃ ┃ ┣ js `Astroid default javascripts for site, Moved from template`  
┃ ┃ ┃ ┃ ┣ countdown.min.js  
┃ ┃ ┃ ┃ ┣ debug.js  
┃ ┃ ┃ ┃ ┣ jquery-noconflict.js  
┃ ┃ ┃ ┃ ┣ lazyload.min.js  
┃ ┃ ┃ ┃ ┣ megamenu.js  
┃ ┃ ┃ ┃ ┣ mobilemenu.js  
┃ ┃ ┃ ┃ ┣ offcanvas.js  
┃ ┃ ┃ ┃ ┣ script.js  
┃ ┃ ┃ ┃ ┣ smooth-scroll.polyfills.min.js  
┃ ┃ ┃ ┃ ┗ videobg.js  
┃ ┃ ┃ ┗ scss `Astroid default scss for site, Moved from template`  
┃ ┃ ┃ ┃ ┣ components  
┃ ┃ ┃ ┃ ┃ ┣ _backtotop.scss  
┃ ┃ ┃ ┃ ┃ ┣ _badge.scss  
┃ ┃ ┃ ┃ ┃ ┣ _banner.scss  
┃ ┃ ┃ ┃ ┃ ┣ _blog.scss  
┃ ┃ ┃ ┃ ┃ ┣ _components.scss  
┃ ┃ ┃ ┃ ┃ ┗ _rating.scss  
┃ ┃ ┃ ┃ ┣ joomla  
┃ ┃ ┃ ┃ ┃ ┣ _frontend.scss  
┃ ┃ ┃ ┃ ┃ ┣ _joomla.scss  
┃ ┃ ┃ ┃ ┃ ┣ _language_switcher.scss  
┃ ┃ ┃ ┃ ┃ ┗ _mod_articles_categories.scss  
┃ ┃ ┃ ┃ ┣ utilities  
┃ ┃ ┃ ┃ ┃ ┣ _animations.scss  
┃ ┃ ┃ ┃ ┃ ┣ _modal.scss  
┃ ┃ ┃ ┃ ┃ ┣ _responsive.scss  
┃ ┃ ┃ ┃ ┃ ┗ _utilities.scss  
┃ ┃ ┃ ┃ ┣ _comingsoon.scss  
┃ ┃ ┃ ┃ ┣ _contactinfo.scss  
┃ ┃ ┃ ┃ ┣ _error.scss  
┃ ┃ ┃ ┃ ┣ _header.scss  
┃ ┃ ┃ ┃ ┣ _layouts.scss  
┃ ┃ ┃ ┃ ┣ _menu.scss  
┃ ┃ ┃ ┃ ┣ _mixins.scss  
┃ ┃ ┃ ┃ ┣ _mobilemenu.scss  
┃ ┃ ┃ ┃ ┣ _offcanvas.scss  
┃ ┃ ┃ ┃ ┣ _pagination.scss  
┃ ┃ ┃ ┃ ┣ _rtl.scss  
┃ ┃ ┃ ┃ ┣ _social.scss  
┃ ┃ ┃ ┃ ┣ _variables.scss  
┃ ┃ ┃ ┃ ┗ astroid.scss  
┃ ┃ ┣ bootstrap `Site template Bootstrap, Moved from template`  
┃ ┃ ┃ ┣ js  
┃ ┃ ┃ ┗ scss  
┃ ┃ ┣ bootstrap-slider `For Admin use only`  
┃ ┃ ┣ dropzone `For Admin use only`  
┃ ┃ ┣ fontawesome `Fontawesome both for Admin and Site`  
┃ ┃ ┣ jquery `jQuery both for Admin and Site`  
┃ ┃ ┣ moment `Moment both for Admin and Site`  
┃ ┃ ┣ semantic-ui `For Admin use only`  
┃ ┃ ┗ spectrum `For Admin use only`  
┃ ┣ astroid.min.js `For Admin use only`  
┃ ┗ index.html  
┣ framework `Astroid Framework`  
┃ ┣ elements `Astroid elements`  
┃ ┃ ┣ banner   
┃ ┃ ┣ component  
┃ ┃ ┣ message  
┃ ┃ ┣ module_position  
┃ ┃ ┗ ...  
┃ ┣ fields `Astroid Fields for Admin`  
┃ ┣ forms `Astroid Forms for Admin`  
┃ ┣ frontend `* Frontend Blocks, Moved from template`  
┃ ┣ layouts `Astroid Layouts, For Admin use only`  
┃ ┃ ┣ fields `Fields Layouts, For Admin use only`  
┃ ┃ ┣ framework `For Admin use only`  
┃ ┃ ┣ manager `Astroid Admin Layout, For Admin use only`  
┃ ┣ library  
┃ ┃ ┣ FontLib `For Admin use only`  
┃ ┃ ┣ scssphp `For Admin use only`  
┃ ┃ ┣ vendor `Third party libraries, For Admin use only`  
┃ ┃ ┣ astroid `** Astroid Library, PSR4 Autoloader, Main Astroid library to make magic happen, will be fully documented soon.`  
┃ ┃ ┃ ┣ Component  
┃ ┃ ┃ ┃ ┣ Article.php  
┃ ┃ ┃ ┃ ┣ Includer.php  
┃ ┃ ┃ ┃ ┣ LazyLoad.php  
┃ ┃ ┃ ┃ ┣ Menu.php  
┃ ┃ ┃ ┃ ┗ Utility.php  
┃ ┃ ┃ ┣ Element  
┃ ┃ ┃ ┃ ┣ BaseElement.php  
┃ ┃ ┃ ┃ ┣ Column.php  
┃ ┃ ┃ ┃ ┣ Element.php  
┃ ┃ ┃ ┃ ┣ Layout.php  
┃ ┃ ┃ ┃ ┣ Row.php  
┃ ┃ ┃ ┃ ┗ Section.php  
┃ ┃ ┃ ┣ Helper  
┃ ┃ ┃ ┃ ┣ Client.php  
┃ ┃ ┃ ┃ ┣ Constants.php  
┃ ┃ ┃ ┃ ┣ Font.php  
┃ ┃ ┃ ┃ ┣ Form.php  
┃ ┃ ┃ ┃ ┣ Head.php  
┃ ┃ ┃ ┃ ┣ Media.php  
┃ ┃ ┃ ┃ ┣ Migration.php  
┃ ┃ ┃ ┃ ┣ Style.php  
┃ ┃ ┃ ┃ ┣ Template.php  
┃ ┃ ┃ ┃ ┗ Video.php  
┃ ┃ ┃ ┣ Admin.php  
┃ ┃ ┃ ┣ Auditor.php  
┃ ┃ ┃ ┣ Debugger.php  
┃ ┃ ┃ ┣ Document.php  
┃ ┃ ┃ ┣ Framework.php  
┃ ┃ ┃ ┣ Helper.php  
┃ ┃ ┃ ┣ Reporter.php  
┃ ┃ ┃ ┣ Site.php  
┃ ┃ ┃ ┗ Template.php  
┃ ┣ options `Astroid Default Options, Moved from template`  
┃ ┃ ┣ article.xml  
┃ ┃ ┣ basic.xml  
┃ ┃ ┣ colors.xml  
┃ ┃ ┣ custom.xml  
┃ ┃ ┣ footer.xml  
┃ ┃ ┣ header.xml  
┃ ┃ ┣ index.html  
┃ ┃ ┣ layout.xml  
┃ ┃ ┣ miscellaneous.xml  
┃ ┃ ┣ social.xml  
┃ ┃ ┣ theming.xml  
┃ ┃ ┗ typography.xml  
┃ ┣ ~~article.php~~ `Depreciated in new version`  
┃ ┣ ~~astroid.php~~ `Depreciated in new version`  
┃ ┣ ~~audit.php~~ `Depreciated in new version`  
┃ ┣ ~~constants.php~~ `Depreciated in new version`  
┃ ┣ ~~element.php~~ `Depreciated in new version`  
┃ ┣ ~~helper.php~~ `Depreciated in new version`  
┃ ┣ index.html  
┃ ┣ ~~menu.php~~ `Depreciated in new version`  
┃ ┗ ~~template.php~~ `Depreciated in new version`  
┣ jd `Some extra plugins`  
┣ language `Astroid Admin Language`  
┣ plugins `Astroid Plugins`  
┃ ┗ astroid `Astroid System Plugin`  
┣ astroid.xml `Astroid Library Manifest`  
┗ script.php  

##### * New Astroid version will be fully compatible with Joomla 4

