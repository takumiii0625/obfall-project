import { Fragment } from "react";

/** 現行 Blade の {!! nl2br(e($text)) !!}: エスケープした本文の改行を <br> にする */
export default function Nl2br({ text }: { text: string | null | undefined }) {
  const lines = (text ?? "").split(/\r\n|\r|\n/);
  return (
    <>
      {lines.map((line, i) => (
        <Fragment key={i}>
          {i > 0 ? <br /> : null}
          {line}
        </Fragment>
      ))}
    </>
  );
}
