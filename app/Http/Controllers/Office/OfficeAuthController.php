<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Requests\Office\Auth\ForgotPwRequest;
use App\Http\Requests\Office\Auth\InitRequest;
use App\Http\Requests\Office\Auth\LoginRequest;
use App\Http\Requests\Office\Auth\OnetimeRequest;
use App\Http\Requests\Office\Auth\SetPwRequest;
use App\Libraries\Utils;
use App\Mail\Office\ForgotPwMail;
use App\Mail\Office\OnetimeKeyMail;
use App\Mail\Office\SetPwMail;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;


class OfficeAuthController extends Controller
{
    /**
     * 管理者初期アカウント設定（入力）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function initInput(Request $request)
    {
        if (! session('firstAdmin')) {
            return redirect()->route('officeLoginInput');
        }

        $assign = [];

        return view('office/auth/init/input', compact('assign'));
    }

    /**
     * 管理者初期アカウント設定（処理）
     *
     * @param  InitRequest                       $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function initExecute(InitRequest $request)
    {
        $firstAdmin = session('firstAdmin');
        if (! $firstAdmin) {
            return redirect()->route('officeLoginInput');
        }

        $request->session()->regenerateToken();

        // 入力値
        $input = $request->validated();

        try {
            DB::beginTransaction();

            // adminsを更新
            DB::table('admins')->where('id', $firstAdmin->id)->where('email', $firstAdmin->email)->update([
                'name'         => $input['name'],
                'email'        => $input['email'],
                'password'     => Hash::make($input['password']),
                'created_at'   => Carbon::now(),
                'activated_at' => Carbon::now(),
            ]);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeInitInput')->withInput($input)->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");
            return redirect()->route('officeInitInput')->withInput($input)->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeInitComplete');
    }

    /**
     * 管理者初期アカウント設定（完了）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function initComplete(Request $request)
    {
        $assign = [];

        $request->session()->flush();

        return view('office/auth/init/complete', compact('assign'));
    }

    /**
     * パスワードを忘れたら（入力）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function forgotPwInput(Request $request)
    {
        $assign = [];

        return view('office/auth/forgot/pw/input', compact('assign'));
    }

    /**
     * パスワードを忘れたら（処理）
     *
     * @param  ForgotPwRequest                   $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgotPwExecute(ForgotPwRequest $request)
    {
        $request->session()->regenerateToken();

        $input = $request->validated();

        // 管理者情報を取得
        $admin = DB::table('admins')
            ->where('email', $input['email'])
            ->whereNotNull('activated_at')
            ->whereNull('terminated_at')
            ->whereNull('deleted_at')
            ->first();

        // レコードがなければ何もせず完了画面へ（攻撃者に対しヒントを与えないよう、メールアドレスが間違っているとは伝えない）
        if (! $admin) {
            return redirect()->route('officeForgotPwComplete');
        }

        // 設定用トークンを発行（有効期限72時間）
        $token = Utils::makeRandomStr();
        $url = URL::temporarySignedRoute('officeSetPwInput', Carbon::now()->addHours(72), ['token' => $token]);

        try {
            DB::beginTransaction();

            // adminsを更新
            DB::table('admins')->where('id', $admin->id)->update(['remember_token' => $token]);

            // メール通知
            Mail::to($admin->email)->send(new ForgotPwMail('【OBfall】パスワードの設定依頼受付のお知らせ', ['admin' => $admin, 'url' => $url]));

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeForgotPwInput')->withInput($input)->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");
            return redirect()->route('officeForgotPwInput')->withInput($input)->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeForgotPwComplete');
    }

    /**
     * パスワードを忘れたら（完了）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function forgotPwComplete(Request $request)
    {
        $assign = [];

        return view('office/auth/forgot/pw/complete', compact('assign'));
    }

    /**
     * パスワード設定（入力）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function setPwInput(Request $request)
    {
        if (! session('token')) {
            if (! $request->token) {
                return redirect()->route('officeForgotPwInput')->with('error', '無効なURLです。');
            }

            session(['token' => $request->token]);

            if (! session('hasValidSignature')) {
                if (! $request->hasValidSignature()) {
                    return redirect()->route('officeForgotPwInput')->with('error', '期限切れURLです。');
                }

                session(['hasValidSignature' => true]);
            }
        }

        // 管理者情報を取得
        $admin = DB::table('admins')
            ->where('remember_token', $request->token ?? session('token'))
            ->whereNull('terminated_at')
            ->whereNull('deleted_at')
            ->first();
        if (! $admin) {
            $request->session()->forget(['token', 'hasValidSignature']);
            $request->session()->save();

            return redirect()->route('officeForgotPwInput')->with('error', '無効なURLです。');
        }

        session(['admin' => $admin]);

        $assign = [];

        return view('office/auth/set/pw/input', compact('assign'));
    }

    /**
     * パスワード設定（処理）
     *
     * @param  SetPwRequest                      $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPwExecute(SetPwRequest $request)
    {
        if (! session('token') || ! session('admin')) {
            return redirect()->route('officeForgotPwInput');
        }

        $request->session()->regenerateToken();

        $input = $request->validated();

        try {
            DB::beginTransaction();

            // adminsを更新
            DB::table('admins')->where('id', session('admin')->id)->where('remember_token', session('token'))->update([
                'password'       => Hash::make($input['password']),
                'remember_token' => null,
                'activated_at'   => Carbon::now(),
            ]);

            // メール通知
            Mail::to(session('admin')->email)->send(new SetPwMail('【OBFall】パスワード変更完了のお知らせ', ['admin' => session('admin')]));

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeSetPwInput')->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");
            return redirect()->route('officeSetPwInput')->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeSetPwComplete');
    }

    /**
     * パスワード設定（完了）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function setPwComplete(Request $request)
    {
        $assign = [];

        $request->session()->flush();

        return view('office/auth/set/pw/complete', compact('assign'));
    }


    /**
     * ログイン（入力）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function loginInput(Request $request)
    {
        $assign = [];

        return view('office/auth/login/input', compact('assign'));
    }

    /**
     * ログイン（処理）
     *
     * @param  LoginRequest                      $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginExecute(LoginRequest $request)
    {
        $request->session()->regenerateToken();

        $input = $request->validated();

        // ログイン試行回数チェック
        if (session('blocked') && Carbon::now()->lt(session('blocked'))) {
            return redirect()->route('officeLoginInput')->withInput($input)->withError('ログインが制限されました。時間をおいて再度お試しください。');
        }

        // システムリリース時の初期管理者の場合、IDPWをリセットさせる
        $firstAdmin = DB::table('admins')
            ->where('email', $input['email'])
            ->whereNull('activated_at')
            ->whereNull('terminated_at')
            ->whereNull('deleted_at')
            ->first();

        if ($firstAdmin && Hash::check($input['password'], $firstAdmin->password)) {
            session(['firstAdmin' => $firstAdmin]);

            // 初期アカウント設定ページ
            return redirect()->route('officeInitInput');
        }

        // 通常時
        $admin = DB::table('admins')
            ->where('email', $input['email'])
            ->whereNotNull('activated_at')
            ->whereNull('terminated_at')
            ->whereNull('deleted_at')
            ->first();

        // ログインロックチェック
        if ($admin && $admin->login_locked_at) {
            $lockedAt = Carbon::parse($admin->login_locked_at);

            // ロック時間が1時間を超えている場合、ロック解除
            if (Carbon::now()->gte($lockedAt->addHour())) {
                DB::table('admins')->where('id', $admin->id)->update(['login_locked_at' => null,]);
                session(['attempts' => 0]);
            } else {
                // 1時間以内ならロックメッセージを表示
                return redirect()->route('officeLoginInput')->withInput($input)->withError('ご利用のアカウントは、何度もログインに失敗したため一時的にロックされました。1時間経ってからもう一度ログインしてください。');
            }
        }

        // ログイン成功時
        if ($admin && Hash::check($input['password'], $admin->password)) {
            // ログイン
            Auth::guard('office')->loginUsingId($admin->id);

            // ※メール認証を行う場合は以下をコメントイン
            // $onetimeKey = Utils::makeRandomNumber(4, 8);

            // try {
            //     DB::beginTransaction();

            //     // adminsを更新
            //     DB::table('admins')->where('id', $admin->id)->update(['onetime_key' => $onetimeKey, 'remember_token' => null]);

            //     // メール通知
            //     Mail::to($admin->email)->send(new OnetimeKeyMail('【NoaChoice】ワンタイムキー発行のお知らせ', ['admin' => $admin, 'onetimeKey' => $onetimeKey]));

            //     DB::commit();
            // } catch (QueryException $e) {
            //     DB::rollBack();
            //     $params = implode(', ', $e->getBindings());
            //     Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");


            //     return redirect()->route('officeLoginInput')->withInput($input)->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
            // } catch (\Throwable $e) {
            //     DB::rollBack();
            //     Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");

            //     return redirect()->route('officeLoginInput')->withInput($input)->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
            // }

            // session(['admin' => $admin]);

            // // ワンタイムキー入力ページ
            // return redirect()->route('officeOnetimeInput');

            return redirect()->route('officeNewsIndex');
        }

        // ログイン失敗時はログイン試行回数をカウントアップ
        $attempts = session('attempts', 0) + 1;
        session(['attempts' => $attempts]);

        // 5秒間再試行不可
        session(['blocked' => Carbon::now()->addSeconds(5)]);
        // 6回目の入力ミスで処理日時をlogin_locked_atに保存
        if ($admin && $attempts >= 6) {
            DB::table('admins')->where('id', $admin->id)->update([
                'login_locked_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('officeLoginInput')->withInput($input)->withError('ログインに失敗しました。メールアドレスとパスワードが正しいかご確認ください。');
    }

    /**
     * 管理者ワンタイムキー（入力）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function onetimeInput(Request $request)
    {
        $admin = DB::table('admins')
            ->where('email', session('admin')->email ?? 9999)
            ->whereNotNull('activated_at')
            ->whereNull('terminated_at')
            ->whereNull('deleted_at')
            ->first();
        if (! $admin) {
            return redirect()->route('officeLoginInput');
        }

        $assign = [];

        return view('office/auth/login/onetime_key', compact('assign'));
    }

    /**
     * 管理者ワンタイムキー（処理）
     *
     * @param  OnetimeRequest                      $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function onetimeExecute(OnetimeRequest $request)
    {
        if (! session('admin')) {
            return redirect()->route('officeLoginInput')->with('error', 'ログインに失敗しました。同じブラウザでお試しください。');
        }

        $request->session()->regenerateToken();

        $input = $request->validated();

        $admin = DB::table('admins')
            ->where('id', session('admin')->id)
            ->where('onetime_key', $input['onetime_key'])
            ->whereNotNull('activated_at')
            ->whereNull('terminated_at')
            ->whereNull('deleted_at')
            ->first();
        if (! $admin) {
            return redirect()->route('officeLoginInput')->with('error', 'ログインに失敗しました。不正なワンタイムキーです。');
        }

        // 二重ログインを防ぐために一旦ログアウト
        Auth::logout();
        Auth::guard('office')->logout();
        $request->session()->flush();

        try {
            DB::beginTransaction();

            // adminsを更新
            DB::table('admins')->where('id', $admin->id)->update(['onetime_key' => null]);

            // ログイン
            Auth::guard('office')->loginUsingId($admin->id);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeOnetimeInput')->withInput($input)->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");
            return redirect()->route('officeOnetimeInput')->withInput($input)->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeNewsIndex');
    }

    /**
     * ログアウト
     *
     * @param  Request                           $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Auth::guard('office')->logout();
        $request->session()->flush();

        return redirect()->route('officeLoginInput')->with('success', 'ログアウトしました。');
    }
}
