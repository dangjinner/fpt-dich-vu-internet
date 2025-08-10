$(() => {
    let languageTable = $('.table-language')

    languageTable.on('click', '.delete-locale-button', (event) => {
        event.preventDefault()

        $('.delete-crud-entry').data('url', $(event.currentTarget).data('url'))
        $('.modal-confirm-delete').modal('show')
    })

    $(document).on('click', '.delete-crud-entry', (event) => {
        event.preventDefault()
        $('.modal-confirm-delete').modal('hide')

        let deleteURL = $(event.currentTarget).data('url')
        Botble.showButtonLoading($(this))

        $httpClient
            .make()
            .delete(deleteURL)
            .then(({ data }) => {
                if (data.data) {
                    languageTable.find(`i[data-locale=${data.data}]`).unwrap()
                    $('.tooltip').remove()
                }

                languageTable.find(`.delete-locale-button[data-url="${deleteURL}"]`).closest('tr').remove()

                Botble.showSuccess(data.message)
            })
            .finally(() => {
                Botble.hideButtonLoading($(this))
            })
    })

    $(document).on('submit', '.add-locale-form', function (event) {
        event.preventDefault()
        event.stopPropagation()

        const form = $(this)
        const button = form.find('button[type="submit"]')

        Botble.showButtonLoading(button)

        $httpClient
            .make()
            .postForm(form.prop('action'), new FormData(form[0]))
            .then(({ data }) => {
                Botble.showSuccess(data.message)
                languageTable.load(`${window.location.href} .table-language > *`)
            })
            .finally(() => {
                Botble.hideButtonLoading(button)
            })
    })

    let $availableRemoteLocales = $('#available-remote-locales')
    const $remoteLocalesLoading = $availableRemoteLocales.closest('.card')

    Botble.showLoading($remoteLocalesLoading)

    if ($availableRemoteLocales.length) {
        let getRemoteLocales = () => {
            $httpClient
                .make()
                .get($availableRemoteLocales.data('url'))
                .then(({ data }) => {
                    languageTable.load(`${window.location.href} .table-language > *`)
                    $availableRemoteLocales.html(data.data)
                    Botble.hideLoading($remoteLocalesLoading)
                })
        }

        getRemoteLocales()

        $(document).on('click', '.btn-import-remote-locale', function (event) {
            event.preventDefault()

            $('.button-confirm-import-locale').data('url', $(this).data('url'))
            $('.modal-confirm-import-locale').modal('show')
        })

        $('.button-confirm-import-locale').on('click', (event) => {
            event.preventDefault()
            let _self = $(event.currentTarget)

            Botble.showButtonLoading(_self)

            let url = _self.data('url')

            $httpClient
                .make()
                .post(url)
                .then(({ data }) => {
                    Botble.showSuccess(data.message)
                    getRemoteLocales()
                })
                .finally(() => {
                    _self.closest('.modal').modal('hide')
                    Botble.hideButtonLoading(_self)
                })
        })
    }
})
