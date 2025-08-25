{{ $assign['admin']->name }} 様<br><br>

パスワードの変更が完了しました。<br>
※パスワードはログイン時に必要になるため、ご自身で大切に管理していただくようお願いいたします。<br><br>

NoaChoice URL：<br>
→ <a href="{{ route('officeNewsIndex') }}" target="_blank">{{ route('officeNewsIndex') }}</a><br><br><br>


パスワードを変更した覚えがない場合は、下記のURLよりパスワードの設定をお願いいたします。<br>
→ <a href="{{ route('officeForgotPwInput') }}" target="_blank">{{ route('officeForgotPwInput') }}</a><br><br><br><br>



@include ('user/signature')