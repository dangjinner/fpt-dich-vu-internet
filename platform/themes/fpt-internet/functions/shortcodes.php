<?php

use Botble\Theme\Supports\ThemeSupport;
use Botble\Theme\Facades\Theme;
use Botble\Shortcode\Compilers\Shortcode;

app()->booted(function () {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    add_shortcode('section-1', __('Section 1'), __('Section 1'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.section-1', compact('shortcode'));
    });

    add_shortcode('section-2', __('Section 2'), __('Section 2'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.section-2', compact('shortcode'));
    });

    add_shortcode('section-3', __('Section 3'), __('Section 3'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.section-3', compact('shortcode'));
    });

    add_shortcode('section-4', __('Section 4'), __('Section 4'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.section-4', compact('shortcode'));
    });

    add_shortcode('section-5', __('Section 5'), __('Section 5'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.section-5', compact('shortcode'));
    });

    add_shortcode('section-6', __('Section 6'), __('Section 6'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.section-6', compact('shortcode'));
    });

    add_shortcode('section-7', __('Section 7'), __('Section 7'), function (Shortcode $shortcode) {
        return Theme::partial('shortcodes.section-7', compact('shortcode'));
    });
});

