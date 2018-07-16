> ```
>                     __                    _        __
>    ____ _   _____  / /_   _____  ____    (_)  ____/ /
>   / __  /  / ___/ / __/  / ___/ / __ \  / /  / __  / 
>  / /_/ /  (__  ) / /_   / /    / /_/ / / /  / /_/ /  
>  \__ _/  /____/  \__/  /_/     \____/ /_/   \__ _/   
>
> ```                                                  
# Introduction
In this tutorial, we will be installing the template using Upload Feature in your Joomla Administration Control Panel.

Be sure you have downloaded the template are and logged into Joomla Administrator Control Panel.

Navigate to `Extensions >> Manage >> Install`

# Installation

On the following screen, click the `browse for file` button and select the download files `astroid_vxxx.zip`, Joomla will automatically start the upload and continue with the installation after selection of a valid zip file.

After installation, you will screen a screen such as following with the success notification.

<aside class="success">
Congratulations, You have successfully installed the <code>Astroid Framework template.</code>
</aside>

## Setting Astroid as the default template

You can now navigate to `Extensions >> Templates >> Styles` and set Astroid as your default template by clicking the (star) icon next to the template.

# Template Options

## Basic
Under Basic you have the following settings, here you can style the preloader, Back to top Button and select the layout settings.

### Preloader

This option allows you to enable or disable the preloader for the site. It is displayed while the content is being loaded.

Option | Default | Description
--------- | ------- | -----------
Animation | none | Here you can select the animation for the preloader from the list.
Color | inherit | Here you can set the color of the animated element of a preloader.
Background | inherit | Here you can select the preloader background color which is to be displayed as a background for the preloader.
Size | inherit | This option allow you to set the size of the preloader.

![preloader](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Preloader.png)

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

![backtotop](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Backtotop.png)

## Layout Settings

You can use two main layouts for your site, Full-Width or Boxed. The full-width layout is the default layout for the template and it displays your content centered whereas in the boxed layout you can apply a background to your body and all your content will still be centered with the background flowing around it.

Option | Default | Description
------------------ | ------- | -----------
Background Image | none | Select a Background Image for boxed layout.
Background Repeat | No-Repeat | Allows you to choose the repeat for the background image. You can select All Repeat, horizontal repeat, vertical repeat or disable repeat of the image.
Background Size | inherit | Adjust the background image displaying. You can select one of the following values: `cover`, `contain` and `inherit`.
Background Position | Center Top | Choose the position for the background image from the Dropdown list.
Background Attachment | Fixed | Set the background image attachment style: `Scroll – background image scrolls with the content` , `Fixed – the background image is fixed and content scrolls over it` *(Select fixed if you want have parallax scrolling effect)*

![Layoutsetting1](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Layoutset1.png)

![Layoutsetting2](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Layoutset2.png)

## Header
Header section combines with the options such as logo, mega menu, mobile menu & off canvas menu etc that will appear at the top of each page when displayed. Disabling the header would disable all header options.

#### Header Module Position
Here you can select a suitable module position where you want to display header.

#### Header Mode
You can select from 6 different header types, the header layouts provide a visual representation of what your header on the frontend would look like.

1. **Horizontal layout** provides 3 different layouts with logo being on the left & mega menu being on the `left`, `center` or `right`.  You also have an option to publish a block on the right that can either be a module position or custom HTML.

2. **Stacked header layout** provides with 3 different layout options:
* **Stacked Center:** This layout provides you with the logo and menu in the center of the page with an option to add a block below the menu.
* **Stacked Separated:** This layout provides you an option to have the logo between the menu, Half the menu items will appear on the left and other half on the right with an option to publish blocks above and below the menu/logo position.

> In case of Odd number of menu items you can select position right or left for extra menu item.

* **Stacked Divided:** This layout provides you with logo & menu on the left (on top of each other) with option to publish 2 blocks on the right, next to menu and/or the logo.

#### Header Blocks
Header blocks are positions that let you publish content inside the header. Based on the layout selected you may see 1 or 2 blocks. You can either directly publish HTML in each block or select a module position of your choice and publish modules to the selected position.

#### Mega Menu
You can select from the dropdown list which menu you’d like to publish as your main menu.

#### Mobile Menu
You can select from the dropdown list which menu you’d like to publish as your main menu on mobile.

#### Dropdown Animation
This options decides the animation that will be used for displaying the dropdown menu.

### Logo Options
You can select a logo for desktop view, mobile view and sticky header.

#### Logo Type
Logo type gives an option to set the image for logo or the logo text.

* Text Logo Settings - You can enter the text for the logo and an optional tagline as well.
* Image Logo Settings - You can upload a logo for the desktop view and one for mobile view as well.

### Sticky Header
A sticky header is a menu or navigation bar that stays at the top of the page no matter where you scroll. In other words, a “fixed” header.
You can enable or disable the sticky header option, By enabling the option the header will stick to the top when you reach its scroll position.

There are 2 different ways you can show the sticky header
*Sticky: A Sticky or Fixed header appears when a page is scrolled down.
*Sticky on Scroll up: Sticky Header only appears when scrolled up to the page. 


Option | Default | Description
------------------ | ------- | -----------
Sticky Header Logo | none | Select an image for your sticky header logo (*Sticky header logo is only for desktop and will not be visible on the mobile sticky header*).
Sticky Header on Desktop | Sticky | You can select whether you need the header to be sticky at all times or sticky on scroll up.
Sticky Header on Tablets | Sticky | You can select whether you need the header to be sticky at all times , sticky on scroll up or to be static (not visible on scroll) in Tablet view.
Sticky Header on Mobile | Sticky | You can select whether you need the header to be sticky at all times , sticky on scroll up or to be static (not visible on scroll) in mobile view.

### OffCanvas Menu
Here you can customize Off-Canvas style for your site. This is how an off-canvas menu works: The user clicks an icon or performs some sort of action (e.g. slide in on Top , Reveal , Push ) that results in a vertical navigation menu sliding into the screen from off canvas.

Option | Default | Description
------------------ | ------- | -----------
Toggle Visibility | Always | You can select whether you need offcanvas enabled on desktop or mobile only or you can have it displayed at all time.
Panel Width | 240 | You can set the width of the offcanvas navbar (in pixels), default is 240px.
Off canvas Animation | Slide in on Top | You can select the animation that will be used for opening the offcanvas bar.

![header](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Header.png)

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

![bodycolor](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/BodyColor.png)

### Header 

Here you can set the Header color schemes for your site.

Option | Default | Description
------- | ----------- | -----------
Background Color | #333 | Allows you to set the default Background color for the Header section for the whole site.
Text Color | #fff | Set the Text color for the Header section.
Logo Text Color | #007bff  | Set color for your text logo.
Logo Tag Line Color | #007bff  | Set color for Tag Line in your text logo.
Backgroud Color for sticky header | #fff | Set background color of the Sticky Header.

![header-color](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/HeaderColor.png)

### Main Menu

Here you can set the Main Menu color schemes for your site.

Option | Default | Description
------- | ----------- | -----------
Link Color | #333 | Set the link color for the main menu.
Link Hover Color | #007bff | Set the link hover color for the main menu.
Link Active Color | #007bff | Set the appearance of a link while it is being activated.

![mainmenu-color](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/MainMenuColor.png)

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

![dropdownmenu-color](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/DropDownMenuColor.png)

### Off-Canvas

Here you can set the Off-Canvas color schemes for your site.

Option | Default | Description
------- | ----------- | -----------
Background Color | #fff |Set the default Background color for the Off-Canvas Menu.
Text Color | #007bff |Set the Text color for the menu items in the Off-Canvas.
Link Color | #333 | Set the color of the link in the Off-Canvas menu for menu and Sub-menu items.
Active Link Color | #fff | Set the color for the active links (links become active once you click on them).
Active Background Color | #007bff |Set the Background color for the active links.

![offcanvas-color](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/OffCanvasColor.png)

### Footer

Here you can set the Footer color schemes for your site.

Option | Default | Description
------- | ----------- | -----------
Background Color | #333 | Set the default Background color for the Footer.
Text Color | #fff | Set the Text color for the Footer items.
Link Color | #007bff | Set the color of the link in the dropdown menu for submenu items.
Link Hover Color | #007bff | Set the color for hovered links; links hover when the mouse moves over it.

![footer-color](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/FooterColor.png)

## Layout
Layout manager provides the ability to build flexible layout from the collection of available elements. A layout consist of sections, grids and content elements that can be easily managed with the built in drag and drop functionality. It allows customization of each section like Design Settings, Responsive Settings, Animation Settings and others.

![layout](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Layout.png)

#### Layout Structure

* Layout includes a responsive, mobile first fluid grid system that appropriately scales up to 12 columns as the device or viewport size increases. You can select the desired number of columns from the predefined columns grid. 

* Icon with arrows allows you to change positions of rows by moving them up or down. Use plus icon to add new Row, then select column structure and insert module position(s) accordingly.
* Sections, rows and elements can be added, edited, copied and deleted directly in the layout manager.

#### Managing Layout  
In the layout particular section can be edited, drag drop, copy, new section can be added and new row with in the section can also be added. Also we can edit, delete and copy particular column.

* Drag and Drop: Click on Drag icon to Drag and Drop  rows/columns to arrange your layout.
* Edit: Click the pencil icon to edit sections and rows. 
* Copy: Click the copy icon to duplicate a section, row or element.
* Delete: Click the delete icon to delete a section, row or element.
* New row: Click on New row to add new row.
* New Section: Click on New section to add new section below to the targeted section.

![editoptions](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/LayoutOptions.png)

#### Element
New elements can be created by clicking the Add icon that appears in bottom-center when hovering the element.

Following are the elements within this section:
* Module Position
* Component Area
* Messages

`If we already added component area and messages before than we are not able to add them again`

#### Section
We can add new section by clicking on the add new section option given with in the row level options or we can also add new section by clicking on add section button.

![editoptions](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/NewSections.png)

#### Edit Options of Element and Section
Elements and section both have same edit options i.e General settings , Design Settings , Responsive settings , Animation Settings

* **Position Settings:** In this we can set position of the modules.

![position-settings](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Position.png) 

* **General Settings:** general settings have Element Title , Custom Class and Custom ID options.

![general-settings](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/General.png)

* **Design Settings:** In this we have Background options. To enable Background options  we need to switch on the Custom Background Option.

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

![design-settings](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Design.png)

* **Responsive settings:** This allows you to control visibility of columns. You can hide columns on selected devices

Following are the options for ResponsiveSettings:

Option | Description
------- | -----------
Hide on Extra Small device | Enable to hide this section on Extra small Devices.                                   
Hide on Small Device | Enable to hide this section on Small Devices.                                                    
Hide on Medium device | Enable to hide this section on Medium Devices.                                             
Hide on Large Device |  Enable to hide this section on Large Devices.                                                   
Hide on Extra Large Device | Enable to hide this section on Extra-Large Devices.

![responsive-settings](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Responsive.png)

* **Animation Settings:** In this we have different animation options which make possible to animate particular column.

![responsive-settings](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Animation.png)

## Typography
This is a fully customizable font-related section.You can change the fonts and their style accordingly, you can easily customize typography for all body text and the Responsive Headings, that define the Headings H1-H6.

### Body Typography

It allows you to adjust typography settings for the Body on the site.

Option | Default | Description
------- | ----------- | -----------
Font Family | Nunito | Select the font family from the drop-down list. Here you can select the System Font or the Google font to whole Body of your website
Alt Font Family | Arial, Helvetica, sans-serif | If the browser does not support the first font family, it tries the Alternate font family.
Font Weight | 400 | Select the font weight from the list, it will define how bold your text are.
Font Size | 1 | Set the font size you need to use in the text element.
Letter Spacing | 0 | Set the needed distance between letters.
Line Height | 1 | line-height property specifies the height of a line.
Text Transform | none | Set the font transformation, if needed (uppercase, capitalize and lowercase).

![bodytypogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/BodyTypography.png)

### Menu Typography
This section allows to adjust typography settings for the Menu.If inherit selected then property will inherit its value from body typography properties.

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

![menutypogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/MenuTypography1.png)

![menutypogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/MenuTypography2.png)

### SubMenu Typography
This section allows to adjust typography settings for the SubMenu.If inherit selected then property will inherit its value from body typography properties. 

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

![submenutypogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/SubMenuTypography1.png)

![submenutypogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/SubMenuTypography2.png)

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

![h1typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H1Typography1.png)

![h1typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H1Typography2.png)

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

![h2typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H2Typography1.png)

![h2typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H2Typography2.png)

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

![h3typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H3Typography1.png)

![h3typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H3Typography2.png)

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

![h4typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H4Typography1.png)

![h4typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H4Typography2.png)

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

![h5typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H5Typography1.png)

![h5typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H5Typography2.png)

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

![h6typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H6Typography1.png)

![h6typogarphy](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/H6Typography2.png)

## Footer

Footer is a small section at the bottom of each page. You can Enable or Disable the footer copyright bar, by enabling this section it enables you to edit the content of the bottom copyright information of the page.


Option | Default | Description
------- | ----------- | -----------
Custom HTML | none | Here we can enter the text that displays in the copyright bar.
Module Position | astroid-footer | Select a suitable module position where you want to display this feature.
Featue Load Position | After module | If there are other module(s) published to this module position, you can select to display the content of this feature either below or after the module(s) published to this position.

![footer](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Footer.png)

## Custom Code

Here we can add Custom CSS , Custom Javascript 

Option | Default | Description
------- | ----------- | -----------
Tracking Code | none | 
Space Before `</head>` | none
Space before `</body>`| none
Custom CSS | none | Here you can add custom CSS to add your own styles or overwrite default CSS, Wrapped within `<style>` tags.
Custom JS | none | Here you can add custom javascript code here, Wrapped within `<script>` tags.

![customcode](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/CustomCode.png)

## Social Profile

This section allows you to display your social profiles on your site.

In this section we have : 
* **Module Position :** Select a suitable module position where you want to display this feature.
* **Social Load Position :** If there are other module(s) published to this module position, you can select weather the content of this feature should be displayed below the or after the module(s) published to this position.
* **Style :** Choose the style how you want to show Social profile on your site , default value is Inherit color.
   In style we have 2 Options to style our social icons:
   1. Inherit color.
   2. Brand color.
* In this section we have in all 19 types of Social Profiles : 
  1. Facebook
  2. Instagram
  3. Youtube
  4. Twitter
  5. Google+
  6. LinkedIn
  7. Google Drive
  8. Play Store
  9. Pinterest
  10. Amazon
  11. Github
  12. App Store
  13. Whatsapp
  14. Soundcloud
  15. Behance
  16. Dribbble
  17. Spotify
  18. Tumblr
  19. Reddit
  
![social](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Social.png)

## Miscellaneous
In this section, you can add contact Information, customize coming soon and 404 page, set favicon for your site and can also define the responsive breakpoints for your site.

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

![miscontact](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/MisContact.png)

### Coming Soon

Here you can customize the maintenance mode page when your site is under construction/maintenance.

`If we enable the development mode than it will take your site offline and show a static coming soon page`

Option | Default | Description
------- | ----------- | -----------
Logo | none | Here you can select a logo which will display on your coming soon Page, default template logo will be displayed if not selected. 
Background Image | none | You can select a Background image for your coming soon page.
Title | Coming Soon |  Here you can Enter the Title for your Coming Soon Page which will be displayed when your site is under construction.
Countdown Date | 2017-05-15 | Here you can set a date for countdown exactly when your site is going to be live.
Content | none | Enter description for your coming soon page.
Background Repeat | No Repeat | Set if/how a background image will be repeated.
Background Size | Inherit | This property specifies the size of the background images.
Background Position | Center Top | This property sets the starting position of a background image.

![miscomingsoon](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/MisComingSoon1.png)

![miscomingsoon](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/MisComingSoon2.png)

### 404 Error

Allows you to customize 404 page for your site

Option | Default | Description
------- | ----------- | -----------
Show Header | none | Select If want to show header.
Background Image | none | Set a Background Image for 404 Error Page
Logo | default template logo | Set a logo for 404 Error Page, default template logo will be used if not selected.
Call To Action | text | Enter text to dislay on Call To Action Button.
404 Page Content | tinyMCE | Enter the content of your 404 page.

![mis404](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Mis404.png)

### Favicon

Allows you to upload your browser URL icon. It's recommended to apply a size of 96x96 pixels to the favicon icon

Option | Default | Description
------- | ----------- | -----------
Favicon image | none | Select an icon for a favicon, also known as a shortcut icon, website icon, tab icon, URL icon, or bookmark icon.

![misfavicon](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/MisFavicon.png)

## Mega Menu
A mega menu is defined as a drop down interface that is triggered by the user hovering over a link or defined area. This dropdown usually shows all options in one main, mega-panel and oftentimes groups related topics into categories. In this section you can configure menu options.

### Mega Menu : Enable/disable Mega Menu option.

* By default Mega Menu option is disable, you can set icon, subtitle, custom class, width and dropdown Alignment for your dropdown menu.

Option | Description
------- | -----------
Dropdown Alignment | allows you choose align (left/right/centre) dropdown position.
Subtitle | allows you to set subtitle for your menu item.
Icon Only | When you want to show only icon for your Menu instead full title you can enable this option.
Icon | You can set icon for your Menu Items. 
Width | You can set total width in pixel for submenu area.
Custom CSS Class | allows you to add Custom CSS Class(es) to the menu item.

* By enabling Mega Menu you can easily create and customize Mega Menu with sub menu items and modules, offers you different layouts with drag and drop menu building system. Each menu item contains Astroid Menu Options which provides ability to add rows, columns, links and more to a mega menu.

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

# Developer Documentation

## Field Types & Example Codes

### Astroidgroup form field type
The astroidgroup form field type lets you group several fields within one section/heading. The section heading is also added under the tabs navigation on the left.

`Example`

```xml
<field type="astroidgroup" name="fieldname" title="title Goes here" description="description goes here"/>
```

### Astroidradio form field type
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

### Astroidmedia form field type
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

### Astroidlist form field type
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

### Asrtroidswitch form field type
The Asrtroidswitch form field provide a switch i.e a checkbox which enable user to make choice (binary choice) , a choice between one of two possible mutually exclusive options

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

### Astroidtypography form field type
For typography h1,h2,h3,h4,h5,h6 & body.

`Example`																																												
```xml
<field  astroidgroup="body_typography" name="fieldname" type="astroidtypography"  font-face="" alt-font-face="" font-color="" font-size="1"  font-unit="em" letter-spacing="0” line-height="1"   font-style="" font-weight="400" text-transform="none"></field>
```

Input Values:

Name | Default value | Type | Description
------- | ----------- | -------- |---------
font-face | Arial | STRING | font-face can be Arial, Times New Roman, Verdana and Trebuchet and other’s can be possible
alt-font-face | Abel | STRING |
font-color | White | STRING | Font-color can be Hex , RGB or RGBA
font-size | 1 | INT | font-size property sets the size of a font
font-unit | em | STRING | font-unit can be px , em pt , ex etc
letter-spacing | 0 | INT | letter-spacing property increases or decreases the space between characters in a text.
line-height | 1 | INT | line-height property specifies the height of a line
font-style | None | STRING | font-style can be  italic , oblique and many more
font-weight | 400 | INT | font-weight property sets how thick or thin characters in text should be displayed. Font-weight can be normal , bold , bolder etc.
text-transform | none | STRING | text-transform can be none , capitalize , uppercase , lowercase , initial , inherit.
color-picker | true | STRING | Provides color picker popup. (You can send in false in order to turn off the color picker)

### Astroidrange form field type
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

![footer](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Rangeoutput.png)

### Astroidcalendar form field type
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

### Textarea form field type
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

### Astroidmodulesposition form field type
A module position is a placeholder in a template. Placeholders identify one or several positions within the template.

`Example`

```xml
<field astroidgroup="astroidgroup goes here" name="fieldname" type="astroidmodulesposition" label="label goes here" default="" description="description goes here" />
```
### Astroidicon form field type
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

![footer](https://raw.githubusercontent.com/hiteshaggarwal/Astroid-Documentation/master/source/images/Iconoutput.png)

### Menu form field type
The menu form field type provides a drop down list of the available menus from your Joomla! site. If the field has a saved value this is selected when the page is first loaded. If not, the default value (if any) is selected.

`Example`

```xml
<field name="fieldname" type="menu" default="mainmenu" label="label goes here" description="description goes here" />
```
Input Values: 

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
