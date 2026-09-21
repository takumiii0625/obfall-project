/**
 * 管理画面のメッセージ（現行 office/parts/item/alert.blade.php）。
 * 現行はセッションの success / error を表示。移行後は呼び出し側が値を渡す。
 */
type Props = {
  success?: string | null;
  error?: string | null;
};

export default function OfficeAlert({ success, error }: Props) {
  if (!success && !error) return null;
  return (
    <div className="row pb-3">
      <div className="col-12">
        {success ? (
          <p className="alert alert-success p-1 text-break" role="alert">
            {success}
          </p>
        ) : null}
        {error ? (
          <p className="alert alert-danger p-1 text-break" role="alert">
            {error}
          </p>
        ) : null}
      </div>
    </div>
  );
}
