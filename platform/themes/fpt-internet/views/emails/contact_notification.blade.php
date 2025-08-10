<h2>Khách hàng mới đăng ký dịch vụ</h2>
<p><strong>Họ tên:</strong> {{ $contact['name'] }}</p>
<p><strong>Số điện thoại:</strong> {{ $contact['phone'] }}</p>
<p><strong>Địa chỉ:</strong> {{ $contact['address'] }}</p>
<p><strong>Dịch vụ:</strong> {{ $contact['service'] }}</p>
<p><strong>Xem chi tiết tại đây:</strong> <a href="https://docs.google.com/spreadsheets/d/{{ theme_option('google_spreadsheet_id') }}">https://docs.google.com/spreadsheets/d/{{ theme_option('google_spreadsheet_id') }}</a></p>
