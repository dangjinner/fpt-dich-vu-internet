<?php

app()->booted(function () {
    theme_option()
        ->setSection([
            'title' => __('Google Sheet'),
            'desc' => __('Setting google spreadsheet'),
            'id' => 'google-spreadsheet',
            'subsection' => true,
            'icon' => 'ti ti-mail',
        ])
        ->setField([
            'id' => 'copyright',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Copyright'),
            'attributes' => [
                'name' => 'copyright',
                'value' => __('© :year Your Company. All right reserved.', ['year' => now()->format('Y')]),
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Change copyright'),
                    'data-counter' => 250,
                ],
            ],
            'helper' => __('Copyright on footer of site'),
        ])
        ->setField([
            'id' => 'primary_font',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'googleFonts',
            'label' => __('Primary font'),
            'attributes' => [
                'name' => 'primary_font',
                'value' => 'Roboto',
            ],
        ])
        ->setField([
            'id' => 'primary_color',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Primary color'),
            'attributes' => [
                'name' => 'primary_color',
                'value' => '#ff2b4a',
            ],
        ])
        ->setField([
            'id' => 'google_spreadsheet_id',
            'section_id' => 'google-spreadsheet',
            'type' => 'text',
            'label' => __('Google Spreadsheet ID'),
            'attributes' => [
                'name' => 'google_spreadsheet_id',
                'value' => '',
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Change google spreadsheet ID'),
                    'data-counter' => 250,
                ],
            ],
            'helper' => __('https://docs.google.com/spreadsheets/d/[ID]/edit'),
        ])
        ->setField([
            'id' => 'google_sheet_name',
            'section_id' => 'google-spreadsheet',
            'type' => 'text',
            'label' => __('Google Sheet Name'),
            'attributes' => [
                'name' => 'google_sheet_name',
                'value' => '',
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Change sheet name'),
                    'data-counter' => 250,
                ],
            ],
        ])
        ->setField([
            'id' => 'notify_emails',
            'section_id' => 'google-spreadsheet',
            'type' => 'text',
            'label' => __('Notify Emails'),
            'attributes' => [
                'name' => 'notify_emails',
                'value' => '',
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Change notify emails'),
                ],
            ],
            'helper' => 'abc@gmail.com, xyz@gmail.com',
        ])
        ->setField([
            'id' => 'hotline',
            'section_id' => 'google-spreadsheet',
            'type' => 'text',
            'label' => __('Hotline'),
            'attributes' => [
                'name' => 'hotline',
                'value' => '',
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Change phone number'),
                ],
            ],
        ])
        ->setField([
            'id' => 'zalo',
            'section_id' => 'google-spreadsheet',
            'type' => 'text',
            'label' => __('Zalo'),
            'attributes' => [
                'name' => 'zalo',
                'value' => '',
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Change Zalo'),
                ],
            ],
        ]);
});
