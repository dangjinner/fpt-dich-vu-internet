@extends(BaseHelper::getAdminMasterLayoutTemplate())
@section('content')
    <x-core::card>
        <x-core::card.header>
            <x-core::card.title>{{ trans('plugins/translation::translation.translations') }}</x-core::card.title>
        </x-core::card.header>
        <x-core::card.body class="box-translation" v-pre>
            @if (empty($group))
                <x-core::form :url="route('translations.import')">
                    <div class="row">
                        <div class="col-md-4">
                            <x-core::form.select
                                name="replace"
                                :options="[
                                    0 => trans('plugins/translation::translation.append_translation'),
                                    1 => trans('plugins/translation::translation.replace_translation'),
                                ]"
                                :input-group="true"
                            >
                                <x-slot:append>
                                    <x-core::button
                                        type="submit"
                                        color="primary"
                                        class="button-import-groups"
                                    >
                                        {{ trans('plugins/translation::translation.import_group') }}
                                    </x-core::button>
                                </x-slot:append>
                            </x-core::form.select>
                        </div>
                    </div>
                </x-core::form>
            @endif
            @if (!empty($group))
                <x-core::form
                    :url="route('translations.group.publish', compact('group'))"
                    method="post"
                    class="mb-3"
                >
                    <div class="btn-list">
                        <x-core::button
                            tag="a"
                            :href="route('translations.index')"
                        >
                            {{ trans('plugins/translation::translation.back') }}
                        </x-core::button>
                        <x-core::button
                            type="submit"
                            color="primary"
                            class="button-publish-groups"
                        >
                            {{ trans('plugins/translation::translation.publish_translations') }}
                        </x-core::button>
                    </div>
                </x-core::form>

                <x-core::alert type="warning">
                    {{ trans('plugins/translation::translation.export_warning', ['lang_path' => lang_path()]) }}
                </x-core::alert>

                {!! apply_filters('translation_other_translation_header', null) !!}
            @endif

            <x-core::form role="form">
                {!! Form::customSelect('group', $groups, $group, ['class' => 'group-select select-search-full']) !!}
            </x-core::form>

            @if (empty($group))
                <div class="text-muted">{{ trans('plugins/translation::translation.choose_group_msg') }}</div>
            @else
                <div class="table-responsive">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                @foreach ($locales as $locale)
                                    <th>{{ $locale }}</th>
                                @endforeach
                                {!! apply_filters('translation_other_translation_table_header', null) !!}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($translations as $key => $translation)
                                <tr id="{{ $key }}">
                                    @foreach ($locales as $locale)
                                        @php($item = $translation[$locale] ?? null)
                                        <td class="text-start">
                                            <a
                                                href="#edit"
                                                class="editable status-{{ $item ? $item->status : 0 }} locale-{{ $locale }}"
                                                data-locale="{{ $locale }}"
                                                data-name="{{ $locale . '|' . $key }}"
                                                data-type="textarea"
                                                data-pk="{{ $item ? $item->id : 0 }}"
                                                data-url="{{ $editUrl }}"
                                                data-title="{{ trans('plugins/translation::translation.edit_title') }}"
                                            >{!! $item ? htmlentities($item->value, ENT_QUOTES, 'UTF-8', false) : '' !!}</a>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            {!! apply_filters('translation_other_translation_table_body', null) !!}
                        </tbody>
                    </table>
                </div>
            @endif
        </x-core::card.body>
    </x-core::card>

    @if (!empty($group))
        <x-core::modal.action
            id="confirm-publish-modal"
            :title="trans('plugins/translation::translation.publish_translations')"
            :description="trans('plugins/translation::translation.confirm_publish_group', ['group' => $group])"
            type="warning"
            :submit-button-attrs="['id' => 'button-confirm-publish-groups']"
            :submit-button-label="trans('core/base::base.yes')"
        />
    @endif
@endsection
