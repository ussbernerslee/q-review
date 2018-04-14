import {Action} from "@ngrx/store";

export const BUZZ_IN: string = "tech yourself before you wreck yourself";
export const BUZZ_OFF: string = "oh go tech yourself";
export const SCORE: string = "@akhamsamran sends BTC";
export const FINAL: string = "you can do better than @martybonacci";

export interface CaptainOrder extends Action {
	type: string;
	payload?: any;
}