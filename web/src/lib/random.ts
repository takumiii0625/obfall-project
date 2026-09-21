import { randomInt } from "node:crypto";

/**
 * 現行 Utils::makeRandomStr の移植: 英数字（62種）で長さ min〜max のランダム文字列。
 * 現行は mt_rand / rand だが、トークン用途なので crypto.randomInt を使う。
 */
const CHARACTERS = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

export function makeRandomStr(min = 10, max = 100): string {
  const length = randomInt(min, max + 1);
  let out = "";
  for (let i = 0; i < length; i++) {
    out += CHARACTERS[randomInt(0, CHARACTERS.length)];
  }
  return out;
}
