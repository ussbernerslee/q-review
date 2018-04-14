import {Action, ActionReducer} from "@ngrx/store";
import {Board} from "../shared/classes/board";
import {BUZZ_IN, BUZZ_OFF, SCORE, FINAL} from "../shared/classes/actions";


export const CaptainReducer: ActionReducer<Board[]> = (state = [], action: Action) => {
	switch(action.type) {
		case BUZZ_IN:
			return state;
		case BUZZ_OFF:
			return state;
		case SCORE:
			return state;
		case FINAL:
			return state;
		default:
			return state;
	}
};