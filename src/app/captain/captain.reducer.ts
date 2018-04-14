import {Action, ActionReducer} from "@ngrx/store";
import {BUZZ_IN, BUZZ_OFF, SCORE, FINAL, CaptainOrder} from "../shared/classes/captain.order";


export const CaptainReducer: ActionReducer<any> = (state = [], action: CaptainOrder) => {
	switch(action.type) {
		case BUZZ_IN:
			return state;
		case BUZZ_OFF:
			return state;
		case SCORE:
			if(state.id === action) {
				return Object.assign({}, state, {leaderboard: action.payload});
			}
		case FINAL:
			return state;
		default:
			return state;
	}
};