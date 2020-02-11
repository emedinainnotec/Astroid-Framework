<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid\Component;

use Astroid\Framework;
use Astroid\Helper;
use Astroid\Helper\Style;

defined('_JEXEC') or die;

class Utility
{
    public static function meta()
    {
        $app = \JFactory::getApplication();
        $document = Framework::getDocument();
        $itemid = $app->input->get('Itemid', '', 'INT');
        $menu = $app->getMenu();
        $item = $menu->getItem($itemid);

        $params = new \JRegistry();
        $template_params = Framework::getTemplate()->getParams();
        $config = \JFactory::getConfig();

        if (empty($item)) {
            return;
        }

        $params->loadString($item->params);

        $enabled = $params->get('astroid_opengraph_menuitem', 0);
        if (empty($enabled)) {
            return;
        }

        $fb_id = $template_params->get('article_opengraph_facebook', '');
        $tw_id = $template_params->get('article_opengraph_twitter', '');

        $og_title = $item->title;
        if (!empty($params->get('astroid_og_title_menuitem', ''))) {
            $og_title = $params->get('astroid_og_title_menuitem', '');
        }
        $og_description = '';
        if (!empty($params->get('astroid_og_desc_menuitem', ''))) {
            $og_description = $params->get('astroid_og_desc_menuitem', '');
        }
        $og_image = '';
        if (!empty($params->get('astroid_og_image_menuitem', ''))) {
            $og_image = \JURI::root() . $params->get('astroid_og_image_menuitem', '');
        }

        $og_sitename = $config->get('sitename');
        $og_siteurl = \JURI::getInstance();

        $meta = [];

        $document->addMeta('twitter:card', 'summary');

        if ($item->type == 'component' && isset($item->query) && $item->query['option'] == 'com_content' && $item->query['view'] == 'article') {
            $document->addMeta('', 'article', ['property' => 'og:type']);
        }
        if (!empty($og_title)) {
            $document->addMeta('', $og_title, ['property' => 'og:title']);
        }
        if (!empty($og_sitename)) {
            $document->addMeta('', $og_sitename, ['property' => 'og:site_name']);
        }
        if (!empty($og_siteurl)) {
            $document->addMeta('', $og_siteurl, ['property' => 'og:url']);
        }
        if (!empty($og_description)) {
            $document->addMeta('', substr($og_description, 0, 200), ['property' => 'og:description']);
        }
        if (!empty($fb_id)) {
            $document->addMeta('', $fb_id, ['property' => 'fb:app_id']);
        }
        if (!empty($tw_id)) {
            $document->addMeta('twitter:creator', '@' . $tw_id);
        }
        if (!empty($og_image)) {
            $document->addMeta('og:image', $og_image);
        }
    }

    public static function layout()
    {
        $params = Framework::getTemplate()->getParams();
        $document = Framework::getDocument();
        $template_layout = $params->get('template_layout', 'wide');
        if ($template_layout != 'boxed') {
            return false;
        }
        $layout_background_image = $params->get('layout_background_image', '');

        if (!empty($layout_background_image)) {
            $style = new Style('.astroid-layout.astroid-layout-boxed');
            $style->addCss('background-image', 'url(' . \JURI::root() . Helper\Media::getPath() . '/' . $layout_background_image . ')');
            $style->addCss('background-repeat', $params->get('layout_background_repeat', 'inherit'));
            $style->addCss('background-size', $params->get('layout_background_size', 'inherit'));
            $style->addCss('background-position', $params->get('layout_background_position', 'inherit'));
            $style->addCss('background-attachment', $params->get('layout_background_attachment', 'inherit'));
            $style->render();
        }
    }

    public static function smoothScroll()
    {
        $params = Framework::getTemplate()->getParams();
        $document = Framework::getDocument();
        $enable_smooth_scroll = $params->get('enable_smooth_scroll', '');
        if ($enable_smooth_scroll == '1') {
            $speed = $params->get('smooth_scroll_speed', '');
            $document->addScript('vendor/smooth-scroll.polyfills.min.js', 'body');
            $script = '
			var scroll = new SmoothScroll(\'a[href*="#"]\', {
            speed: ' . $speed . ',
            header: ".astroid-header"
			});';
            $document->addScriptDeclaration($script, 'body');
        }
    }

    public static function background()
    {
        $params = Framework::getTemplate()->getParams();
        $document = Framework::getDocument();
        if ($params->get('template_layout') == 'boxed') {
            $styles = '';
            // Background color
            if ($params->get('color_body_background_color')) {
                $styles .= 'background-color: ' . $params->get('color_body_background_color') . ';';
            }
            // Let's add the image styles only if an image is selected.
            if ($params->get('basic_background_image')) {
                $styles .= '
                      background-image: url("' . \JURI::root() . Helper\Media::getPath() . '/' . $params->get('basic_background_image') . '");
                      background-repeat: ' . $params->get('basic_background_repeat') . ';
                      background-size: ' . $params->get('basic_background_size') . ';
                      background-position: ' . str_replace('_', ' ', $params->get('basic_background_position')) . ';
                      background-attachment: ' . $params->get('basic_background_attachment') . ';
                  ';
            }

            $bodystyle = 'body {' . $styles . '}';
            $document->addStyleDeclaration($bodystyle);
        }
    }

    public static function typography()
    {
        $params = Framework::getTemplate()->getParams();
        $types = array('body' => 'body, .body', 'h1' => 'h1, .h1', 'h2' => 'h2, .h2', 'h3' => 'h3, .h3', 'h4' => 'h4, .h4', 'h5' => 'h5, .h5', 'h6' => 'h6, .h6', 'menu' => '.astroid-nav > li > a, .astroid-sidebar-menu > li > a', 'submenu' => '.nav-submenu-container .nav-submenu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu');
        foreach ($types as $type => $selector) {
            if ($params->exists($type . '_typography')) {
                $status = $params->get($type . '_typography');
            } else {
                $status = $params->get($type . 's_typography');
            }
            if (trim($status) !== 'custom') {
                continue;
            }
            $typography = $params->get($type . '_typography_options', null);
            if (empty($typography)) {
                continue;
            }
            Helper\Style::renderTypography($selector, $typography);
        }
    }

    public static function colors()
    {
        $params = Framework::getTemplate()->getParams();
        // Body
        $body = new Style('body');
        $body->addCss('background-color', $params->get('body_background_color', ''));
        $body->addCss('color', $params->get('body_text_color', ''));
        $body->link()->addCss('color', $params->get('body_link_color', ''));
        $body->link()->hover()->addCss('color', $params->get('body_link_hover_color', ''));
        $body->render();  // render body colors

        // Header
        Style::addCssBySelector('header', 'color', $params->get('header_text_color', ''));
        Style::addCssBySelector('.astroid-header-section, .astroid-sidebar-header', 'background-color', $params->get('header_bg', ''));

        $textLogo = new Style('.astroid-logo-text');
        $textLogo->child('.site-title')->addCss('color', $params->get('header_logo_text_color', ''));
        $textLogo->child('.site-tagline')->addCss('color', $params->get('header_logo_text_tagline_color', ''));
        $textLogo->render();  // render text logo colors

        // Sticky Header
        $stickyHeader = new Style('#astroid-sticky-header');
        $stickyHeader->addCss('background-color', $params->get('stick_header_bg_color', ''));
        $stickyHeaderLink = $stickyHeader->child('.astroid-nav .nav-link');
        $stickyHeaderLink->addCss('color', $params->get('stick_header_menu_link_color', ''));
        $stickyHeaderLink->hover()->addCss('color', $params->get('stick_header_menu_link_hover_color', ''));
        $stickyHeaderLink->active('.active')->addCss('color', $params->get('stick_header_menu_link_active_color', ''));
        $stickyHeader->render();  // render sticky header

        // Menu
        $navLink = new Style('.astroid-nav .nav-link, .astroid-sidebar-menu .nav-link');
        $navLink->addCss('color', $params->get('main_menu_link_color', ''));
        $navLink->hover()->addCss('color', $params->get('main_menu_link_hover_color', ''));
        $navLink->focus()->addCss('color', $params->get('main_menu_link_hover_color', ''));
        $navLink->active('.active')->addCss('color', $params->get('main_menu_link_active_color', ''));
        $navLink->render(); // render navlink

        // Dropdown Menu
        $dropdown = Style::addCssBySelector('.astroid-nav .megamenu-container, .astroid-nav .nav-submenu', 'background-color', $params->get('dropdown_bg_color', ''));
        Style::addCssBySelector('.has-megamenu.open .arrow', 'border-bottom-color', $params->get('dropdown_bg_color', ''));

        $link = $dropdown->child('li.nav-item-submenu > a');
        $link->addCss('color', $params->get('dropdown_link_color', ''));
        $link->hover()->addCss('color', $params->get('dropdown_menu_link_hover_color', ''))->addCss('background-color', $params->get('dropdown_menu_hover_bg_color', ''));
        $link->active('.active')->addCss('color', $params->get('dropdown_menu_active_link_color', ''))->addCss('background-color', $params->get('dropdown_menu_active_bg_color', ''));
        $dropdown->render(); // render dropdown

        // Mobile Menu / Offcanvas Menu
        $mobile_background_color = $params->get('mobile_backgroundcolor', '');
        $mobile_link_color = $params->get('mobile_menu_link_color', '');
        $mobile_menu_text_color = $params->get('mobile_menu_text_color', '');
        $mobile_hover_background_color = $params->get('mobile_hover_background_color', '');
        $mobile_active_link_color = $params->get('mobile_menu_active_link_color', '');
        $mobile_active_background_color = $params->get('mobile_menu_active_bg_color', '');
        $mobile_menu_icon_color = $params->get('mobile_menu_icon_color', '');
        $mobile_menu_active_icon_color = $params->get('mobile_menu_active_icon_color', '');

        $mobilemenu_styles = [];
        if (!empty($mobile_background_color)) {
            $mobilemenu_styles[] = '.astroid-offcanvas, .astroid-mobilemenu, .astroid-mobilemenu-container .astroid-mobilemenu-inner .dropdown-menus,.astroid-offcanvas .burger-menu-button{ background-color: ' . $mobile_background_color . ' !important;}';
        }
        if (!empty($mobile_menu_text_color)) {
            $mobilemenu_styles[] = '.astroid-offcanvas, .astroid-mobilemenu { color: ' . $mobile_menu_text_color . ' !important;}';
        }
        if (!empty($mobile_link_color)) {
            $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item a, .menu-indicator{ color: ' . $mobile_link_color . ' !important;}';
        }
        if (!empty($mobile_hover_background_color)) {
            $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item a:hover{ background-color: ' . $mobile_hover_background_color . ' !important;}';
        }
        if (!empty($mobile_active_link_color)) {
            $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.active > a, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.active > .nav-header, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.nav-item-active > a, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.nav-item-active > a + .menu-indicator{ color: ' . $mobile_active_link_color . ' !important;}';
        }
        if (!empty($mobile_active_background_color)) {
            $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.active, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.nav-item-active { background-color: ' . $mobile_active_background_color . ' !important;}';
        }
        if (!empty($mobile_menu_icon_color)) {
            $mobilemenu_styles[] = '.burger-menu-button .inner, .burger-menu-button .inner::before, .burger-menu-button .inner::after{background-color: ' . $mobile_menu_icon_color . ';}';
        }
        if (!empty($mobile_menu_active_icon_color)) {
            $mobilemenu_styles[] = '.astroid-mobilemenu-open .burger-menu-button .inner, .astroid-mobilemenu-open .burger-menu-button .inner::before, .astroid-mobilemenu-open .burger-menu-button .inner::after, .astroid-offcanvas .burger-menu-button .inner, .astroid-offcanvas .burger-menu-button .inner::before, .astroid-offcanvas .burger-menu-button .inner::after{background-color: ' . $mobile_menu_active_icon_color . ';}';
        }

        Framework::getDocument()->addStyleDeclaration(implode('', $mobilemenu_styles));

        // Contact Icon
        Style::addCssBySelector('.astroid-contact-info i[class*="fa-"]', 'color', $params->get('icon_color', ''));
    }

    public static function custom()
    {
        $params = Framework::getTemplate()->getParams();
        $document = Framework::getDocument();

        $document->addCustomTag($params->get('trackingcode', ''));
        $document->addStyleDeclaration($params->get('customcss', ''));
        $document->addStyleSheet(explode("\n", $params->get('customcssfiles', '')));

        $document->addScriptdeclaration($params->get('customjs', ''));
        $document->addScript(explode("\n", $params->get('customjsfiles', '')));

        $document->addCustomTag($params->get('beforehead', ''));
        $document->addCustomTag($params->get('beforebody', ''), 'body');
    }

    public static function error()
    {
        $params = Framework::getTemplate()->getParams();
        $document = Framework::getDocument();

        $bodyStyle = new Style('body');
        $background_setting_404 = $params->get('background_setting_404');
        if ($background_setting_404) {
            switch ($background_setting_404) {
                case 'color':
                    $bodyStyle->addCss('background-color', $params->get('background_color_404', ''));
                    break;
                case 'image':
                    $bodyStyle->addCss('background-color', $params->get('img_background_color_404', ''));

                    $background_image = $params->get('background_image_404', '');
                    if (!empty($background_image)) {
                        $bodyStyle->addCss('background-image', 'url(' . \JURI::root() . Helper\Media::getPath() . '/' . $background_image . ')');
                        $bodyStyle->addCss('background-repeat', $params->get('background_repeat_404', ''));
                        $bodyStyle->addCss('background-size', $params->get('background_size_404', ''));
                        $bodyStyle->addCss('background-attachment', $params->get('background_attchment_404', ''));
                        $bodyStyle->addCss('background-position', $params->get('background_position_404', ''));
                    }
                    break;
            }
        }
        $bodyStyle->render();
    }
}
