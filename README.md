[![Github All Releases](https://img.shields.io/github/downloads/joomdev/Astroid-Framework/total.svg)](https://github.com/joomdev/Astroid-Framework/releases)
![AUR](https://img.shields.io/aur/license/yaourt.svg)
[![GitHub release](https://img.shields.io/github/release/joomdev/Astroid-Framework.svg)](https://github.com/joomdev/Astroid-Framework/releases)

# Requirements
* Joomla: 3.8 +
* PHP : 5.6+

# Browser Support
| ![Chrome](https://raw.githubusercontent.com/alrra/browser-logos/master/src/chrome/chrome_48x48.png)|![Firefox](https://raw.githubusercontent.com/alrra/browser-logos/master/src/firefox/firefox_48x48.png)|![Edge](https://raw.githubusercontent.com/alrra/browser-logos/master/src/edge/edge_48x48.png)|![Safari](https://raw.githubusercontent.com/alrra/browser-logos/master/src/safari/safari_48x48.png)|
| :---: | :---:	|:---:|:---:|
| &nbsp;&nbsp;Chrome 64+&nbsp;&nbsp; | &nbsp;&nbsp;Firefox 58+&nbsp;&nbsp; | &nbsp;&nbsp;Edge 14+&nbsp;&nbsp; | &nbsp;&nbsp;Safari 10+ &nbsp;&nbsp; |

# Introduction
In this tutorial, we will be installing the template using Upload Feature in Joomla Administration Control Panel.

Be sure you have downloaded the template, (*You can get the latest copy at https://github.com/joomdev/Astroid-Framework/releases/latest*) and logged into Joomla Administrator Control Panel.

Navigate to `Extensions >> Manage >> Install`


# Installation

In order to Install, click the `browse for file` button and select the download files `astroid_vxxx.zip`, Joomla will automatically start the upload  & continue with the installation after selection of a valid zip file.

After installation, you will be notified with a success notification as following screen.

![Installation Successfull](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/sucess_installation.png)

## Setting Astroid as the default template

You can now navigate to `Extensions >> Templates >> Styles` and set Astroid as your default template by clicking the (star) icon next to the template.
![Set Astroid as your Default template](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/set_default.png)
# Template Options
Template options are divided in multiple sections and then sub sections under them. You can see the sections on the left side of the screen and we will go through all the sections one by one.
## Basic
Under the Basic section you have the following settings
#### Preloader
#### Back to Top
#### Layout Settings


### Preloader

This option allows you to enable or disable the preloader for the site. It is displayed while the content is being loaded.

Option | Default | Description
--------- | ------- | -----------
Animation | none | Here you can select the animation for the preloader from the list.
Color | inherit | Here you can set the color of the animated element of a preloader.
Background | inherit | Here you can select the preloader background color which is to be displayed as a background for the preloader.
Size | inherit | This option allow you to set the size of the preloader.

![preloader](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/preloader.png)

![preloader style icon](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/preloader_style_icon.png)

Preloader is rendered from the following file, learn more about astroid overrides [here](#frontend-folder-overrides).
```html
ROOT/templates/astroid_template_zero/frontend/preloader.php
```
### Back to Top

The "Back to top" button allows you to scroll smoothly to the top of the page with one click. This option allows you to show/hide the back to top button. This Button will display at the bottom right corner of the page after the user scrolls down a bit.

Option | Default | Description
--------- | ------- | -----------
Icon | top-arrow | Here you can select the icon style for your Back to top Button from the dropdown list.
Icon Size | default | You can easily set the size of the icon in pixel to it’s is maximum value by moving an indicator in a horizontal fashion.
Color | inherit | Here you can set the icon color for back to top button.
Background | inherit | You can set the background color for back to top button.
Shape | Circle | You can select Back to top Icon shape i.e. `Circle`, `Round` and `Square`

### Back To Top Button On Mobile
By Default the Back to Top Button will be enabled on mobile, disable the button if you don’t want this feature in mobile view.

![backtotop](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/back_to_top.png)
Back To Top button is rendered from the following file, learn more about astroid overrides [here](#frontend-folder-overrides).
```html
ROOT/templates/astroid_template_zero/frontend/backtotop.php
```
## Layout Settings

You can use two main layouts for your site, Full-Width or Boxed. The full-width layout is the default layout for the template and it displays your content centered whereas in the boxed layout you can apply a background to your body and all your content will still be centered with the background flowing around it.

Option | Default | Description
------------------ | ------- | -----------
Background Image | none | Select a Background Image for boxed layout.
Background Repeat | No-Repeat | Allows you to choose the repeat for the background image. You can select All Repeat, horizontal repeat, vertical repeat or disable repeat of the image.
Background Size | inherit | Adjust the background image displaying. You can select one of the following values: `cover`, `contain` and `inherit`.
Background Position | Center Top | Choose the position for the background image from the Dropdown list.
Background Attachment | Fixed | Set the background image attachment style: `Scroll – background image scrolls with the content` , `Fixed – the background image is fixed and content scrolls over it` *(Select fixed if you want have parallax scrolling effect)*


![Layoutsetting2](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/layout_settings.png)

## Header
The header section contains your logo, mega menu, module menu & off canvas menu. Disabling the header would disable all these elements.

### Header Module Position
Here you can select a suitable module position where you want to display header. *The module position must exist in the layout manager.* Learn more about creating modules positions in layout manager [here](#layout-manager).

### Header Mode
You can select from 6 different header types, the header layouts provide a visual representation of what your header on the frontend would look like.

1. **Horizontal layout** provides 3 different layouts with logo being on the left & mega menu being on the `left`, `center` or `right`.  You also have an option to add a block on the right that can either be a module position or custom HTML.

2. **Stacked header layout** provides with 3 different layout options:
* **Stacked Center:** This layout provides you with the logo and menu in the center of the page with an option to add a block below the menu.
* **Stacked Separated:** This layout provides you an option to have the logo between the menu, Half the menu items will appear on the left and other half on the right with an option to add blocks above and below the menu/logo position.

> In case of Odd number of menu items you can select position right or left for extra menu item.

* **Stacked Divided:** This layout provides you with logo & menu on the left (on top of each other) with option to add 2 blocks on the right, next to menu and/or the logo.

### Header Blocks
Header blocks are positions that let you add content inside the header. Based on the layout selected you may see 1 or 2 blocks. You can either directly enter custom HTML in each block or select a module position of your choice and publish modules to the selected position.

### Mega Menu
You can select from the dropdown list which Joomla! menu you’d like to publish as your main menu.

### Mobile Menu
You can select from the dropdown list which Joomla! menu you’d like to publish as your mobile menu.

![Header settings](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/header_settings.png)

### Logo Options
You can select a logo for desktop view, mobile view and sticky header.

### Logo Type
Logo type gives an option to set the image for logo or the logo text.

* Text Logo Settings - You can enter the text for the logo and an optional tagline as well.
* Image Logo Settings - You can upload a logo for the desktop view and one for mobile view as well.

### Sticky Header
A sticky header is a menu or navigation bar that stays at the top of the page no matter where you scroll. In other words, a “fixed” header.
You can enable or disable the sticky header option, By enabling the option the header will stick to the top when you reach its scroll position.

There are 2 different ways you can show the sticky header
* Sticky: A Sticky or Fixed header appears when a page is scrolled down.
* Sticky on Scroll up: Sticky Header only appears when scrolled up to the page. 

Option | Default | Description
------------------ | ------- | -----------
Sticky Header Logo | none | Select an image for your sticky header logo (*Sticky header logo is only for desktop and will not be visible on the mobile sticky header*).
Sticky Header on Desktop | Sticky | You can select whether you need the header to be sticky at all times or sticky on scroll up.
Sticky Header on Tablets | Sticky | You can select whether you need the header to be sticky at all times , sticky on scroll up or to be static (not visible on scroll) in Tablet view.
Sticky Header on Mobile | Sticky | You can select whether you need the header to be sticky at all times , sticky on scroll up or to be static (not visible on scroll) in mobile view.

![Header logo settings](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/header_logo_settings.png)

### OffCanvas Menu
Here you can customize Off-Canvas style for your site. This is how an off-canvas menu works: The user clicks an icon or performs some sort of action (e.g. slide in on Top , Reveal , Push ) that results in a vertical navigation menu sliding into the screen from off canvas.

Option | Default | Description
------------------ | ------- | -----------
Toggle Visibility | Always | You can select whether you need offcanvas enabled on desktop or mobile only or you can have it displayed at all time.
Panel Width | 240 | You can set the width of the offcanvas navbar (in pixels), default is 240px.
Off canvas Animation | Slide in on Top | You can select the animation that will be used for opening the offcanvas bar.

![Header offcanvas settings](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/header_offcanvas_settings.png)

### Animation
Here you can customize the dropdown animation for both the mega menu as well as for dropdown menu. You can control the speed of an animation by setting a value with the range indicator in a horizontal fashion and also ease in and ease out the animation.

Option | Default | Description
------------------ | ------- | -----------
 Animation| Fade | You can select whether you want animation as fade or slide can also select none if you don't want animation.
Animation speed | 300 ms | Set a value by moving an indicator in a horizontal fashion.
Easing | Linear | You can select the animation from dropdown list.

![Header offcanvas settings](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/header_animation_settings.png)

## Colors
This section allows you to style the color schemes on your site.

### Body

Here you can configure color settings for the body.

Option | Default | Description
------- | ----------- | -----------
Background Color | #eee | Allows you to set the default Background color for the body for the whole site.
Text Color | #333 | Set the Text color of the Body Content.
Link Color | #007bff | Set the color of the link in the Body Content.
Link Hover Color | #007bff | Set the color for hovered links; links hover when the mouse moves over it.

![bodycolor](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/body_color.png)

### Header 

Here you can set the Header color schemes for your site.

Option | Default | Description
------- | ----------- | -----------
Background Color | #333 | Allows you to set the default Background color for the Header section for the whole site.
Text Color | #fff | Set the Text color for the Header section.
Logo Text Color | #007bff  | Set color for your text logo.
Logo Tag Line Color | #007bff  | Set color for Tag Line in your text logo.
Backgroud Color for sticky header | #fff | Set background color of the Sticky Header.

![header-color](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/header_color.png)

### Main Menu

Here you can set the Main Menu color schemes for your site.

Option | Default | Description
------- | ----------- | -----------
Link Color | #333 | Set the link color for the main menu.
Link Hover Color | #007bff | Set the link hover color for the main menu.
Link Active Color | #007bff | Set the appearance of a link while it is being activated.

![mainmenu-color](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/main_menucolor.png)

### Dropdown Menu

Here you can set the Dropdown color schemes for your site.

Option | Default | Description
------- | ----------- | -----------
Background Color | #fff  |Allows you to set the default Background color for the Dropdown menu.
Link Color | #333 | Set the color of the link in the dropdown menu for submenu items.
Hover Link Color | #fff | Set the color for hovered links; links hover when the mouse moves over it.
Hover Background Color | #007bff | Set the Background color for the hovered links.
Active Link Color | #fff | Set the color for the active links; links become active once you click on them.
Active Background Color | #007bff | Set the Background color for the active links.

![dropdownmenu-color](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/dropdown_menucolor.png)

### Off-Canvas

Here you can set the Off-Canvas color schemes for your site.

Option | Default | Description
------- | ----------- | -----------
Background Color | #fff |Set the default Background color for the Off-Canvas Menu.
Text Color | #007bff |Set the Text color for the menu items in the Off-Canvas.
Link Color | #333 | Set the color of the link in the Off-Canvas menu for menu and Sub-menu items.
Active Link Color | #fff | Set the color for the active links (links become active once you click on them).
Active Background Color | #007bff |Set the Background color for the active links.

![offcanvas-color](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/offcanvas_color.png)

## Layout Manager
Layout manager provides the ability to build flexible layout from the collection of available elements. A layout consist of sections, grids and  elements that can be easily managed with the built in drag and drop functionality. It allows customization of each section with Design Settings, Responsive Settings, Animation Settings and others.

![layout](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/Layout.png)

### Layout Structure

* Layout based on module positions includes a responsive, grid system that appropriately scales up to 12 columns as the device or viewport size increases. You can select the desired number of columns from the predefined columns grid or can create your own custom grid layout. 

* Icon with arrows allows you to change positions of rows by moving them up or down. Use plus icon to add new Row, then select column structure and insert module position(s) accordingly.
* Sections, rows and elements can be added, edited, copied and deleted directly in the layout manager.

### Managing Layout  
In the layout particular section can be edited, drag drop, copy, new section can be added and new row with in the section can also be added. Also we can edit, delete and copy particular column.

* Drag and Drop: Click on Drag icon to Drag and Drop  rows/columns to arrange your layout.
* Edit: Click the pencil icon to edit sections and rows. 
* Copy: Click the copy icon to duplicate a section, row or element.
* Delete: Click the delete icon to delete a section, row or element.
* New row: Click on New row to add new row.
* New Section: Click on New section to add new section below to the targeted section.


### Element
New elements can be created by clicking the Add icon that appears in bottom-center when hovering the element.

Following are the elements within this section:
* Module Position
* Component Area
* Messages
* Banner

`If we already added component area and messages before than we are not able to add them again`<br />
`Add messages element to display errors, warnings and notices, if you won't add it you won't be able to see the notifications messages.`

### Section
We can add new section by clicking on the add new section option given with in the row level options or we can also add new section by clicking on add section button.


### Edit Options of Element and Section
Elements and section both have same edit options i.e General Settings, Design Settings and Responsive Settings.


* **General Settings:** general settings have options to set module position, Title, Custom Class and Custom ID of an element.

![general-settings](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/layout_general.png)

* **Design Settings:** In this we have Animation and Custom Background options. To enable Background options we need to switch on the Custom Background Option.

Following are the options for Background in Design Settings:

Option | Default | Description
------- | ----------- | -----------
Background Color | None | Set the Background color for the particular column
Background Image | None | Set the Background image for the particular column
Select Background Repeat | Inherit | Set the Background image of the particular column
Select a background Size | Inherit | Adjust the background image displaying. You can select one of the following values: `cover`, `contain` and `inherit`
Select a Background Attachment | Inherit | Set the background image attachment style: `Scroll – background image scrolls with the content` , `Fixed – the background image is fixed and content scrolls over it`
Select a Background Position | Inherit | Choose the position for the background image from the Dropdown list.
Background Video | None | Set the background video for the particular column

![design-settings](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/layout_design.png)

* **Animation Settings:** Here you will get different animation options which make possible to animate particular column, section and element. You can define animation delay time which will specify a delay for the start of an animation.

* **Responsive settings:** This allows you to control visibility of the columns. You can use breakpoints to define differing content layouts based on device width, you can set the column size to the content layout to ensure that your layout is responsive. And also you can hide components for specific device layouts.

Following are the options for ResponsiveSettings:

Option | Description
------- | -----------
Hide on Extra Small device | Enable to hide this section on Extra small Devices.                                   
Hide on Small Device | Enable to hide this section on Small Devices.                                                    
Hide on Medium device | Enable to hide this section on Medium Devices.                                             
Hide on Large Device |  Enable to hide this section on Large Devices.                                                   
Hide on Extra Large Device | Enable to hide this section on Extra-Large Devices.

![responsive-settings](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/layout_responsive.png)

## Typography
This is a fully customizable font-related section. You can change the fonts and their style accordingly, you can easily customize typography for all body text and the Responsive Headings, that define the Headings H1-H6.

### Body Typography

It allows you to adjust typography settings for the Body on the site. If default selected then properties will inherit from CSS code.

Option | Default | Description
------- | ----------- | -----------
Font Family | Nunito | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 400 | Select the font weight from the list, it will define how bold your text are.
Font Size | 1 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).


![bodytypogarphy](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/body_typography.png)


### Menu Typography
This section allows to adjust typography settings for the Menu. If inherit selected then property will inherit its value from body typography properties.

Option | Default | Description
------- | ----------- | -----------
Font Family | Arial, Helvetica, sans-serif | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 500 | Select the font weight from the list, it will define how bold your text are.
Font Size | 0.7 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).
Font-Color | #000 | set the color of the text. The color is specified by: `color name - like "red"` , `HEX value - like "#ff0000"` , `RGB value - like "rgb(255,0,0)"`.

![menutypogarphy](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/menu_typography.png)


### SubMenu Typography
This section allows to adjust typography settings for the SubMenu. If inherit selected then property will inherit its value from body typography properties. 

Option | Default | Description
------- | ----------- | -----------
Font Family | Arial, Helvetica, sans-serif | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 500 | Select the font weight from the list, it will define how bold your text are.
Font Size | 0.7 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).
Font-Color | #000 | set the color of the text. The color is specified by: `color name - like "red"` , `HEX value - like "#ff0000"` , `RGB value - like "rgb(255,0,0)"`.

![submenutypogarphy](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/submenu_typograpghy.png)


### Headings (H1-H6) Typography
This section allows to adjust typography settings for the headings(H1-H6) used on the site. If inherit selected then property will inherit its value from body typography properties. 

`Here we can set different typography for different types of headings from H1 to H6`

* **H1 Typography**

This section control the typography for all H1 headings.

Option | Default | Description
------- | ----------- | -----------
Font Family | Arial, Helvetica, sans-serif | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 700 | Select the font weight from the list, it will define how bold your text are.
Font Size | 3.5 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).
Font-Color | #000 | set the color of the text. The color is specified by: `color name - like "red"` , `HEX value - like "#ff0000"` , `RGB value - like "rgb(255,0,0)"`. 

![h1typogarphy](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/h1typography.png)


* **H2 Typography**

This section control the typography for all H2 headings.

Option | Default | Description
------- | ----------- | -----------
Font Family | Arial, Helvetica, sans-serif | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 600 | Select the font weight from the list, it will define how bold your text are.
Font Size | 3 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).
Font-Color | #000 | set the color of the text. The color is specified by: `color name - like "red"` , `HEX value - like "#ff0000"` , `RGB value - like "rgb(255,0,0)"`.

![h2typogarphy](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/h2typography.png)


* **H3 Typography**

This section control the typography for all H3 headings.

Option | Default | Description
------- | ----------- | -----------
Font Family | Arial, Helvetica, sans-serif | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 500 | Select the font weight from the list, it will define how bold your text are.
Font Size | 2 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).
Font-Color | #000 | set the color of the text. The color is specified by: `color name - like "red"` , `HEX value - like "#ff0000"` , `RGB value - like "rgb(255,0,0)"`.

![h3typogarphy](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/h3typography.png)

* **H4 Typography**

This section control the typography for all H4 headings.

Option | Default | Description
------- | ----------- | -----------
Font Family | Arial, Helvetica, sans-serif | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 500 | Select the font weight from the list, it will define how bold your text are.
Font Size | 1.5 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).
Font-Color | #000 | set the color of the text. The color is specified by: `color name - like "red"` , `HEX value - like "#ff0000"` , `RGB value - like "rgb(255,0,0)"`.

![h4typogarphy](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/h4typography.png)


* **H5 Typography**

This section control the typography for all H5 headings.

Option | Default | Description
------- | ----------- | -----------
Font Family | Arial, Helvetica, sans-serif | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 500 | Select the font weight from the list, it will define how bold your text are.
Font Size | 1 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).
Font-Color | #000 | set the color of the text. The color is specified by: `color name - like "red"` , `HEX value - like "#ff0000"` , `RGB value - like "rgb(255,0,0)"`.

![h5typogarphy](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/h5typography.png)


* **H6 Typography**

This section control the typography for all H6 headings.

Option | Default | Description
------- | ----------- | -----------
Font Family | Arial, Helvetica, sans-serif | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 500 | Select the font weight from the list, it will define how bold your text are.
Font Size | 0.7 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).
Font-Color | #000 | set the color of the text. The color is specified by: `color name - like "red"` , `HEX value - like "#ff0000"` , `RGB value - like "rgb(255,0,0)"`.

![h6typogarphy](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/h6typography.png)


## Article/Blog
Article/Blog settings allows you to customize the blog and article layout of website.

### Basic Settings
This section allows you to configure the following options.

#### Article type Icons: 
Article type icons are for further more illustration to show which type of content the particular article (post) have. Tha icon will appear on the top right corner of the article.

##### Article Type options
The article type icon can be customize in the Administrator (Back-end) by clicking on the Content menu, in the respective article you will get the following options:

###### Article Type

###### Regular: 
Same as of the default joomla article.

![Regular type](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/article_regular.png)

###### Video: 
Select the video type and enter the respective video URL.  
For both YouTube video ID and Vimeo ID. First, go to the video webpage. Copy the URL and you just need to paste in the Video URL field.

![Video type](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/article_video.png)

###### Gallery: 
For Gallery Type article you need to upload a Gallery Image and define a title and a small description for it. You can add multiple Items to your article.

![Gallery type](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/article_gallery.png)

###### Audio: 
You can Choose from Soundcloud or spotify.
To get an embed code for your track or playlist, click the 'Share' button below the waveform and an overlay will appear. Click on the embed tab to view what options you have to embed your player. Copy-paste the embed code in the code editor.

For Spotify : To retrieve a Spotify song URL, on the web player click on the three dots on a song and choose copy song Link and then copy and paste it in the spotify field.

![Audio type](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/article_audio.png)

###### Review:
You can easily add a detail review for your single article by giving star rating followed by detail description.

![Review type](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/article_review.png)

###### Qoute:
You can add words from a text or speech written or spoken by another person or author. 

![Qoute type](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/article_qoute.png)

###### Article Badge
Use article badge to indicate a specific post. It will appear on the top left corner of the respective post. Here you will get the option to choose between predefined badges or you can create your own.


#### Read Time: 
Enables this option shows the estimated reading time of article.

### Single Article Options:

#### Author Info: 
The Author information is displays underneath the article, the author information is updated the in the Author profile in User Tab.

![Authorinfo](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/user.png)

#### Article Rating: 
Article rating/review shows the star rating for a single article and allows user to give a star rating.

#### Related Posts: 
Allows you to display a list of related posts underneath the article post. The list is based on the meta keyword of the post which makes them more relevant and more likely to display. 
The settings also allows to display number of related post you want to display.

#### Social Buttons Type: 
You can also enable Social Share buttons under each article. You can use AddThis or ShareThis content sharing platform in order to add social buttons. 

##### AddThis: 
Customize the button you would like to use on your site. Copy the code and paste in the code editor.

##### ShareThis: 
Customize the button you would like to use on your site .Copy the property Id and Paste in the Input field. Under Property Settings page you should see the Property ID.

#### Open Graph
Open grapgh allows you to identify which elements of your page you want to show when someone share's your page.
Here you don't need to mess with scripts or tags. Simply add your Facebook App ID and Twitter Username.
You can even set different OG Title, OG Description and OG Image for each article.

![Opengrapgh](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/open_grapgh.png)

#### Comments
This option allows a comment system on the each article post so that users will be able to leave comments under their own name.
Choose between the platforms facebook, disqus, HyperComments or IntenseDebate.

![Article/Blog](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/article_blog.png)

## Custom Code

Here we can add Custom CSS , Custom Javascript 

Option | Default | Description
------- | ----------- | -----------
Tracking Code | none | A tracking code is a snippet of JavaScript code that tracks the activity of a website user by collecting data and sending it to the analytics module. 
Space Before `</head>` | none | For the javascript before `</head>`
Space before `</body>`| none | For the javascript before `</body>`
Custom CSS | none | Here you can add custom CSS to add your own styles or overwrite default CSS, Wrapped within `<style>` tags.
Custom JS | none | Here you can add custom javascript code here, Wrapped within `<script>` tags.

![customcode](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/custom_code.png)

## Social Profile

This section allows you to display your social profiles on your site.

In this section we have : 
* **Module Position :** Select a suitable module position where you want to display this feature.
* **Social Load Position :** If there are other module(s) published to this module position, you can select weather the content of this feature should be displayed below the or after the module(s) published to this position.
* **Style :** Choose the style how you want to show Social profile on your site , default value is Inherit color.

In style we have 2 Options to style our social icons:
   1. Inherit color.
   2. Brand color.

In this section we have in all 21 types of Predefined Social Profiles and also to add Custom social Profile : 
  1. Facebook
  2. Messenger
  3. Twitter
  4. YouTube
  5. LinkedIn
  6. Instagram
  7. WhatsApp
  8. Pinterest
  9. Google Plus
  10. GitHub
  11. Tumblr
  12. reddit
  13. Telegram
  14. Skype
  15. Slack
  16. SoundCloud
  17. Behance
  18. Dribbble
  19. Spotify
  20. Flickr
  21. VK
  
  
![social](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/social.png)

## Miscellaneous

In this section, you can add footer copyright bar, contact Information, customize coming soon and 404 page, set favicon for your site and can also define the responsive breakpoints for your site.

### Copyright

Copyright is a small section at the bottom of each page. You can Enable or Disable the footer copyright bar, by enabling this section it enables you to edit the content of the bottom copyright information of the page.


Option | Default | Description
------- | ----------- | -----------
Custom HTML | none | Here we can enter the text that displays in the copyright bar.
Module Position | astroid-footer | Select a suitable module position where you want to display this feature.
Featue Load Position | After module | If there are other module(s) published to this module position, you can select to display the content of this feature either below or after the module(s) published to this position.

![Copyright](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/copyright.png)

### Contact Information

Here you to add Phone number, Mobile number, Email address, Address and opening hours, also allows to customize the settings where you want to display your Contact Information.

Option | Default | Description
------- | ----------- | -----------
Module Position | none | Select a suitable module position where you want to display this feature.
Featured Load position | After Module | If your selected module position for feature has also module then it will works. This is specially where you want to show this feature, before module or after module.
Phone Number | none | Add phone number here. Leave blank if not required.
Mobile Number | none | Add mobille number here. Leave blank if not required.
Email | none | Add email address here. Leave blank if not required.
Open Hours | none | Add Opening hour here. Leave blank if not required.
Address | none | Add your address here. Leave blank if not required.
Display | icons | Here you can choose to get the information (Phone number ,mobile number, Email, Open hours and Address) displays with Text or Icons.

![miscontact](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/contact_information.png)

### Coming Soon

Here you can customize the maintenance mode page when your site is under construction/maintenance.

`If we enable the development mode than it will take your site offline and show a static coming soon page`

Option | Default | Description
------- | ----------- | -----------
Logo | none | Here you can select a logo which will display on your coming soon Page, default template logo will be displayed if not selected. 
Background Image | none | You can select a Background image for your coming soon page.
Title | Coming Soon |  Here you can Enter the Title for your Coming Soon Page which will be displayed when your site is under construction.
Countdown Date | 2017-05-15 | Here you can set a date for countdown exactly when your site is going to be live.
Social Icon | Icons will appear those which are configured in social section | Enable social Icon
Content | none | Enter description for your coming soon page.
Background Repeat | No Repeat | Set if/how a background image will be repeated.
Background Size | Inherit | This property specifies the size of the background images.
Background Position | Center Top | This property sets the starting position of a background image.

![miscomingsoon](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/coming_soon.png)

### 404 Error

Allows you to customize 404 page for your site

Option | Default | Description
------- | ----------- | -----------
Show Header | none | Select If want to show header.
Background Image | none | Set a Background Image for 404 Error Page
Logo | default template logo | Set a logo for 404 Error Page, default template logo will be used if not selected.
Call To Action | text | Enter text to dislay on Call To Action Button.
404 Page Content | tinyMCE | Enter the content of your 404 page.

![mis404](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/404error.png)

### Favicon

Allows you to upload your browser URL icon. It's recommended to apply a size of 96x96 pixels to the favicon icon

Option | Default | Description
------- | ----------- | -----------
Favicon image | none | Select an icon for a favicon, also known as a shortcut icon, website icon, tab icon, URL icon, or bookmark icon.

![favicon](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/favicon.png)

## Astroid Mega Menu
A mega menu is defined as a drop down interface that is triggered by the user hovering over a link or defined area. This dropdown usually shows all options in one main, mega-panel and oftentimes groups related topics into categories. In this section you can configure menu options.

### Mega Menu : Enable/disable Mega Menu option.

* By default Mega Menu option is disable, you can set icon, subtitle, custom class, width and dropdown Alignment for your dropdown menu.


Option | Description
------- | -----------
Dropdown Alignment | allows you choose align (left/right/centre/Container/Full) dropdown position.
Subtitle | allows you to set subtitle for your menu item.
Icon Only | When you want to show only icon for your Menu instead full title you can enable this option.
Icon | You can set icon for your Menu Items. 
Width | You can set total width in pixel for submenu area.
Custom CSS Class | allows you to add Custom CSS Class(es) to the menu item.

* By enabling Mega Menu you can easily create and customize Mega Menu with sub menu items and modules, offers you different layouts with drag and drop menu building system. Each menu item contains Astroid Menu Options which provides ability to add rows, columns, links and more to a mega menu.

![megamenu](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/mega_menu.png)

Option | Description
------- | -----------
Dropdown Direction | allows you choose align (left/right/centre/full) dropdown position.
Subtitle | allows you to set subtitle for your menu item.
Icon Only | When you want to show only icon for your Menu instead full title you can enable this option.
Icon | You can set icon for your Menu Items. 
Mega menu Width | You can set total width in pixel for mega menu area.
Custom CSS Class | allows you to add Custom CSS Class(es) to the menu item.

* You can add rows by clicking the Add row button that appears in bottom-center , Upon clicking the Add Row button a pop-up will appear showing predefined 12 column grid Layout from here you can select the Menu layout.

* After selecting the menu layout an Add icon button will appear in center, you should be able to see submenu items and modules by clicking on that icon. You can select existing module(s) and submenu items for your column.

* Using drag and drop function, you can easily arrange columns, move elements or modules into another position, from one column into another.

## Astroid Banner
Banner is either a graphic image that announces the name or identity of a site and often is spread across the width of the Web page or is an advertising image.

In this section you can configure Banner options.

By default, Banner is disabled. Once you enable the Banner, you can customize it's settings, you can set the Banner Title, subtitle, background color or image and more.

Option | Description
------- | -----------
Enable Banner | This option allows to Enable/Show or Disable/Hide the Banner.
Banner Title | Set a Title for the Banner, if it is not set, the Menu Title of the menu item will displayed as Banner Title.
Background color | Here you can set a Background color for the Banner.
Background Image | Here you can set  a Background Image for the Banner.
Banner Title Tag | Select the title tag from the dropdown option for the Banner.
Banner Class | You can specify class name for certain tasks for the Banner.
Banner Layout | You can set Banner Layout as Container or Container Fluid, The container provides a responsive fixed width container. The Container fluid provides a full width container, spanning the entire width of the viewport.

`NOTE: In order to make this feature work you have to publish the Banner element using the layout manager.`
In Layout Manager Add a Section where you want to show your banner and select a Banner Element in it.
![banner](https://cdn.joomdev.com/documentation/astroid-framework/images/v2.0.0/banner.png)

# Developer Documentation

## Field Types & Example Codes

### astroidgroup form field type
The astroidgroup form field type lets you group several fields within one section/heading. The section heading is also added under the tabs navigation on the left.

`Example`

```xml
<field type="astroidgroup" name="fieldname" title="title Goes here" description="description goes here"/>
```

### astroidradio form field type
The Asrtroidradio form field type provides radio buttons to select different/multiple options. 

`Example`

```xml
<field type="astroidradio" name="fieldname" title="title Goes her" description="dscription goes here">
<option value="option_one">option_one</option>
<option value="option_two">option_two</option>
</field>
```
Input values:

Value | Description | Required
------- | ----------- | -----------
type | Field type (must be astroidgroup) and this is mandatory | yes
name | The name of the field that will be used for storing values in the database | yes
title | The title of the field that should be displayed in the left navigation & as a heading | yes
description | The description that will be displayed under the title (heading) | no

### astroidmedia form field type
The Astroidmedia form field type provides media option to upload images like background image , logo etc.

`Example`

```xml
<field type="astroidmedia" name="fieldname" title="title Goes here" description="description goes here"/>
```
Input values:

Value | Description | Required
------- | ----------- | -----------
type | Field type (must be astroid group) and this is mandatory | yes
name | The name of the field that will be used for storing values in the database | yes
title | The title of the field that should be displayed in the left navigation & as a heading | yes
description | The description that will be displayed under the title (heading) | no

### astroidlist form field type
With Astroidlist form field type we can create a drop down list. It allows the user to choose one value from a list.

`Example`

```xml
<field type="astroidlist" name="fieldname" title="title Goes here" description="description goes here"  astroid-variable="value for dropdown list" />
```
Input values:

Value | Description | Required
------- | ----------- | -----------
type | Field type (must be astroidlist) and this is mandatory | yes
name | The name of the field that will be used for storing values in the database | yes
title | The title of the field that should be displayed in the left navigation & as a heading | yes
description | The description that will be displayed under the title (heading) | no
astroid-variable | Provided a value for drop down list (astroid list ). | yes

### astroidswitch form field type
The astroidswitch form field provide a switch i.e a checkbox which enable user to make choice (binary choice) , a choice between one of two possible mutually exclusive options

`Example`

```xml
<field type="astroidswitch" name="fieldname" title="Title Goes here" description="Description goes here"  checked="false/true" />
```
Input values:

Value | Description | Required
------- | ----------- | -----------
type | Field type (must be astroidswtich) and this is mandatory | yes
name | The name of the field that will be used for storing values in the database | yes
title | The title of the field that should be displayed in the left navigation & as a heading | yes
description | The description that will be displayed under the title (heading) | no
checked | This is the default value false == 0 and true == 1. Checked=”true” means astroidswitch is checked and checked=”false” means astroidswitch is not checked | no

### Color form field type 
The Color form field provide a color picker to select the color.

`Example`

```xml
<field type="color" name="fieldname" title="Title Goes here" description="Description goes here" />
```												

Input values:

Value | Description | Required
------- | ----------- | -----------
type | Field type (must be color) and this is mandatory | yes
name | The name of the field that will be used for storing values in the database | yes
title | The title of the field that should be displayed in the left navigation & as a heading | yes
description | The description that will be displayed under the title (heading) | no

### astroidtypography form field type
For typography h1,h2,h3,h4,h5,h6 & body.

`Example`																																												
```xml
<field  astroidgroup="body_typography" name="fieldname" type="astroidtypography"  font-face="" alt-font-face="" font-color="" font-size="1"  font-unit="em" letter-spacing="0” line-height="1"   font-style="" font-weight="400" text-transform="none"></field>
```

Input Values:

Name | Default value | Type | Description
------- | ----------- | -------- |---------
font-face | Arial | STRING | font-face can be Arial, Times New Roman, Verdana and Trebuchet and other’s can be possible
alt-font-face | Abel | STRING | If the browser does not support the first font family, it tries the Alternate font family.
font-color | White | STRING | Font-color can be Hex , RGB or RGBA
font-size | 1 | INT | font-size property sets the size of a font
font-unit | em | STRING | font-unit can be px , em pt , ex etc
letter-spacing | 0 | INT | letter-spacing property increases or decreases the space between characters in a text.
line-height | 1 | INT | line-height property specifies the height of a line
font-style | None | STRING | font-style can be  italic , oblique and many more
font-weight | 400 | INT | font-weight property sets how thick or thin characters in text should be displayed. Font-weight can be normal , bold , bolder etc.
text-transform | none | STRING | text-transform can be none , capitalize , uppercase , lowercase , initial , inherit.
color-picker | true | STRING | Provides color picker popup. (You can send in false in order to turn off the color picker)

### astroidrange form field type
Let the user specify a numeric value which must be no less than a minimum value, and no more than another maximum value.

`Example`

```xml
<field name="fieldname" type="astroidrange" min="20" max="500" step="1" postfix="px" prefix="" default="40" description="description goes here" />
```
Input Values:

Name | Description | Required
------- | ----------- | -------- 
min | min attribute specifies the minimum value for the astroidrange | no
max | min attribute specifies the maximum value for the astroidrange | no
step | step attribute specifies the size of each movement (an increment or jump between values) of the astroidrange | no
postfix | Postfix attribute specifies what to show after range value | no
prefix | Prefix attribute specifies what to show beforer range value | no
default | Default attribute specifies the default value of astroidrange like default range start from 70 | no

`Output`


### astroidcalendar form field type
Astroidcalendar field type let the user select date from the calendar like Countdown date.

`Example`

```xml
<field name="fieldname" type="astroidcalendar" description="description goes here" default="2017-05-15" ></field>
```
Input Values:

Name | Description | Required
------- | ----------- | -------- 
default | Default date to be shown in calendar | no

### Text form field type
Elements of type text create basic, single-line inputs. You should use them anywhere you want the user to enter a single-line value.

`Example`

```xml
<field type="text" label="Label goes here" description="description goes here" default="48rem" ></field>
```
Input Values:

Name | Description | Required
------- | ----------- | --------  
default | To set the default value in the text field | no

### textarea form field type
Textarea defines a multi-line text input control. A text area can hold an unlimited number of characters.

`Example`

```xml
<field name="fieldname" type="textarea" filter="raw" label="Label goes here" description="description goes here" hint="hint goes here" />
```
Input Values:

Name | Description | Required
------- | ----------- | -------- 
filter | Method to recursively filter data for form fields | no
hint | The text displayed in the html placeholder element | no

### List form field type
With list form field type we can create a drop down list. It allows the user to choose one value from a list.

`Example`

```xml
<field  name="fieldname" type="list"  label="Label goes here" description="description goes here" default="option_two"  astroid-variable="astroid variable goes here">
    <option value="option_one">option_one</option>
    <option value="option_two">option_two</option>
</field> 
```
Input Values:

Name | Description | Required
------- | ----------- | -------- 
default | With default value we can set which value is by default selected in drop down list | no
astroid-variable | Provide a value for drop down list (astroid list ) | no

### astroidmodulesposition form field type
A module position is a placeholder in a template. Placeholders identify one or several positions within the template.

`Example`

```xml
<field astroidgroup="astroidgroup goes here" name="fieldname" type="astroidmodulesposition" label="label goes here" default="" description="description goes here" />
```
### astroidicon form field type
AstroidIcon provides you with a list of icons available for the back to top icon. The list is hard coded in the code and can’t be modified on a template level.

`Example`

```xml
<field description="description goes here" name="fieldname" type="astroidicon" default="fas fa-long-arrow-alt-up" label="label goes here" />
```
Input Values:

Name | Description | Default value | Required
------- | ----------- | -------- | ---------
default | With default value we can set which value is by default selected in drop down list | fas fa-long-arrow-alt-up | no

`Output`	


### Menu form field type
The menu form field type provides a drop down list of the available menus from your Joomla! site. If the field has a saved value this is selected when the page is first loaded. If not, the default value (if any) is selected.

`Example`

```xml
<field name="fieldname" type="menu" default="mainmenu" label="label goes here" description="description goes here" />
```
Input Values: 

Value | Description | Required
------- | ----------- | -----------
Name | Description | Required
type | This is mandatory and must be menu | yes
name | This is the unique name of the field | yes
label | This is the descriptive title of the field | yes
default | This is the default menu | no
description | This is the text that will be shown as a tooltip when the user moves the mouse over the drop-down box | no

### Code  

#### Custom CSS 
You can use the Custom CSS to customize the appearance.

`Example`

```xml
<field code="css"  name="customcss"  type="textarea"  label="Label goes here" description="Description goes here"></field>
```

#### Custom JavaScript

`Example`

```xml
<field  code="javascript" name="customjs"  type="textarea" label="Label goes here" description="Description goes here"></field>
```


## Frontend Folder Overrides
By default in astroid framework, majority of the HTML rendered can be edited via the /frontend/ folder in your template. However, updating astroid to newer version would overwrite your modifications with that or core astroid files.

Starting Astroid 1.1.3, You can override the frontend folder as well.

If you'd like to override the the header layout file **header.php**
```html
ROOT/templates/astroid_template_zero/frontend/header.php
```

Copy the file **header.php** to 
```html
ROOT/templates/astroid_template_zero/html/frontend/header.php
```

and that should do it, the overrides are applicable to all files under the frontend folder.

# Changelog

Here is record of all notable changes made to a Astroid Framework.

## v2.0.0: 16-October-2018

## Added
* Animation delay now possible on columns, section & element level.
* **Added new blog article types**: Astroid now comes with inbuilt integration for the following article types.
Video :: Add youtube or vimeo video (demo: http://bit.ly/2yDmuhH).
Gallery :: Create an image carousel (demo: http://bit.ly/2yGIDvB).
Audio :: Add Sound Cloud or Spotify audio (demo: http://bit.ly/2OsaNF9).
Review :: Add a review with rating's (demo: http://bit.ly/2ynSerL).
Quote :: Add a beautiful quote with author's name (demo: http://bit.ly/2J0qYUj).
* Custom badges for articles (Editor's Choice, Best Seller, Best Price, Hot. Trending, Custom)
* Open graph : Add custom open graph title, image and description for each article.
* Column responsive settings : Manage width of each column for all bootstrap breakpoints.
* Contact information icon color picker added : easily change color of the contact information section icons now.
* Custom color options in column level.
* Refresh button added in media manager.
* Menu module overrides added.
* JD Simple Contact Form added in quickstart package.
* JD Profiles lite added in quickstart package.
* JD SkillSet added in quickstart package.
* Added option to display social icons on coming soon page.

## Updated
* Joomla 3.8.13 updated in quickstart package.

## Fixes
* IE11 compatibility issues fixed.
* Header Block module title issues fixed.
* Sp Page Builder compatibility issues fixed.
* Module title now displays for modules rendering in the Mega menu.
* Template COPY issue fixed (copying a template from Joomla template manager failed earlier).
* Improved Frontend UI
* Improved Backend UI
* Improved mod_articles_categories overrides
* Improved search module
* Improved Search Results page
* Improved Language
* Improved Typography
* Improved articles latest module overrides

## Removed
* AcyMailing from QuickStart Package
* ChronoForms from QuickStart Package
* Pagination overrides deleted (**Path:** html/layout/joomla/pagination)
* media.php overrides deleted (**Path:** html/mod_articles_latest/)
* mod_custom overrides deleted from quickstart package (**Path:** html/mod_custom)

## v1.3.0: 31-August-2018

### Added
* Column Level Class and ID
* Users can use html tag in banner title input field.
* Functionality to add Custom CSS and JS files. #15
* Updated
* FontAwesome updated to 5.3.1
* Joomla 3.8.12 updated in quickstart package
* Register Login 1.9 updated in quickstart package
* Fixes
* Coming Soon page fixed
* Error page Typography fixed
* Debug & Error reporting is now working on Error page
* Setting export functionality fixed for Firefox alt text
* Mobile menu issue fixed
* Body background color issue fixed in boxed layout
* Fixed menu assignment in quickstart package. #16

### Removed
* Removed error.php file from template frontend folder.

## v1.2.1: 16-August-2018

* Split title module chrome Added
* Performance improvement in header
* Duplicating Astroid Template issue resolved

## v1.2.0: 14-August-2018

* Custom Grid Options Added
* Section Color Options Added
* Sub level Menu Options Added
* Custom Social Profile Option Added
* Column Resizing Logic Updated
* Font Awesome Library updated
* Moved all astroid based templates params to #__astroid_templates table.
* Footer section renamed to copyright section and merged in miscellaneous section
* Footer Color Option removed
* Bug Fixes

## v1.1.3: 6-August-2018

* Social Profile list ordering
* Missing Social icons added in Social Profile list
* WhatsApp language Added
* Joomla 3.8.11 Compatible
* px, em, rem, pt, % Units added in Typography
* Banner Element Improved
* Frontend folder override functionality added.
* Language filtered

## v1.1.2: 30-July-2018

* Frontend and Backend RTL Compatible
* Google font loading bug fixed
* Custom CSS and SCSS functionality added. (Now, you can create your own custom CSS and SCSS file)
* Bootstrap version updated to v4.1.3

## v1.1.1: 23-July-2018

* Removed Extra container from Stacked Layout
* VK Social profile Added
* Close icon(X) on offcanvas and mobile menu Added
* Sticky header Improved
* Favicon added on 404 page
* Removed default location and phone number from Contact information
* Removed extra margin on logo from Stacked Style 2
* Main menu Color improvement

## v1.1.0: 18-July-2018

* Section container layouts with more options
* Frontend editing overrides
* Column calculation with component area
* Added Banner Element
* Added Banner option in Menu item settings
* Added Flickr icon to the Social Profiles
* CRSF Token on post requests
* Astroid admin security
* Backend UI/UX improved
* Import/Export buttons for better positioning.
* Updated language file
* Some other bug fixed

## v1.0.2: 3-July-2018

* Critical and minor HTML bug resolved

## v1.0.1: 1-July-2018

* Default Parameter updated
* Default parameter updated
* Off-Canvas and Mobile Menu bug fixed


## v1.0.0: 28-June-2018

* Initial Release

