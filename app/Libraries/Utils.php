<?php

namespace App\Libraries;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Utils
{
    /**
     * 表示件数の選択肢を返す
     *
     * @param mixed
     * @return int
     */
    public static function perPage($perPage, $default = 50)
    {
        $perPage = intval($perPage);
        return ($perPage >= 20 && $perPage <= 300) ? $perPage : $default;
    }

    /**
     * 500エラーが発生した場合、ログファイル名を変更する。
     *
     * @param  string $msg
     * @return void
     */
    public static function stopLog($msg = '500エラーが発生しました。'): void
    {
        // エラー内容をログに記録
        Log::error($msg);

        // ログファイルの名前を変更
        $logDir = storage_path('logs/' . request()->getHost());
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $today = Carbon::now()->format('Y-m-d');
        if (file_exists("{$logDir}/laravel-{$today}.log")) {
            rename("{$logDir}/laravel-{$today}.log", "{$logDir}/500_{$timestamp}.log");
        }

        return;
    }

    /**
     * $min以上$max以下のランダム文字列を返す
     *
     * @param  int    $min
     * @param  int    $max
     * @return string
     */
    public static function makeRandomStr($min = 10, $max = 100): string
    {
        $length = mt_rand($min, $max);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomStr = '';
        for ($i = 0; $i < $length; $i++) {
            $randomStr .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomStr;
    }

    /**
     * $min以上$max以下のランダム数字を返す
     *
     * @param  int    $min
     * @param  int    $max
     * @return string
     */
    public static function makeRandomNumber($min = 10, $max = 100): string
    {
        $length = mt_rand($min, $max);
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomStr = '';
        for ($i = 0; $i < $length; $i++) {
            $randomStr .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomStr;
    }

    /**
     * 指定されたURLのパスを返す
     *
     * @return string
     */
    public static function urlToPath($url): string
    {
        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);

        return $query ? "{$path}?{$query}" : $path ?? '';
    }

    /**
     * 指定された範囲の数字配列を返す
     *
     * @return array
     */
    public static function rangeNumber($start, $end): array
    {
        $data = [];
        for ($i = $start; $i <= $end; $i++) {
            $data[$i] = $i;
        }

        return $data;
    }

    /**
     * 指定された範囲の数字配列を単位とともに返す
     *
     * @return array
     */
    public static function rangeNumberWithUnit($start, $end, $unit): array
    {
        $data = [];
        for ($i = $start; $i <= $end; $i++) {
            $data[$i] = "{$i}{$unit}";
        }

        return $data;
    }

    /**
     * date('Y-m-d')にフォーマットした値を返す
     * デリミターがあればハイフンの代わりに使用する
     *
     * @return string|null
     */
    public static function dateToYmd($date, $delimiter = '-'): string|null
    {
        return $date ? date("Y{$delimiter}m{$delimiter}d", strtotime($date)) : null;
    }

    /**
     * date('Y年m月d日')にフォーマットした値を返す
     *
     * @return string|null
     */
    public static function dateToYmdJa($date): string|null
    {
        return $date ? date('Y年m月d日', strtotime($date)) : null;
    }

    /**
     * date('Y年n月j日')にフォーマットした値を返す
     *
     * @return string|null
     */
    public static function dateToYnjJa($date): string|null
    {
        return $date ? date('Y年n月j日', strtotime($date)) : null;
    }

    /**
     * date('Y-m-d H:i:s')にフォーマットした値を返す
     * デリミターがあれば使用する
     *
     * @return string|null
     */
    public static function dateToYmdHis($date, $delimiter1 = '-', $delimiter2 = ':'): string|null
    {
        return $date ? date("Y{$delimiter1}m{$delimiter1}d H{$delimiter2}i{$delimiter2}s", strtotime($date)) : null;
    }

    /**
     * date('Y年n月j日 G時i分s秒')にフォーマットした値を返す
     *
     * @return string|null
     */
    public static function dateToYnjGisJa($date): string|null
    {
        return $date ? date('Y年n月j日 G時i分s秒', strtotime($date)) : null;
    }

    /**
     * 指定した日付の翌年の前日をdate('Y-m-d')にフォーマットした値を返す
     *
     * @return string|null
     */
    public static function nextYearPreviousDate($date): string|null
    {
        if (! $date) {
            $date = date('Y-m-d');
        }

        // 不正な日付フォーマットの場合は処理日を使う
        if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            $date = date('Y-m-d', strtotime($date));
        }

        list($year, $month, $day) = explode('-', $date);

        // 不正な日付の場合は処理日を使う
        if (! checkdate($month, $day, $year)) {
            $date = date('Y-m-d', strtotime($date));
        }

        $dateTime = new \DateTime($date);

        return $dateTime->modify('+1 year')->modify('-1 day')->format('Y-m-d');
    }

    /**
     * スペースなどすべて削除
     *
     * @return string
     */
    public static function allTrim($string): string
    {
        // BOMを削除（文字列の先頭のみ）
        $string = preg_replace('/^\xEF\xBB\xBF/', '', $string);

        // 全角・半角スペースを両端から削除
        return preg_replace('/^[\s　]+|[\s　]+$/u', '', $string);
    }

    /**
     * 郵便番号をハイフン区切りにして返す
     *
     * @return string
     */
    public static function zipWithHyphen($zipWithoutHypen): string
    {
        $zip1 = substr($zipWithoutHypen, 0, 3);
        $zip2 = substr($zipWithoutHypen, 3);

        return "{$zip1}-{$zip2}";
    }

    /**
     * アップロード可能なファイルか拡張子チェック
     *
     * @param  string $extension
     * @return bool
     */
    public static function isAllowedExtension($extension): bool
    {
        return in_array(strtolower($extension), ['csv', 'gif', 'html', 'jpeg', 'jpg', 'pdf', 'png', 'webp']);
    }

    /**
     * アップロード可能なファイルかサイズチェック
     *
     * @return bool
     */
    public static function uploadSize($size): bool
    {
        return ($size >= 2048000) ? false : true;
    }

    /**
     * S3から取得したファイルパスを返す
     *
     * @return array
     */
    public static function getS3FilePath($uri)
    {
        return Storage::disk('s3')->url($uri);
    }

    /**
     * S3から取得したファイルを返す
     *
     * @return array
     */
    public static function getS3File($uri)
    {
        return Storage::disk('s3')->get($uri);
    }

    /**
     * S3のファイルを削除する
     *
     * @return array
     */
    public static function deleteS3File($uri)
    {
        return Storage::disk('s3')->delete($uri);
    }

    /**
     * メール送信する
     * アカウント登録していないメールアドレスでも送信可能
     *
     * @param  array      $info メール情報
     * @param  array|null $rep  置換情報
     * @return bool
     * @throws Exception
     */
    public static function sendmail(array $info, ?array $rep = null): bool
    {
        // 必須パラメータのバリデーション
        $requiredParams = ['to', 'subject', 'body', 'fromName', 'fromMail'];
        foreach ($requiredParams as $param) {
            if (! isset($info[$param]) || empty($info[$param])) {
                throw new \Exception("Missing required parameter: {$param}");
            }
        }

        // メールアドレスのバリデーション
        if (! filter_var($info['to'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email address: {$info['to']}");
        }

        // メール本文の取得と置換
        $body = file_get_contents(resource_path() . "/views/emails/{$info['body']}.txt");
        if (is_array($rep) && !empty($rep)) {
            $body = str_replace(array_keys($rep), array_values($rep), $body);
        }

        // 日本語対応のためのエンコーディング
        $subject = mb_encode_mimeheader($info['subject'], 'UTF-8', 'B');
        $body = chunk_split(base64_encode($body));

        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'Content-Transfer-Encoding: base64',
            'From: ' . mb_encode_mimeheader($info['fromName'], 'UTF-8', 'B') . " <{$info['fromMail']}>",
            'Reply-To: ' . $info['fromMail'],
        ];

        if (! empty($info['cc'])) {
            $headers[] = 'Cc: ' . $info['cc'];
        }

        if (! empty($info['bcc'])) {
            $headers[] = 'Bcc: ' . $info['bcc'];
        }

        // メール送信
        $result = mb_send_mail($info['to'], $subject, $body, implode("\r\n", $headers));

        if (! $result) {
            throw new \Exception('Failed to send email: ' . error_get_last()['message']);
        }

        return $result;
    }

    /**
     * CURLを実行する
     *
     * @param  string $params['path']   'example.com/users'
     * @param  string $params['method'] HTTP method (GET, POST, etc.)
     * @param  array  $params['input']  ['key' => 'value']
     * @return array
     */
    public static function curl($params): array
    {
        $curl = curl_init();

        $url = 'https://' . config('app.env_domain') . $params['path'];
        $method = $params['method'] ?? 'POST';

        $options = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_SSL_VERIFYPEER => config('app.env') === 'production', // 本番環境でのみSSL検証を有効に
        ];

        if (config('app.env') !== 'production') {
            $options[CURLOPT_SSL_VERIFYHOST] = 0; // 開発環境ではホスト名の検証も無効に
        }

        if ($method === 'POST') {
            $options[CURLOPT_POSTFIELDS] = $params['input'];
        } elseif ($method === 'GET' && !empty($params['input'])) {
            $url .= '?' . http_build_query($params['input']);
            $options[CURLOPT_URL] = $url;
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            return ['status' => 500, 'error' => $error, 'data' => []];
        }

        if (! $response) {
            return ['status' => 500, 'data' => []];
        }

        $decodedResponse = ['status' => 200, 'data' => json_decode($response, true)];

        return $decodedResponse ?: ['status' => 500, 'error' => 'Invalid JSON response', 'data' => []];
    }

    /**
     * 西暦→和暦変換
     * Utils::toWareki('EX年m月d日') : 令和06年09月01日
     * Utils::toWareki('e.x.n.j') : 令.6.9.1
     *
     * @param  string $format 'K':元号
     *                        'k':元号略称
     *                        'Q':元号(英語表記)
     *                        'q':元号略称(英語表記)
     *                        'X':和暦年(前ゼロ表記)
     *                        'x':和暦年
     * @param  string $time 変換対象となる日付(西暦)
     * @return string $result 変換後の日付(和暦)
     */
    public static function toWareki($format, $time = 'now')
    {
        $eras = [
            ['jp' => '令和', 'en' => 'Reiwa', 'start' => '2019-05-01'], // 令和(2019年5月1日〜)
            ['jp' => '平成', 'en' => 'Heisei', 'start' => '1989-01-08'], // 平成(1989年1月8日〜)
            ['jp' => '昭和', 'en' => 'Showa', 'start' => '1926-12-25'], // 昭和(1926年12月25日〜)
            ['jp' => '大正', 'en' => 'Taisho', 'start' => '1912-07-30'], // 大正(1912年7月30日〜)
            ['jp' => '明治', 'en' => 'Meiji', 'start' => '1873-01-01'], // 明治(1873年1月1日〜) ※明治5年以前は旧暦を使用していたため、明治6年以降から対応
        ];

        $datetime = new \DateTime($time);
        $year = $datetime->format('Y');

        foreach ($eras as $era) {
            $eraStart = new \DateTime($era['start']);
            if ($datetime >= $eraStart) {
                $eraYear = $year - $eraStart->format('Y') + 1;
                $eraNameJp = $era['jp'];
                $eraNameEn = $era['en'];
                break;
            }
        }

        $result = strtr($format, [
            'E' => $eraNameJp,
            'e' => mb_substr($eraNameJp, 0, 1),
            'Q' => $eraNameEn,
            'q' => substr($eraNameEn, 0, 1),
            'X' => sprintf('%02d', $eraYear),
            'x' => $eraYear,
        ]);

        return $datetime->format($result);
    }
}
