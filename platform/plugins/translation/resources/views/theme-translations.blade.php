@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::form
        :url="route('translations.theme-translations.post')"
        method="post"
    >
        <input
            type="hidden"
            name="locale"
            value="{{ $group['locale'] }}"
        >

        <x-core::card>
            <x-core::card.header>
                <x-core::card.title>{{ trans('plugins/translation::translation.theme-translations') }}</x-core::card.title>
            </x-core::card.header>

            <x-core::card.body>
                <div class="row">
                    <div class="col-md-6">
                        <p>{{ trans('plugins/translation::translation.translate_from') }}
                            <strong class="text-info">{{ $defaultLanguage ? $defaultLanguage['name'] : 'en' }}</strong>
                            {{ trans('plugins/translation::translation.to') }}
                            <strong class="text-info">{{ $group['name'] }}</strong>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="text-end">
                            @include(
                                'plugins/translation::partials.list-theme-languages-to-translate',
                                compact('groups', 'group'))
                        </div>
                    </div>
                </div>
                <x-core::alert
                    :important="false"
                    type="warning"
                    style="margin-bottom: 65px"
                >
                    {{ trans('plugins/translation::translation.theme_translations_instruction') }}
                </x-core::alert>

                <div
                    class="widget-body box-translation"
                    v-pre
                >
                    @if (count($groups) > 0 && $group)
                        {!! apply_filters('translation_theme_translation_header', null, $groups, $group) !!}

                        {!! $translationTable->renderTable() !!}
                    @else
                        <p class="text-warning">{{ trans('plugins/translation::translation.no_other_languages') }}</p>
                    @endif
                </div>
            </x-core::card.body>

            <x-core::card.footer>
                <x-core::button
                    type="submit"
                    color="primary"
                    class="button-save-theme-translations"
                >
                    {{ trans('core/base::forms.save') }}
                </x-core::button>
            </x-core::card.footer>
        </x-core::card>
    </x-core::form>
@endsection
