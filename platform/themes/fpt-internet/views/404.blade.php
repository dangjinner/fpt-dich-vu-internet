@php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fireEventGlobalAssets();
@endphp

{!! Theme::partial('header') !!}

<div class="page-404">
    <div class="content">
        <div class="illustration">
            <!-- SVG đơn giản -->
            <svg width="150" height="150" viewBox="0 0 150 150">
                <circle cx="75" cy="75" r="70" fill="#0072bc"/>
                <text x="50%" y="55%" text-anchor="middle" fill="#fff" font-size="48" font-weight="700">404</text>
            </svg>
        </div>
        <h1>Trang không tìm thấy</h1>
        <p>Xin lỗi, chúng tôi không tìm thấy trang bạn đang tìm kiếm.</p>
        <div class="actions">
            <a href="/" class="btn primary">Về trang chủ</a>
            <button onclick="history.back()" class="btn outline">Quay lại</button>
        </div>
    </div>
</div>


{!! Theme::partial('footer') !!}


